<?php
namespace utils\exceptions;

/**
 * Class: Error
 * Contains all error codes
 */
class Error {
    /**
     * GENERAL_ERROR
     * A general error occures when it cannot be categorized in an other error.
     * This error shouldn't be used, because the client doesn't know the cause and the meaning
     * of the error
     *
     * @var int = 1
     */
    static $GENERAL_ERROR = 1;

    /**
     * WRONG_FIELDS
     * The wrong fields where sent in a request
     *
     * @var int = 2
     */
    static $WRONG_FIELDS = 2;

    /**
     * ARGUMENT_EXCEPTION
     * Either the wrong arguments were sent or they were sent in the wrong format
     *
     * @var int = 3
     */
    static $ARGUMENT_EXCEPTION = 3;

    /**
     * ITEM_NOT_FOUND
     * An item wasn't found in the db
     *
     * @var int
     */
    static $ITEM_NOT_FOUND = 4;
}

