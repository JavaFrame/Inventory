<?php
namespace utils\exceptions;

class InventoryException extends \Exception {
    private $errorCode;
    private $realMsg;

    function __construct(int $errorCode, string $msg, \Throable $previous = null) {
        parent::__construct("($errorCode) $msg", $previous);
        $this->errorCode = $errorCode;
        $this->realMsg = $msg;
    }

    /**
     * Getter for errorCode
     *
     * @return string
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * Getter for msg
     *
     * @return string
     */
    public function getMsg()
    {
        return $this->realMsg;
    }

}

