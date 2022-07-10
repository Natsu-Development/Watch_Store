<?php 
	ob_start();
	include('include/header.php');

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancelOrder'])) {
		$orderId = $_POST['orderId'];
		$status = $_POST['status'];
		if($status==0) {
			$order->deleteOrder($orderId);
		}
		else {
			echo '<script>alert("Đơn hàng này đã được xác nhận bạn không thể hủy đơn hàng này.")</script>';
		}
	}

	if(isset($_GET['deleteSuccess'])) {
		echo '<script>alert("Hủy đơn hàng thành công.")</script>';
	}
	
	if(isset($_GET['checkOut'])) {
		echo '<script>alert("Thanh toán giỏ hàng thành công")</script>';
	}
?>
    <main role="main">
        <!-- Block content - Đục lỗ trên giao diện bố cục chung, đặt tên là `content` -->
        <div class="container mt-4">
            <div id="thongbao" class="alert alert-danger d-none face" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <h1 class="text-center">Đơn hàng của tôi</h1>
			<form action="" method="post">
            <div class="row">
                <div class="col col-md-12">
                    <table class="table table-bordered" style="font-size: 16px;">
                        <thead>
                            <tr style="text-align: center">
                                <th>STT</th>
                                <th>Ảnh sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
								<th>Quá trình</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
						<?php 
							$showAllOrder = $order->showAllOrderOfCustomer(Session::get('customerId'));
							$totalPrice = 0;
							if($showAllOrder) {
								$i = 0;
								while($resultShowAllOrder = $showAllOrder->fetch_assoc()) {
									$i++;
						?>
                        <tbody id="datarow" style="text-align: center">
                            <tr style="text-align: center">
                                <td><?php echo $i;?></td>
                                <td>
                                    <img src="Admin/uploads/<?php echo $resultShowAllOrder['image']?>" class="hinhdaidien">
                                </td>
                                <td><?php echo $resultShowAllOrder['productName']?></td>
								<td>
                                <input type="text" style="width: 40px; text-align:center;" min="1" value="<?php echo $resultShowAllOrder['amount']?>" name="amount" readonly/>
								</td>
                                <td><?php $totalPrice +=$resultShowAllOrder['price']*$resultShowAllOrder['amount']; echo $format->format_currency($resultShowAllOrder['price']*$resultShowAllOrder['amount'])." "."VNĐ"?></td>
                                <td>
									<input type="hidden" name="status" value="<?php echo $resultShowAllOrder['status']?>">
                                    <?php 
										if($resultShowAllOrder['status']==0) {
											echo "Đang chờ xử lí";
										}
										else {
											echo "Đang giao hàng";
										}
									?>
                                </td>
								<td>
									<input type="hidden" name="orderId" value="<?php echo $resultShowAllOrder['orderId']?>">
									<button type="submit" name="cancelOrder"
										<?php 
											if($resultShowAllOrder['status']==0) {
												echo 'class="btn btn-primary"';
											}
											else {
												echo 'class="btn btn-primary" style="background-color: rgba(0,0,0,0.5); color:white"';
											}
										?>
									>Hủy đơn hàng</button>
								</td>
                            </tr>
                        </tbody>
						<?php 
								}
							}
						?>
                    </table>
					<div style="display:flex;margin: 16px;font-size: 20px;float: right;">
						<span style="margin-right: 24px;">Tổng tiền:</span>
						<span style="color: #d4020d">
							<div class="size-16 align-right">
								<?php
									if($totalPrice>0 && isset($totalPrice)) {
										echo $format->format_currency($totalPrice)." "."VNĐ";
									}
								?>
							</div>
						</span>
					</div>		
                </div>
            </div>
			</form>	
        </div>
        <!-- End block content -->
    </main>

<?php 
	include('include/footer.php');
	ob_end_flush();
?>