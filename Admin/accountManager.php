<?php
	ob_start();
	include_once('../classes/account.php');
	include('modules/header.php');
	include('modules/category.php');
	$account = new account();
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$deleteAccount = $account->deleteAccount($id);
	}
	if(isset($_GET['delete'])) {
		echo '<script>alert("Xóa tài khoản thành công")</script>'; 
	}
	if(isset($_GET['add'])) {
		echo '<script>alert("Thêm tài khoản thành công")</script>'; 
	}
	if(isset($_GET['edit'])) {
		echo '<script>alert("Sửa tài khoản thành công")</script>'; 
	}
?>
<div class="grid__column-10">
                    <div class="admin-title">
                        <span>QUẢN LÍ TÀI KHOẢN</span>
                    </div>
					<form action="" method="get" style="margin-bottom: 15px;">
						<div class="header__search-wrap" style="display: flex">
							<input class="header__search-input" name="accountFind" placeholder="Nhập tên của Tài khoản để tìm kiếm" style="height: 34px;background-color: #E8F0FE;color: black; margin-right: 14px;" />
							<button class="header__search-btn" type="submit" style="background-color: #d4020d"> <i class="header__search-btn-icon fas fa-search"></i> </button>
						</div>	
					</form>	
                    <div class="product-add">
                        <a href="accountAdd.php">
                            <button class="product-add__action">Thêm tài khoản mới</button>
                        </a>
                    </div>
                    <div class="admin-product__add">
                        <div class="grid__row">
							<table class="table table-hover ">

                                <!--Table head-->
                                <thead style="font-size: 13px; border: 3px;color: white;background-color: #d4020d; " class="table-primary "> 
									<tr style="text-align: top; width: 20px";>
										<th>STT</th>
										<th>Tên người dùng</th>
										<th>Tên Tài khoản</th>
										<th>Mật khẩu</th>
										<th>Hành động</th>
									</tr>
                                </thead>
								<tbody style="font-size: 13px; ">
									<?php
										if(isset($_GET['accountFind'])) {
											$accountNameToFind = $_GET['accountFind'];
											$showAccount = $account->findAccountByName($accountNameToFind);
											if($showAccount) {
												$i = 0;
												while($result = $showAccount->fetch_assoc()) {
													$i++;
									?>
                                    <tr name="sp1">
                                        <td scope="row " style="width: 20px; "><?php echo $i;?></td>
                                        <td><?php echo $result['name'];?></td>
                                        <td><?php echo $result['accountName'];?></td>
                                        <td><?php echo $result['password'];?></td>
										<td><a href="accountAdd.php?accountId=<?php echo $result['id']?>"><button class="btn" style="background-color: var(--primary-color);color: white;margin: 8px;height: 30px; min-width: 80px;">Sửa</button></a><a onClick= "return confirm('Bạn có muốn xóa TÀI KHOẢN này không?')" href="accountManager.php?id=<?php echo $result['id']?>"><button class="btn" style="background-color: var(--primary-color);color: white;margin: 8px;height: 30px; min-width: 80px;">Xóa</button></a></td>
                                    </tr>
									<?php 
												}
											}
										}
										else {
											$showAccount = $account->showAccount();
											if($showAccount) {
												$i = 0;
												while($result = $showAccount->fetch_assoc()) {
													$i++;
									?>
                                    <tr name="sp1">
                                        <td scope="row " style="width: 20px; "><?php echo $i;?></td>
										<td><?php echo $result['name'];?></td>
                                        <td><?php echo $result['accountName'];?></td>
                                        <td><?php echo $result['password'];?></td>
										<td>
											<a href="accountAdd.php?accountId=<?php echo $result['id']?>">
												<button class="btn" style="background-color: var(--primary-color);color: white;margin: 8px;height: 30px; min-width: 80px;">Sửa</button>
											</a>
											<a onClick= "return confirm('Bạn có muốn xóa tài khoản này không?')" href="accountManager.php?id=<?php echo $result['id']?>">
												<button class="btn" style="background-color: var(--primary-color);color: white;margin: 8px;height: 30px; min-width: 80px;">Xóa</button>
											</a>
										</td>
                                    </tr>
									<?php 
												}
											}
										}
									?>
								</tbody>
							</table>	
						</div>

                    </div>
</div>

			</div>
		</div>
	</div>	
<?php 
	include('modules/footer.php');
	ob_end_flush();
?>
