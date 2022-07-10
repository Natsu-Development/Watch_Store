<?php 
	ob_start();
	include("include/header.php");
	if(isset($_GET['productCode'])) {
		$id = $_GET['productCode'];
	}
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addToCart'])) {
        $amount = $_POST['amount'];
		// if($product->checkAmountProduct($id, $amount)) {
        	$insertCart = $cart->cartAdd($amount, $id);
		// }
    }

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['purchase'])) {
        $amount = $_POST['amount'];
		if(Session::get('customerId')) {
			if($product->checkAmountProduct($id, $amount)) {
				$insertCart = $cart->cartAdd($amount, $id);
				header('Location: checkout.php');
			}
		}
		else {
			header('Location: userLogin.php');
		}
    }

	if(isset($_GET['addCart'])) {
		echo '<script>alert("Sản phẩm này đã được thêm vào giỏ hàng")</script>';
	}
?>
    <div class="container">
        <div class="grid">
            <div class="grid__row app__content">
				<?php 
					$productDetails = $product->getProductById($id);
					if($productDetails) {
						while($result = $productDetails->fetch_assoc()) {
				?>
                <div class="grid__column-6 product">
                    <!--Chỉnh sửa ảnh mặt hàng-->
                    <div class="product-slide">
<!--
                        <div class="change-product">
                            <i class="fa fa-chevron-circle-left" onClick="back()"></i>
                            <i class="fa fa-chevron-circle-right right" onClick="next()"></i>
                        </div>
-->
<!--                        <div class="changeSlide-product">-->
                            <img class="product-img" src="Admin/uploads/<?php echo $result['image']?>">
<!--
							<img class="product-img" src="Admin/uploads/<?php echo $result['image']?>">
							<img class="product-img" src="Admin/uploads/<?php echo $result['image']?>">
							<img class="product-img" src="Admin/uploads/<?php echo $result['image']?>">
							<img class="product-img" src="Admin/uploads/<?php echo $result['image']?>">
-->
<!--                        </div>-->
                    </div>
<!--
                    <div class="picture-slide">
                        <div class="control-picture">
                            <i class="fa fa-chevron-circle-left"></i>
                            <i class="fa fa-chevron-circle-right right"></i>
                        </div>
                        <div class="picture">
                            <img class="picture-product" src="../Image/Casio/Casio A168WEGB-1BDF.jpg">
                            <img class="picture-product" src="../Image/Casio/Casio AE-1200WHD-1AVDF.jpg">
                            <img class="picture-product" src="../Image/Casio/Casio LTP-VT01GL-9BUDF.jpg">
                            <img class="picture-product" src="../Image/Casio/Casio MTP-1374L-1AVDF.jpg">
                            <img class="picture-product" src="../Image/Casio/Casio MTP-VT01G-7BUDF Nam Quartz.jpg">
                        </div>
                    </div>
-->
                </div>
                <div class="grid__column-6 product">
                    <div class="heading-product">
                        <span>Đồng Hồ 
							<?php 
								$brandId = $result['brandId'];
								$brandName = $brand->getBrandById($brandId);
								if($brandName) {
									while($resultGetBrand = $brandName->fetch_assoc()) {
										echo $resultGetBrand['name'];
									}
 								}
							?>
						</span>
                    </div>
                    <div class="heading-product__name">
                        <span><?php echo $result['productName']?></span>
                    </div>
                    <div class="product-information">
                        <div class="product-information__rating">
                            <span class="product-information__rating-heading">5.0</span>
                            <div class="product-information__rating-star">
                                <div class="product-information__rating-star-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="product-information__assess">
                            <span class="product-information__assess-number">327</span>
                            <span class="product-information__assess-text">Đánh Giá</span>
                        </div>
                        <div class="product-information__sold">
                            <span class="product-information__sold-number">735</span>
                            <span class="product-information__sold-text">Đã Bán</span>
                        </div>
                    </div>
                    <div class="container-product">
                        <div class="container-product__price"><?php echo $format->format_currency($result['discountPrice'])." "."VNĐ"?></div>
                    </div>
                    <!--
			<div class="transport">
				<label class="transport-text">Vận chuyển</label>
				<div class="transport-details">
					<i class="fas fa-caravan transport-details__icon"></i>
					<span class="transport-details__text">Vận Chuyển Tới</span>
					<span class="transport-details__selection">Thành Phố Quảng Ngãi
						<i class="fas fa-angle-down transport-details__selection-icon"></i>
						<option>Thủ đô Hà Nội</option>
						<option>Thành phố Hồ Chí Minh</option>
						<option>Thành phố Đà Nẵng</option>
					</span>
					<div class="transport-details__cost">
						Phí Vận Chuyển<div class="transport-details__cost-money">20000đ-50000đ</div>
					</div>		
				<div class="transport-quantity">
					<span class="transport-quantity__text">Số Lượng</span>
					<div class="transport-quantity__control">
						<button class="transport-quantity__control-subtract">-</button>
						<input class="transport-quantity__control-amount" type="text" value="1">
						<button class="transport-quantity__control-up"><i class="transport-quantity__control-up__icon">+</i></button>
					</div>
					<span class="transport-quantity__remain">242 Sản Phẩm còn lại</span>
				</div>
				</div>	
			</div>
-->
                    <div class="description">
                        <p><?php echo $result['introduce']?></p>
                    </div>
                    <b>
                        <span style="margin-right: 30px; font-size: 16px;">Số lượng còn lại của sản phẩm: <?php echo $result['amount']?></span>
                    </b>
                    <div class="product-purchase">
						<form action="" method="post">
							<div style="margin-bottom: 24px;">
								<span style="margin-right: 30px; font-size: 16px;">Số lượng</span>
								<input type="number" class="buyfield" min="1" value="1" name="amount" style="width: 50px; text-align: center">
							</div>
							<button class="btn product-purchase__add-cart" type="submit" name="addToCart" value="Thêm vào giỏ hàng">
							<i class="product-purchase__add-icon fas fa-cart-plus"></i>Thêm Vào Giỏ Hàng
							</button>
                        	<button class="btn product-purchase__buy" type="submit" name="purchase">Mua Hàng</button>
						</form>	
                    </div>
                </div>
                <div class="grid__column-12">
                    <div class="product-decribe">
                        <div class="product-decribe__css">
                            <div class="product-decribe__heading">Thông Tin Sản Phẩm</div>
                            <div class="product-decribe__information">
                                <div class="product-decribe__information-category">
                                    <label class="product-category__heading">Nhãn Hiệu</label>
                                    <div class="product-catogory__heading-details"><a class="product-catogory__heading-test" href="../Casio/Casio.html">CASIO</a></div>
                                </div>
                                <div class="product-decribe__brand">
                                    <label class="product-decirbe__brand-heading">Nguồn gốc</label>
                                    <div class="product-decribe__brand-details">Thụy Sĩ</div>
                                </div>
                                <div class="product-decribe__warehouse">
                                    <label class="product-decribe__warehouse-heading">Kiểu máy</label>
                                    <div class="product-decribe__warehouse-details">Automatic</div>
                                </div>
                                <div class="product-decribe__from">
                                    <label class="product-decribe__from-heading">Kích cỡ</label>
                                    <div class="product-decribe__fromm-details">42mm</div>
                                </div>
                                <div class="product-decribe__from">
                                    <label class="product-decribe__from-heading">Chất liệu vỏ</label>
                                    <div class="product-decribe__fromm-details">Thép không gỉ</div>
                                </div>
                                <div class="product-decribe__from">
                                    <label class="product-decribe__from-heading">Chất liệu dây</label>
                                    <div class="product-decribe__fromm-details">Dây kim loại</div>
                                </div>
                                <div class="product-decribe__from">
                                    <label class="product-decribe__from-heading">Chất liệu kính</label>
                                    <div class="product-decribe__fromm-details">Kính Sapphire</div>
                                </div>
                                <div class="product-decribe__from">
                                    <label class="product-decribe__from-heading">Độ chịu nước</label>
                                    <div class="product-decribe__fromm-details">42mm</div>
                                </div>
                                <div class="product-decribe__from">
                                    <label class="product-decribe__from-heading">Chức năng khác</label>
                                    <div class="product-decribe__fromm-details">Bộ máy skeleton</div>
                                </div>
                                <div class="product-decribe__from">
                                    <label class="product-decribe__from-heading">Bảo hiểm</label>
                                    <div class="product-decribe__fromm-details"> 5 năm kể cả lỗi người dùng</div>
                                </div>
                                <div class="product-decribe__from">
                                    <label class="product-decribe__from-heading">Bảo hành quốc tế</label>
                                    <div class="product-decribe__fromm-details">2 năm</div>
                                </div>
                                <div class="product-decribe__from">
                                    <label class="product-decribe__from-heading">Giới tính</label>
                                    <div class="product-decribe__fromm-details">Nam</div>
                                </div>
                            </div>
                        </div>
                        <div class="product-decribe__details">
                            <div class="product-decribe__details-heading">Mô Tả Chi Tiết</div>
                            <div class="product-decribe__details-container">
                                <span class="product-decribe__details-text"><?php echo $result['details']?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid__column-12">
                    <div class="product-vote">
                        <div class="product-vote__heading">ĐÁNH GIÁ SẢN PHẨM</div>
                        <div class="product-vote__text">
                            Chưa có đánh giá
                        </div>
                    </div>
                    <form class="comment">
                        <lable class="comment-heading"><br>Nhận xét và đánh giá</lable>
                        <div class="product-information__rating-star">
                            <span style="font-size: 12px;">(Đánh giá của bạn)</span>
                            <div class="product-information__rating-star-rate">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="text-aria">
                            <textarea cols="150" rows="10" placeholder="Nhận xét của bạn về sản phẩm"></textarea>
                        </div>
                        <input onclick="send()" type="button" class="btn btn--primary" value="Gửi">
                    </form>
                    <div class="product-recommend">
                        <div class="product-title">
                            <span>Sản phẩm bạn sẽ thích</span>
                        </div>
                        <div class="home-product">
                            <div class="grid__row">
                                <div class="grid__column-2-4">
                                    <a href="" class="home-product-item">
                                        <div class="home-product-img">
                                            <div class="home-product-item__img" style="background-image: url(Image/Orient/Orient\ FEU07005WX.jpg);">
                                            </div>
                                            <span class="installment">Trả góp 0%</span>
                                        </div>
                                        <h4>
                                            <span class="home-product-item__name">Orient FEU07005WX</span>
                                            <span class="home-product-item__decribe">Orient Nam - 42mm - Kính Sapphire</span>
                                        </h4>
                                        <div class="home-product-item__price">
                                            <div class="home-product-item__price-old">3.200.000đ</div>
                                            <div class="home-product-item__price-current">2.899.000đ</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="grid__column-2-4">
                                    <a href="" class="home-product-item">
                                        <div class="home-product-img">
                                            <div class="home-product-item__img" style="background-image: url(Image/GShock/./G-SHOCK\ GA-120-1ADR.jpg);">
                                            </div>
                                            <span class="installment">Trả góp 0%</span>
                                        </div>
                                        <h4>
                                            <span class="home-product-item__name">G-SHOCK GA-120-1ADR</span>
                                            <span class="home-product-item__decribe">G-SHOCK Nam - 42mm - Kính Sapphire</span>
                                        </h4>
                                        <div class="home-product-item__price">
                                            <div class="home-product-item__price-old">3.200.000đ</div>
                                            <div class="home-product-item__price-current">2.899.000đ</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="grid__column-2-4">
                                    <a href="" class="home-product-item">
                                        <div class="home-product-img">
                                            <div class="home-product-item__img" style="background-image: url(Image/Tissot/./Tissot\ T109.610.16.037.00.jpg);">
                                            </div>
                                            <span class="installment">Trả góp 0%</span>
                                        </div>
                                        <h4>
                                            <span class="home-product-item__name">Tissot T109.610.16.037.00</span>
                                            <span class="home-product-item__decribe">Tissot Nam - 42mm - Kính Sapphire</span>
                                        </h4>
                                        <div class="home-product-item__price">
                                            <div class="home-product-item__price-old">5.200.000đ</div>
                                            <div class="home-product-item__price-current">4.700.000đ</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="grid__column-2-4">
                                    <a href="" class="home-product-item">
                                        <div class="home-product-img">
                                            <div class="home-product-item__img" style="background-image: url(Image/Seiko/./Seiko\ 5\ Sports\ SRPD73K2.jpg);">
                                            </div>
                                            <span class="installment">Trả góp 0%</span>
                                        </div>
                                        <h4>
                                            <span class="home-product-item__name">Seiko 5 Sports SRPD73K2</span>
                                            <span class="home-product-item__decribe">Seiko Nam - 42mm - Kính Sapphire</span>
                                        </h4>
                                        <div class="home-product-item__price">
                                            <div class="home-product-item__price-old">2.200.000đ</div>
                                            <div class="home-product-item__price-current">1.700.000đ</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-title">
                        <span>Sản phẩm liên quan</span>
                    </div>
                    <div class="home-product">
                        <div class="grid__row">
                            <div class="grid__column-2-4">
                                <a href="  " class="home-product-item">
                                    <div class="home-product-img">
                                        <div class="home-product-item__img" style="background-image: url(Image/Casio/Casio\ F-91WS-2DF.jpg);">
                                        </div>
                                        <span class="installment">Trả góp 0%</span>
                                    </div>
                                    <h4>
                                        <span class="home-product-item__name">Casio F-91WS-2DF</span>
                                        <span class="home-product-item__decribe">Casio Nam - 42mm - Kính Sapphire</span>
                                    </h4>
                                    <div class="home-product-item__price">
                                        <div class="home-product-item__price-old">1.200.000đ</div>
                                        <div class="home-product-item__price-current">700.000đ</div>
                                    </div>
                                </a>
                            </div>
                            <div class="grid__column-2-4">
                                <a href="  " class="home-product-item">
                                    <div class="home-product-img">
                                        <div class="home-product-item__img" style="background-image: url(Image/Casio/Casio\ MTP-VT01G-7BUDF\ Nam\ Quartz.jpg);">
                                        </div>
                                        <span class="installment">Trả góp 0%</span>
                                    </div>
                                    <h4>
                                        <span class="home-product-item__name">Casio MTP-VT01G-7BUDF</span>
                                        <span class="home-product-item__decribe">Casio Nam - 42mm - Kính Sapphire</span>
                                    </h4>
                                    <div class="home-product-item__price">
                                        <div class="home-product-item__price-old">2.200.000đ</div>
                                        <div class="home-product-item__price-current">1.700.000đ</div>
                                    </div>
                                </a>
                            </div>
                            <div class="grid__column-2-4">
                                <a href="  " class="home-product-item">
                                    <div class="home-product-img">
                                        <div class="home-product-item__img" style="background-image: url(Image/./Casio/Casio\ MTP-VT01GL-2BUDF.jpg);">
                                        </div>
                                        <span class="installment">Trả góp 0%</span>
                                    </div>
                                    <h4>
                                        <span class="home-product-item__name">Casio MTP-VT01GL-2BUDF</span>
                                        <span class="home-product-item__decribe">Casio Nam - 40mm - Kính Sapphire</span>
                                    </h4>
                                    <div class="home-product-item__price">
                                        <div class="home-product-item__price-old">2.200.000đ</div>
                                        <div class="home-product-item__price-current">1.800.000đ</div>
                                    </div>
                                </a>
                            </div>
                            <div class="grid__column-2-4">
                                <a href="  " class="home-product-item">
                                    <div class="home-product-img">
                                        <div class="home-product-item__img" style="background-image: url(Image/Casio/Casio\ MTS-100L-1AVDF.jpg);">
                                        </div>
                                        <span class="installment">Trả góp 0%</span>
                                    </div>
                                    <h4>
                                        <span class="home-product-item__name">Casio MTS-100L-1AVDF</span>
                                        <span class="home-product-item__decribe">Casio Nam - 40mm - Kính Sapphire</span>
                                    </h4>
                                    <div class="home-product-item__price">
                                        <div class="home-product-item__price-old">3.700.000đ</div>
                                        <div class="home-product-item__price-current">3.299.000đ</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
				<?php 
						}
					}
				?>
            </div>

        </div>
    </div>
<?php 
	include("include/footer.php");
	ob_end_flush();
?>