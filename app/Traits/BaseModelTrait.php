<?php

namespace App\Traits;

trait BaseModelTrait
{
    public function getAll($table)
    {
        $query = "SELECT * FROM {$table}";

        return $this->database->query($query)->findAll();
    }

    public function getById($table, $id)
    {
        $query = "SELECT * FROM {$table} WHERE id = :id";
        $params = ["id" => $id];

        return $this->database->query($query, $params)->find();
    }
    
    public function getOneByCondition($table, $condition)
    {
        $query = "SELECT * FROM {$table} WHERE {$condition}";
        
        return $this->database->query($query)->find();
    }

    public function getByCondition($table, $condition)
    {
        $query = "SELECT * FROM {$table} WHERE {$condition}";
        
        return $this->database->query($query)->findAll();
    }

    public function addRecord(string $table, array $data): int
    {
        return $this->database->insertRecord($table, $data);
    }

    public function addRecords(string $table, array $columns, array $data): int
    {
        return $this->database->insertRecords($table, $columns, $data);
    }

    public function updateRecord(string $table, string $condition, string $column, $value): int
    {
        return $this->database->updateRecord($table, $condition, $column, $value);
    }

    public function updateRecords(string $table, array $data, string $condition): int
    {
        return $this->database->updateRecords($table, $data, $condition);
    }

    public function deleteRecord(string $table, string $condition, array $values): int
    {
        return $this->database->deleteRecord($table, $condition, $values);
    }

    public function deleteAllRecords(string $table): int
    {
        return $this->database->deleteRecords($table);
    }
}