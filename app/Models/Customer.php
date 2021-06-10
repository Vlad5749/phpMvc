<?php
namespace Models;

use Core\Model;

class Customer extends Model
{
    function __construct()
    {
        $this->table_name = "customer";
        $this->id_column = "customer_id";
    }
    
    
    public function filter($params)
    {
        $this->sql .= " where ";
        foreach ($params as $key => $value) {
            $this->sql .= "$key=? and ";
            array_push($this->params, $value);
        }
        $this->sql = substr($this->sql, 0, -5);
        
        return $this;
    }
    
    public function getPostValues()
    {
        $values = [];
        $columns = $this->getColumns();
        foreach ($columns as $column) {
            $column_value = filter_input(INPUT_POST, $column);
            if ($column_value && $column !== $this->id_column ) {
                $values[$column] = filter_var($column_value, FILTER_SANITIZE_STRING);
            }
        }
        return $values;
    }
}