<div class="container">
            <div class="grid">
                <div class="grid__row app__content">
                    <div class="grid__column-12">

<!--
                        <div class="home-filter"> <span class="home-filter__label">Sắp xếp theo</span>
                            <button class="home-filter__btn btn btn--primary" style="margin-left: 50px;">Phổ biến</button>
                            <button class="home-filter__btn btn">Mới nhất</button>
                            <button class="home-filter__btn btn">Bán chạy</button>
                            <div class="select-input" id="move"> <span class="home-select__label">Giá</span> <i class="select-input__icon fas fa-angle-down"></i>
                                <ul class="select-input__list">
                                    <li class="select-input__list-link"><a href="">Giá từ thấp đến cao</a></li>
                                    <li class="select-input__list-link"><a href="">Giá từ cao đến thấp</a></li>
                                </ul>
                            </div>
                        </div>
-->

<!--
                        <div class="home-filter"> <span class="home-filter__label">Tìm kiếm nâng cao</span>
                            <input class="sort-start" placeholder="Nhập tên sản phẩm">
                            <div class="select-input1" style="margin-left: 48px;">
                                <select class="searchHard" id="thuonghieu">
                                  <option value="1">Casio</option>
                                  <option value="2">G Shock</option>
                                  <option value="3">Orient</option>
                                  <option value="4">Fossil</option>
                                  <option value="5">Tissot</option>
                                  <option value="6">Citizen</option>
                                  <option value="7">Seiko</option>
                                </select>
                            </div>
                            <div class="sort">
                                <input class="sort-start" placeholder="Nhập vào giá bắt đầu" id="price">
                                <span class="sort-to">Đến</span>
                                <input class="sort-end" placeholder="Nhập vào giá trị kết thúc" id="price1">
                                <button class="sort-btn" onclick="priceSearch()">Tìm</button>
                            </div>
                        </div>
