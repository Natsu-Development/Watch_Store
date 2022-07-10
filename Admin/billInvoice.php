<?php 
	include('modules/header.php');
	include('modules/category.php');
	include('../classes/order.php');
	include_once('../helper/format.php');
	$format = new Format();
	$order = new order();
?>
<div class="grid__column-10 ">
                    <div class="admin-title ">
                        <span>Hóa đơn điện tử</span>
                    </div>
                    <div class="grid__row ">
                        <div class="admin-product__add ">
                            <!-- nội dung -->
							<form action="" method="get" style="margin-bottom: 15px;">
								<div class="header__search-wrap" style="display: flex">
									<input class="header__search-input" name="findName" placeholder="Nhập tên khách hàng để tìm kiếm" style="height: 34px;background-color: #E8F0FE;color: black; margin-right: 14px;" />
									<button class="header__search-btn" type="submit" style="background-color: #d4020d"> <i class="header__search-btn-icon fas fa-search"></i> </button>
								</div>	
							</form>	
                            <!--Table head-->
							<form action="" method="post" style="width: 1160px;">
                            <table class="table table-hover ">
								
                                <!--Table head-->
                                <thead style="font-size: 13px; border: 3px;color: white;background-color: #d4020d; " class="table-primary ">
									<tr style="text-align: top " ;>
										<th>STT</th>
										<th>Tên khách hàng</th>
										<th>Tổng tiền</th>
										<th>Ghi chú chuyển tiền</th>
										<TH>Tên ngân hàng chuyển</TH>
										<TH>Ngày và giờ</TH>
									</tr>
                                </thead>
                                <!--Table head-->

                                <!--Table body-->
								<?php 
                                    if(isset($_GET['findName'])) {
                                        $findOrder = $order->getBillInvoiceByName($_GET['findName']);
                                        if($findOrder) {
                                            $i =0;
                                            while($resultFind = $findOrder->fetch_assoc()) {
                                                $i++;
								?>
                                <tbody style="font-size: 13px; ">
                                    <tr name="sp1 ">
                                        <td scope="row " style="width: 20px; "><?php echo $i?></td>
                                        <td>
											<?php 
												echo $resultFind['customerName'];
											?>
										</td>
										<td>
											<?php 
												echo $format->format_currency($resultFind['price'])." "."VNĐ";
											?>
										</td>
										<td>
											<?php echo $resultFind['note']?>
										</td>
                                        <td>
											<?php
												echo $resultFind['bankName'];
											?>
										</td>
										<td><?php
												echo $resultFind['time'];
											?>
										</td>	
                                    </tr>                                  
                                </tbody>
								<?php 
                                            }
										}
									}
                                    else {
                                        $findBill = $order->getAllBillInvoice();
                                        if($findBill) {
                                            $i =0;
										    while($resultFind = $findBill->fetch_assoc()) {
											$i++;
                                ?>
                                        <tbody style="font-size: 13px; ">
                                            <tr name="sp1 ">
                                                <td scope="row " style="width: 20px; "><?php echo $i?></td>
                                                <td>
                                                    <?php 
                                                        echo $resultFind['customerName'];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        echo $format->format_currency($resultFind['price'])." "."VNĐ";
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $resultFind['note']?>
                                                </td>
                                                <td>
                                                    <?php
                                                        echo $resultFind['bankName'];
                                                    ?>
                                                </td>
                                                <td><?php
                                                        echo $resultFind['time'];
                                                    ?>
                                                </td>	
                                            </tr>                                  
                                        </tbody>
                                <?php 
                                            }
                                        }
                                    }
                                ?>
                                    
                                <!--Table body-->

                            </table>
<!--
                            <div class="save__controls ">
                                <button class="save__controls-back " onclick="saveSuccess()">Lưu</button>
                            </div>
-->
                            <!--Table-->
                            <!-- hết nội dung -->
							</form>
                        </div>
                    </div>

                </div>
			</div>
		</div>
	</div>
<?php 
	include('modules/footer.php');
?>