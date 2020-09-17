<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 11/04/2020
 * Time: 14:22
 */

namespace abstractClass;


use interfaces\FileParseInterface;
use interfaces\FinderInterface;


abstract class AbstractFileReader implements FileParseInterface {

    protected $filePathFinder;

    public function __construct(FinderInterface $filePathFinder) {
        $this->filePathFinder = $filePathFinder;
    }

    public function setFile(string $filePath) {
        $this->filePathFinder->setParams($filePath, null);
    }
}