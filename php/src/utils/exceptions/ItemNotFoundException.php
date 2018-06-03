<?php

namespace utils\exceptions;

/**
 * Class ItemNotFoundException
 * @author yourname
 */
class ItemNotFoundException extends InventoryException
{
    function __construct(int $productId) {
        parent::__construct(Error::$ITEM_NOT_FOUND, "Item \"$productId\" wasn't found in db");
    }
}
