<?php

namespace System\Database;

use PDO;
use PDOStatement;

class Connection{
    protected PDO $db;
    protected static $instance;
    
    public static function getInstance() {
        if (static::$instance === null) {
            static::$instance = new static();
        }
        return static::$instance;
    }
    
    protected function __construct() {
        $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, [
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		]);
    }

    public function select(string $query, array $params = []) : ?array {
        return $this->query($query, $params)->fetchAll();
    }

    public function query(string $query, array $params = []) : PDOStatement {
        $query = $this->db->prepare($query);
        $query->execute($params);

        return $query;
    }
}