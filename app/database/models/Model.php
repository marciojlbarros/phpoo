<?php

namespace app\database\models;

use app\database\Connection;
use app\database\Filters;

abstract class Model
{
    private string $fields = '*';
    private string $filters = '';
    protected string $table;

    public function setFields($fields)
    {
        $this->fields = $fields;
    }

    public function setFilters(Filters $filters)
    {
        $this->filters = $filters->dump();
    }

    public function fetchAll()
    {
        try {
            $sql = "SELECT {$this->fields} FROM {$this->table} {$this->filters}";

            $connection = Connection::connect();

            $query = $connection->query($sql);

            return $query->fetchAll(\PDO::FETCH_CLASS, get_called_class());
        } catch (\PDOException $e) {
            dd($e->getMessage());
        }
    }

    public function findBy(string $field = '', string $value = '')
    {
        try {
            // if (!$this->filters) {
            //     $sql = "SELECT {$this->fields} FROM {$this->table} WHERE {$field} = :{$field}";
            // } else {
            //     $sql = "SELECT {$this->fields} FROM {$this->table} {$this->filters}";
            // }

            $sql = (!$this->filters) ?
            $sql = "SELECT {$this->fields} FROM {$this->table} WHERE {$field} = :{$field}" :
            $sql = "SELECT {$this->fields} FROM {$this->table} {$this->filters}";

            $connection = Connection::connect();

            $prepare = $connection->prepare($sql);

            $prepare->execute(!$this->filters ? [$field => $value] : []);

            return $prepare->fetchObject(get_called_class());
        } catch (\PDOException $e) {
            dd($e->getMessage());
        }
    }
}
