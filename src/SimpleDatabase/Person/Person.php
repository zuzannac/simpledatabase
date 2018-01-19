<?php

namespace SimpleDatabase\Person;

use SimpleDatabase\Database\Object;

class Person extends Object
{
    protected static $column_name = 'persons';
    
    /**
     * @var integer
     */
    protected $id;
    
    /**
     * @var string
     */
    protected $firstName;
    
    /**
     * @var string
     */
    protected $lastName;
    
    public function __construct($id, $firstName, $lastName)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }
    
    public function getFirstname()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

}
