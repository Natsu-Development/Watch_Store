<?php 
	include('modules/header.php');
	include('modules/category.php');
	include('../classes/brand.php');
	$brand = new brand();

	if(isset($_GET['brandId'])) {
		$id = $_GET['brandId'];
	}
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['brandAdd'])) {
		$brandAdd = $brand->brandAdd($_POST);
	}
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['brandEdit'])) {
		$brandEdit = $brand->brandUpdate($_POST, $id);
	}
?>

<div class="grid__column-10" style="font-size: 14px;" >
					<div class="modal-dialog modal-lg" style="box-shadow: rgba(0,0,0,0.3) 1px 1px 5px; max-width: 950px;" >
                        <div class="modal-content">
                            <div class="modal-header" style="border-bottom: none;">
								<?php 
									if(isset($_GET['brandId'])) {
								?>
                                <h4 >Sửa thương hiệu</h4>
								<?php 
									}
									else {
								?>
								<h4> Thêm thương hiệu </h4>
								<?php 
									}
								?>	
                               
                            </div>
                            <div class="modal-body"  style="height: 220px;">
                            <?php
								if(isset($_GET['brandId'])) {
									$getBrandById = $brand->getBrandById($id);
									if($getBrandById) {
										while($result = $getBrandById->fetch_assoc()) {
							?>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        
                                        <div class="col-md-6">
											<div class="input-group">
												<label for="inputPassword4">Tên thương hiệu</label>
												<input style="width: 300px;" type="text"  id="inputPassword4" placeholder="Tên thương hiệu" name="brandName" value="<?php if(isset($_GET["brandId"])) echo $result['name']?>">
											</div>
											<div class="input-group">
												<label for="inputPassword4">Số điện thoại</label>
												<input style="width: 300px;" type="text"  id="inputPassword4" placeholder="Số điện thoại" name="numberPhone" value="<?php if(isset($_GET["brandId"])) echo $result['numberPhone']?>">
											</div>
											<div class="input-group">
												<label for="inputPassword4">Địa chỉ</label>
												<input style="width: 300px;" type="text"  id="inputPassword4" placeholder="Địa chỉ" name="address" value="<?php if(isset($_GET["brandId"])) echo $result['address']?>">
											</div>	
                                        </div>
                                    </div>
                                    <?php 
												if(isset($_GET["brandId"])) {
													echo '<div class="modal-footer" style="border-top: none;">
															<input type="submit" class="btn btn-success" name="brandEdit" value="Lưu">
														</div>';
												}
												else {
													echo '<div class="modal-footer" style="border-top: none;">
															<input type="submit" class="btn btn-success" name="brandAdd" value="Thêm">
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
											<label for="inputPassword4">Tên thương hiệu</label>
											<input style="width: 300px;" type="text"  id="inputPassword4" placeholder="Tên thương hiệu" name="brandName" value="<?php if(isset($_GET["brandId"])) echo $result['name']?>">
										</div>
										<div class="input-group">
											<label for="inputPassword4">Số điện thoại</label>
											<input style="width: 300px;" type="text"  id="inputPassword4" placeholder="Số điện thoại" name="numberPhone" value="<?php if(isset($_GET["brandId"])) echo $result['numberPhone']?>">
										</div>
										<div class="input-group">
											<label for="inputPassword4">Địa chỉ</label>
											<input style="width: 300px;" type="text"  id="inputPassword4" placeholder="Địa chỉ" name="address" value="<?php if(isset($_GET["brandId"])) echo $result['address']?>">
										</div>	
                                        </div>
                                    </div>
                                    <?php 
												if(isset($_GET["brandId"])) {
													echo '<div class="modal-footer" style="border-top: none;">
															<input type="submit" class="btn btn-success" name="brandEdit" value="Lưu">
														</div>';
												}
												else {
													echo '<div class="modal-footer" style="border-top: none;">
															<input type="submit" class="btn btn-success" name="brandAdd" value="Thêm">
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