<?php
declare(strict_types=1);
namespace Woo\App\Util;

use \PDO;
use \Exception;
use Woo\App\Settings\Config;

class Singleton extends Config
{
	public $Pdo = null;

	public static function GetInstance(): self
	{
		static $instance;

		if (null === $instance)
		{
			$instance = new self();
		}

		return $instance;
	}

	protected function __construct()
	{
		$this->Pdo = self::Conn();
	}

	protected function __clone()
	{
	}

	protected function __wakeup()
	{
	}

	final static function Conn()
	{
		try
		{
			$con = new PDO('mysql:host='.self::MYSQL_HOST.';port='.self::MYSQL_PORT.';dbname='.self::MYSQL_DBNAME.';charset=utf8mb4', self::MYSQL_USER, self::MYSQL_PASS);
			// show warning text
			$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			// throw error exception
			$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//Default fetch mode
			$con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			// don't colose connecion on script end
			$con->setAttribute(PDO::ATTR_PERSISTENT, true);
			// set utf for connection utf8_general_ci or utf8_unicode_ci
			$con->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'");
			// prepared statements, don't cache query with prepared statments
			$con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			// Auto commit
			// $con->setAttribute(PDO::ATTR_AUTOCOMMIT,flase);
			// Buffered querry default
			// $con->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true);
			return $con;
		}
		catch(Exception $e)
		{
			echo 'Connection failed: ' . $e->getMessage ();
			// print_r($e->errorInfo());
			return null;
		}
	}

	public function DoLogic()
	{
		// Do something
	}
}

/*
	// Singleton instance
	$si = Singleton::GetInstance();
	$rows = $si->Pdo->query('select * from `users`')->fetchAll();
*/
?>
