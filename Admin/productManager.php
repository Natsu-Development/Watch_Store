<?php 
	include('modules/header.php');
	include('modules/category.php');
	include('../classes/product.php');
	include_once('../helper/format.php');
	$format = new Format();
	$product = new product();
	if(isset($_GET['deleteId'])) {
		$id = $_GET['deleteId'];
		$productDelete = $product->deleteProduct($id);
	}
	if(isset($_GET['productFind'])) {
		$productName = $_GET['productFind'];
		$productFind = $product->findProductByName($productName);
	}

	if(isset($_GET['add'])) {
		echo '<script>alert("Thêm sản phẩm thành công")</script>'; 
	}
	if(isset($_GET['edit'])) {
		echo '<script>alert("Sửa sản phẩm thành công")</script>'; 
	}
	if(isset($_GET['delete'])) {
		echo '<script>alert("Xóa sản phẩm thành công")</script>'; 
	}
?>
<div class="grid__column-10">
                    <div class="admin-title">
                        <span>QUẢN LÍ SẢN PHẨM</span>
                    </div>
					<form action="" method="get" style="margin-bottom: 15px;">
						<div class="header__search-wrap" style="display: flex">
							<input class="header__search-input" name="productFind" placeholder="Nhập tên của sản phẩm để tìm kiếm" style="height: 34px;background-color: #E8F0FE;color: black; margin-right: 14px;" />
							<button class="header__search-btn" type="submit" style="background-color: #d4020d"> <i class="header__search-btn-icon fas fa-search"></i> </button>
						</div>	
					</form>	
                    <div class="product-add">
                        <a href="productAdd.php">
                            <button class="product-add__action">Thêm sản phẩm mới</button>
                        </a>
                    </div>
                    <div class="admin-product__add">
                        <div class="grid__row">
							<?php 
								if(isset($_GET['productFind'])) {
									$productName = $_GET['productFind'];
									$productFind = $product->findProductByName($productName);
									if($productFind) {
										while($result = $productFind->fetch_assoc()) {
							?>
										<div class="grid__column-2-4">
										<a class="home-product-item">
											<div class="home-product-img">
												<div class="home-product-item__img" style="background-image: url(uploads/<?php echo $result['image']?>);">
												</div>
											</div>
											<h4>
												<span class="home-product-item__name"><?php echo $result["productName"]?></span>
												<span class="home-product-item__decribe"><?php echo $result["productTitle"]?></span>
											</h4>
											<div class="home-product-item__price">
												<div class="home-product-item__price-old">
												<?php 
													echo $format->format_currency($result['price'])." "."VNĐ";
												?>
												</div>
												<div class="home-product-item__price-current"><?php echo $format->format_currency($result['discountPrice'])." "."VNĐ"?></div>
											</div>
										</a>
										<a href="productAdd.php?productCode=<?php echo $result["productCode"]?>">
											<button type="submit" value="Sửa" class="btn" style="background-color: var(--primary-color);color: white;margin: 8px;height: 34px; min-width: 96px;">
												Sửa
											</button> 
										</a>
										<a onClick= "return confirm('Bạn có muốn xóa sản phẩm này không?')" href="productManager.php?deleteId=<?php echo $result["productCode"]?>"> 
											<button type="submit" value="Xóa" class="btn" style="background-color: var(--primary-color);color: white;margin: 8px;height: 34px; min-width: 96px;">
												Xóa
											</button> 
										</a>
										</a>
										</div>;
								<?php 
										}
									}
								}
								else {
									$showProduct = $product->showAllProduct();
									if($showProduct) {
										while($result = $showProduct->fetch_assoc()) {
								?>
											<div class="grid__column-2-4">
											<a class="home-product-item">
												<div class="home-product-img">
													<div class="home-product-item__img" style="background-image: url(uploads/<?php echo $result['image']?>);">
													</div>
												</div>
												<h4>
													<span class="home-product-item__name"><?php echo $result["productName"]?></span>
													<span class="home-product-item__decribe"><?php echo $result["productTitle"]?></span>
												</h4>
												<div class="home-product-item__price">
													<div class="home-product-item__price-old">
													<?php 
														echo $format->format_currency($result['price'])." "."VNĐ";
													?>
													</div>
													<div class="home-product-item__price-current"><?php echo $format->format_currency($result['discountPrice'])." "."VNĐ"?></div>
												</div>
											</a>
											<a href="productAdd.php?productCode=<?php echo $result["productCode"]?>">
												<button type="submit" value="Sửa" class="btn" style="background-color: var(--primary-color);color: white;margin: 8px;height: 34px; min-width: 96px;">
													Sửa
												</button> 
											</a>
											<a onClick= "return confirm('Bạn có muốn xóa sản phẩm này không?')" href="productManager.php?deleteId=<?php echo $result["productCode"]?>"> 
												<button type="submit" value="Xóa" class="btn" style="background-color: var(--primary-color);color: white;margin: 8px;height: 34px; min-width: 96px;">
													Xóa
												</button> 
											</a>
											</a>
											</div>;
										<?php 
										}
									}
								}		
										?>
                        </div>
                    </div>
                </div>
<div class="grid__column-12">
				<ul class="pagination home-product-pagination" id="phantrang">
								<li class="pagination-item"><a href="#" class="pagination-item__link"><i class="pagination-item__icon fas fa-angle-left"></i></a></li>
								<?php 
									/*for($i = 1; $i<=$page; $i++) {
										echo '<li class="pagination-item pagination-item--active"> <a href="?action=productManager&page='.$i.'" class="pagination-item__link">'.$i.'</a> </li>';
									}*/
								?>
								<li class="pagination-item"> <a href="#" class="pagination-item__link"><i class="pagination-item__icon fas fa-angle-right"></i></a></li>
                       	 	</ul>
</div>
			</div>
		</div>
	</div>	
<?php 
	include('modules/footer.php');
?>
