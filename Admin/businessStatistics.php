<?php
	ob_start();
	include('modules/header.php');
	include('modules/category.php');
    include('../classes/brand.php');
    include('../classes/order.php');
    include('../classes/product.php');
    include_once('../classes/product.php');
    $brand = new brand();
    $order = new order();
    $product = new product();
?>

<div class="grid__column-10">
                    <div class="admin-product__add">
                        <div class="admin-title">
                            <span>THỐNG KÊ KINH DOANH</span>
                        </div>
                        <br><br>
                        <canvas id="myChart" width="13" height="5"></canvas>
                        <script>
                            var ctx = document.getElementById('myChart').getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    <?php
                                        $arrayNameProduct = array(); 
                                        $showAllOrder = $order->showAllOrder();
                                        if($showAllOrder) {
                                            while($resultFind = $showAllOrder->fetch_assoc()) {  
                                                array_push($arrayNameProduct, $resultFind['productName']);
                                            } 
                                        }   
                                        ?>
                                    labels: [
                                        <?php
                                            for($i=count($arrayNameProduct)-1; $i>=0; $i--) {
                                                if($i>0 && $arrayNameProduct[$i] == $arrayNameProduct[$i-1]) {
                                                    
                                                }
                                                else if($i==0) {
                                                    echo "'$arrayNameProduct[$i]'";
                                                }
                                                else {
                                                    echo "'$arrayNameProduct[$i]'".",";
                                                }
                                            }
                                        ?>    
                                    ],
                                    datasets: [{
                                        label: 'Đã bán',
                                        <?php 
                                            $arrayOrder = array();
                                            $showOrder = $order->showAllOrder();
                                            if($showOrder) {
                                                $amountOfProduct=0;
                                                while($resultOrder = $showOrder->fetch_assoc()) {
                                                    $amountOfProduct++;
                                                    array_push($arrayOrder, $resultOrder['productCode']);
                                                }
                                            }
                                            sort($arrayOrder);
                                            $max = 0; $count = 1; $productCode = 0; $min = 9999; $productCodeMin = 0;
                                            $cnt = array();
                                            for($i = 0;$i < 100; $i++){
                                                $cnt[$i] = 0;
                                            } 
                                            for($i = 0; $i < count($arrayOrder);$i++){
                                                $cnt[$arrayOrder[$i]]++;
                                            }
                                            for($i = 0;$i < 100; $i++){
                                                if($cnt[$i] > 0 && $cnt[$i]>$max){
                                                    $productCode = $i;
                                                    $max=$cnt[$i];
                                                }
                                            }
                                            for($i = 0;$i < 100; $i++){
                                                if($cnt[$i] > 0 && $cnt[$i]<$min){
                                                    $productCodeMin = $i;
                                                    $min=$cnt[$i];
                                                }
                                            }
                                            $nameOfProduct;$nameOfProductMin;
                                            $getProduct = $product->getProductById($productCode);
                                            if($getProduct) {
                                                while($resultProduct = $getProduct->fetch_assoc()) {
                                                    $nameOfProduct = $resultProduct['productName'];
                                                }
                                            }
                                            $getProductMin = $product->getProductById($productCodeMin);
                                            if($getProductMin) {
                                                while($resultProduct = $getProductMin->fetch_assoc()) {
                                                    $nameOfProductMin = $resultProduct['productName'];
                                                }
                                            }
                                        ?>
                                        data: [
                                            <?php 
                                                for($i=0; $i<count($arrayOrder); $i++) {
                                                    if($i>0 && $arrayOrder[$i] == $arrayOrder[$i-1]) {
                                                    
                                                    }
                                                    else if($i!=count($arrayOrder)-1) {
                                                        echo $cnt[$arrayOrder[$i]].",";
                                                    }
                                                    else {
                                                        echo $cnt[$arrayOrder[$i]];
                                                    }
                                                }    
                                            ?>
                                        ],
                                        // data: [237, 89, 42, 72, 98, 67, 58],
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(255, 206, 86, 0.2)',
                                            'rgba(75, 192, 192, 0.2)',
                                            'rgba(153, 102, 255, 0.2)',
                                            'rgba(255, 159, 64, 0.2)',
                                            'rgba(255,63,10,0.2)'
                                        ],
                                        borderColor: [
                                            'rgba(255, 99, 132, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',
                                            'rgba(75, 192, 192, 1)',
                                            'rgba(153, 102, 255, 1)',
                                            'rgba(255, 159, 64, 1)',
                                            'rgba(255,63,10,1)'
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero: true
                                            }
                                        }]
                                    }
                                }
                            });
                        </script>
                        <div class="chart_title">
                            <p>Biểu đồ trên là số lượng các sản phẩm đã được bán trong vòng 1 tháng qua .</p>
                        </div>
                        <div class="info">
                            <p> - Tổng số sản phẩm được bán : <?php echo $amountOfProduct?> sản phẩm</p>
                            <p> - Sản phẩm được mua nhiều nhất là <?php echo $nameOfProduct?> (<?php echo $max?> cái)</p>
                            <p> - Sản phẩm ít người mua nhất là <?php echo $nameOfProductMin?> (<?php echo $min?> cái)</p>
                        </div>
                        <div class="title" style="padding-bottom: 145px;">
                            <br>
                            <span>TÌNH HÌNH KINH DOANH 6 THÁNG VỪA QUA</span>
                        </div>
                        <table class="table table-hover">

                            <!--Table head-->
                            <thead style="font-size: 15px; border: 1px; background-color: #d4020d; color: white" class="table-primary">
                                <tr>
                                    <th>Năm</th>
                                    <th>Tháng</th>
                                    <th>Tổng sản phẩm bán được</th>
                                    <th>Sản phẩm được mua nhiều nhất</th>
                                    <th>Sản phẩm ít người mua nhất</th>
                                    <th>Doanh thu</th>

                                </tr>
                            </thead>
                            <!--Table head-->

                            <!--Table body-->
                            <tbody style="font-size: 13px;">
                                <tr name="sp3" id="3">
                                    <td scope="row" style="width: 20px;">2022</td>
                                    <td>3</td>
                                    <td>4</td>
                                    <td>Fossil ME1138</td>
                                    <td>Citizen AW1212</td>
                                    <td>11.850.000 VNĐ</td>
                                </tr>
                                <tr name="sp3" id="3">
                                    <td scope="row" style="width: 20px;">2022</td>
                                    <td>4</td>
                                    <td>3</td>
                                    <td>G-SHOCK GA-700SK</td>
                                    <td>Casio LTP-VT01GL-9BUDF</td>
                                    <td>8.350.000 VNĐ</td>
                                </tr>
                                <tr name="sp3" id="3">
                                    <td scope="row" style="width: 20px;">2022</td>
                                    <td>5</td>
                                    <td>7</td>
                                    <td>Casio MTP-1374L-1AVDF </td>
                                    <td>Tissot T095.417 (40)</td>
                                    <td>14.950.000 VNĐ</td>
                                </tr>
                            </tbody>
                            <!--Table body-->
                        </table>
                        <br><br>
                        <div class="info">
                            <p> - Trong 3 tháng vừa qua , ta thấy được số lượng sản phẩm được bán ra nhiều nhất là vào tháng 1 và tháng 2 , </p>
                            <p> đó là thời điểm gần Tết và trong Tết nên mọi người mua sắm nhiều</p>
                            <p> - Sản phẩm được bán hiều nhất là Casio vì giá thành ổn định và độ bền cao</p>
                            <p> - Sản phẩm ít người mua nhất là Tissot vì giá tương đối cao và chưa phổ biến</p>
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
	include('modules/footer.php');
	ob_end_flush();
?>