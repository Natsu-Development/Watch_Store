<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helper/format.php');
?>

<?php
	/**
	 * 
	 */
	class cartHandle
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function cartAdd($amount, $id){

			$amount = $this->fm->validation($amount);
			$amount = mysqli_real_escape_string($this->db->link, $amount);
			$id = mysqli_real_escape_string($this->db->link, $id);
			$sId = session_id();
			$checkCart = "select * from cart where productCode = '$id' and sId = '$sId'";
			$resultCheckCart = $this->db->select($checkCart);
			if($resultCheckCart){
				echo '<script>alert("Sản phẩm này đã được thêm vào giỏ hàng.")</script>';
				return;
			}else{
				$query = "select * from product where productCode = '$id'";
				$result = $this->db->select($query)->fetch_assoc();
				
				$image = $result["image"];
				$discountPrice = $result["discountPrice"];
				$productName = $result["productName"];

				$queryInsertCart = "insert into cart(productCode, sId, productName, price, amount, image) values('$id', '$sId', '$productName', '$discountPrice', '$amount', '$image')";
				$insertCart = $this->db->insert($queryInsertCart);
				if($insertCart){
					echo '<script>alert("Thêm sản phẩm vào giỏ hàng thành công")</script>';
					header("Refresh: 0");		
				}
				else {
					echo '<script>alert("Thêm sản phẩm vào giỏ hàng không thành công")</script>';
				}
			}
			
		}
		
		public function getCart(){
			$sId = session_id();
			$query = "select * from cart where sId = '$sId'";
			$result = $this->db->select($query);
			return $result;
		}
		public function updateCart($amount, $cartId){
			$amount = mysqli_real_escape_string($this->db->link, $amount);
			$cartId = mysqli_real_escape_string($this->db->link, $cartId);
			$query = "update cart set amount = '$amount' where cartId = '$cartId'";
			$result = $this->db->update($query);
			if($result){
				echo '<script>alert("Cập nhật giỏ hàng thành công")</script>';
				header("Refresh: 0");
			}else{
				echo '<script>alert("Cập nhật giỏ hàng không thành công")</script>';
				return;
			}
		
		}
		public function deleteCart($id){
			$cartid = mysqli_real_escape_string($this->db->link, $id);
			$query = "delete from cart where cartId = '$id'";
			$result = $this->db->delete($query);
			if($result){
				echo '<script>alert("Xóa giỏ hàng thành công")</script>';
				header("Refresh: 0");
			}
			else {
				echo '<script>alert("Xóa giỏ hàng không thành công")</script>';
				return;
			}
		}

		public function checkCart(){
			$sId = session_id();
			$query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
			$result = $this->db->select($query);
			return $result;
		}
		public function checkOrder($customer_id){
			$sId = session_id();
			$query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function deleteAllCart(){
			$sId = session_id();
			$query = "delete from cart where sId = '$sId'";
			$result = $this->db->delete($query);
		}
	
		public function insertOrder($customerId, $method){
			$sId = session_id();
			$flag = 0;
			$query = "SELECT * FROM cart WHERE sId = '$sId'";
			$getProduct = $this->db->select($query);
			if($getProduct){
				while($result = $getProduct->fetch_assoc()){
					$productCode = $result['productCode'];
					$productName = $result['productName'];
					$amount = $result['amount'];
					$price = $result['price'] * $amount;
					$image = $result['image'];
					$customerName = $_SESSION['customerName'];
					$queryOrder = "insert into tbl_order(productCode, productName, amount, price, image, customerId, customerName) values ('$productCode', '$productName', '$amount', '$price', '$image', '$customerId', '$customerName')";
					$insertOrder = $this->db->insert($queryOrder);
					if($insertOrder) {
						$flag = 1;
					}
					else {
						$flag = 0;
					}
				}
				// xóa giỏ hàng của khách hàng
				if($flag==1) {
					$this->deleteAllCart();
				}
				// kiểm tra phương thức thanh toán rồi trả về đúng trang
				if($flag==1 && $method==1) {
					header('Location: myOrder.php?checkOut=true');
				}
				else if($flag==1 && $method==2) {
					return;
				}
				else {
					echo '<script>alert("Thanh toán giỏ hàng không thành công")</script>';
				}
			}
		}
		
		public function getAmountPrice($customer_id){
		
			$query = "SELECT price FROM tbl_order WHERE customer_id = '$customer_id'";
			$get_price = $this->db->select($query);
			return $get_price;
		}
		public function get_cart_ordered($customer_id){
			$query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'";
			$get_cart_ordered = $this->db->select($query);
			return $get_cart_ordered;
		}
		public function get_inbox_cart(){
			$query = "SELECT * FROM tbl_order ORDER BY date_order";
			$get_inbox_cart = $this->db->select($query);
			return $get_inbox_cart;
		}
		public function shifted($id,$time,$price){
			$id = mysqli_real_escape_string($this->db->link, $id);
			$time = mysqli_real_escape_string($this->db->link, $time);
			$price = mysqli_real_escape_string($this->db->link, $price);
			$query = "UPDATE tbl_order SET

					status = '1'

					WHERE id = '$id' AND date_order='$time' AND price ='$price'";
			$result = $this->db->update($query);
			if($result){
				$msg = "<span class='success'>Update Order Successfully</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Update Order Not Successfully</span>";
				return $msg;
			}
		}
		public function del_shifted($id,$time,$price){
			$id = mysqli_real_escape_string($this->db->link, $id);
			$time = mysqli_real_escape_string($this->db->link, $time);
			$price = mysqli_real_escape_string($this->db->link, $price);
			$query = "DELETE FROM tbl_order 
					WHERE id = '$id' AND date_order='$time' AND price ='$price'";
			$result = $this->db->update($query);
			if($result){
				$msg = "<span class='success'>Detele Order Successfully</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Delete Order Not Successfully</span>";
				return $msg;
			}
		}
		public function shifted_confirm($id,$time,$price){
			$id = mysqli_real_escape_string($this->db->link, $id);
			$time = mysqli_real_escape_string($this->db->link, $time);
			$price = mysqli_real_escape_string($this->db->link, $price);
			$query = "UPDATE tbl_order SET

					status = '2'

					WHERE customer_id = '$id' AND date_order='$time' AND price ='$price'";
			$result = $this->db->update($query);
			return $result;
		}
		


	}
?>