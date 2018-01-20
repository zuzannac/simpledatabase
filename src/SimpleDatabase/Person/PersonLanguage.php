<?php

namespace SimpleDatabase\Person;

use SimpleDatabase\Database\Object;

class PersonLanguage extends Object
{

    protected static $table_name = 'persons_languages';

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

    function getPersonId()
    {
        return $this->personId;
    }

    function getLanguageName()
    {
        return $this->languageName;
    }

    /**
     * 
     * @param type $personId
     * @return string[]
     */
    public static function getLanguagesNamesByPersonId($personId)
    {
        global $database;
        $personsLanguages = $database->getAll(self::class);

        $languages = array_filter(
                $personsLanguages, function ($o) use ($personId) {
            return $o->personId == $personId;
        }
        );

        return array_map(function($o) {
            return $o->languageName;
        }, $languages);
    }

    public function addToDatabase($personId, array $languages)
    {
        global $database;
                
        foreach ($languages as $languageName) {
            
            if (!$database->exists(\SimpleDatabase\Person\Language::getTableName(), array('name' => $languageName))) {
                $database->add(\SimpleDatabase\Person\Language::getTableName(), array('name' => $languageName));
            }
            
            $database->add(self::$table_name, array('personId' => $personId, 'languageName' => $languageName));
        }
    }
    
    public static function removePersonFromDatabase($id)
    {
        global $database;
        $database->remove(self::$table_name, array('personId' => $id));
    }
    
}
