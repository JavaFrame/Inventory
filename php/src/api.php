<?php
namespace api;
require __DIR__ . "/../vendor/autoload.php";


use utils\Communication;
use utils\exceptions\ArgumentException;
use utils\exceptions\Error;
use utils\exceptions\InventoryException;

function errorHandler($code, $msg, $file, $line) {
    Communication::error(Error::$GENERAL_ERROR, "$file:$line ($code) $msg");
}

function shutdownHandler() {
    $lastError = error_get_last();
    if($lastError["type"] === E_ERROR) {
        errorHandler(E_ERROR, $lastError["message"], $lastError["file"], $lastError["line"]);
    }
    ob_clean();
    $json = Communication::toJsonString();
    echo $json;
}

set_error_handler("api\\errorHandler");
register_shutdown_function("api\\shutdownHandler");


(new Api())->handleRequest();

class Api {
    static $nodes = array(
        "info" => ["api\\Api", "test"],
        "getAll" => ["inventory\InventoryApi", "getAll"],
        "get" => ["inventory\InventoryApi", "get"],
        "buy" => ["inventory\InventoryApi", "buy"],
    );

    static function test() {
    }

    /**
     * __construct
     * Creates a new Api object
     *
     */
    function __construct() {
    }

    /**
     * handleRequest
     * Hadels the api request which is gatherd from the getApiRequest() function.
     * The arguments are got by the function getArgs()
     *
     */
    function handleRequest() {
        try {
            $cmd = self::getApiRequest();
            if(!isset(self::$nodes[$cmd]))
                throw new \Exception("Couldn't find node \"$cmd\"");
            $node = self::$nodes[$cmd];

            $args = self::getArgs();

            call_user_func_array($node, $args);
        } catch(\Exception $ex) {
            if($ex instanceof InventoryException) {
                Communication::error($ex->getErrorCode(), $ex->getMsg(), (string) $ex);
            } else {
                Communication::error(Error::$GENERAL_ERROR, $ex->getMessage(), $ex);
            }
        } finally {
            $json = Communication::toJsonString();
            //echo $json;
        }
    }


    /**
     * getApiRequest
     * Extracts the api request from the REQUEST_URI.
     * It normalizes the the request path
     *
     * @return string returns a the request path as string
     */
    function getApiRequest() {
        $requestUri = $_SERVER["REQUEST_URI"];
        $fileName = basename(__FILE__);
        $cmdPos = strpos($requestUri, $fileName) + strlen($fileName);
        $cmd = substr($requestUri, $cmdPos);

        $cmdArr = explode("/", $cmd);
        $cmdArr = array_filter($cmdArr, function($i) {
            return !empty($i);
        });

        $cmd = implode("/", $cmdArr);
        return $cmd;
    }

    /**
     * getArgs
     * Returns the either the post or the get arguments depending on the REQUEST_METHOD.
     *
     */
    function getArgs() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $args = json_decode(file_get_contents("php://input"), true);
            if($args == null)
                throw new ArgumentException("No arguments where sent");
            return $args;
        }
        return $_GET;
    }
}

