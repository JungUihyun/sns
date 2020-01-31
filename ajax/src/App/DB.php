<?php
namespace src\App;

class DB {
	private static $DB = null;

	public static function getConnection() {
		$dbname = "yy_20119";
		$charset = "utf8mb4";
		$id = "yy_20119";
		$password = "1234";
		if(is_null(self::$DB)) self::$DB = new \PDO("mysql:host=gondr.asuscomm.com; dbname=" . $dbname . "; charset=" . $charset . ";", "" . $id . "", "" . $password . "", [19 => 5, 3 => 1]);
		return self::$DB;
	}

	public static function execute($sql, $arr = []) {
		$q = self::getConnection()->prepare($sql);
		$q->execute($arr);
		return $q;
	}

	public static function fetch($sql, $arr = []) {
		$q = self::getConnection()->prepare($sql);
		$q->execute($arr);
		return $q->fetch();
	}

	public static function fetchAll($sql, $arr = []) {
		$q = self::getConnection()->prepare($sql);
		$q->execute($arr);
		return $q->fetchAll();
	}
}
?>