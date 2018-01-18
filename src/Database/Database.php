<?php

namespace Database;

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
            $this->data = array();
        } else {
            $this->data = $data;
        }
    }
    
    
    public function getUniqueId()
    {
        $existingIds = array_column($this->data, 'id');
        
        if (!empty($existingIds)) {
            return max($existingIds) + 1;
        } else {
            return 1;
        }
    }
    
}
