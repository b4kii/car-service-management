<?php

namespace App\Core\Database;

use App\Core\Database\Interfaces\DatabaseInterface;

class Database implements DatabaseInterface
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
    
    public function insertRecord(string $table, array $data): int
    {
        $columns = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));
        
        $query = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";
        $this->statement = $this->connection->prepare($query);

        try {
            $this->statement->execute($data);
        } catch (\PDOException $e) {
            echo "Error while inserting record - {$query}\n{$e->getMessage()} ";
            exit();
        }

        return $this->connection->lastInsertId();
    }
    
    public function insertRecords(string $table, array $columns, array $data): int
    {
        $data = array_map(function ($row) use($columns) {
            return array_combine($columns, $row);
        }, $data);

        $placeholders = ":" . implode(", :", $columns);
        $columns = implode(", ", $columns);
        $query = "INSERT INTO {$table} ({$columns}) VALUES ($placeholders)";
        $this->statement = $this->connection->prepare($query);

        $affectedRows = $this->statement->rowCount();
        
        try {
            foreach ($data as $row)
            {
                $this->statement->execute($row);
                $affectedRows += 1;
            }
        } catch (\PDOException $e) {
            echo "Error while inserting multiple records - {$query}\n{$e->getMessage()} ";
            exit();
        }
        
        return $affectedRows;
    }

    public function updateRecord(string $table, string $condition, string $column, $value): int
    {
        $query = "UPDATE {$table} SET {$column} = '{$value}' WHERE {$condition}";

        try {
            $this->query($query);
            return $this->statement->rowCount();
        } catch (\PDOException $e) {
            echo "Error while updating record - {$query}\n{$e->getMessage()}";
            exit();
        }
    }

    public function updateRecords(string $table, array $data, string $condition): int
    {
        $records = implode(', ', array_map(function ($record)
        {
            return "$record = :$record";
        }, array_keys($data)));
        $query = "UPDATE {$table} SET {$records} WHERE {$condition}";

        try {
            $this->query($query, $data);
            return $this->statement->rowCount();
        } catch (\PDOException $e) {
            echo "Error while updating records - {$query}\n{$e->getMessage()}";
            exit();
        }
    }
    
    public function deleteRecord(string $table, string $condition, array $values): int
    {
        $query = "DELETE FROM {$table} WHERE {$condition}";

        try {
            $this->query($query, $values);
            return $this->statement->rowCount();
        } catch (\PDOException $e) {
            echo "Error while deleting record - {$query}\n{$e->getMessage()} ";
            exit();
        }
    }
    
    public function deleteRecords(string $table): int
    {
        $query = "DELETE FROM {$table}";

        try {
            $this->query($query);
            return $this->statement->rowCount();
        } catch (\PDOException $e) {
            echo "Error while deleting all records - {$query}\n{$e->getMessage()} ";
            exit();
        }
    }

    public function isEmpty(string $table): bool
    {
        $query = "SELECT COUNT(*) AS c FROM $table";

        try {
            $x = $this->query($query)->find();
            return $x["c"] == 0;
        } catch (\PDOException $e) {
            echo "Error while checking empty table- {$query}\n{$e->getMessage()} ";
            exit();
        }
    }
}