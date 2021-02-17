<?php

class Database
{
    private static $dbName = 'cadence_test';
    private static $dbHost = 'localhost';
    private static $dbUser = 'root';
    private static $dbPass = '';
    
    private static $cont = null;
    
    public function __construct() 
    {
        die('Function init not allowed!');
    }
    
    public static function conectar()
    {
        if(null == self::$cont)
        {
            try
            {
                self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUser, self::$dbPass); 
            }
            catch(PDOException $exception)
            {
                die($exception->getMessage());
            }
        }
        return self::$cont;
    }
    
    public static function desconectar()
    {
        self::$cont = null;
    }
}

?>
