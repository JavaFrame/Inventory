<?php
namespace inventory;
use utils\Communication;
use utils\exceptions\Error;

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

    static function buy(array $products) {
        $status = array();
        foreach($products as $product) {
            if(!isset($product["id"]) || !isset($product["amount"])) {
                throw new \Exception("An entry in products has to have an id field and an amount field" .
                    "(product: " . print_r($product, true) . ")");
            }
            $result = InventoryDB::getInstance()->buyProductById($product["id"], $product["amount"]);
            if($result == false)
                $status[] = array("id" => $product["id"], "code" => 1, "msg" => "sql failed");
        }
        Communication::data($status);
    }


}
