<?php

include "bootstrap.php";

use SimpleDatabase\Database\Database;
use SimpleDatabase\Person\PersonLanguage;


global $database;
$database = new Database('data/persons.json');

if (!isset($_GET['action'])) {
    exit();
}

switch ($_GET['action']) {
    case 'list':
        $persons = $database->getAll('SimpleDatabase\Person\Person');
        listPersons($persons);
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
