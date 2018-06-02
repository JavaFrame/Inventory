<?php
namespace inventory;
use utils\Communication;

class InventoryApi {
    static function getAll(int $offset, int $limit) {
        $result = InventoryDB::getInstance()->getAll($offset, $limit);
        $result = array_map(function($product) {
            return $product->toArray();
        }, $result);
        Communication::data($result);
    }

    static function get(int $productId) {
        $result = InventoryDB::getInstance()->getByProductId($productId);
        Communication::data($result->toArray());
    }

}
