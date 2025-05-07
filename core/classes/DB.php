<?php

class DB {
    private $conn;
    private $stmt;
    private static $instance = null;

    private function __construct() {
        // private constructor
    }

    // private function __clone() {}
    // public function __wakeup() {}

    public static function getInstance(): DB {
        if(self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(array $db_config): void {
        $dsn = "mysql:host={$db_config['host']};dbname={$db_config['dbname']};charset={$db_config['charset']}";
        try {
            $this->conn = new PDO($dsn, username: $db_config['username'], password: $db_config['password']);
        }
        catch(PDOException $e) {
            abort(code: 500);
        }
    }

    public function query($query, $params = []): bool|DB {
        try {
            $this->stmt = $this->conn->prepare(query: $query);
            $this->stmt->execute(params: $params);
        }
        catch (PDOException $e) {
            return false;
        }
        
        return $this;
    }
    
    public function findAll(): array {
        return $this->stmt->fetchAll();
    }

    public function find(): mixed {
        return $this->stmt->fetch();
    }

    public function findOrAbort(): mixed {
        $res = $this->find();
        
        if(!$res) {
            abort();
        }
        
        return $res;
    }
    
    public function rowCount(): int {
        return $this->stmt->rowCount();
    }

    public function getColumn() {
        return $this->stmt->fetchColumn();
    }
} 