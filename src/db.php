<?php
class Database {
    private $serverName;
    private $connectionOptions;

    public function __construct() {
        $this->serverName = getenv('DB_SERVER');
        $this->connectionOptions = [
            "Database" => getenv('DB_NAME'),
            "Uid" => getenv('DB_USER'),
            "PWD" => getenv('DB_PASSWORD')
        ];
    }

    public function getConnection() {
        $conn = sqlsrv_connect($this->serverName, $this->connectionOptions);
        if ($conn === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        return $conn;
    }
}
