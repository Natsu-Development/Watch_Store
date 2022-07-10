<?php
class help{
	function execute($sql) {
		include("config.php");

		//query
		mysqli_query($conn, $sql);

		//close connection
		mysqli_close($connect);
	}

	function executeResult($sql) {
		//create connection toi database
		include("config.php");

		//query
		$resultset = mysqli_query($conn, $sql);
		$list      = [];
		while ($row = mysqli_fetch_array($resultset, 1)) {
			$list[] = $row;
		}

		//dong connection
		mysqli_close($connect);

		return $list;
	}
}