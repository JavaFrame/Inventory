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
    static function error(int $errorCode, string $errorMsg) {
        self::$error[] = array("type" => "error", "code" => $errorCode, "msg" => $errorMsg);
    }

    /**
     * data
     *
     * @param mixed $data the data content which should be sent
     */
    static function data($data) {
        self::$data[] = array("type" => "data", "data" => $data);
    }

    /**
     * toJsonString
     * generates a json string from the recorded data and error entries
     */
    static function toJsonString() : string {
        if(count(self::$data) == 0)
            self::data(array());
        return json_encode(array_merge(self::$data, self::$error));
    }
}
