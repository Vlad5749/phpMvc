<?php
namespace Models;

use Core\Model;

/**
 * Class Product
 */
class Product extends Model
{

    /**
     * Product constructor.
     */
    function __construct()
    {
        $this->table_name = "products";
        $this->id_column = "id";
    }
    
         /**
     * @param $params
     */
    public function filter($params)
    {
        $key = array_keys($params)[0];
        $from = $params[$key][0];
        if (isset($params[$key][1])) {
            $to = $params[$key][1];
        } else {
            $to = $this->getMax($key);
        }
        
        $this->sql .= " where $key between ? and ?";
        array_push($this->params, $from);
        array_push($this->params, $to);
            
        return $this;
    }
   
    public function getPostValues()
    {
        $values = [];
        $columns = $this->getColumns();
        foreach ($columns as $column) {
            $column_value = filter_input(INPUT_POST, $column);
            if ($column_value && $column !== $this->id_column ) {
                $values[$column] = $column_value;
            }
        }
        
        if ($values) {
            $values['sku'] = filter_var($values['sku'], FILTER_SANITIZE_STRING);
            $values['name'] = filter_var($values['name'], FILTER_SANITIZE_STRING);
            $values['price'] = filter_var($values['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $values['qty'] = filter_var($values['qty'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

            if (isset($values['description'])) {
                $values['description'] = filter_var($values['description'], FILTER_SANITIZE_STRING);
                $values['description'] = htmlspecialchars($values['description']);
            }
        }
        return $values;
    }
    
    public function getItem($id)
    {
        $sql = "select * from $this->table_name where $this->id_column = ?;";
        $db = new \Core\DB();
        $product = $db->query($sql, array($id))[0];
        if (isset($product['description'])) {
            $product['description'] = htmlspecialchars_decode($product['description']);
        }
        return $product;
    }
}