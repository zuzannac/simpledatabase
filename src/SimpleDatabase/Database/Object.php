<?php

namespace SimpleDatabase\Database;

abstract class Object
{
    protected static $column_name;
    
    public static function getColumnName()
    {
        return static::$column_name;
    }
}
