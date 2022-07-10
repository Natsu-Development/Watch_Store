<?php 
	include('modules/header.php');
	include('modules/category.php');
	include('../classes/order.php');
	include('../classes/product.php');
	include_once('../helper/format.php');
	$format = new Format();
	$order = new order();
	$product = new product();

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm'])) {
		$id = $_POST['orderId'];
		$amount = $_POST['amount'];
		// xử lí sản phẩm để xác nhận đơn hàng
		$productCode = $_POST['productCode'];
		if($product->handleProductToOrder($productCode, $amount)) {
		// cập nhật giỏ hàng
			$order->updateOrder($id);
		}
	}
	
	if(isset($_GET['orderId'])) {
		$order->deleteOrderAdmin($_GET['orderId']);
	}
	if(isset($_GET['add'])) {
		echo '<script>alert("Thêm đơn hàng thành công")</script>';
	}
	if(isset($_GET['edit'])) {
		echo '<script>alert("Sửa đơn hàng thành công")</script>';
	}
	if(isset($_GET['delete'])) {
		echo '<script>alert("Xóa đơn hàng thành công")</script>';
	}
?>
<div class="grid__column-10 ">
                    <div class="admin-title ">
                        <span>QUẢN LÍ ĐƠN HÀNG</span>
                    </div>
                    <div class="grid__row ">
						<?php 
							if(isset($_GET['orderFind'])) {
						?>
                        <div class="admin-product__add ">
                            <!-- nội dung -->
							<form action="" method="get" style="margin-bottom: 15px;">
								<div class="header__search-wrap" style="display: flex">
									<input class="header__search-input" name="orderFind" placeholder="Nhập tên khách hàng để tìm kiếm" style="height: 34px;background-color: #E8F0FE;color: black; margin-right: 14px;" />
									<button class="header__search-btn" type="submit" style="background-color: #d4020d"> <i class="header__search-btn-icon fas fa-search"></i> </button>
								</div>	
							</form>	
							<div class="product-add">
								<a href="orderAdd.php">
									<button class="product-add__action">Thêm đơn hàng mới</button>
								</a>
							</div>
                            <!--Table head-->
							<form action="" method="post" style="width: 1160px;">
                            <table class="table table-hover ">
								
                                <!--Table head-->
                                <thead style="font-size: 13px; border: 3px;color: white;background-color: #d4020d; " class="table-primary ">
									<tr style="text-align: top " ;>
										<th>STT</th>
										<th>Tên khách hàng</th>
										<th>Tên sản phẩm</th>
										<th>Số lượng</th>
										<TH>Địa chỉ giao hàng</TH>
										<TH>Số điện thoại</TH>
										<TH>Ngày đặt hàng</TH>
										<TH>Tổng tiền(vnđ)</TH>
										<TH>Xác nhận</TH>
										<th>Hành động</th>
									</tr>
                                </thead>
                                <!--Table head-->

                                <!--Table body-->
								<?php 
									$findOrder = $order->findOrderByCustomerName($_GET['orderFind']);
									if($findOrder) {
										$i =0;
										while($resultFind = $findOrder->fetch_assoc()) {
											$i++;
											$customerId = $resultFind['customerId'];
											$productCode = $resultFind['productCode'];
								?>
                                <tbody style="font-size: 13px; ">
                                    <tr name="sp1 ">
                                        <td scope="row " style="width: 20px; "><?php echo $i?></td>
                                        <td>
											<?php 
												// lấy tên khách hàng theo mã khách hàng
												$query = "select name from customer where id = '$customerId'";
												echo $order->getInfoCustomer($query);
											?>
										</td>
										<td>
											<?php 
												$query = "select productName from product where productCode = '$productCode'";
												echo $product->getDataProduct($query);
											?>
										</td>
										<td>
											<input type="hidden" name="amount" value=<?php echo $resultFind['amount'] ?> >
											<?php echo $resultFind['amount']?>
										</td>
                                        <td>
											<?php
												$query = "select address from customer where id = '$customerId'";
												echo $order->getInfoCustomer($query);
											?>
										</td>
										<td><?php
												$query = "select numberPhone from customer where id = '$customerId'";
												echo $order->getInfoCustomer($query);
											?>
										</td>
										<td>
											<?php 
												echo date_format(date_create($resultFind['dateOrder']), 'd/m/Y H:i:s');
											?>
										</td>
										<td><?php echo $format->format_currency($resultFind['price'])." "."VNĐ"?></td>
										<?php 
											if($resultFind['status']==0) {
										?>
                                        <td>
										<input type="hidden" name="productCode" value="<?php echo $resultFind['productCode']?>">
											<input type="hidden" name="orderId" value="<?php echo $resultFind['orderId']?>">
											<button type="submit" class="btn btn-primary" name="confirm" value="0">Xác nhận</button>
										</td>
										<?php 
											}
											else {
										?>
										<td>
											<span>Đã xác nhận</span>
										</td>	
										<?php 
											}
										?>
										<td style="display: flex">
											<a href="orderAdd.php?orderId=<?php echo $result['orderId']?>">
												<button type="button" class="btn" style="background-color: var(--primary-color);color: white;margin: 8px;height: 34px; min-width: 70px;">Sửa</button>
											</a>	
											<a onClick= "return confirm('Bạn có muốn xóa đơn hàng này không?')" href="orderManager.php?orderId=<?php echo $result['orderId']?>">
												<button type="button" class="btn" style="background-color: var(--primary-color);color: white;margin: 8px;height: 34px; min-width: 70px;">Xóa</button>
											</a>
										</td>
                                    </tr>                                  
                                </tbody>
								<?php 
										}
									}
								?>
                                <!--Table body-->

                            </table>
<!--
                            <div class="save__controls ">
                                <button class="save__controls-back " onclick="saveSuccess()">Lưu</button>
                            </div>
-->
                            <!--Table-->
                            <!-- hết nội dung -->
							</form>
                        </div>
						<?php 
							}
							else {
						?>
						<div class="admin-product__add ">
                            <!-- nội dung -->
							<form action="" method="get" style="margin-bottom: 15px;">
								<div class="header__search-wrap" style="display: flex">
									<input class="header__search-input" name="orderFind" placeholder="Nhập tên khách hàng để tìm kiếm" style="height: 34px;background-color: #E8F0FE;color: black; margin-right: 14px;" />
									<button class="header__search-btn" type="submit" style="background-color: #d4020d"> <i class="header__search-btn-icon fas fa-search"></i> </button>
								</div>	
							</form>	
							<div class="product-add">
								<a href="orderAdd.php">
									<button class="product-add__action">Thêm đơn hàng mới</button>
								</a>
							</div>
                            <!--Table head-->
							<form action="" method="post" style="width: 1160px;">
                            <table class="table table-hover ">
								
                                <!--Table head-->
                                <thead style="font-size: 13px; border: 3px;color: white;background-color: #d4020d; " class="table-primary ">
									<tr style="text-align: top " ;>
										<th>STT</th>
										<th>Tên khách hàng</th>
										<th>Tên sản phẩm</th>
										<th>Số lượng</th>
										<TH>Địa chỉ giao hàng</TH>
										<TH>Số điện thoại</TH>
										<TH>Ngày đặt hàng</TH>
										<TH>Tổng tiền(vnđ)</TH>
										<TH>Xác nhận</TH>
										<th>Hành động</th>
									</tr>
                                </thead>
                                <!--Table head-->

                                <!--Table body-->
								<?php 
									$showOrder = $order->showAllOrder();
									if($showOrder) {
										$i =0;
										while($result = $showOrder->fetch_assoc()) {
											$i++;
											$customerId = $result['customerId'];
											// $productCode = $result['productCode'];
								?>
                                <tbody style="font-size: 13px; ">
                                    <tr name="sp1 ">
                                        <td scope="row " style="width: 20px; "><?php echo $i?></td>
                                        <td>
											<?php 
												// lấy tên khách hàng theo mã khách hàng
												$query = "select name from customer where id = '$customerId'";
												echo $order->getInfoCustomer($query);
											?>
										</td>
										<td>
											<?php 
												$query = "select productName from product where productCode = '$result[productCode]'";
												echo $product->getDataProduct($query);
											?>
										</td>
										<td>
											<input type="hidden" name="amount" value=<?php echo $result['amount'] ?> >
											<?php echo $result['amount']?>
										</td>
                                        <td>
											<?php
												$query = "select address from customer where id = '$customerId'";
												echo $order->getInfoCustomer($query);
											?>
										</td>
										<td><?php
												$query = "select numberPhone from customer where id = '$customerId'";
												echo $order->getInfoCustomer($query);
											?>
										</td>
										<td>
											<?php 
												echo date_format(date_create($result['dateOrder']), 'd/m/Y H:i:s');
											?>
										</td>
										<td><?php echo $format->format_currency($result['price'])." "."VNĐ"?></td>
										<?php 
											if($result['status']==0) {
										?>
                                        <td>
											<input type="hidden" name="productCode" value="<?php echo $result['productCode']?>">
											<input type="hidden" name="orderId" value="<?php echo $result['orderId']?>">
											<button type="submit" class="btn" name="confirm" value="0" style="background-color: #007bff;color: white;margin: 8px;height: 34px; min-width: 96px;">Xác nhận</button>
										</td>
										<?php 
											}
											else {
										?>
										<td>
											<span>Đã xác nhận</span>
										</td>	
										<?php 
											}
										?>
										<td style="display: flex">
											<a href="orderAdd.php?orderId=<?php echo $result['orderId']?>">
												<button type="button" class="btn" style="background-color: var(--primary-color);color: white;margin: 8px;height: 34px; min-width: 70px;">Sửa</button>
											</a>	
											<a onClick= "return confirm('Bạn có muốn xóa đơn hàng này không?')" href="orderManager.php?orderId=<?php echo $result['orderId']?>">
												<button type="button" class="btn" style="background-color: var(--primary-color);color: white;margin: 8px;height: 34px; min-width: 70px;">Xóa</button>
											</a>
										</td>
                                    </tr>                                  
                                </tbody>
								<?php 
										}
									}
								?>
                                <!--Table body-->

                            </table>
<!--
                            <div class="save__controls ">
                                <button class="save__controls-back " onclick="saveSuccess()">Lưu</button>
                            </div>
-->
                            <!--Table-->
                            <!-- hết nội dung -->
							</form>
                        </div>
						<?php 
							}
						?>
                    </div>

                </div>
			</div>
		</div>
	</div>
<?php 
	include('modules/footer.php');
?>