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
        $personsLanguages = $database->getAll('SimpleDatabase\Person\PersonLanguage');

        $languages = array_filter(
                $personsLanguages, function ($o) use ($personId) {
            return $o->getPersonId() == $personId;
        }
        );

        return array_map(function($o) {
            return $o->languageName;
        }, $languages);
    }

}
