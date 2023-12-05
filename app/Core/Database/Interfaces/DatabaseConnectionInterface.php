<?php

namespace App\Core\Database\Interfaces;

interface DatabaseConnectionInterface
{
    public function query($query, $params = []);
    public function find($mode = \PDO::FETCH_ASSOC);
    public function findAll($mode = \PDO::FETCH_ASSOC);
    public function insertRecord (string $table, array $data): int;
    public function insertRecords(string $table, array $columns, array $data): int;
    
    public function deleteRecord(string $table, string $condition, array $values): int;
    public function deleteRecords(string $table): int;
}