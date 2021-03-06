<?php 

class Database
{
    private static $dbName 			= 'axitech00';
    private static $dbHost 			= 'mysql.axitech.com.br';
    private static $dbUsername 		= 'axitech00';
    private static $dbUserPassword 	= 'axitech00';
    private static $cont  			= null;
     
    public function __construct() {
        die('Init function is not allowed');
    }
     
    public static function connect()
    {
    	if ( null == self::$cont ) {  

    	try {
    			
    		self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".
    			                                  self::$dbName, 
    			                                  self::$dbUsername, 
    			                                  self::$dbUserPassword, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));

        } catch (PDOException $e) {

    		die($e->getMessage()); 
    	}
	}

    return self::$cont;

	}
     
    public static function disconnect() {
        self::$cont = null;
    }
}