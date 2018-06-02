<?php

namespace utils\exceptions;

/**
 * Class ArgumentException
 * @author yourname
 */
class ArgumentException extends InventoryException
{
    /**
     * @param mixed $msg
     */
    public function __construct($msg)
    {
        parent::__construct(Error::$ARGUMENT_EXCEPTION, $msg);
    }

}
