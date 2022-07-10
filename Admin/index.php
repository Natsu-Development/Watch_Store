<?php 
	include("../classes/adminLogin.php");
?>
<?php 
	$class = new adminLogin();
	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$adminUser = $_POST['username'];
		$adminPass = md5($_POST['password']);
		
		$loginCheck = $class->loginAdmin($adminUser, $adminPass);
	}
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADMIN</title>
    <link rel="stylesheet" href="../Css/style.css">
    <link rel="stylesheet" type="text/css" href="../fontawesome-free-5.14.0-web/./css/./all.min.css" />
</head>

<body>
	<?php 
		if(isset($_GET["id"])) {
			echo '<script>alert("Tài khoản và mật khẩu không đúng. Vui lòng thử lại")</script>';
		}
		if(isset($_GET["warning"])) {
			echo '<script>alert("Vui lòng nhập đầy đủ thông tin đăng nhập")</script>';
		}
	?>
    <!-- main -->
    <div class="center-container">
        <!--header-->
        <div class="header-w3l">
            <h1>TRANG ĐĂNG NHẬP CỦA ADMIN</h1>
        </div>
        <!--//header-->
        <div class="main-content-agile">
            <div class="sub-main-w3">
                <div class="wthree-pro">
                    <h2>CHÀO MỪNG BẠN ĐÃ TRỞ LẠI</h2>
                </div>
                <form action="" method="post">
                    <div class="pom-agile">
                        <input id="a" placeholder="Tên đăng nhập" name="username" type="text">
                        <span class="icon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                    </div>
                    <div class="pom-agile">
                        <input id="b" placeholder="Mật khẩu" name="password" type="password">
                        <span class="icon2"><i class="fa fa-unlock" aria-hidden="true"></i></span>
                    </div>
                    <div class="sub-w3l">
                        <h6><a href="#">Bạn quên mật khẩu?</a></h6>
                        <div class="right-w3l">
							<input class="btnSignIn" type="submit" name="login" value="Đăng nhập">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>