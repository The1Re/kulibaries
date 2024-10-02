<?php

class Database
{
    private static $hostname = 'localhost';
    private static $username = 'db24_004';
    private static $password = 'db24_004';
    private static $database = 'db24_004_kulibaries';
    private static $connection = null;

    /**
     * Connect to database
     * 
     * @return mysqli instance of connection
     */
    public static function connect(): mysqli
    {
        Database::$connection = new mysqli(
            Database::$hostname,
            Database::$username,
            Database::$password,
            Database::$database
        );
        
        if (Database::$connection->connect_error)
            die("Error to connect database : " . Database::$connection->connect_error);

        return Database::$connection;
    }

    /**
     * Close methods
     * 
     * @return bool status when connection close
     */
    public static function close(): bool
    {
        return Database::$connection->close();
    }

    /**
     * Query methods 
     * it connect database and when query success/fail it close connection
     * 
     * @param string $sql_query sql query
     * @param array $params param array
     * @return bool|mysqli_result
     */
    public static function query(string $sql_query, array $params = [])
    {
        $conn = Database::connect();
        $stmt = $conn->prepare($sql_query);

        if ($stmt === false)
            die("Error prepare failed : " . Database::$connection->connect_error);

        if (!empty($params)) {
            $types = Database::getTypeParams($params);
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        Database::close();
        return $result;
    }

    /**
     * Get type params
     * convert type in array value
     * example [1, 'test', 1.5] -> 'isd'
     * i : int, d : double, s : string, b : blob
     * 
     * @param array $params
     * @return string type of value in array
     */
    private static function getTypeParams(array $params): string
    {
        $types = '';

        foreach ($params as $param)
        {
            if (is_int($param))
                $types .= 'i';
            else if (is_double($param))
                $types .= 'd';
            else if (is_string($param))
                $types .= 's';
            else
                $types .= 'b';
        }

        return $types;
    }
}