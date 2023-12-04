<?php

namespace App\Core\Database;

use App\Core\Database\Interfaces\DatabaseConnectionInterface;

class DatabaseConnection implements DatabaseConnectionInterface
{
    public $connection;
    public $statement = null;
    
    public function __construct($config)
    {
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";
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
    
    public function findAll($mode = \PDO::FETCH_ASSOC)
    {
        return $this->statement->fetchAll($mode);
    }
    
    public function insert(string $table, array $data)
    {
        $columns = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));
        
        $query = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";
        $stmt = $this->statement->connection->prepare($query);
        
        $stmt->execute($data);

        return $this->connection->lastInsertId();
    }
    
    public function insertMultiple(string $table, array $columns, array $data)
    {
        $data = array_map(function ($row) use($columns) {
            return array_combine($columns, $row);
        }, $data);

        $placeholders = ":" . implode(", :", $columns);
        $columns = implode(", ", $columns);
        $query = "INSERT INTO {$table} ({$columns}) VALUES ($placeholders)";
        $this->statement = $this->connection->prepare($query);

        foreach ($data as $row)
        {
            $this->statement->execute($row);
        }
    }
    
    public function delete(string $table, string $condition, array $values): bool
    {
        $query = "DELETE FROM {$table} WHERE {$condition}";
        dd($this->query($query, $values));
        return true;
    }
    
    public function deleteAll(string $table): void
    {
        $query = "DELETE FROM {$table}";
        $this->query($query);
    }
    
}