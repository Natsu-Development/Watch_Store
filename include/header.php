<?php
	ob_start();
	include('lib/session.php');
	Session::init();

	include('lib/database.php');
	include('helper/format.php');

	spl_autoload_register(function($class){
		include_once("classes/".$class.".php");
	});

	$db = new Database();
	$format = new Format();
	$cart = new cartHandle();
	$brand = new brand();
	$product = new product();
	$order = new order();
	$account = new account();
	if(isset($_GET['customerId'])) {
		$deleteAllCart = $cart->deleteAllCart();
		Session::destroy();
	}
?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WATCH SHOP</title>
	
	<link rel="stylesheet" href="Css/cart.css" type="text/css">
	<link rel="stylesheet" href="Bootstrap4/bootstrap-4.5.3-dist/css/bootstrap.min.css" type="text/css">
	
    <link rel="stylesheet" type="text/css" href="Css/basecss.css" />
    <link rel="stylesheet" type="text/css" href="Css/responsiveCss.css" />
    <link rel="stylesheet" type="text/css" href="Css/webcss.css" />
    <link rel="stylesheet" type="text/css" href="fontawesome-free-5.14.0-web/css/all.min.css" />
    <script type="text/javascript" src="JavaScript/jquery-3.5.1.min.js"></script>
</head>

