<?php

function customErrorHandler(int $errorLevel, string $errorMessage,string $file, string $line) {
    echo '<h2 style="text-align: center">Something went wrong there...</h2>';
    echo '<p>You created an ' . getErrorType($errorLevel) . ' error.  <small>(Whoops!)</small></p>';
    echo 'You probably want to know what happened, well PHP said: </br>
            <pre>' . $errorMessage . '</pre>';
    echo 'Enlightening, eh?.  This happened in:
            </br> <strong>' . $file . '</strong>
            </br> on line:
            </br>' . $line . '</p></br>';
    echo '<p>Hope that helps....';

    return true;

}

function customExceptionHandler($e) {
    $root = $_SERVER['DOCUMENT_ROOT'];
    $file = $e->getFile();
    echo '<head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            <link rel="stylesheet" href="/css/bootstrap.min.css">
            <title>Uh-oh... </title>
    </head>';
    echo '<style>
            .jumbotron.error-page-header{
                background: #FF5733;
                color:#fff;
                border-bottom-left-radius: 0;
                border-bottom-right-radius: 0;
            },
            .error-detail {
                font-weight: 800;
            }


        </style>';

    echo '<body>';
        echo '<div class="container">
                <div class="row">
                        <div class="container">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center ">
                                <h2 >Something exceptional happened there, <small>(and not in a good way...)</small></h2>
                            </div>
                        </div>
                </div>
            </div>

            <div class="container">

                <div class="jumbotron">
                    <div class="container">

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <p>You tried a <span class="error-detail">' . $e->getMessage() . '</span> <small>(Whoops!)</small></p>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <p>You probably want to know where, well PHP said:
                                <ul>
                                    <li>The file was: <span class="error-detail">' .substr($file,strlen($root))  . '</span></li>
                                    <li>Line <span class="error-detail">' . $e->getLine() . '</span></li>
                                </ul>
                            </p>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <p>This is what you did...';
                            echo '<ol>';
                            $stackTrace = array_reverse($e->getTrace());
                            foreach($stackTrace as $key => $li){

                                echo '<li>';
                                    if($key == 0) {
                                        echo 'You called ';
                                    } else if ($key == count($stackTrace)-1) {
                                        echo 'And finally tried ';
                                    } else {
                                        echo 'And then ';
                                    }
                                    $traceFile = substr($li['file'],strlen($root)) ;
                                    echo '<span class="error-detail">' . $li['class'] . '::' . $li['function'] . '</span>';
                                    echo '<ul>';
                                        echo'<li>From ' . $traceFile . '</li>';
                                        echo'<li>Line ' . $li['line'] . '</li>';
                                    echo '</ul>';
                                echo '</li>';
                            };
                            echo '</ol>';
                      echo '</p>
                        </div>

                    </div>
                </div>
          </div>';
    echo '</body>';
    return true;
}

function check_for_fatal()
{
    $error = error_get_last();
    if ( $error["type"] == E_ERROR ) {
        customErrorHandler( $error["type"], $error["message"], $error["file"], $error["line"]);
    }
}

function getErrorType(int $errorLevel) {
    switch($errorLevel)
    {
        case E_ERROR: // 1 //
            return 'E_ERROR';
        case E_WARNING: // 2 //
            return 'E_WARNING';
        case E_PARSE: // 4 //
            return 'E_PARSE';
        case E_NOTICE: // 8 //
            return 'E_NOTICE';
        case E_CORE_ERROR: // 16 //
            return 'E_CORE_ERROR';
        case E_CORE_WARNING: // 32 //
            return 'E_CORE_WARNING';
        case E_COMPILE_ERROR: // 64 //
            return 'E_COMPILE_ERROR';
        case E_COMPILE_WARNING: // 128 //
            return 'E_COMPILE_WARNING';
        case E_USER_ERROR: // 256 //
            return 'E_USER_ERROR';
        case E_USER_WARNING: // 512 //
            return 'E_USER_WARNING';
        case E_USER_NOTICE: // 1024 //
            return 'E_USER_NOTICE';
        case E_STRICT: // 2048 //
            return 'E_STRICT';
        case E_RECOVERABLE_ERROR: // 4096 //
            return 'E_RECOVERABLE_ERROR';
        case E_DEPRECATED: // 8192 //
            return 'E_DEPRECATED';
        case E_USER_DEPRECATED: // 16384 //
            return 'E_USER_DEPRECATED';
    }
}


register_shutdown_function( "check_for_fatal" );
set_error_handler('customErrorHandler');
set_exception_handler('customExceptionHandler');