<?php 

namespace App\connection;

use PDO, PDOExeption;

class DataBaseConnection{

	private static $dbHost= "localhost";
	private static $dbName = "test";
	private static $dbUser = "root";
	private static $dbUserPassword = "";

	private static $connection = null;

	public static function connect()
	{
		try {
			self::$connection = new PDO(
				"mysql:host=".self::$dbHost.";dbname=".self::$dbName,
				self::$dbUser,
				self::$dbUserPassword
			);
		} catch (PDOExeption $e){
			die($e->getMessage());
		}
		return self::$connection;
	}

	public static function disconnect()
	{
		self::$connection = null;
	}
}

?>