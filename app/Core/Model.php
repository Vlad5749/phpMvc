<?php
namespace Core;

/**
 * Class Model
 */
class Model implements DbModelInterface
{
    /**
     * @var
     */
    protected $table_name;
    /**
     * @var
     */
    protected $id_column;
    /**
     * @var array
     */
    protected $columns = [];
    /**
     * @var
     */
    protected $collection;
    /**
     * @var
     */
    protected $sql;
    /**
     * @var array
     */
    protected $params = [];

    /**
     * @return $this
     */
    public function initCollection()
    {
        $columns = implode(',',$this->getColumns());
        $this->sql = "select $columns from " . $this->table_name;
        return $this;
    }

    /**
     * @return array
     */
    public function getColumns()
    {
        $db = new DB();
        $sql = "show columns from  $this->table_name;";
        $results = $db->query($sql);
        foreach($results as $result) {
            array_push($this->columns,$result['Field']);
        }
        return $this->columns;
    }

    /**
     * @param $params
     * @return $this
     */
    public function sort($params)
    {
        $columns = implode(',', $this->columns);
        $key = array_keys($params)[0];
        $value = $params[$key];
        $this->sql .= " order by $key $value";
        
        return $this;
    }

    public function getMax($field) 
    {
        $db = new DB();
        $sql = "select max($field) from $this->table_name";
        $results = $db->query($sql);
        return $results[0]["max($field)"];
    }

    public function addItem($values) 
    {
        $db = new DB();
        $columns = "";
        foreach ($values as $key => $value) {
            if ($value !== null) {
                $columns .= $key . ",";
            }
        }
        $columns = substr($columns, 0, -1);
        
        $paramsArr = [];
        $params = "(";
        foreach ($values as $key => $value) {
            $params .= "?,";
            array_push($paramsArr, $value);
        }
        $params = substr($params, 0, -1);
        $params .= ")";
        
        $sql = "insert into $this->table_name ($columns) values "
            . $params;
        $db->query($sql, $paramsArr);
    }
    
    public function saveItem($id, $values)
    {
        $db = new DB();
        $param = "";
        $paramArr = [];
        foreach ($values as $key => $value) {
            $param .= $key . " = ?,";
            array_push($paramArr, $value);
        }
        $param = substr($param, 0, -1);
        
        $sql = "update $this->table_name "
             . "set $param "
             . "where id = ?";
        array_push($paramArr, $id);
        
        $db->query($sql, $paramArr);
    }
    
    public function deleteItem($id) 
    {
        $db = new DB();
        $sql = "delete from $this->table_name "
             . "where id = ?";
        $db->query($sql, array($id));
    }


    /**
     * @return array
     */
    public function getPostValues()
    {
        $values = [];
        $columns = $this->getColumns();
        foreach ($columns as $column) {
            /*
            if ( isset($_POST[$column]) && $column !== $this->id_column ) {
                $values[$column] = $_POST[$column];
            }
             * 
             */
            $column_value = filter_input(INPUT_POST, $column);
            if ($column_value && $column !== $this->id_column ) {
                $values[$column] = $column_value;
            }
        }
        return $values;
    }

    /**
     * @return $this
     */
    public function getCollection()
    {
        $db = new DB();
        $this->sql .= ";";
        $this->collection = $db->query($this->sql, $this->params);
        return $this;
    }

    /**
     * @return mixed
     */
    public function select()
    {
        return $this->collection;
    }

    /**
     * @return null
     */
    public function selectFirst()
    {
        return isset($this->collection[0]) ? $this->collection[0] : null;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getItem($id)
    {
        $sql = "select * from $this->table_name where $this->id_column = ?;";
        $db = new DB();
        return $db->query($sql, array($id))[0];
    }

    public function getTableName(): string
    {
        return $this->table_name;
    }

    public function getPrimaryKeyName(): string
    {
        return $this->id_column;
    }

    public function getId()
    {
        return 1;
    }
}
