<?php
include "../php/utils.php";

class DBconn
{
	private static $instance;
	private static $conn;

	private function __construct()
	{
	}

	private function __clone()
	{
	}

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

	function checkToken($loggedUser, $token)
	{
		return mysqli_fetch_assoc(doQuery(self::$conn, "SELECT * FROM tokens WHERE id = ? AND token = ?;", "ss", ...[$loggedUser, $token])) != null;
	}

	function getQueues($bathroom_id)
	{
		$result = doQuery(self::$conn, "SELECT * from queue WHERE bathroom = $bathroom_id ORDER BY onEntry ASC");
		$output_data = [];
		while ($row = mysqli_fetch_row($result)) {
			$output_data[] = $row;
		}
		return $output_data;
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

	function isAlreadyInQueue($username, $bathroom_id):bool{
		$result = doQuery(self::$conn, "SELECT * from queue WHERE bathroom = $bathroom_id AND name = '$username'");
		return !mysqli_fetch_row($result) == null;
	}

	function insert($name, $bathroom_id)
	{
		doQuery(self::$conn, "INSERT INTO queue (name, bathroom) VALUES (?, ?)", "si", ...[$name, $bathroom_id]);
	}

	function queueGoOn($bathroom_id)
	{
		doQuery(self::$conn, "DELETE from queue where bathroom = ? ORDER BY onEntry ASC limit 1", "i", ...[$bathroom_id]);
	}

	function checkQueueTop($name, $bathroom_id)
	{
		$topOne = mysqli_fetch_assoc(doQuery(self::$conn, "SELECT * from queue where bathroom = ? ORDER BY onEntry ASC limit 1", "i", ...[$bathroom_id]));
		return $topOne["name"] == $name;
	}
}