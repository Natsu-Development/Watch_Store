<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once($filepath.'/../lib/database.php');
	include_once($filepath.'/../helper/format.php');
?>

<?php 
	class account {
		
		private $db;
		private $fm;
		
		public function __construct() {
			$this->db = new Database();
			$this->fm = new Format();
		}
		
		public function accountAdd($data) {
			$name = $this->fm->validation($data['userName']);
			$accountName = $this->fm->validation($data['accountName']);
			$password = $this->fm->validation($data['password']);
			
			$name = mysqli_real_escape_string($this->db->link, $name);
			$accountName = mysqli_real_escape_string($this->db->link, $accountName);
			$password = mysqli_real_escape_string($this->db->link, $password);
			
			if(empty($accountName) || empty($password) || empty($name)) {
				echo '<script>alert("Vui lòng điền đầy đủ thông tin của tài khoản")</script>'; 
				return ;
			}
			else {
				$query = "insert into customer(accountName, password, name) values ('$accountName', '$password', '$name')";
				$result = $this->db->insert($query);
				
				if($result) {
					header("Location: accountManager.php?add=true");
					return ;
				}
				else {
					echo '<script>alert("Thêm tài khoản không thành công")</script>'; 
					return ;
				}
			}
		}
		
		public function accountUpdate($data, $id) {
			$accountName = $this->fm->validation($data['accountName']);
			$password = $this->fm->validation($data['password']);
			
			$accountName = mysqli_real_escape_string($this->db->link, $accountName);
			$password = mysqli_real_escape_string($this->db->link, $password);
			
			if(empty($accountName) || empty($password)) {
				echo '<script>alert("Vui lòng điền đầy đủ thông tin của tài khoản")</script>';
				return ;
			}
			else {
				$query = "update customer set accountName='$accountName', password='$password' where id = '$id'";
				$result = $this->db->update($query);
				
				if($result) {
					header("Location: accountManager.php?edit=true");
					return ;
				}
				else {
					echo '<script>alert("Sửa tài khoản không thành công")</script>'; 
					return;
				}
			}
		}
		
		public function deleteAccount($id) {
			$query = "delete from customer where id = '$id'";
			$result = $this->db->delete($query);
			if($result) {
				header("Location: accountManager.php?delete=true");
				return;
			}
			else {
				echo '<script>alert("Xóa tài khoản không thành công")</script>'; 
				return;
			}
		}
		
		public function showAccount() {
			$query = "select *  from customer order by id desc";
			$result = $this->db->select($query);
			return $result;
		}
		
		public function getAccountById($id) {
			$query = "select * from customer where id= '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		
		public function findAccountByName($accountName) {
			$query = "select * from customer where name like '%$accountName%'";
			$result = $this->db->select($query);
			return $result;
		}


		// user
		public function signUp($data) {
			// tài khoản
			$accountName = mysqli_real_escape_string($this->db->link, $data['accountName']);
			$password = mysqli_real_escape_string($this->db->link, $data['password']);
			// thông tin người dùng
			$name = mysqli_real_escape_string($this->db->link, $data['name']);
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$numberPhone = mysqli_real_escape_string($this->db->link, $data['numberPhone']);
			$address = mysqli_real_escape_string($this->db->link, $data['address']);
			
			if(empty($name) || empty($email) || empty($numberPhone) || empty($address)) {
				return;
			}
			else {
				$query = "insert into customer(name, address, email, numberPhone, accountName, password) values ('$name', '$address', '$email', '$numberPhone', '$accountName', '$password')";
				$result = $this->db->insert($query);
				if($result) {
					echo '<script>alert("Đăng kí thành công")</script>';
					return;
				}
				else {
					echo '<script>alert("Đăng kí không thành công")</script>';
					return;
				}
 			}
		}
		
		public function loginUser($userName, $userPass) {
			$userName = $this->fm->validation($userName);
			$userPass = $this->fm->validation($userPass);
			
			$userName = mysqli_real_escape_string($this->db->link, $userName);
			$userPass = mysqli_real_escape_string($this->db->link, $userPass);
			
			if(empty($userName) || empty($userPass)) {
				echo '<script>alert("Vui lòng nhập đầy đủ thông tin đăng nhập")</script>';
				return ;
			}
			else {
				$query = "select * from customer where accountName = '$userName' and password = '$userPass' limit 1";
				$result = $this->db->select($query);
				
				if($result) {
					$value = $result->fetch_assoc();
					$_SESSION["customerId"] = $value['id'];
					$_SESSION["customerName"] = $value['name'];
					$_SESSION["address"] = $value['address'];
					$_SESSION["numberPhone"] = $value['numberPhone'];
					$_SESSION["email"] = $value['email'];
					$_SESSION["userName"] = $value['accountName'];
					$_SESSION["userPass"] = $value['password'];
					if(isset($_GET['action'])) {
						header('Location: checkout.php');
					}
					else {
						header('Location: index.php');
					}
				}
				else {
					echo '<script>alert("Đăng nhập không thành công")</script>';
					// echo '<a href="brandManager.php">
					// <button class="btn" style="background-color: var(--primary-color);color: white;margin: 8px;height: 30px; min-width: 80px;">Xóa</button>
					// </a>';
					return;
				}
			}
		}

		public function getAllCustomer() {
			$query = "select * from customer";
			$result = $this->db->select($query);
			return $result;
		}

		public function getInfo($customerId) {
			$query = "select * from customer where id = '$customerId'";
			$result = $this->db->select($query);
			return $result;
		}
		
	}
?>