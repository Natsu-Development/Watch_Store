<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once($filepath.'/../lib/database.php');
	include_once($filepath.'/../helper/format.php');
?>

<?php 
	class brand {
		
		private $db;
		private $fm;
		
		public function __construct() {
			$this->db = new Database();
			$this->fm = new Format();
		}
		
		public function brandAdd($data) {
			$brandName = $this->fm->validation($data['brandName']);
			$brandNumberPhone = $this->fm->validation($data['numberPhone']);
			$brandAddress = $this->fm->validation($data['address']);
			
			$brandName = mysqli_real_escape_string($this->db->link, $brandName);
			$brandNumberPhone = mysqli_real_escape_string($this->db->link, $brandNumberPhone);
			$brandAddress = mysqli_real_escape_string($this->db->link, $brandAddress);
			
			if(empty($brandName) || empty($brandNumberPhone) || empty($brandAddress)) {
				echo '<script>alert("Vui lòng điền đầy đủ thông tin của thương hiệu")</script>'; 
				return ;
			}
			else {
				$query = "insert into brand(name, numberPhone, address) values ('$brandName', '$brandNumberPhone', '$brandAddress')";
				$result = $this->db->insert($query);
				
				if($result) {
					header("Location: brandManager.php?add=true");
					return ;
				}
				else {
					echo '<script>alert("Thêm thương hiệu không thành công")</script>'; 
					return ;
				}
			}
		}
		
		public function brandUpdate($data, $id) {
			$brandName = $this->fm->validation($data['brandName']);
			$brandNumberPhone = $this->fm->validation($data['numberPhone']);
			$brandAddress = $this->fm->validation($data['address']);
			
			$brandName = mysqli_real_escape_string($this->db->link, $brandName);
			$brandNumberPhone = mysqli_real_escape_string($this->db->link, $brandNumberPhone);
			$brandAddress = mysqli_real_escape_string($this->db->link, $brandAddress);
			
			if(empty($brandName) || empty($brandNumberPhone) || empty($brandAddress)) {
				echo '<script>alert("Vui lòng điền đầy đủ thông tin của thương hiệu")</script>';
				return ;
			}
			else {
				$query = "update brand set name='$brandName', numberPhone='$brandNumberPhone', address='$brandAddress' where id = '$id'";
				$result = $this->db->update($query);
				
				if($result) {
					header("Location: brandManager.php?edit=true");
					return ;
				}
				else {
					echo '<script>alert("Sửa thương hiệu không thành công")</script>'; 
					return;
				}
			}
		}
		
		public function deleteBrand($id) {
			$query = "delete from brand where id = '$id'";
			$result = $this->db->select($query);
			if($result) {
				header("Location: brandManager.php?delete=true");
				return;
			}
			else {
				echo '<script>alert("Xóa thương hiệu không thành công")</script>'; 
				return;
			}
		}
		
		public function showBrand() {
			$query = "select *  from brand order by id desc";
			$result = $this->db->select($query);
			return $result;
		}
		
		public function getBrandById($id) {
			$query = "select * from brand where id= '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		
		public function findBrandByName($brandName) {
			$query = "select * from brand where name like '%$brandName%'";
			$result = $this->db->select($query);
			return $result;
		}
	}
?>