<?php

namespace App\Core\Database\Interfaces;

interface DatabaseInterface
{
    public function query($query, $params = []);
    public function find($mode = \PDO::FETCH_ASSOC);
    public function findAll($mode = \PDO::FETCH_ASSOC);
    public function insertRecord (string $table, array $data): int;
    public function insertRecords(string $table, array $columns, array $data): int;
    public function updateRecord(string $table, string $condition, string $column, $values): int;
    public function updateRecords(string $table, array $data, string $condition): int;
    public function deleteRecord(string $table, string $condition): int;
    public function deleteRecords(string $table): int;
    
    public function isEmpty(string $table): bool;
}