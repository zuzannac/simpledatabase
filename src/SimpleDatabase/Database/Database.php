<?php

namespace SimpleDatabase\Database;

class Database
{
    /**
     * Path to JSON file
     * 
     * @var string
     */
    protected $file;
    
    /**
     * @var array
     */
    protected $data;
    
    public function __construct($file) 
    {
        if (!file_exists($file)) {
            throw new Exception("File not found: ".$file);
        }
        $this->file = $file;
        $data = json_decode(file_get_contents($file), true);
        
        if (json_last_error() === JSON_ERROR_NONE) {
            $this->data = $data;
        } else {
            $this->data = array();
        }
    }
    
    /**
     * 
     * @param string $column_name
     * @return int
     */
    public function getUniqueId($column_name)
    {
        $existingIds = array_column($this->data[$column_name], 'id');
        
        if (!empty($existingIds)) {
            return max($existingIds) + 1;
        } else {
            return 1;
        }
    }
    
    /**
     * 
     * @param string $class
     */
    public function getAll($class)
    {        
        $data = $this->data[$class::getColumnName()];
        $objArray = array();
        
        foreach ($data as $row) {
            $obj = new $class(...array_values($row));
            $objArray[] = $obj;
        }
        
        return $objArray;
    }
    
}
