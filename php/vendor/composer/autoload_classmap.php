<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'api\\Api' => $baseDir . '/src/api.php',
    'inventory\\InventoryApi' => $baseDir . '/src/inventory/InventoryApi.php',
    'inventory\\InventoryDB' => $baseDir . '/src/inventory/InventoryDB.php',
    'inventory\\Product' => $baseDir . '/src/inventory/Product.php',
    'utils\\Communication' => $baseDir . '/src/utils/Communication.php',
    'utils\\Config' => $baseDir . '/src/utils/Config.php',
    'utils\\DbTable' => $baseDir . '/src/utils/DbTable.php',
    'utils\\exceptions\\ArgumentException' => $baseDir . '/src/utils/exceptions/ArgumentException.php',
    'utils\\exceptions\\Error' => $baseDir . '/src/utils/exceptions/Error.php',
    'utils\\exceptions\\InventoryException' => $baseDir . '/src/utils/exceptions/InventoryException.php',
    'utils\\exceptions\\ItemNotFoundException' => $baseDir . '/src/utils/exceptions/ItemNotFoundException.php',
);
