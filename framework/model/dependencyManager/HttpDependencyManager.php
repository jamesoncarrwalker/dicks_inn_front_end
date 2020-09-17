<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 11/04/2020
 * Time: 06:35
 */

namespace model\dependencyManager;



use abstractClass\AbstractObjectManager;
use enum\ConfigSectionEnum;
use interfaces\ConfigInterface;
use interfaces\DependencyManagerInterface;
use interfaces\FileParseInterface;
use model\helper\DumpVars;


class HttpDependencyManager extends AbstractObjectManager implements DependencyManagerInterface {

    protected $appConfigObject;
    protected $frameworkConfigObject;
    protected $dependenciesListFileReader;
    protected $appDependencyFileLocations;
    protected $frameworkDependencyFileLocations;
    protected $allClassesWithDependenciesList;
    protected $allDependencyFileLocations;
    protected $instantiatedDependenciesArray;

    public function __construct(ConfigInterface $frameworkConfigObject,
                                ConfigInterface $appConfigObject,
                                FileParseInterface $dependenciesListFileReader
    ) {
        $this->frameworkConfigObject = $frameworkConfigObject;
        $this->appConfigObject = $appConfigObject;
        $this->dependenciesListFileReader = $dependenciesListFileReader;
        $this->setDependencyFilePaths();
    }

    public function getAllClassesWithDependenciesList() :array {

        if(!isset($this->allClassesWithDependenciesList)) {

            if(!isset($this->appDependencyFileLocations) || !isset($this->frameworkDependencyFileLocations)) {
                $this->setDependencyFilePaths();
            }

            $this->setAllFileLocationsArray();

            $this->setClassesWithDependenciesList();

        }

        return $this->allClassesWithDependenciesList ?? [];
    }

    public function getDependenciesListForClass(string $classNameToLookFor) :array {
       return $this->hasDependencies($classNameToLookFor) ? ($this->allClassesWithDependenciesList[$classNameToLookFor][ConfigSectionEnum::DEPENDENCY]??[]) : [];
    }

    public function hasDependencies(string $classToLookFor) :bool {
        if(!isset($this->allClassesWithDependenciesList)) {
            $this->setClassesWithDependenciesList();
        }

        return  isset($this->allClassesWithDependenciesList[$classToLookFor][ConfigSectionEnum::DEPENDENCY] ) ||
                isset($this->allClassesWithDependenciesList[$classToLookFor][ConfigSectionEnum::EXTENDS] )
            ;
    }

    public function getParentClassFqn(string $classToLookFor) {
        if(!isset($this->allClassesWithDependenciesList)) {
            $this->setClassesWithDependenciesList();
        }

        return  $this->allClassesWithDependenciesList[$classToLookFor][ConfigSectionEnum::EXTENDS]??false;
    }


    public function getDependencies(string $classNameToGetDependenciesFor) :array {

        //is the class registered in the dependencies config
        if (!$this->hasDependencies($classNameToGetDependenciesFor)) {
            return [];
        }


        if(!$dependencyRegistration = $this->getDependencyRegistration($classNameToGetDependenciesFor)) {
            return [];
        }

        //if the class being called is a singleton and already exists there is an error
        //so kill the script
        if($this->isSingletonDependency($dependencyRegistration) && isset($this->instantiatedDependenciesArray[$classNameToGetDependenciesFor])) {
            throw new \Exception('The singleton class ' . $classNameToGetDependenciesFor . ' has already been instantiated');
        }
        $returnDependenciesArray = [];

        //if are we extending from a parent object don't forget to grab them
        if($parentFQN = $dependencyRegistration['EXTENDS'] ?? false) {
            $returnDependenciesArray = $this->getDependencies($parentFQN);
        }
        //loop through the dependency list entries
        foreach($this->getDependenciesListForClass($classNameToGetDependenciesFor) ??[] as $dependencyListEntry) {
            //check the type e.g. Obj, str, int etc
            $dependencyType = $dependencyListEntry['TYPE'] ?? 'OBJECT';
            if($dependencyType !== 'OBJECT') {
                $returnDependenciesArray[] = $this->getVariableDependency($dependencyListEntry);
            } else {

                $dependencyFQN = $dependencyListEntry['VALUE'];
                //does our dependency have it's own registration? - if not create it
                if(!$dependencyEntryRegistration = $this->getDependencyRegistration($dependencyFQN)) {
                       $returnDependenciesArray[] = new $dependencyFQN();
                    //there is no registration so it's not specified as a singleton, so no need to save
                } else {
                    if($this->isSingletonDependency($dependencyEntryRegistration)) {

                        //if it is a singleton check if it's already instantiated
                        if(isset($this->instantiatedDependenciesArray[$dependencyFQN])) {
                            //if if is, then pull the object out of the array and save it
                            $returnDependenciesArray[] = $this->instantiatedDependenciesArray[$dependencyFQN];
                        } else {
                            //otherwise create it and start the recursion!

                            //check if our dependency extends from somewhere
                            if($extends = $dependencyListEntry['EXTENDS'] ?? false) {
                                $parentDependencies = $this->getDependencies($extends);
                            } else {
                                $parentDependencies = [];
                            }
                            $instantiatedDependency = new $dependencyFQN(...array_merge($parentDependencies,$this->getDependencies($dependencyFQN)));
                            $this->instantiatedDependenciesArray[$dependencyFQN] = $instantiatedDependency;
                            $returnDependenciesArray[] = $this->instantiatedDependenciesArray[$dependencyFQN];
                        }
                    } else {
                        //check if our dependency extends from somewhere
                        if($extends = $dependencyListEntry['EXTENDS'] ?? false) {
                            $parentDependencies = $this->getDependencies($extends);
                        } else {
                            $parentDependencies = [];
                        }

                        //otherwise just create a new one and don't save it
                        $returnDependenciesArray[] = new $dependencyFQN(...array_merge($parentDependencies,$this->getDependencies($dependencyFQN)));
                    }
                }

            }
        }
        return $returnDependenciesArray;
    }

