<?php 
	const localhost = "127.0.0.1";
	const user = "root";
	const password = "";
	const database = "database";
	
	$connect = mysqli_connect(localhost, user, password, database);
	mysqli_set_charset($connect, "utf8");

	if($connect->connect_error) {
		echo "Kết nối MYSQLi lỗi" . $mysqli->connect_error;
		exit();
	}
?>