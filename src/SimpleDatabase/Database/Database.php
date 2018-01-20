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
            throw new Exception("File not found: " . $file);
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
     * @param string $table_name
     * @return int
     */
    public function getUniqueId($table_name)
    {
        $existingIds = array_column($this->data[$table_name], 'id');

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
        $data = $this->data[$class::getTableName()];
        $objArray = array();

        foreach ($data as $row) {
            $obj = new $class(...array_values($row));
            $objArray[] = $obj;
        }

        return $objArray;
    }

    public function add($table_name, $data)
    {
        $this->data[$table_name][] = $data;
        $this->updateFile();
    }

    public function remove($table_name, array $search)
    {
        $data = $this->data[$table_name];

        foreach ($data as $key => $row) {
            if (!array_diff($search, $row)) {
                unset($this->data[$table_name][$key]);
            }
        }

        $this->updateFile();
    }

    public function exists($table_name, array $search)
    {
        $data = $this->data[$table_name];

        foreach ($data as $row) {
            if (!array_diff($search, $row)) {
                return true;
            }
        }

        return false;
    }

    protected function updateFile()
    {
        file_put_contents($this->file, json_encode($this->data));
    }

}
