<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once($filepath.'/../lib/database.php');
	include_once($filepath.'/../helper/format.php');
?>

<?php 
	class product {
		
		private $db;
		private $fm;
		
		public function __construct() {
			$this->db = new Database();
			$this->fm = new Format();
		}
		
		public function productAdd($data, $file) {
			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$productTitle = mysqli_real_escape_string($this->db->link, $data['productTitle']);
			$trademark = mysqli_real_escape_string($this->db->link, $data['trademark']);
			$amount = mysqli_real_escape_string($this->db->link, $data['amount']);
			$introduce = mysqli_real_escape_string($this->db->link, $data['productIntroduce']);
			$details = mysqli_real_escape_string($this->db->link, $data['productDetails']);
			$price = mysqli_real_escape_string($this->db->link, $data['price']);
			$discountPrice = mysqli_real_escape_string($this->db->link, $data['discountPrice']);
			// hình ảnh
			$permitted = array('jpg', 'jpeg', 'png', 'gif');
			$fileName = $_FILES['image']['name'];
			$size = $_FILES['image']['size'];
			$temp = $_FILES['image']['tmp_name'];
			
			$div = explode('.', $fileName);
			$file_ext = strtolower(end($div));
			$uniqueImage = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploadImage = 'uploads/'.$uniqueImage;
		
			if(empty($productName) || empty($trademark) || empty($amount) || empty($introduce) || empty($details) || empty($price) || empty($discountPrice) || empty($fileName)) {
				$alert = "Vui lòng điền đầy đủ thông tin của sản phẩm";
				return $alert;
			}
			else {
				move_uploaded_file($temp, $uploadImage);
				$query = "insert into product(productName, productTitle, image, brandId, amount, introduce, details, price, discountPrice) values ('$productName', '$productTitle', '$uniqueImage', '$trademark', '$amount', '$introduce', '$details', '$price', '$discountPrice')";
				$result = $this->db->insert($query);
				
				if($result) {
					header('Location: productManager.php?add=true');
				}
				else {
					echo '<script>alert("Thêm sản phẩm không thành công. Vui lòng thử lại")</script>';
					return;
				}
			}
		}
		
		public function productUpdate($data, $files, $productCode) {
			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$productTitle = mysqli_real_escape_string($this->db->link, $data['productTitle']);
			$trademark = mysqli_real_escape_string($this->db->link, $data['trademark']);
			$amount = mysqli_real_escape_string($this->db->link, $data['amount']);
			$introduce = mysqli_real_escape_string($this->db->link, $data['productIntroduce']);
			$details = mysqli_real_escape_string($this->db->link, $data['productDetails']);
			$price = mysqli_real_escape_string($this->db->link, $data['price']);
			$discountPrice = mysqli_real_escape_string($this->db->link, $data['discountPrice']);
			// hình ảnh
			$permitted = array('jpg', 'jpeg', 'png', 'gif');
			$fileName = $_FILES['image']['name'];
			$size = $_FILES['image']['size'];
			$temp = $_FILES['image']['tmp_name'];
			
			$div = explode('.', $fileName);
			$file_ext = strtolower(end($div));
			$uniqueImage = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploadImage = 'uploads/'.$uniqueImage;
		
			if(empty($productName) || empty($trademark) || empty($amount) || empty($introduce) || empty($details) || empty($price) || empty($discountPrice)) {
				header("Location: productAdd.php?warning=1");
				return ;
			}
			else {
				if(!empty($fileName)) {
					// nếu người dùng chọn ảnh
					// coi lại size ảnh
					if($size>2000000000000) {
						echo '<script>alert("test")</script>';
						return;
					}
					else if(in_array($file_ext, $permitted) == false) {
						return;
					}
					echo '<script>alert("test1")</script>';
					// xóa ảnh đó ra khỏi file
					$queryImage = "select image from product where productCode = '$productCode'";
					$resultImage = $this->db->getData($queryImage);
					unlink('uploads/'.$resultImage);
					
					// thêm ảnh cần chỉnh sửa vào file
					move_uploaded_file($temp, $uploadImage);
					
					$query = "update product set productName = '$productName', productTitle = '$productTitle', image = '$uniqueImage', brandId ='$trademark', amount = '$amount', introduce = '$introduce', details = '$details', price = '$price', discountPrice='$discountPrice' where productCode = '$productCode'";
				}
				else {
					// nếu người dùng không sửa ảnh
					$query = "update product set productName = '$productName', productTitle = '$productTitle', brandId ='$trademark', amount = '$amount', introduce = '$introduce', details = '$details', price = '$price', discountPrice='$discountPrice' where productCode = '$productCode'";
				}
				$result = $this->db->update($query);
				if($result) {
					header('Location: productManager.php?edit=true');
					return $alert;
				}
				else {
					echo '<script>alert("Sửa sản phẩm không thành công. Vui lòng thử lại")</script>';
					return;
				}
			}
		}
		
		public function deleteProduct($id) {
			// lấy hình ảnh của sản phẩm muốn xóa
			$queryImage = "select image from product where productCode = '$id'";
			$resultImage = $this->db->getData($queryImage);
			$query = "delete from product where productCode = '$id'";
			$result = $this->db->delete($query);
			if($result) {
				// xóa hình ảnh của sản phẩm đó trong file uploads
				unlink('uploads/'.$resultImage);
				header("Location: productManager.php?delete=true");
				return;
			}
			else {
				echo '<script>alert("Xóa sản phẩm không thành công. Vui lòng thử lại")</script>';
				return;
			}
		}
		
		public function findProductByName($productName) {
			$query = "select * from product where productName like '%$productName%'";
			$result = $this->db->select($query);
			return $result;
		}
		
		public function showProduct($index) {
			$query = "select * from product limit ".$index.", 8";
			
			$result = $this->db->select($query);
			return $result;
		}
		
		public function showAllProduct() {
			$query = "select * from product";
			$result = $this->db->select($query);
			return $result;
			//			$query = "select product.*, brand.id from product inner join brand on product.brandId = brand.id order by product.productCode desc";
//			
		}
		
		public function getProductById($productCode) {
			$query = "select * from product where productCode = '$productCode'";
			$result = $this->db->select($query);
			return $result;
		}
		
		public function getDataProduct($query) {
			$result = $this->db->getData($query);
			return $result;
		}
		
		public function checkAmountProduct($productCode, $amount) {
			$productCode = mysqli_real_escape_string($this->db->link, $productCode);
			$amount = mysqli_real_escape_string($this->db->link, $amount);
			$query = "select amount from product where productCode ='$productCode'";
			$amountProduct = $this->getDataProduct($query);
			if($amountProduct>=$amount && $amount>0) {
				return true;
			}
			else {
				echo '<script>alert("Số lượng của sản phẩm không đủ với số lượng bạn yêu cầu. Vui lòng thử lại")</script>';
				return false;
			}
		}
		
		public function handleProductToOrder($productCode, $amountOrder) {
			$query = "select amount from product where productCode ='$productCode'";
			$amountProduct = $this->getDataProduct($query);
			$productCode = mysqli_real_escape_string($this->db->link, $productCode);
			$amountOrder = mysqli_real_escape_string($this->db->link, $amountOrder);
			$remainAmount  = $amountProduct - $amountOrder;
			$query = "update product set amount='$remainAmount' where productCode='$productCode'";
			$result = $this->db->update($query);
			if($result) {
				return true;
			}
			else {
				return false;
			}
		}
		
		public function findProductByBrand($id) {
			$query = "select * from product where brandId = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		
		// đếm số lượng sản phẩm để phân trang
		public function countProduct() {
			$query = "select count(productCode) as number from product";
			$result = $this->db->select($query);
			while($number = $result->fetch_assoc()) {
				$amount = $number['number'];
			}	
			$page = ceil($amount/8);
			return $page;
		}
	}
?>