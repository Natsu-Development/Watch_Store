<div class="grid__column-10">
                    <div class="admin-product__add">
                        <!-- nội dung -->
                        <div class="admin-title">
                            <span>QUẢN LÍ NGƯỜI DÙNG</span>
                        </div>
                        <div class="date1"></div>
                        <!--Table head-->
                        <table class="table table-hover">

                            <!--Table head-->
                            <thead style="font-size: 13px; border: 3px;color: white;background-color: #d4020d;" class="table-primary">
                                <tr>

                                    <th>STT</th>
                                    <th>Tên tài khoản</th>
                                    <th>mật khẩu</th>
                                    <th>Ngày đăng kí</th>
                                    <th>Trạng thái</th>
                                    <th>Khóa</th>

                                </tr>
                            </thead>
                            <!--Table head-->

                            <!--Table body-->
                            <tbody style="font-size: 13px;">
                                <tr name="sp1" id="1">
                                    <td scope="row"><b>1</b></td>
                                    <td class="td">Đạo</td>
                                    <td>*********</td>
                                    <td>26/10/2020</td>
                                    <td>Đang hoạt động</td>
                                    <td>
                                        <button onclick="block('1','f','v');" id="f" class="block" style="background-color: #d4020d; color: white;">KHÓA</button>
                                        <button onclick="unblock('1','f','v');" id="v" class="unblock" style="background-color: #d4020d; color: white;">MỞ KHÓA</button>
                                    </td>


                                    </td>
                                </tr>
                                <tr name="sp2" id="2">

                                    <th scope="row">2</th>
                                    <td class="td">Cát</td>
                                    <td>********</td>
                                    <td>10/11/2020</td>
                                    <td>Hoạt dộng một giờ trước</td>
                                    <td><button onclick="block('2','d','g');" id="d" class="block" style="background-color: #d4020d; color: white;">KHÓA</button>
                                        <button onclick="unblock('2','d','g');" id="g" class="unblock" style="background-color: #d4020d; color: white;">MỞ KHÓA</button>
                                    </td>


                                </tr>
                                <tr name="sp3" id="3">

                                    <th scope="row">3</th>
                                    <td class="td">Bảo</td>
                                    <td>********</td>
                                    <td>30/11/2020</td>
                                    <td>Đang hoạt động</td>
                                    <td>
                                        <button onclick="block('3','t','h')" id="t" class="block" style="background-color: #d4020d; color: white;">KHÓA</button>
                                        <button onclick="unblock('3','t','h')" id="h" class="unblock" style="background-color: #d4020d; color: white;">MỞ KHÓA</button>
                                    </td>


                                </tr>

                            </tbody>
                            <!--Table body-->

                        </table>
                        <!--Table-->
                        <!-- hết nội dung -->
                    </div>

                </div>