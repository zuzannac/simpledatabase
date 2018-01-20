<?php

namespace SimpleDatabase\Database;

abstract class Object
{
    protected static $table_name;
    
    public static function getTableName()
    {
        return static::$table_name;
    }
}
