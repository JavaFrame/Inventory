<?php
namespace utils;

/**
 * Class: Communication
 * Handels the communication between the server and the client.
 *
 */
class Communication {
    private static $data = array();
    private static $error = array();
    /**
     * error
     * Adds an error entry
     *
     * @param int $errorCode the error code of the  error
     * @param string $errorMsg the message of the error
     */
    static function error(int $errorCode, string $errorMsg, string $ex = null) {
        self::$error = array("type" => "error", "code" => $errorCode, "msg" => $errorMsg,
            "ex" => $ex);
    }

    /**
     * data
     *
     * @param mixed $data the data content which should be sent
     */
    static function data($data) {
        self::$data = array("type" => "data", "data" => $data);
    }

    /**
     * toJsonString
     * generates a json string from the recorded data and error entries
     */
    static function toJsonString()  {
        if(self::$error != null)
            return json_encode(self::$error);
        return json_encode(self::$data);
    }
}