-->
                        <div class="poster" id="poster">
                            <div class="poster-main">
                                <div class="pos1"><img src="Image/Banner/./poster1.webp"></div>
                            </div>
                            <div class="poster-second">
                                <div class="poster-second__1">
                                    <div class="pos2"><img src="Image/Banner/./banner-dong-ho-nam.png"></div>
                                    <div class="pos3"><img src="Image/Banner/./banner-dong-ho-nu.webp"></div>
                                </div>
                                <div class="poster-second__2">
                                    <div class="pos4"><img src="Image/Banner/./banner-dong-ho-doi.webp"></div>
                                    <div class="pos5"><img src="Image/Banner/./banner-dong-ho-tre-em.webp"></div>
                                </div>
                            </div>
                        </div>
                        <div class="product-title" id="title">
                            <span id="title1">Sản phẩm nổi bật</span>
                        </div>
                        <div class="home-product">
                            <div class="grid__row">
								<?php 
									if(isset($_GET['search'])) {
										$findProduct = $product->findProductByName($_GET['search']);
										if($findProduct) {
											while($result=$findProduct->fetch_assoc()) {
								?>
								<div class="grid__column-2-4">
                                    <a href="productDetails.php?productCode=<?php echo $result['productCode']?>" class="home-product-item">
                                        <div class="home-product-img">
                                            <div class="home-product-item__img" style="background-image: url(Admin/uploads/<?php echo $result['image']?>);">
                                            </div>
                                            <span class="installment">Trả góp 0%</span>
                                        </div>
                                        <h4>
                                            <span class="home-product-item__name"><?php echo $result['productName']?></span>
                                            <span class="home-product-item__decribe"><?php echo $result['productTitle']?></span>
                                        </h4>
                                        <div class="home-product-item__price">
                                            <div class="home-product-item__price-old">
												<?php 
													echo $format->format_currency($result['price'])." "."VNĐ"
												?>
											</div>
                                            <div class="home-product-item__price-current"><?php echo $format->format_currency($result['discountPrice'])." "."VNĐ"?></div>
                                        </div>
                                    </a>
                                </div>
								<?php 
											}
										}
									}
									else if(isset($_GET['brandId'])) {
										$brandProduct = $product->findProductByBrand($_GET['brandId']);
										if($brandProduct) {
											while($result=$brandProduct->fetch_assoc()) {
								?>
								<div class="grid__column-2-4">
                                    <a href="productDetails.php?productCode=<?php echo $result['productCode']?>" class="home-product-item">
                                        <div class="home-product-img">
                                            <div class="home-product-item__img" style="background-image: url(Admin/uploads/<?php echo $result['image']?>);">
                                            </div>
                                            <span class="installment">Trả góp 0%</span>
                                        </div>
                                        <h4>
                                            <span class="home-product-item__name"><?php echo $result['productName']?></span>
                                            <span class="home-product-item__decribe"><?php echo $result['productTitle']?></span>
                                        </h4>
                                        <div class="home-product-item__price">
                                            <div class="home-product-item__price-old">
												<?php 
													echo $format->format_currency($result['price'])." "."VNĐ"
												?>
											</div>
                                            <div class="home-product-item__price-current"><?php echo $format->format_currency($result['discountPrice'])." "."VNĐ"?></div>
                                        </div>
                                    </a>
                                </div>
								<?php 
											}
										}
									}
									else{
										// hiện tất cả sản phẩm
										$currentPage = 1;
										if(isset($_GET["page"])) {
											$currentPage = $_GET["page"];
										}
										$index = ($currentPage - 1)*8;
										$showProduct = $product->showProduct($index);
										if($showProduct) {
											while($result = $showProduct->fetch_assoc()) {	
								?>
                                <div class="grid__column-2-4">
                                    <a href="productDetails.php?productCode=<?php echo $result['productCode']?>" class="home-product-item">
                                        <div class="home-product-img">
                                            <div class="home-product-item__img" style="background-image: url(Admin/uploads/<?php echo $result['image']?>);">
                                            </div>
                                            <span class="installment">Trả góp 0%</span>
                                        </div>
                                        <h4>
                                            <span class="home-product-item__name"><?php echo $result['productName']?></span>
                                            <span class="home-product-item__decribe"><?php echo $result['productTitle']?></span>
                                        </h4>
                                        <div class="home-product-item__price">
                                            <div class="home-product-item__price-old">
												<?php 
													echo $format->format_currency($result['price'])." "."VNĐ"
												?>
											</div>
                                            <div class="home-product-item__price-current"><?php echo $format->format_currency($result['discountPrice'])." "."VNĐ"?></div>
                                        </div>
                                    </a>
                                </div>
								<?php 
											}
										}
									}
								?>
                                <!-- hết sản phẩm -->
                            </div>
                        </div>
                        <ul class="pagination home-product-pagination" id="phantrang">
<!--							dấu đi trang quay lại-->
                            <li class="pagination-item">
                                <a href="index.php?page=<?php if(isset($_GET['page']))echo $_GET['page']-1?>" class="pagination-item__link">
                                    <i class="pagination-item__icon fas fa-angle-left"></i>
                                </a>
                            </li>
							<?php 
								$page = $product->countProduct();
								if($page) {
									for($i = 1; $i<=$page; $i++) {
							?>
                            <li class="pagination-item pagination-item--active"> 
                                <a href="index.php?page=<?php echo $i?>" 
                                    <?php 
                                        if(isset($_GET['page']) && $i==$_GET['page']) {
                                            echo 'class="pagination-item__link"'; 
                                        }
                                        else if(!isset($_GET['page']) && $i==1) {
                                            echo 'class="pagination-item__link"';
                                        }
                                    ?> 
                                > <?php echo $i?></a> 
                            </li>
							<?php 
									}
								}
							?>
<!--							dấu đi trang tiếp theo-->
                            <li class="pagination-item"> <a href="index.php?page=<?php if(isset($_GET['page'])) echo $_GET['page']+1?>" class="pagination-item__link"><i class="pagination-item__icon fas fa-angle-right"></i></a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
