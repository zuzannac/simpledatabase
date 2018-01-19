<?php

namespace SimpleDatabase\Person;

use SimpleDatabase\Database\Object;

class PersonLanguage extends Object
{
    protected static $column_name = 'persons_languages';
    
    /**
     * @var integer
     */
    protected $personId;
    
    /**
     * @var string
     */
    protected $languageName;
    
    
    public function __construct($personId, $languageName)
    {
        $this->personId = $personId;
        $this->languageName = $languageName;
    }

}
