<?php

namespace SimpleDatabase\Person;

use SimpleDatabase\Database\Object;

class Language extends Object
{
    protected static $table_name = 'languages';
        
    /**
     * @var string
     */
    protected $name;
        
    public function __construct($name)
    {
        $this->name = $name;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public static function addToDatabase($name)
    {
        global $database;
        $database->add(self::$table_name, array('name' => $name));
    }
    
    public static function removeFromDatabase($name)
    {
        global $database;
        $database->remove(self::$table_name, array('name' => $name));
    }
    
}
