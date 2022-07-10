<?php 
	$filepath = realpath(dirname(__FILE__));
	include ($filepath.'/../lib/session.php');
	Session::checkLogin();
	include_once($filepath.'/../lib/database.php');
	include_once($filepath.'/../helper/format.php');
?>

<?php 
	class adminLogin {
		
		private $db;
		private $fm;
		
		public function __construct() {
			$this->db = new Database();
			$this->fm = new Format();
		}
		
		public function loginAdmin($adminUser, $adminPass) {
			$adminUser = $this->fm->validation($adminUser);
			$adminPass = $this->fm->validation($adminPass);
			
			$adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
			$adminPass = mysqli_real_escape_string($this->db->link, $adminPass);
			
			if(empty($adminUser) || empty($adminPass)) {
				header("Location: index.php?warning=1");
				return ;
			}
			else {
				$query = "SELECT * FROM admin_account WHERE USERNAME = '$adminUser' AND PASSWORD = '$adminPass' LIMIT 1";
				$result = $this->db->select($query);
				
				if($result) {
					$value = $result->fetch_assoc();
					Session::set("adminLogin", true);
					Session::set("adminUser", $value['USERNAME']);
					Session::set("adminLogin", $value['PASSWORD']);
					Session::set("adminLogin", $value['PERMISSION']);
					header("Location: adminPage.php");
				}
				else {
					header("Location: index.php?id=false");
					return ;
				}
			}
		}
	}
?>