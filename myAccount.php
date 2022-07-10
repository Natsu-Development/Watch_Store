<?php 
	ob_start();
	include('include/header.php');
//	if(isset($_POST['delete'])) {
//		$id = $_POST['cartId'];
//		$deleteCart = $cart->deleteCart($id);
//	}
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateAccount'])) {
		$account->updateAccount($_POST);
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

            <h1 class="text-center">Tài khoản của tôi</h1>
			<form action="" method="post">
            <div class="row">
				<div class="col col-md-3"></div>
				<?php
					$myAccount = $account->getInfo(Session::get('customerId'));
					if($myAccount) {
						while($result = $myAccount->fetch_assoc()) {
				?>
                <div class="col col-md-6" style="text-align: center;">
					<div class="input-group" style="margin: 24px; font-size: 16px;">
						<label for="inputPassword4" style="margin-right: 48px;">Tên khách hàng</label>
						<input style="width: 300px;text-align:center" type="text"  id="inputPassword4" name="customerName" value="<?php echo $result['name']?>">
					</div>
					<div class="input-group" style="margin: 24px; font-size: 15px;">
						<label for="inputPassword4" style="margin-right: 113px;">Địa chỉ</label>
						<input style="width: 300px;text-align:center" type="text"  id="inputPassword4" name="address" value="<?php echo $result['address']?>">
					</div>
					<div class="input-group" style="margin: 24px; font-size: 16px;">
						<label for="inputPassword4" style="margin-right: 121px;">Email</label>
						<input style="width: 300px;text-align:center" type="text"  id="inputPassword4" name="email" value="<?php echo $result['email']?>">
					</div>
					<div class="input-group" style="margin: 24px; font-size: 16px;">
						<label for="inputPassword4" style="margin-right: 68px;">Số điện thoại</label>
						<input style="width: 300px;text-align:center" type="text"  id="inputPassword4" name="numberPhone" value="<?php echo $result['numberPhone']?>">
					</div>
					<div class="input-group" style="margin: 24px; font-size: 16px;">
						<label for="inputPassword4" style="margin-right: 65px;">Tên tài khoản</label>
						<input style="width: 300px;text-align:center" type="text"  id="inputPassword4" name="accountName" value="<?php echo $result['accountName']?>">
					</div>
					<div class="input-group" style="margin: 24px; font-size: 16px;">
						<label for="inputPassword4" style="margin-right: 95px;">Mật khẩu</label>
						<input style="width: 300px;text-align:center" type="text"  id="inputPassword4" name="password" value="<?php echo $result['password']?>">
					</div>
					<input type="hidden" name="customerId" value="<?php echo $result['id']?>">
					<button type="submit" class="btn btn-primary" name="updateAccount">Cập nhật tài khoản</button>
                </div>
				<?php 
						}
					}
				?>
				<div class="col col-md-3"></div>
            </div>
			</form>	
        </div>
        <!-- End block content -->
    </main>

<?php 
	include('include/footer.php');
	ob_end_flush();
?>