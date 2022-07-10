<?php 
	include('include/header.php');
    // include_once('helper/format.php');
    // $format = new Format();
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnPay'])) {
        header('Location: vnpay_php/index.php?total='.$_GET['total'].'');
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
                    <h2>Thanh toán online</h2>
                    <p class="lead">Vui lòng kiểm tra thông tin Khách hàng, thông tin Giỏ hàng trước khi Thanh toán.</p>
                </div>

                <div class="row">
                    <div class="col-md-8 order-md-1" style="margin: auto">
                        <h4 class="mb-3" style="margin-left: 272px;font-size: 18px;">Thông tin tài khoản của bạn</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="kh_ten">Số tài khoản</label>
                                <input type="text" class="form-control" name="kh_ten" id="kh_ten"
                                    style="height: 30px;font-size: 15px;">
                            </div>
                            <div class="col-md-12">
                                <label for="kh_diachi">Tên chủ tài khoản</label>
                                <input type="text" class="form-control" name="kh_diachi" id="kh_diachi"
                                  style="height: 30px;font-size: 15px;">
                            </div>
                            <div class="col-md-12">
                                <label for="kh_dienthoai">Nội dung chuyển khoản</label>
                                <input type="text" class="form-control" name="kh_dienthoai" id="kh_dienthoai"
                                   style="height: 30px;font-size: 15px;">
                            </div>
                            <div class="col-md-12">
                                <label for="kh_email">Số tiền chuyển khoản</label>
                                <input type="text" class="form-control" name="kh_email" id="kh_email"
                                    value="<?php echo $format->format_currency($_GET['total'])." "."VNĐ"?>" style="height: 30px;font-size: 15px;">
                            </div>
							<div class="col-md-12">
                                <label for="kh_email">Ngân hàng</label>
									<select name="bank_code" id="bank_code" class="form-control" style="font-size: 14px;">
										<option value="">Không chọn</option>
										<option value="NCB"> Ngan hang NCB</option>
										<option value="AGRIBANK"> Ngan hang Agribank</option>
										<option value="SCB"> Ngan hang SCB</option>
										<option value="SACOMBANK">Ngan hang SacomBank</option>
										<option value="EXIMBANK"> Ngan hang EximBank</option>
										<option value="MSBANK"> Ngan hang MSBANK</option>
										<option value="NAMABANK"> Ngan hang NamABank</option>
										<option value="VNMART"> Vi dien tu VnMart</option>
										<option value="VIETINBANK">Ngan hang Vietinbank</option>
										<option value="VIETCOMBANK"> Ngan hang VCB</option>
										<option value="HDBANK">Ngan hang HDBank</option>
										<option value="DONGABANK"> Ngan hang Dong A</option>
										<option value="TPBANK"> Ngân hàng TPBank</option>
										<option value="OJB"> Ngân hàng OceanBank</option>
										<option value="BIDV"> Ngân hàng BIDV</option>
										<option value="TECHCOMBANK"> Ngân hàng Techcombank</option>
										<option value="VPBANK"> Ngan hang VPBank</option>
										<option value="MBBANK"> Ngan hang MBBank</option>
										<option value="ACB"> Ngan hang ACB</option>
										<option value="OCB"> Ngan hang OCB</option>
										<option value="IVB"> Ngan hang IVB</option>
										<option value="VISA"> Thanh toan qua VISA/MASTER</option>
									</select>
                            </div>
                        </div>
                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit" name="btnPay">Thanh toán
                            </button>
                    </div>
                </div>
            </form>

        </div>
        <!-- End block content -->
    </main>
<?php 
	include('include/footer.php');
?>