<template>
    <div class="container">
        <div class="navigator">
            <a href="#">Trang chủ</a>»<span>Thông báo</span>
        </div>
        <session class="box-content">
            <div class="title">
                <h3>Tính toán điện năng trung bình</h3>
            </div>
            <div class="content-page box-ttdn">
                <table class="table-ttdn">
                    <tr>
                        <th>Địa điểm sử dụng</th>
                        <th>Mục đích sử dụng</th>
                        <th>Tên loại thiết bị</th>
                        <th>Công suất <br/> (P/W)</th>
                        <th>Số lượng <br/> (Cái)</th>
                        <th>Thời gian sử dụng TB trong ngày <br> (Giờ)</th>
                        <th>Điện năng tiêu thụ TB trong ngày</th>
                        <th>Thời gian sử dụng TB trong tháng</th>
                        <th>Điện năng tiêu thụ trong tháng</th>
                    </tr>
                    <tr class="special">
                        <td>Phòng khách</td>
                        <td>
                            Thiết bị chiếu sáng <br>
                            <button type="button" class="btn btn-primary btn-add" data-toggle="modal" data-target="#add_device">Thêm thiết bị</button>
                        </td>
                        <td>
                            Đèn huỳnh quang 1.2m
                        </td>
                        <td>
                            <input class="form-control" type="text">
                        </td>
                        <td>
                            <input class="form-control" type="text">
                        </td>
                        <td>
                            <input class="form-control" type="text">
                        </td>
                        <td class="number">
                            <span>6</span>
                        </td>
                        <td><input class="form-control" type="text"></td>
                        <td class="number">
                            <span>12960</span>
                        </td>
                    </tr>

                    <tr class="special">
                        <td>Phòng ngủ 1</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-add" data-toggle="modal" data-target="#add_device">Thêm thiết bị</button>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Phòng ngủ 2</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-add" data-toggle="modal" data-target="#add_device">Thêm thiết bị</button>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class="special">
                        <td>Nhà bếp</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-add" data-toggle="modal" data-target="#add_device">Thêm thiết bị</button>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Sân vườn</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-add" data-toggle="modal" data-target="#add_device">Thêm thiết bị</button>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <div class="row">
                <div class="cskh">
                    <img src="{{asset('client/imgs/CSKH.jpg')}}" alt="cskh">
                </div>
            </div>
        </session>
        <session class="footer">
            <div class="box-footer">
                <p>Công Ty Điện Lực Hòa Bình</p>
                <p>Đường Cù Chính Lan - TP. Hòa Bình - Hòa Bình</p>
            </div>
        </session>
    </div>
</template>

<script>
    export default {
        name: 'IndexComponent',
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