    public function getDependencyRegistration(string $classNameToLookFor) {
        if(!isset($this->allClassesWithDependenciesList)) {
            $this->setClassesWithDependenciesList();
        }

        return $this->allClassesWithDependenciesList[$classNameToLookFor] ?? null;
    }


    private function setDependencyFilePaths() {
        if(!isset($this->appDependencyFileLocations)) {
            $this->appDependencyFileLocations =  $this->appConfigObject->getConfigPaths()[ConfigSectionEnum::DEPENDENCY] ?? [];
        }

        if(!isset($this->frameworkDependencyFileLocations)) {
            $this->frameworkDependencyFileLocations =  $this->frameworkConfigObject->getConfigPaths()[ConfigSectionEnum::DEPENDENCY] ?? [];
        }
    }

    private function setAllFileLocationsArray() {

        if(!isset($this->allDependencyFileLocations)) {
            $this->setDependencyFilePaths();
        }

        $this->allDependencyFileLocations = array_values(
            array_merge($this->frameworkDependencyFileLocations, $this->appDependencyFileLocations)
        );
    }

    private function setClassesWithDependenciesList() {
        if(!isset($this->allDependencyFileLocations)) {
            $this->setAllFileLocationsArray();
        }

        foreach($this->allDependencyFileLocations as $fileLocation) {
            $this->dependenciesListFileReader->setFile($fileLocation);

            $dependenciesList = $this->dependenciesListFileReader->parseFile();
            if($dependenciesList) {

                if(is_array($this->allClassesWithDependenciesList)) {
                    $this->allClassesWithDependenciesList = array_merge($this->allClassesWithDependenciesList,$dependenciesList);
                } else {
                    $this->allClassesWithDependenciesList = $dependenciesList;
                }
            }
        }

    }

    public function addInstantiatedDependency(string $name, $value) {
        $this->instantiatedDependenciesArray[$name] = $value;
    }




    private function isSingletonDependency($dependencyRegistration) :bool {
        return
            (isset($dependencyRegistration['SINGLETON']) && $dependencyRegistration['SINGLETON'] === true) ||
            (isset($dependencyRegistration['CONTROLLER']) && $dependencyRegistration['CONTROLLER'] === true);
    }

    private function getVariableDependency($dependency) {
        $variableValue = null;

        foreach($dependency['VALUE']??[] as $key => $value) {
            switch($key) {
                case 'SERVER_KEY':
                    $variableValue = $_SERVER[$value] ?? null;
                    break;
                case 'REQUEST_KEY':
                    $variableValue = $_REQUEST[$value] ?? null;
                    break;
                case "OBJECT_METHOD":
                    $objectFQN = $value['OBJECT'];
                    $object = new $objectFQN(...$this->getDependencies($objectFQN));
                    $variableValue = $object->{$value['METHOD']}();
                    break;
                case "INT" :
                    $variableValue = abs($value);
                    break;
                case "STR":
                    $variableValue = $value . "";
                    break;
                case "DEPENDENCY":
                    $variableValue = $this->instantiatedDependenciesArray[$value] ?? null;
                    break;
            }
        }

        return $variableValue ?? $dependency['DEFAULT'];
    }
}