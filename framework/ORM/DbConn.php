<?php

namespace framework\ORM;

use app\Config; /** @todo: dependency injection */

class DbConn
{
	const REUSE = true;

	static $conn = null;

	public static function get()
	{
		if (!self::$conn || !self::REUSE) {
			self::$conn = new \PDO('mysql:host='.Config::DB_HOST.';dbname='.Config::DB_NAME.';charset=utf8', Config::DB_USER, Config::DB_PWD);
			//self::$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			//self::$conn->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
		}
		return self::$conn;
	}
}
