<?php 
	include('include/header.php');

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnCheckout'])) {
        $customerId = Session::get('customerId');
		// nếu người dùng chọn thanh toán offline
		if($_POST['httt_ma']==1) {
			// xóa giỏ hàng
        	$insertOrder = $cart->insertOrder($customerId, 1);// 1 ở đây là phương thức thanh toán offline 
		}
		// nếu người dùng chọn thanh toán online
		else {
			$total = $_POST['total'];
			if($order->getOrderId()===NULL) {
				$orderId = 1;
			}
			else {
				$orderId = $order->getOrderId()+1;
			}
			header('Location: vnpay_php/index.php?total='.$total.'&orderId='.$orderId.'');
		}
    }
?>
<main role="main"  style="font-size: 16px;">
        <!-- Block content - Đục lỗ trên giao diện bố cục chung, đặt tên là `content` -->
        <div class="container mt-4">
            <form class="needs-validation" name="frmthanhtoan" method="post"
                action="">
                <input type="hidden" name="kh_tendangnhap" value="dnpcuong">

                <div class="py-5 text-center">
                    <i class="fa fa-credit-card fa-4x" aria-hidden="true"></i>
                    <h2>Thanh toán</h2>
                    <p class="lead">Vui lòng kiểm tra thông tin Khách hàng, thông tin Giỏ hàng trước khi thanh toán.</p>
                </div>

                <div class="row">
					<div class="col-md-4 order-md-2 mb-4">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Giỏ hàng</span>
<!--                            <span class="badge badge-secondary badge-pill">2</span>-->
                        </h4>
                        <ul class="list-group mb-3">
							<?php 
								$getCustomerCart = $cart->getCart();
								$totalPrice = 0;
								if($getCustomerCart) {
									while($resultCustomerCart = $getCustomerCart->fetch_assoc()) {
							?>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0" style="font-size: 16px;"><?php echo $resultCustomerCart['productName']?></h6>
                                    <small class="text-muted"><?php echo $format->format_currency($resultCustomerCart['price'])." "."VNĐ" . ' * '. $resultCustomerCart['amount']?></small>
                                </div>
                                <span class="text-muted">
									<?php 
										$totalPrice += $resultCustomerCart['price'] * $resultCustomerCart['amount']; 
										echo $format->format_currency($resultCustomerCart['price'] * $resultCustomerCart['amount'])." "."VNĐ";
									?>
								</span>
                            </li>
							<?php 
									}
								}
							?>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Tổng thành tiền</span>
								<input type="hidden" value="<?php echo $totalPrice?>" name="total">
                                <strong><?php echo $format->format_currency($totalPrice)." "."VNĐ"?></strong>
                            </li>
						</ul>

                    </div>
                    <div class="col-md-8 order-md-1">
                        <h4 class="mb-3">Thông tin khách hàng</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="kh_ten">Họ tên</label>
                                <input type="text" class="form-control" name="kh_ten" id="kh_ten"
                                    value="<?php echo Session::get('customerName')?>">
                            </div>
                            <div class="col-md-12">
                                <label for="kh_diachi">Địa chỉ</label>
                                <input type="text" class="form-control" name="kh_diachi" id="kh_diachi"
                                    value="<?php echo Session::get('address')?>">
                            </div>
                            <div class="col-md-12">
                                <label for="kh_dienthoai">Điện thoại</label>
                                <input type="text" class="form-control" name="kh_dienthoai" id="kh_dienthoai"
                                    value="<?php echo Session::get('numberPhone')?>">
                            </div>
                            <div class="col-md-12">
                                <label for="kh_email">Email</label>
                                <input type="text" class="form-control" name="kh_email" id="kh_email"
                                    value="<?php echo Session::get('email')?>">
                            </div>
                        </div>

                        <h4 class="mb-3">Hình thức thanh toán</h4>

                        <div class="d-block my-3">
                            <div class="custom-control custom-radio">
                                <input id="httt-1" name="httt_ma" type="radio" class="custom-control-input" required=""
                                    value="1">
                                <label class="custom-control-label" for="httt-1">Thanh toán khi nhận hàng</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="httt-2" name="httt_ma" type="radio" class="custom-control-input" required=""
                                    value="2">
                                <label class="custom-control-label" for="httt-2">Thanh toán qua chuyển khoản</label>
                            </div>
                        </div>
                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit" name="btnCheckout">Thanh toán</button>
                    </div>
                </div>
            </form>

        </div>
        <!-- End block content -->
    </main>
<?php 
	include('include/footer.php');
?>