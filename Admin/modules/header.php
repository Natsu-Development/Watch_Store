<?php 
	ob_start();
	include('../lib/session.php');
    Session::init();
	Session::checkSession();
//	if(isset($_SESSION['adminUser'])) {
//		echo '<script>alert("Đăng nhập thành công")</script>';
//	}
	if(isset($_GET["action"]) && $_GET["action"]=="logOut") {
		Session::destroy();
	}
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Admin Page</title>
    <link rel="stylesheet" type="text/css" href="../Css/basecss.css" />
    <link rel="stylesheet" type="text/css" href="../Css/webadmincss.css" />
    <link rel="stylesheet" type="text/css" href="../fontawesome-free-5.14.0-web/css/all.min.css" />
    <script type="text/javascript" src="../JavaScript/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="../Bootstrap4/bootstrap-4.5.3-dist/css/bootstrap.css">
	<link rel="stylesheet" href="../Bootstrap4/bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <script type="text/javascript" src="../Bootstrap4/bootstrap-4.5.3-dist/js/bootstrap.js" defer></script>
    <script type="text/javascript" src="../JavaScript/adminJs.js" defer></script>
    <script type="text/javascript" src="../JavaScript/temp.js" defer></script>
    <script type="text/javascript" src="../JavaScript/Chart.js"></script>


</head>

<body>

<header class="header">
        <div class="grid">
            <nav class="header__navbar">
                <ul class="header__navbar-list">
                    <li class="header__navbar-items header__navbar-user">
                        <!--		  <img src="./Image/Banner/61205.svg" alt="" class="header__navbar-user-img-active">-->
                        <img src="../Image/./GShock/G-SHOCK DW-5600BB-1DR.jpg" alt="" class="header__navbar-user-img"> <span class="header__navbar-user-name"><?php 
							echo Session::get('adminUser');
						?></span>
                        <div class="header__navbar-link__separator"></div>
                        <a class="header__navbar-link" href="adminPage.php?action=logOut">Đăng xuất
		  </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="header-with-search">

            <div class="header__logo"></div>
            <div class="header__search">
<!--
                <div class="header__search-wrap">
                    
	  <div class="header__logo">
         <img class="logo" src="https://pngimage.net/wp-content/uploads/2018/06/gshock-logo-png-10.png" alt="">
      </div>

                    <input class="header__search-input" value placeholder="Nhập để tìm kiếm" />
                    <ul class="header__search-history-list">
                        <h3 class="header__search-history-heading">Lịch sử tìm kiếm</h3>
                        <li class="header__search-history-icon"><a href="">xiaomi</a></li>
                        <li class="header__search-history-icon"><a href="">iphone</a></li>
                    </ul>
                </div>
-->
                <!--Chỉnh sửa lại khoảng cách của nút tìm kiếm-->
<!--                <button class="header__search-btn"> <i class="header__search-btn-icon fas fa-search"></i> </button>-->
            </div>
    </header>