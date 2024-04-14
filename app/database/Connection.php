<?php

namespace app\database;

class Connection
{
    private static $connection;

    public static function connect()
    {
        if (!self::$connection) {
            self::$connection = new \PDO('mysql:host=localhost;dbname=rotasphpoo', 'root', '', [
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
            ]);
        }

        return self::$connection;
    }
}
