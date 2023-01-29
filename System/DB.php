<?php

namespace System;

use Exception;
use RedBeanPHP\R;

class DB {
    protected static $instance;

    public static function getInstance() {
        if (static::$instance === null) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    protected function __construct() {

        $config = require_once('config/config_db.php');
        R::setup($config['dsn'], $config['user'], $config['password'], true);

        if (!R::testConnection()) {
            throw new Exception("SQL Setup Error", 500);
        }

        if (DEBUG) {
            R::debug(true, 3);
        }

        R::ext('xdispense', function ($type) {
            return R::getRedBean()->dispense($type);
        });
    }
}


/*

    
    
public function select(string $query, array $params = []) : ?array {
        return $this->query($query, $params)->fetchAll();
    }

    public function query(string $query, array $params = []) : PDOStatement {
        $query = $this->db->prepare($query);
        $query->execute($params);

        $errorInfo = $query->errorInfo();

        if ($errorInfo[0] !== PDO::ERR_NONE) {
            throw new Exception("SQL Error {$errorInfo[2]}");
            
        }

        return $query;
    }
    
    public function lastInsertId() : int{
		return (int)$this->db->lastInsertId();
	}

*/