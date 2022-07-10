<?php 
	include('include/header.php');
	if(isset($_POST['delete'])) {
		$id = $_POST['cartId'];
		$deleteCart = $cart->deleteCart($id);
	}
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateCart'])) {
		$cartId = $_POST['cartId'];
		$amount = $_POST['amount'];
		$productCode = $_POST['productCode'];
		// check số lượng sản phẩm
		if($product->checkAmountProduct($productCode, $amount)) {
			$cartEdit = $cart->updateCart($amount, $cartId);
		}
	}
?>
    <main role="main">
        <!-- Block content - Đục lỗ trên giao diện bố cục chung, đặt tên là `content` -->
        <div class="container mt-4">
            <div id="thongbao" class="alert alert-danger d-none face" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <h1 class="text-center">Giỏ hàng</h1>
			<form action="" method="post">
            <div class="row">
                <div class="col col-md-12">
                    <table class="table table-bordered" style="font-size: 16px;">
                        <thead>
                            <tr style="text-align: center">
                                <th>STT</th>
                                <th>Ảnh sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
						<?php 
							$showAllCart = $cart->getCart();
							$totalPrice = 0;
							if($showAllCart) {
								$i = 0;
								while($resultShowAllCart = $showAllCart->fetch_assoc()) {
									$i++;
						?>
                        <tbody id="datarow" style="text-align: center">
                            <tr style="text-align: center">
                                <td><?php echo $i;?></td>
                                <td>
                                    <img src="Admin/uploads/<?php echo $resultShowAllCart['image']?>" class="hinhdaidien">
                                </td>
                                <td><?php echo $resultShowAllCart['productName']?></td>
								<td>
                                <input type="number" style="width: 40px; text-align:center;" min="1" value="<?php echo $resultShowAllCart['amount']?>" name="amount" />
								</td>
                                <td><?php $totalPrice +=$resultShowAllCart['price']*$resultShowAllCart['amount']; echo $format->format_currency($totalPrice)." "."VNĐ"?></td>
                                <td>
                                    <!-- Nút xóa, bấm vào sẽ xóa thông tin dựa vào khóa chính `sp_ma` -->
									<input type="hidden" name="cartId" value="<?php echo $resultShowAllCart['cartId'] ?>"/>
									<input type="hidden" name="productCode" value="<?php echo $resultShowAllCart['productCode']?>" />
									<input type="submit" name="delete" value="Xóa" class="btn" style="background-color: #d4020d;color: white;min-width: 70px;"/>
									<input type="submit" name="updateCart" value="Sửa" class="btn" style="background-color: #007bff;color: white;min-width: 70px;"/>
                                </td>
                            </tr>
                        </tbody>
						<?php 
								}
							}
						?>
                    </table>
					
                    <div style="display:flex;margin: 16px;font-size: 20px;float: right;">
						<span style="margin-right: 24px;">Tổng tiền:</span>
						<span style="color: #d4020d">
							<div class="size-16 align-right">
								<?php
									if($totalPrice>0 && isset($totalPrice)) {
										echo $format->format_currency($totalPrice)." "."VNĐ";
									}
								?>
							</div>
						</span>
					</div>	
					<div style="text-align: center; margin-top: 60px;">
                    <button 
					   <?php
						if(isset($_POST['checkout'])) {
						   if(Session::get('customerId')) {
							   $checkExistCart = $cart->getCart();
							   if($checkExistCart) {
								   header('Location: checkout.php');
							   }
							   else {
								   echo '<script>alert("Vui lòng thêm sản phẩm vào giỏ hàng để đặt hàng")</script>';
								   header('Location: index.php');
							   }
						   }
						   else {
							   header('Location: userLogin.php?action=checkout');
						   }
						}
					   ?>
					   class="btn btn-primary btn-md" type="submit" name="checkout"><i
                            class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Đặt hàng</button>	
					</div>	
                </div>
            </div>
			</form>	
        </div>
        <!-- End block content -->
    </main>

<?php 
	include('include/footer.php');
	ob_end_flush();
?>