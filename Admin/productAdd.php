<?php 
	ob_start();
	include('../classes/product.php');
	include('modules/header.php');
	include('modules/category.php');
	$product = new product();
	include('../classes/brand.php');
	include_once('../helper/format.php');
	$brand = new brand();
	$format = new Format();

	$product = new product();
	if(isset($_GET['productCode'])) {
		$id = $_GET['productCode'];
	}
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['productAdd'])) {
		$productAdd = $product->productAdd($_POST, $_FILES);
	}
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['productEdit'])) {
		$productEdit = $product->productUpdate($_POST, $_FILES, $id);
	}
?>

<div class="grid__column-10" style="font-size: 14px;" >
					<div class="modal-dialog modal-lg" style="box-shadow: rgba(0,0,0,0.3) 1px 1px 5px; max-width: 950px;" >
                        <div class="modal-content" style="height: 530px;">
                            <div class="modal-header" style="border-bottom: none;">
								<?php 
									if(isset($_GET['productCode'])) {
								?>
                                <h4 >Sửa sản phẩm</h4>
								<?php 
									}
									else {
								?>
								<h4> Thêm sản phẩm</h4>
								<?php 
									}
								?>
                               
                            </div>
                            <div class="modal-body"  style="height: 400px;">
                            <?php
								if(isset($_GET['productCode'])) {
									$getProductById = $product->getProductById($id);
									if($getProductById) {
										while($result = $getProductById->fetch_assoc()) {
							?>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        
                                        <div class="col-md-4">
                                        <img class="img-edit" src="uploads/<?php if(isset($_GET['productCode'])) echo $result['image']?>" alt="" id="temp">

                                        <div>
                                          <div id="displayImg" class="img-add" ></div>
                                          <label for="inputdefault"></label>
                                          <input type="file" id="onload" onchange="ImgFile()" name="image">
                                          <button class="btn btn-success" style="height: 50%;">Xóa ảnh</button>
                                          
                                        </div> 
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-7">
											<div class="input-group">
											<label for="inputPassword4">Tên sản phẩm</label>
											<input style="width: 300px;" type="text"  id="inputPassword4" placeholder="Tên sản phẩm" name="productName" value="<?php if(isset($_GET["productCode"])) echo $result['productName']?>">
											</div>
											<div class="input-group">
											<label for="inputPassword4">Tiêu đề sản phẩm</label>
											<input style="width: 300px;" type="text"  id="inputPassword4" placeholder="Tiêu đề của sản phẩm" name="productTitle" value="<?php if(isset($_GET["productCode"])) echo $result['productTitle']?>">
											</div>
											<div style="padding-top: 15px;"></div>
											<div class="input-group">
											<label for="inputState">Thương hiệu</label><br>
												<select id="inputState" style="text-align: center;" name="trademark">
													<option>Chọn thương hiệu</option>
													<?php 
														$brandList = $brand->showBrand();
														if($brandList) {
															while($resultBrand = $brandList->fetch_assoc()) {
													?>
													<option <?php if($resultBrand['id']==$result['brandId']) echo 'selected';?>
													value="<?php echo $resultBrand['id']?>"><?php echo $resultBrand['name']?></option>
													<?php 
															}
														}
													?>
												</select>	
												
											</div>
											<div class="input-group">
											<label for="inputPrice">Số lượng</label>
											<input style="width: 300px;" type="text" id="inputPrice" placeholder="Số lượng sản phẩm cần thêm" name="amount" value="<?php if(isset($_GET['productCode'])) echo $result['amount']?>">
											</div>
											<div class="input-group">
											<label for="inputPrice">Giá khuyến mãi</label>
											<input style="width: 300px;" type="text" id="inputPrice" placeholder="Giá sản phẩm khuyến mãi" name="discountPrice" value="<?php echo $result['discountPrice']?>" />
											</div>
											<div class="input-group">
											<label for="inputPrice">Giá</label>
											<input style="width: 300px;" type="text" id="inputPrice" placeholder="Giá sản phẩm" name="price" value="<?php echo $result['price']?>">
											</div>
											<div class="input-group">
											<label for="inputPrice">Thông tin giới thiệu</label>
											<input style="width: 300px;" type="text" id="inputPrice" placeholder="Thông tin giới thiệu của sản phẩm" name="productIntroduce" value="<?php if(isset($_GET['productCode'])) echo $result['introduce']?>">
											</div>
											<div class="input-group">
											<label for="inputPrice">Thông tin chi tiết</label>
											<input style="width: 300px;" type="text" id="inputPrice" placeholder="Thông tin chi tiết của sản phẩm" name="productDetails" value="<?php if(isset($_GET['productCode'])) echo $result['details']?>">
											</div>
											<?php 
												if(isset($_GET["productCode"])) {
													echo '<div class="modal-footer" style="border-top: none;">
															<input type="submit" class="btn btn-success" name="productEdit" value="Lưu">
														</div>';
												}
												else {
													echo '<div class="modal-footer" style="border-top: none;">
															<input type="submit" class="btn btn-success" name="productAdd" value="Thêm">
														</div>';
												}
											?>
                                      </div>
									  
                                    </div>
                                    
                                    
                                    
                                  </form>
                            <?php 
										}
									}
								}
								else {
							?> 
								<form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        
                                        <div class="col-md-4">
                                        <img class="img-edit" src="uploads/<?php if(isset($_GET['productCode'])) echo $result['image']?>" alt="" id="temp">

                                        <div>
                                          <div id="displayImg" class="img-add" ></div>
                                          <label for="inputdefault"></label>
                                          <input type="file" id="onload" onchange="ImgFile()" name="image">
                                          <button class="btn btn-success" style="height: 50%;">Xóa ảnh</button>
                                          
                                        </div> 
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-7">
											<div class="input-group">
											<label for="inputPassword4">Tên sản phẩm </label>
											<input style="width: 300px;" type="text"  id="inputPassword4" placeholder="Tên sản phẩm" name="productName" value="<?php if(isset($_GET["productCode"])) echo $result['productName']?>">
											</div>
											<div class="input-group">
											<label for="inputPassword4">Tiêu đề sản phẩm</label>
											<input style="width: 300px;" type="text"  id="inputPassword4" placeholder="Tiêu đề của sản phẩm" name="productTitle" value="<?php if(isset($_GET["productCode"])) echo $result['productTitle']?>">
											</div>
											<div style="padding-top: 15px;"></div>
											<div class="input-group">
											<label for="inputState">Thương hiệu</label><br>
												<select id="inputState" style="text-align: center;" name="trademark">
													<option>Chọn thương hiệu</option>
													<?php 
														$brandList = $brand->showBrand();
														if($brandList) {
															while($resultBrand = $brandList->fetch_assoc()) {
													?>
													<option value="<?php echo $resultBrand['id']?>"><?php echo $resultBrand['name']?></option>
													<?php 
															}
														}
													?>
												</select>	
												
											</div>
											<div class="input-group">
											<label for="inputPrice">Số lượng</label>
											<input style="width: 300px;" type="text" id="inputPrice" placeholder="Số lượng sản phẩm cần thêm" name="amount" value="<?php if(isset($_GET['productCode'])) echo $result['amount']?>">
											</div>
											<div class="input-group">
											<label for="inputPrice">Giá khuyến mãi</label>
											<input style="width: 300px;" type="text" id="inputPrice" placeholder="Giá sản phẩm khuyến mãi" name="discountPrice" value="
											<?php if(isset($_GET['productCode'])) 
													echo $format->format_currency($result['discountPrice'])." "."VNĐ"
											?>" />
											</div>
											<div class="input-group">
											<label for="inputPrice">Giá</label>
											<input style="width: 300px;" type="text" id="inputPrice" placeholder="Giá sản phẩm" name="price" value="<?php if(isset($_GET['productCode'])) echo $format->format_currency($result['price'])." "."VNĐ"?>">
											</div>
											<div class="input-group">
											<label for="inputPrice">Thông tin giới thiệu</label>
											<input style="width: 300px;" type="text" id="inputPrice" placeholder="Thông tin giới thiệu của sản phẩm" name="productIntroduce" value="<?php if(isset($_GET['productCode'])) echo $result['introduce']?>">
											</div>
											<div class="input-group">
											<label for="inputPrice">Thông tin chi tiết</label>
											<input style="width: 300px;" type="text" id="inputPrice" placeholder="Thông tin chi tiết của sản phẩm" name="productDetails" value="<?php if(isset($_GET['productCode'])) echo $result['details']?>">
											</div>
											<?php 
												if(isset($_GET["productCode"])) {
													echo '<div class="modal-footer" style="border-top: none;">
															<input type="submit" class="btn btn-success" name="productEdit" value="Sửa">
														</div>';
												}
												else {
													echo '<div class="modal-footer" style="border-top: none;">
															<input type="submit" class="btn btn-success" name="productAdd" value="Thêm">
														</div>';
												}
											?>
                                      </div>
									  
                                    </div>
                                    
                                    
                                    
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
	ob_end_flush();
?>