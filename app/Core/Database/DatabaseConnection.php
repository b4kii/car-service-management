<?php

namespace App\Core\Database;

class DatabaseConnection
{
    public $connection = null;
    public $statement = null;
    
    public function __construct($config)
    {
        $dsn = sprintf("mysql:host=%s;port=%s;dbname=%s;charset=%s", $config['host'], $config['port'], $config['dbname'], $config['charset']);
        $username = $config['username'];
        $password = $config['password'];
        
        try {
            $this->connection = new \PDO($dsn, $username, $password);
        } catch (\PDOException $e) {
            echo "Error during connecting with database: " . $e->getMessage();
            exit();
        }
    }
    
    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);
        return $this;
    }
    
    public function find($mode = \PDO::FETCH_ASSOC)
    {
        return $this->statement->fetch($mode);
    }
    
    public function findAndDie()
    {
        $result = $this->find();
        if (!$result) {
            abort();
        }
        return $result;
    }
    
    public function findAll($mode = \PDO::FETCH_ASSOC)
    {
        return $this->statement->fetchAll($mode);
    }
    
    public function insert(string $table, array $data)
    {
        $columns = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));
        
        $query = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";
        $this->statement->connection->prepare($query);
        
        foreach ($data as $key => $value) {
            $this->statement->bindValue(":{$key}", $value);
        }
        
        $this->statement->execute();
        
        return $this->connection->lastInsertId();
    }
    
}