<?php
include "../php/utils.php";

class DBconn
{
	private static $instance;
	private static $conn;

	private function __construct() {}

	private function __clone() {}

	public static function getInstance()
	{
		if (!isset(self::$instance) || !isset(self::$conn)) {
			self::$instance = new DBconn();
			self::$conn = mysqli_connect("localhost", "root", "", "codabagni");
		}

		return self::$instance;
	}

	function __destruct()
	{
		mysqli_close(self::$conn);
	}

	function checkToken($user, $token)
	{
		$tokenRow = mysqli_fetch_assoc(doQuery(self::$conn, "SELECT * FROM tokens WHERE name = ?;", "s", $user));
		if ($tokenRow) {
			$tokenStr = $tokenRow["token"];
			if ($tokenStr == $token) return 0;
			else return 1;
		}
		return 2;
	}
	
	function getBathrooms()
	{
		$result = doQuery(self::$conn, "SELECT * from bathrooms");
		$output_data = [];
		while ($row = mysqli_fetch_row($result)) {
			$output_data[] = $row;
		}
		return $output_data;
	}

	function getQueues($bathroom)
	{
		$result = doQuery(self::$conn, "SELECT * from queue WHERE bathroom = ? ORDER BY onEntry ASC", "i", $bathroom);
		$output_data = [];
		while ($row = mysqli_fetch_row($result)) {
			$output_data[] = $row;
		}
		return $output_data;
	}

	function isInQueue($user, $bathroom)
	{
		$result = doQuery(self::$conn, "SELECT * from queue WHERE bathroom = ? AND name = ?", "is", $bathroom, $user);
		return !mysqli_fetch_row($result) == null;
	}

	function insert($user, $bathroom)
	{
		doQuery(self::$conn, "INSERT INTO queue (name, bathroom) VALUES (?, ?)", "si", $user, $bathroom);
	}

	function exitQueue($user, $bathroom)
	{
		doQuery(self::$conn, "DELETE from queue where name = ? AND bathroom = ?", "si", $user, $bathroom);
	}

	function checkQueueTop($user, $bathroom)
	{
		$topOne = mysqli_fetch_assoc(doQuery(self::$conn, "SELECT * from queue where bathroom = ? ORDER BY onEntry ASC limit 1", "i", $bathroom));
		return $topOne == null ? false : $topOne["name"] == $user;
	}
}
