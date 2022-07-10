<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once($filepath.'/../lib/database.php');
	include_once($filepath.'/../helper/format.php');
?>

<?php 
	class order {
		
		private $db;
		private $fm;
		
		public function __construct() {
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function showAllOrder() {
			$query = "select * from tbl_order order by orderId desc";
			$result = $this->db->select($query);
			return $result;
		}
		
		public function getInfoCustomer($query) {
			$result = $this->db->getData($query);
			return $result;
		}
		
		public function updateOrder($id) {
			$id = mysqli_real_escape_string($this->db->link, $id);
			$query = "update tbl_order set status = 1 where orderId = '$id'";
			$result = $this->db->update($query);
			if($result){
				echo '<script>alert("Xác nhận đơn hàng thành công")</script>';
				return;
			}else{
				echo '<script>alert("Xác nhận đơn hàng không thành công")</script>';
				return;
			}
		}
		
		public function showAllOrderOfCustomer($id) {
			$query = "select * from tbl_order where customerId = '$id' order by orderId desc";
			$result = $this->db->select($query);
			return $result;
		}
		
		public function deleteOrder($id) {
			$query = "delete from tbl_order where orderId = '$id'";
			$result = $this->db->delete($query);
			if($result) {
				header('Location: myOrder.php?deleteSuccess=true');
			}
			else {
				echo '<script>alert("Hủy đơn hàng không thành công.")</script>';
			}
		}
		
		public function findOrderByCustomerName($name) {
			if($name=='' || $name==' ') {
				$query = "select * from tbl_order order by orderId desc";
			}
			else {
				$query = "select * from tbl_order where customerName like '%$name%' order by orderId desc";
			}
			$result = $this->db->select($query);
			return $result;
		}
		
		public function getOrderId() {			
			$query = "select max(orderId) as code from tbl_order";
			$result = $this->db->select($query);
			while($number = $result->fetch_assoc()) {
				$code = $number['code'];
			}	
			return $code;
		}
		
		public function getOrderById($id) {
			$query = "select * from tbl_order where orderId = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		
		public function insertOrder($customerId, $productCode, $amount){
			$flag = 0;
			// lấy thông tin khách hàng bằng mã khách hàng
			$queryGetCustomer = "select * from customer where id = '$customerId'";
			$getCustomer = $this->db->select($queryGetCustomer);
			if($getCustomer) {
				while($resultCustomer = $getCustomer->fetch_assoc()) {
					$customerName = $resultCustomer['name'];
				}
			}
			
			// lấy thông tin sản phẩm bằng mã sản phẩm
			$query = "select * from product where productCode = '$productCode'";
			$getProduct = $this->db->select($query);
			if($getProduct){
				while($result = $getProduct->fetch_assoc()){
					$productCode = $result['productCode'];
					$productName = $result['productName'];
					$price = $result['price'] * $amount;
					$image = $result['image'];
					$queryOrder = "insert into tbl_order(productCode, productName, amount, price, image, customerId, customerName) values ('$productCode', '$productName', '$amount', '$price', '$image', '$customerId', '$customerName')";
					$insertOrder = $this->db->insert($queryOrder);
					if($insertOrder) {
						$flag = 1;
					}
					else {
						$flag = 0;
					}
				}
				// kiểm tra phương thức thanh toán rồi trả về đúng trang
				if($flag==1) {
					header('Location: orderManager.php?add=true');
				}
				else {
					echo '<script>alert("Thêm đơn hàng không thành công")</script>';
				}
			}
		}
		
		public function updateOrderAdmin($productCode, $customerId, $amount, $id) {
			if(empty($productCode) || empty($customerId) || empty($amount) || empty($id)) {
				echo '<script>alert("Vui lòng nhập đầy đủ dữ liệu của đơn hàng")</script>';
			}
			$flag = 0;
			// lấy thông tin khách hàng bằng mã khách hàng
			$queryGetCustomer = "select * from customer where id = '$customerId'";
			$getCustomer = $this->db->select($queryGetCustomer);
			if($getCustomer) {
				while($resultCustomer = $getCustomer->fetch_assoc()) {
					$customerName = $resultCustomer['name'];
				}
			}
			// lấy thông tin sản phẩm bằng mã sản phẩm
			$query = "select * from product where productCode = '$productCode'";
			$getProduct = $this->db->select($query);
			if($getProduct){
				while($result = $getProduct->fetch_assoc()){
					$productCode = $result['productCode'];
					$productName = $result['productName'];
					$price = $result['price'] * $amount;
					$image = $result['image'];
					$queryUpdate = "update tbl_order set productCode = '$productCode', productName='$productName', amount = '$amount', price = '$price', image = '$image', customerId='$customerId', customerName = '$customerName', status = 0 where orderId = '$id'";
					$updateOrder = $this->db->update($queryUpdate);
					if($updateOrder) {
						$flag = 1;
					}
					else {
						$flag = 0;
					}
				}
				if($flag==1) {
					header('Location: orderManager.php?edit=true');
				}
				else {
					echo '<script>alert("Sửa đơn hàng không thành công")</script>';
				}
			}
		}
		
		public function deleteOrderAdmin($orderId) {
			$query = "delete from tbl_order where orderId = '$orderId'";
			$result = $this->db->delete($query);
			if($result) {
				header('Location: orderManager.php?delete=true');
			}
			else {
				echo '<script>alert("Xóa đơn hàng không thành công")</script>';
			}
		}

		public function getAllBillInvoice() {
			$query = "select * from payments";
			$result = $this->db->select($query);
			return $result;
		}

		public function getBillInvoiceByName($name) {
			$query = "select * from payments where customerName like '%$name%'";
			$result = $this->db->select($query);
			return $result;
		}
	}
?>