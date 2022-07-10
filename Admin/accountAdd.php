<?php 
	include('modules/header.php');
	include('modules/category.php');
	include('../classes/account.php');
	$account = new account();

	if(isset($_GET['accountId'])) {
		$id = $_GET['accountId'];
	}
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accountAdd'])) {
		$accountAdd = $account->accountAdd($_POST);
	}
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accountEdit'])) {
		$accountEdit = $account->accountUpdate($_POST, $id);
	}
?>

<div class="grid__column-10" style="font-size: 14px;" >
					<div class="modal-dialog modal-lg" style="box-shadow: rgba(0,0,0,0.3) 1px 1px 5px; max-width: 950px;" >
                        <div class="modal-content">
                            <div class="modal-header" style="border-bottom: none;">
								<?php 
									if(isset($_GET['accountId'])) {
								?>
                                <h4 >Sửa tài khoản</h4>
								<?php 
									}
									else {
								?>
								<h4> Thêm tài khoản </h4>
								<?php 
									}
								?>	
                               
                            </div>
                            <div class="modal-body"  style="height: 220px;">
                            <?php
								if(isset($_GET['accountId'])) {
									$getAccountById = $account->getaccountById($id);
									if($getAccountById) {
										while($result = $getAccountById->fetch_assoc()) {
							?>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        
                                        <div class="col-md-6">
											<div class="input-group">
												<label for="inputPassword4">Tên người dùng</label>
												<input style="width: 300px;" type="text"  id="inputPassword4" placeholder="Tên người dùng" name="userName" value="<?php if(isset($_GET["accountId"])) echo $result['name']?>">
											</div>
											<div class="input-group">
												<label for="inputPassword4">Tên tài khoản</label>
												<input style="width: 300px;" type="text"  id="inputPassword4" placeholder="Tên tài khoản" name="accountName" value="<?php if(isset($_GET["accountId"])) echo $result['accountName']?>">
											</div>
											<div class="input-group">
												<label for="inputPassword4">Mật khẩu</label>
												<input style="width: 300px;" type="text"  id="inputPassword4" placeholder="Mật khẩu" name="password" value="<?php if(isset($_GET["accountId"])) echo $result['password']?>">
											</div>	
                                        </div>
                                    </div>
                                    <?php 
												if(isset($_GET["accountId"])) {
													echo '<div class="modal-footer" style="border-top: none;">
															<input type="submit" class="btn btn-success" name="accountEdit" value="Lưu">
														</div>';
												}
												else {
													echo '<div class="modal-footer" style="border-top: none;">
															<input type="submit" class="btn btn-success" name="accountAdd" value="Thêm">
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
											<label for="inputPassword4">Tên người dùng</label>
											<input style="width: 300px;" type="text"  id="inputPassword4" placeholder="Tên người dùng" name="userName" value="<?php if(isset($_GET["accountId"])) echo $result['name']?>">
										</div>
                                        <div class="input-group">
											<label for="inputPassword4">Tên tài khoản</label>
											<input style="width: 300px;" type="text"  id="inputPassword4" placeholder="Tên tài khoản" name="accountName" value="<?php if(isset($_GET["accountId"])) echo $result['accountName']?>">
										</div>
										<div class="input-group">
											<label for="inputPassword4">Mật khẩu</label>
											<input style="width: 300px;" type="text"  id="inputPassword4" placeholder="Mật khẩu" name="password" value="<?php if(isset($_GET["accountId"])) echo $result['password']?>">
										</div>
                                        </div>
                                    </div>
                                    <?php 
												if(isset($_GET["accountId"])) {
													echo '<div class="modal-footer" style="border-top: none;">
															<input type="submit" class="btn btn-success" name="accountEdit" value="Lưu">
														</div>';
												}
												else {
													echo '<div class="modal-footer" style="border-top: none;">
															<input type="submit" class="btn btn-success" name="accountAdd" value="Thêm">
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