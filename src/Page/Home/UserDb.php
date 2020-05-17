<?php
namespace Woo\Page\Home;

use Exception;
use Woo\App\Mysql\Db;

class UserDb
{
	static function GetUsers()
	{
		try
		{
			// Database connection
			$db = Db::GetInstance();

			$r = $db->Pdo->prepare("SELECT * FROM user WHERE id != :id");

			$r->execute([':id' => 0]);

			$rows = $r->fetchAll();

			return $rows;
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}

	static function GetUser($id = 0)
	{
		try
		{
			// Database connection
			$db = Db::GetInstance();

			$r = $db->Pdo->prepare("SELECT * FROM user WHERE id = :id");

			$r->execute([':id' => $id]);

			$rows = $r->fetchAll();

			if(!empty($rows))
			{
				return $rows[0];
			}

			return [];
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
}
?>