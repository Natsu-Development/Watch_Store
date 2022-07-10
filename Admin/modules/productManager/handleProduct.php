<?php
	class handle {
		function connect() {
			$connect = mysqli_connect("127.0.0.1", "root", "", "database");
			mysqli_set_charset($connect, "utf8");

			if($connect->connect_error) {
				echo "Kết nối MYSQLi lỗi" . $mysqli->connect_error;
				exit();
			}
			return $connect;
		}
		
		function productModify($sql) {
			$connect = $this->connect();
			if(mysqli_query($connect, $sql)){
				return 1;
			}
			else {
				return 0;
			}
		}
		
		function uploadFile($name, $temp ,$folder){
			$dup = time();
			$newname = $folder."/".$name;
			if($newname != '' && $folder != ''){
				if(move_uploaded_file($temp, $newname)){
					return 1;
				}
				else {
					return 0;
				}	
			} 
			else{
				return 0;
			}
		}
		
		function executeResult($sql) {
			$connect = $this->connect();
			//query
			$resultset = mysqli_query($connect, $sql);
			$list      = [];
			while ($row = mysqli_fetch_array($resultset, 1)) {
				$list[] = $row;
			}

			//dong connection
			mysqli_close($connect);

			return $list;
		}
		
		function getData($sql) {
			$connect = $this->connect();
			$result = mysqli_query($connect, $sql);
			$i = mysqli_num_rows($result);
			$data = '';
			if($i>0) {
				while($row = mysqli_fetch_array($result)) {
					$data = $row[0];
				}
			}
			return $data;
		}
		
		function getAllCompany($table, $primaryKey, $dataToGet) {
			$sql = "SELECT * from `$table`";
			$connect = $this->connect();
			$record = mysqli_query($connect, $sql);
			$i = mysqli_num_rows($record);
			if($i>0) {
				while($row = mysqli_fetch_array($record)) {
					$id = $row[$primaryKey];
					$data = $row[$dataToGet];
					echo '<option value="'.$id.'">'.$data.'</option>';
				}
			}
		}
	}
	
?>