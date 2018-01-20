<?php

include "bootstrap.php";

use SimpleDatabase\Database\Database;
use SimpleDatabase\Person\PersonLanguage;
use SimpleDatabase\Person\Person;
use SimpleDatabase\Person\Language;


global $database;
$database = new Database('data/persons.json');

$args = $_SERVER['argv'];

if (!isset($args[1])) {
    exit();
}

switch ($args[1]) {
    case 'list':
        $persons = $database->getAll('SimpleDatabase\Person\Person');
        listPersons($persons);
        break;
    case 'find':
        if (count($args) < 3) {
            echo 'Missing argument for function find';
            exit();
        }
        $persons = Person::findByName($args[2]);
        listPersons($persons);
        break;
    case 'languages':
        $languages = array_map('strtolower', array_slice($args, 2));

        $persons = $database->getAll('SimpleDatabase\Person\Person');
        $personsWithAllLanguages = array_filter(
                $persons, function ($o) use ($languages) {
            $personLanguages = PersonLanguage::getLanguagesNamesByPersonId($o->getId());
            return array_diff($languages, $personLanguages) === array();
        }
        );

        listPersons($personsWithAllLanguages);
        break;
    case 'addPerson':
        if (count($args) < 4) {
            echo 'Too few arguments for function addPerson';
            exit();
        }

        $firstName = $args[2];
        $lastName = $args[3];
        $languages = array_map('strtolower', array_slice($args, 4));

        $personId = Person::addToDatabase($firstName, $lastName);
        PersonLanguage::addToDatabase($personId, $languages);

        echo 'Person added';
        break;
    case 'removePerson':
        if (count($args) < 3) {
            echo 'Missing argument for function removePerson';
            exit();
        }
        Person::removeFromDatabase($args[2]);
        PersonLanguage::removePersonFromDatabase($args[2]);

        echo 'Person deleted';
        break;
    case 'addLanguage':
        if (count($args) < 3) {
            echo 'Missing argument for function addLanguage';
            exit();
        }
        Language::addToDatabase($args[2]);
        echo 'Language added';
        break;
    case 'removeLanguage':
        if (count($args) < 3) {
            echo 'Missing argument for function addLanguage';
            exit();
        }
        Language::removeFromDatabase($args[2]);
        echo 'Language deleted';
        break;
    default:
        echo 'Unknown command';
        break;
}

function listPersons($persons)
{
    foreach ($persons as $row) {
        echo $row->toString() . ' - ';
        $personId = $row->getId();
        $languages = PersonLanguage::getLanguagesNamesByPersonId($personId);
        echo '(' . implode(', ', $languages) . ")\n";
    }
}
