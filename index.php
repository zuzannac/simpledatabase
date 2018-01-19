<?php
include "bootstrap.php";

use SimpleDatabase\Database\Database;

$database = new Database('data/persons.json');
print_r($database->getAll('SimpleDatabase\Person\Person'));