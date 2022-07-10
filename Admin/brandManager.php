<?php
	ob_start();
	include('../classes/brand.php');
	include('modules/header.php');
	include('modules/category.php');
	$brand = new brand();
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$deleteBrand = $brand->deleteBrand($id);
	}
?>
<div class="grid__column-10">
                    <div class="admin-title">
                        <span>QUẢN LÍ THƯƠNG HIỆU</span>
                    </div>
					<form action="" method="get" style="margin-bottom: 15px;">
						<div class="header__search-wrap" style="display: flex">
							<input class="header__search-input" name="brandFind" placeholder="Nhập tên của thương hiệu để tìm kiếm" style="height: 34px;background-color: #E8F0FE;color: black; margin-right: 14px;" />
							<button class="header__search-btn" type="submit" style="background-color: #d4020d"> <i class="header__search-btn-icon fas fa-search"></i> </button>
						</div>	
					</form>	
                    <div class="product-add">
                        <a href="brandAdd.php">
                            <button class="product-add__action">Thêm thương hiệu mới</button>
                        </a>
                    </div>
                    <div class="admin-product__add">
                        <div class="grid__row">
							<table class="table table-hover ">

                                <!--Table head-->
                                <thead style="font-size: 13px; border: 3px;color: white;background-color: #d4020d; " class="table-primary "> 
									<tr style="text-align: top; width: 20px";>
										<th>STT</th>
										<th>Tên thương hiệu</th>
										<th>Số điện thoại</th>
										<TH>Địa chỉ</TH>
										<th>Hành động</th>
									</tr>
                                </thead>
								<tbody style="font-size: 13px; ">
									<?php
										if(isset($_GET['brandFind'])) {
											$brandNameToFind = $_GET['brandFind'];
											$showBrand = $brand->findBrandByName($brandNameToFind);
											if($showBrand) {
												$i = 0;
												while($result = $showBrand->fetch_assoc()) {
													$i++;
									?>
                                    <tr name="sp1">
                                        <td scope="row " style="width: 20px; "><?php echo $i;?></td>
                                        <td><?php echo $result['name'];?></td>
                                        <td><?php echo $result['numberPhone'];?></td>
                                        <td><?php echo $result['address'];?></td>
										<td><a href="brandAdd.php?brandId=<?php echo $result['id']?>"><button class="btn" style="background-color: var(--primary-color);color: white;margin: 8px;height: 30px; min-width: 80px;">Sửa</button></a><a onClick= "return confirm('Bạn có muốn xóa thương hiệu này không?')" href="brandManager.php?id=<?php echo $result['id']?>"><button class="btn" style="background-color: var(--primary-color);color: white;margin: 8px;height: 30px; min-width: 80px;">Xóa</button></a></td>
                                    </tr>
									<?php 
												}
											}
										}
										else {
											$showBrand = $brand->showBrand();
											if($showBrand) {
												$i = 0;
												while($result = $showBrand->fetch_assoc()) {
													$i++;
									?>
                                    <tr name="sp1">
                                        <td scope="row " style="width: 20px; "><?php echo $i;?></td>
                                        <td><?php echo $result['name'];?></td>
                                        <td><?php echo $result['numberPhone'];?></td>
                                        <td><?php echo $result['address'];?></td>
										<td>
											<a href="brandAdd.php?brandId=<?php echo $result['id']?>">
												<button class="btn" style="background-color: var(--primary-color);color: white;margin: 8px;height: 30px; min-width: 80px;">Sửa</button>
											</a>
											<a onClick= "return confirm('Bạn có muốn xóa thương hiệu này không?')" href="brandManager.php?id=<?php echo $result['id']?>">
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
