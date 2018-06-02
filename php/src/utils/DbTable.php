<?php
namespace utils;

/**
 * Class: DbTable
 * Represents a basic interface for interacting with the db
 *
 */
class DbTable {
    private $connection;
    private $db;
    private $table;

    /**
     * __construct
     *
     * @param string $host the hostname of the db
     * @param int $port the port of the db
     * @param string $username the username, with which the server connects to the db
     * @param string $pw the password for the username
     * @param string $db the db name
     * @param string $table the table name
     */
    function __construct(string $host, int $port, string $username, string $pw, string $db, string $table)  {
        $this->db = $db;
        $this->table = $table;
        $this->connection = new \mysqli($host, $username, $pw, $db, $port);
    }

    function querySelect(string $selectQuery) : ?array {
        $result = self::query($selectQuery);
        if($result == false) return array();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function query(string $query) {
        return $this->connection->query($query);
    }

    function getDbName() : string {
        return $this->db;
    }

    function getTableName() : string  {
        return $this->table;
    }

    private static $instance = null;
    /**
     * getInstance
     * Returns an instance of DbTable which uses the values configured in the config.xml file.
     *
     * This instance is lazy evaluated and therfor this funciton only instances the DbTable
     * on the first call and after that returns the same instance
     *
     */
    static function getInstance() : DbTable {
        if(self::$instance == null) {
            $config = Config::getXml();
            $host = (string) $config->db->host;
            $port = (int) $config->db->port;
            $username = (string) $config->db->username;
            $pw = (string) $config->db->pw;
            $db = (string) $config->db->db;
            $table = (string) $config->db->table;
            $instance = new DbTable($host, $port, $username, $pw, $db, $table);
        }
        return $instance;
    }
}
