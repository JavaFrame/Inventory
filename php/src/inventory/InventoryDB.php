<?php
namespace inventory;
use utils\DbTable;

class InventoryDB {
    private $table;
    private $columns =
        array("ID", "ProductID", "Name", "Description", "Quantity", "Image", "Price", "Sale");

    function __construct(DbTable $table) {
        $this->table = $table;
    }

    function getAll(int $offset, int $count) : array {
        $query = "SELECT * FROM `" . $this->table->getTableName() . "` LIMIT $offset, $count;";
        $result = $this->table->querySelect($query);
        return array_map(function($row) {
            return self::toProduct($row);
        }, $result);
    }

    function getByProductId(int $productId) : ?Product {
        $query = "SELECT * FROM `" . $this->table->getTableName() . "` WHERE ProductID=$productId;";
        $result = $this->table->querySelect($query);
        if(count($result) == 0) return null;
        return self::toProduct($result[0]);
    }

    function buyProductById(int $productId, int $amount = 1) : bool {
        $query = "UPDATE `" . $this->table->getTableName() .
            "` SET Quantity = Quantity - $amount " .
            "WHERE ProductID=$productId;";
        $result = $this->table->query($query);
        $affectedRows = $this->table->getConnection()->affected_rows;
        return $result && $affectedRows != 0;
    }

    public function getColumns() : array {
        return $this->columns;
    }

    private static function toProduct(array $array) : Product {
        return new Product(
            $array["ID"],
            $array["ProductID"],
            $array["Name"],
            $array["Description"],
            $array["Quantity"],
            $array["Image"],
            $array["Price"],
            $array["Sale"]
        );
    }

    private static $instance;
    public static function getInstance() : InventoryDB {
        if(self::$instance == null) {
            self::$instance = new InventoryDB(DbTable::getInstance());
        }
        return self::$instance;
    }
}