<body>
    <a href="#" class="cd-top">
        ^
    </a>
    <div class="app">
        <header class="header">
            <div class="grid">
                <div class="menu-respond">
                    <div class="navicon-line"></div>
                    <div class="navicon-line"></div>
                    <div class="navicon-line"></div>
                </div>
                <nav class="header__navbar">
                    <ul class="header__navbar-list">
                        <li class="header__navbar-items header__navbar-user">
							<?php 
								if(!Session::get('customerName')) {		
							?>
                            <a class="sign-up" href="userLogin.php">Đăng kí </a>
                            <div class="header__navbar-link__separator"></div>
                            <a class="login" href="userLogin.php">Đăng nhập 
                            </a>
							<?php 
								}
								else {
							?>
                            <img src="Image/Tissot/Tissot T063.428.11.058.00.jpg" alt="" class="header__navbar-user-img"> <span class="header__navbar-user-name"><?php echo Session::get('customerName')?></span>
                            <ul class="header__navbar-user-menu">
								<li class="header__navbar-user-item"> <a href="myAccount.php">Tài khoản của tôi</a> </li>
                                <li class="header__navbar-user-item"> <a href="myOrder.php">Đơn mua của tôi</a> </li>
                                <li class="header__navbar-user-item"> <a href="index.php?customerId=<?php echo Session::get('customerId')?>">Đăng xuất</a> </li>
                            </ul>
							<?php 
								}
							?>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="header-with-search">

                <div class="header__logo"></div>
				<form action="" method="get">
					<div class="header__search">
						<div class="header__search-wrap">
							<!--
		  <div class="header__logo">
			 <img class="logo" src="https://pngimage.net/wp-content/uploads/2018/06/gshock-logo-png-10.png" alt="">
		  </div>
	-->
								<input class="header__search-input" name="search" placeholder="Nhập để tìm kiếm" id="search" />
								<ul class="header__search-history-list">
									<h3 class="header__search-history-heading">Lịch sử tìm kiếm</h3>
									<li class="header__search-history-icon"><a href="">Casio </a></li>
									<li class="header__search-history-icon"><a href="">Fossil</a></li>
								</ul>
						</div>
						<!--Chỉnh sửa lại khoảng cách của nút tìm kiếm-->
						<button class="header__search-btn" type="submit"> <i class="header__search-btn-icon fas fa-search"></i> </button>
					</div>
				</form>	
                <div class="header__cart">
                    <div class="header__cart-wrap" onClick="<?php echo '<script>window.location("cart.php")'?>" > <i class="header__cart-icon fas fa-shopping-cart"></i>
                        <!-- NO CART :header__cart-list--no-cart-->
                        <div class="header__cart-list" onClick="cart.php"> <img src="fontawesome-free-5.14.0-web/images.png" class="header__cart-no-cart-img"> <span class="header__cart-no-cart-msg">Chưa có sản phẩm</span>
                            <h4 class="header__cart-heading">Sản phẩm đã thêm</h4>
                            <ul class="header__cart-list-item">
								<?php 
									$showCart = $cart->getCart();
						 			if($showCart) {
										while($resultShowCart = $showCart->fetch_assoc()) {
								?>
                                <li class="header__cart-item"> <img src="Admin/uploads/<?php echo $resultShowCart['image']?>" alt="" class="header__cart-img">
                                    <div class="header__cart-item-info">
                                        <div class="header__cart-item-head">
                                            <h5 class="header__cart-item-name"><?php echo $resultShowCart['productName']?></h5>
                                            <div class="header__cart-item-price-wrap"> <span class="header__cart-item-price"><?php echo $resultShowCart['price']?></span> <span class="header__cart-item-multiply">x</span> <span class="header__cart-item-qnt"><?php echo $resultShowCart['amount']?></span> </div>
                                        </div>
                                    </div>
                                </li>
								<?php 
										}
									}
								?>
                            </ul>
                            <a href="cart.php" class="header__cart-view-cart btn btn--primary">Xem giỏ hàng</a> </div>	
                    </div>
                </div>
            </div>
            <div id="menu">
                <ul>
                    <li><a class="active" href="index.php"><i class="fa fa-fw fa-home"></i> Trang chủ</a></li>
                    <li><a class="active" href="#">Thương hiệu</a>
                        <ul class="sub-menu">
							<?php 
								$brandList = $brand->showBrand();
								if($brandList) {
									while($result = $brandList->fetch_assoc()) {
							?>
                            <li><a class="catagory-item__link" href="index.php?brandId=<?php echo $result['id']?>"><?php echo $result['name']?></a></li>
							<?php 
									}
								}
							?>
                        </ul>
                    </li>
                    <li><a class="active" href="#">Đồng hồ nam</a>
                        <ul class="sub-menu">
                            <li><a class="catagory-item__link" href="">Thương hiệu</a>
                                <ul class="sub-menu1">
                                    <?php 
										$brandList = $brand->showBrand();
										if($brandList) {
											while($result = $brandList->fetch_assoc()) {
									?>
									<li><a class="catagory-item__link" href="index.php?brandId=<?php echo $result['id']?>"><?php echo $result['name']?></a></li>
									<?php 
											}
										}
									?>
                                </ul>
                            </li>
                            <li><a class="catagory-item__link" href="">Mức giá</a>
                                <ul class="sub-menu1">
                                    <li><a class="catagory-item__link" href="index.php?classify=1">Dưới 5 triệu</a></li>
                                    <li><a class="catagory-item__link" href="index.php?classify=2">5-10 triệu</a></li>
                                    <li><a class="catagory-item__link" href="index.php?classify=3">10-20 triệu</a></li>
                                    <li><a class="catagory-item__link" href="index.php?classify=4">Trên 20 triệu</a></li>
                                </ul>
                            </li>
                            <li><a class="catagory-item__link" href="">Loại dây</a>
                                <ul class="sub-menu1">
                                    <li><a class="catagory-item__link" href="">Thép không gỉ</a></li>
                                    <li><a class="catagory-item__link" href="">Dây da</a></li>
                                    <li><a class="catagory-item__link" href="">Dây vải</a></li>
                                    <li><a class="catagory-item__link" href="">Dây cao su</a></li>
                                    <li><a class="catagory-item__link" href="">Dây nhựa</a></li>
                                </ul>
                            </li>
                            <li><a class="catagory-item__link" href="">Bộ máy</a>
                                <ul class="sub-menu1">
                                    <li><a class="catagory-item__link" href="">Automatic</a></li>
                                    <li><a class="catagory-item__link" href="">Quartz</a></li>
                                    <li><a class="catagory-item__link" href="">Năng lượng mặt trời</a></li>
                                    <li><a class="catagory-item__link" href="">Kinetic</a></li>
                                    <li><a class="catagory-item__link" href="">Lên cót tay</a></li>
                                </ul>
                            </li>
                            <li><a class="catagory-item__link" href="">Size mặt</a>
                                <ul class="sub-menu1">
                                    <li><a class="catagory-item__link" href="">Dưới 30mm</a></li>
                                    <li><a class="catagory-item__link" href="">Từ 30-34mm</a></li>
                                    <li><a class="catagory-item__link" href="">Từ 35-39mm</a></li>
                                    <li><a class="catagory-item__link" href="">Từ 40-43mm</a></li>
                                    <li><a class="catagory-item__link" href="">Trên 43mm</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a class="active" href="#">Đồng hồ nữ</a>
                        <ul class="sub-menu">
                            <li><a class="catagory-item__link" href="">Thương hiệu</a>
                                <ul class="sub-menu1">
                                    <li><a class="catagory-item__link" href="">Casio</a></li>
                                    <li><a class="catagory-item__link" href="">Fossil</a></li>
                                    <li><a class="catagory-item__link" href="">Tissot</a></li>
                                    <li><a class="catagory-item__link" href="">Orient</a></li>
                                    <li><a class="catagory-item__link" href="">Seiko</a></li>
                                    <li><a class="catagory-item__link" href="">G Shock</a></li>
                                    <li><a class="catagory-item__link" href="">Citizen</a></li>
                                </ul>
                            </li>
                            <li><a class="catagory-item__link" href="">Mức giá</a>
                                <ul class="sub-menu1">
                                    <li><a class="catagory-item__link" href="">Dưới 5 triệu</a></li>
                                    <li><a class="catagory-item__link" href="">5-10 triệu</a></li>
                                    <li><a class="catagory-item__link" href="">10-20 triệu</a></li>
                                    <li><a class="catagory-item__link" href="">Trên 20 triệu</a></li>
                                </ul>
                            </li>
                            <li><a class="catagory-item__link" href="">Loại dây</a>
                                <ul class="sub-menu1">
                                    <li><a class="catagory-item__link" href="">Thép không gỉ</a></li>
                                    <li><a class="catagory-item__link" href="">Dây da</a></li>
                                    <li><a class="catagory-item__link" href="">Dây vải</a></li>
                                    <li><a class="catagory-item__link" href="">Dây cao su</a></li>
                                    <li><a class="catagory-item__link" href="">Dây nhựa</a></li>
                                </ul>
                            </li>
                            <li><a class="catagory-item__link" href="">Bộ máy</a>
                                <ul class="sub-menu1">
                                    <li><a class="catagory-item__link" href="">Automatic</a></li>
                                    <li><a class="catagory-item__link" href="">Quartz</a></li>
                                    <li><a class="catagory-item__link" href="">Năng lượng mặt trời</a></li>
                                    <li><a class="catagory-item__link" href="">Kinetic</a></li>
                                    <li><a class="catagory-item__link" href="">Lên cót tay</a></li>
                                </ul>
                            </li>
                            <li><a class="catagory-item__link" href="">Size mặt</a>
                                <ul class="sub-menu1">
                                    <li><a class="catagory-item__link" href="">Dưới 30mm</a></li>
                                    <li><a class="catagory-item__link" href="">Từ 30-34mm</a></li>
                                    <li><a class="catagory-item__link" href="">Từ 35-39mm</a></li>
                                    <li><a class="catagory-item__link" href="">Từ 40-43mm</a></li>
                                    <li><a class="catagory-item__link" href="">Trên 43mm</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a class="active" href="#"><i class="fa fa-fw fa-envelope"></i> Liên hệ</a></li>
                </ul>
            </div>
        </header>