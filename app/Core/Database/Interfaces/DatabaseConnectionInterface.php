<?php

namespace App\Core\Database\Interfaces;

interface DatabaseConnectionInterface
{
    public function query($query, $params = []);
    public function find($mode = \PDO::FETCH_ASSOC);
    public function findAll($mode = \PDO::FETCH_ASSOC);
    public function insert(string $table, array $data);
    public function insertMultiple(string $table, array $columns, array $data);
}