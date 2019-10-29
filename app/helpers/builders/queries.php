<?php
return [
    'insert' => "INSERT INTO {$this->table} ({$into}) VALUES ({$values})",
    'select' => "SELECT $select FROM {$this->table}{$this->where}{$this->order}{$this->limit}",
    'update' => "UPDATE {$this->table} SET {$set}{$this->where}{$this->order}{$this->limit}",
    'delete' => "DELETE FROM {$this->table}{$this->where}{$this->order}{$this->limit}",
];