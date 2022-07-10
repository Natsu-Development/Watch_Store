<?php 
	include('modules/header.php');
	include('modules/category.php');
	include('../classes/order.php');
	include('../classes/product.php');
	include('../classes/account.php');
	include('../classes/cartHandle.php');
	$order = new order();
	$product = new product();
	$account = new account();

	if(isset($_GET['orderId'])) {
		$id = $_GET['orderId'];
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['orderAdd'])) {
		$customerId = $_POST['customerId'];
		$productCode = $_POST['productCode'];
		$amount = $_POST['amount'];
		$order->insertOrder($customerId, $productCode, $amount);
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['orderEdit'])) {
		$customerId = $_POST['customerId'];
		$productCode = $_POST['productCode'];
		$amount = $_POST['amount'];
		$order->updateOrderAdmin($productCode, $customerId, $amount, $id);
	}
?>

<div class="grid__column-10" style="font-size: 14px;" >
					<div class="modal-dialog modal-lg" style="box-shadow: rgba(0,0,0,0.3) 1px 1px 5px; max-width: 950px;" >
                        <div class="modal-content" style="height: 270px">
                            <div class="modal-header" style="border-bottom: none;">
								<?php 
									if(isset($_GET['orderId'])) {
								?>
                                <h4 >Sửa đơn hàng</h4>
								<?php 
									}
									else {
								?>
								<h4> Thêm đơn hàng </h4>
								<?php 
									}
								?>	
                            </div>
                            <div class="modal-body"  style="height: 220px;">
                            <?php
								if(isset($_GET['orderId'])) {
									$getOrderById = $order->getOrderById($id);
									if($getOrderById) {
										while($result = $getOrderById->fetch_assoc()) {
							?>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        
                                        <div class="col-md-6">
											<div class="input-group">
											<label for="inputState">Tên sản phẩm</label><br>
												<select id="inputState" style="text-align: center;" name="productCode">
													<option>Chọn sản phẩm</option>
													<?php 
														$productList = $product->showAllProduct();
														if($productList) {
															while($resultProduct = $productList->fetch_assoc()) {
													?>
													<option <?php if($resultProduct['productCode']==$result['productCode']) echo 'selected';?>
													value="<?php echo $resultProduct['productCode']?>"><?php echo $resultProduct['productName']?></option>
													<?php 
															}
														}
													?>
												</select>	
												
											</div>
<!--											nên lấy ra cb box ở đây hay không-->
											<div class="input-group">
											<label for="inputState">Tên khách hàng</label><br>
												<select id="inputState" style="text-align: center;" name="customerId">
													<option>Chọn khách hàng</option>
													<?php 
														$customerList = $account->getAllCustomer();
														if($customerList) {
															while($resultCustomer = $customerList->fetch_assoc()) {
													?>
													<option <?php if($resultCustomer['id']==$result['customerId']) echo 'selected';?>
													value="<?php echo $resultCustomer['id']?>"><?php echo $resultCustomer['name']?></option>
													<?php 
															}
														}
													?>
												</select>	
												
											</div>
											<div class="input-group">
												<label for="inputPassword4">Số lượng</label>
												<input style="width: 300px;" type="number"  id="inputPassword4" placeholder="Số lượng sản phẩm" name="amount" value="<?php echo $result['amount']?>">
											</div>	
                                        </div>
                                    </div>
                                     <?php 
												if(isset($_GET["orderId"])) {
													echo '<div class="modal-footer" style="border-top: none;">
															<input type="submit" class="btn btn-success" name="orderEdit" value="Sửa">
														</div>';
												}
												else {
													echo '<div class="modal-footer" style="border-top: none;">
															<input type="submit" class="btn btn-success" name="orderAdd" value="Thêm">
														</div>';
												}
										?>
                                  </form>
                            <?php 
										}
									}
								}
								else {
							?> 
								<form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        
                                        <div class="col-md-6">
											<div class="input-group">
											<label for="inputState">Tên sản phẩm</label><br>
												<select id="inputState" style="text-align: center;" name="productCode">
													<option>Chọn sản phẩm</option>
													<?php 
														$productList = $product->showAllProduct();
														if($productList) {
															while($resultProduct = $productList->fetch_assoc()) {
													?>
													<option
													value="<?php echo $resultProduct['productCode']?>"><?php echo $resultProduct['productName']?></option>
													<?php 
															}
														}
													?>
												</select>	
												
											</div>
<!--											nên lấy ra cb box ở đây hay không-->
											<div class="input-group">
											<label for="inputState">Tên khách hàng</label><br>
												<select id="inputState" style="text-align: center;" name="customerId">
													<option>Chọn khách hàng</option>
													<?php 
														$customerList = $account->getAllCustomer();
														if($customerList) {
															while($resultCustomer = $customerList->fetch_assoc()) {
													?>
													<option
													value="<?php echo $resultCustomer['id']?>"><?php echo $resultCustomer['name']?></option>
													<?php 
															}
														}
													?>
												</select>	
												
											</div>
											<div class="input-group">
												<label for="inputPassword4">Số lượng</label>
												<input style="width: 300px;" type="number"  id="inputPassword4" placeholder="Số lượng sản phẩm" name="amount">
											</div>	
<!--
											<div class="input-group">
												<label for="inputPassword4">Giá</label>
												<input style="width: 300px;" type="number"  id="inputPassword4" placeholder="Giá bán" name="address">
											</div>	
-->
                                        </div>
                                    </div>
                                    <?php 
												if(isset($_GET["orderId"])) {
													echo '<div class="modal-footer" style="border-top: none;">
															<input type="submit" class="btn btn-success" name="orderEdit" value="Lưu">
														</div>';
												}
												else {
													echo '<div class="modal-footer" style="border-top: none;">
															<input type="submit" class="btn btn-success" name="orderAdd" value="Thêm">
														</div>';
												}
										?>
                                  </form>
							<?php 
								}
							?>	
                                </div>
                        </div>
                        
                    	
				</div>
            </div>
</div>
</div>
</div>
<?php 
	include('modules/footer.php');
?>