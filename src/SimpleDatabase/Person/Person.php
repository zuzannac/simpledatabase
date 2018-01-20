<?php

namespace SimpleDatabase\Person;

use SimpleDatabase\Database\Object;

class Person extends Object
{

    protected static $table_name = 'persons';

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

    public function getId()
    {
        return $this->id;
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

    public function toString()
    {
        return $this->id . ". " . $this->firstName . " " . $this->lastName;
    }

    public static function findByName($name)
    {
        global $database;
        $persons = $database->getAll(self::class);

        return array_filter($persons, function($o) use ($name) {
            return ( strpos($o->firstName . " " . $o->lastName, $name) !== false );
        });
    }

    public static function getByIds(array $ids)
    {
        global $database;
        $persons = $database->getAll(self::class);

        return array_filter($persons, function($o) use ($ids) {
            return in_array($o->id, $ids);
        });
    }

    public static function addToDatabase($firstName, $lastName)
    {
        global $database;
        $newId = $database->getUniqueId(self::$table_name);
        $database->add(self::$table_name, array('id' => $newId, 'firstName' => $firstName, 'lastName' => $lastName));
        
        return $newId;
    }
    
    public static function removeFromDatabase($id)
    {
        global $database;
        $database->remove(self::$table_name, array('id' => $id));
    }

}
