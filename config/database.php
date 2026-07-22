<?php
/**
 * Database Connection Configuration
 */

class Database {
    private $host = DB_HOST;
    private $db_name = DB_NAME;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $charset = DB_CHARSET;
    private $conn;

    public function connect() {
        $this->conn = null;

        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name . ';charset=' . $this->charset;
        
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
        ];

        try {
            $this->conn = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            error_log('Database Connection Error: ' . $e->getMessage());
            die('Database connection failed. Please try again later.');
        }

        return $this->conn;
    }

    public static function getInstance() {
        static $instance = null;
        if ($instance === null) {
            $instance = new self();
            $instance->connect();
        }
        return $instance->conn;
    }
}

// Initialize database connection
if (!function_exists('getDB')) {
    function getDB() {
        return Database::getInstance();
    }
}
