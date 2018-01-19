<?php
require __DIR__  . '/src/SplClassLoader.php';

$oClassLoader = new \SplClassLoader('SimpleDatabase', 'src');
$oClassLoader->register();
