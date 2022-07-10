<?php 
	session_start();
	include("classes/account.php"); 
	$account = new account();
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signUp'])) {
		$accountAdd = $account->signUp($_POST);
	}
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
		$userName = $_POST['accountName'];
		$userPass = $_POST['password'];
    $account->loginUser($userName, $userPass);
	}
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TRANG ĐĂNG NHẬP</title>
    <link rel="stylesheet" type="text/css" href="Css/userLoginCss.css" />
    <script type="text/javascript" src="JavaScript/userLoginJs.js"></script>
</head>

<body bgcolor="red">
<div class="body">
	<div class="cont">
<form action="" method="POST" class="form" id="form-2" style="margin-top:50px">
        <h2 class="heading">Đăng nhập</h2>


        <div class="form-group">
          <label class="form-label">Tên tài khoản</label>
          <input name="accountName" type="text" placeholder="Tên tài khoản" class="form-control">
          <span class="form-message"></span>
        </div>

        <div class="form-group">
          <label for="password" class="form-label">Mật khẩu</label>
          <input id="password" name="password" type="password" placeholder="Nhập mật khẩu" class="form-control">
          <span class="form-message"></span>
        </div>

        <button class="form-submit" name="login" type="submit">Đăng nhập</button>
      </form>
  <div class="sub-cont">
    <div class="img">
      <div class="img__text m--up">
        <h2>Bạn là thành viên mới?</h2>
        <p>Cùng tham gia với chúng tôi nào!</p>
      </div>
      <div class="img__text m--in">
        <h2>Bạn đã sẵn sàng chưa?</h2>
        <p>Cùng đăng nhập để trải nghiệm dịch vụ của chúng tôi nào</p>
      </div>
      <div class="img__btn" onclick="choose()">
        <span class="m--up">Đăng kí</span>
        <span class="m--in">Đăng nhập</span>
      </div>
    </div>
            <form action="" method="POST" class="form2" id="form-1" style="width:80%;margin-bot:100px">     
                <div class="form-group">
                  <label for="fullname" class="form-label">Tên đầy đủ</label>
                  <input id="fullname" name="name" type="text" placeholder="Tên đầy đủ của bạn" class="form-control">
                  <span class="form-message"></span>
                </div>
        		<div class="form-group">
                  <label for="email" class="form-label">Địa chỉ</label>
                  <input name="address" type="text" placeholder="Địa chỉ của bạn" class="form-control">
                  <span class="form-message"></span>
                </div>
                <div class="form-group">
                  <label for="email" class="form-label">Email</label>
                  <input id="email" name="email" type="text" placeholder="Email của bạn" class="form-control">
                  <span class="form-message"></span>
                </div>
        		<div class="form-group">
                  <label for="email" class="form-label">Số điện thoại</label>
                  <input name="numberPhone" type="text" placeholder="Số điện thoại của bạn" class="form-control">
                  <span class="form-message"></span>
                </div>
				<div class="form-group">
                  <label for="password" class="form-label">Tên tài khoản</label>
                  <input id="password" name="accountName" type="text" placeholder="Nhập mật khẩu" class="form-control">
                  <span class="form-message"></span>
                </div>
                <div class="form-group">
                  <label for="password" class="form-label">Mật khẩu</label>
                  <input id="password" name="password" type="password" placeholder="Nhập mật khẩu" class="form-control">
                  <span class="form-message"></span>
                </div>
        
                <div class="form-group">
                  <label for="password_confirmation" class="form-label">Nhập lại mật khẩu</label>
                  <input id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu" type="password" class="form-control">
                  <span class="form-message"></span>
                </div>
                <input class="form-submit" type="submit" name="signUp" value="Đăng ký">
          	</form>
  </div>
	</div>
</div>
    <script>

      /*document.addEventListener('DOMContentLoaded', function () {
        // Mong muốn của chúng ta
        Validator({
          form: '#form-1',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
            Validator.isRequired('#fullname', 'Vui lòng nhập tên đầy đủ của bạn'),
            Validator.isEmail('#email'),
            Validator.minLength('#password', 6),
            Validator.isRequired('#password_confirmation'),
            Validator.isConfirmed('#password_confirmation', function () {
              return document.querySelector('#form-1 #password').value;
            }, 'Mật khẩu nhập lại không chính xác')
          ],
//          onSubmit: function (data) {
//            // Call API
//            console.log(data);
//          }
        });


        Validator({
          form: '#form-2',
          formGroupSelector: '.form-group',
          errorSelector: '.form-message',
          rules: [
            Validator.isEmail('#email'),
            Validator.minLength('#password', 6),
          ],
//          onSubmit: function (data) {
//            // Call API
//            console.log(data);
//          }
        });
      });*/

    </script>
</body>
</html>