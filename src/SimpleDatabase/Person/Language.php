<?php

namespace SimpleDatabase\Person;

use SimpleDatabase\Database\Object;

class Language extends Object
{
    protected static $column_name = 'languages';
        
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
    
}
