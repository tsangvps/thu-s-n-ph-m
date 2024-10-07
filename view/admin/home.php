<?php
$title = "Bảng điều khiển";
$header = "
    <script src='https://cdn.datatables.net/2.1.7/js/dataTables.min.js'></script>
    <link rel='stylesheet' href='https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.min.css'>
";
$script = "
";
include_once(__DIR__ . "/header.php");
$history = $db->fetch_assoc("SELECT rental_requests.*, products.name as pname, products.id as msp, users.name as uname FROM `rental_requests`
                            INNER JOIN products ON products.id = rental_requests.product_id 
                            INNER JOIN users ON users.id = rental_requests.user_id
                            ORDER BY `rental_requests`.`id` DESC", 0);
?>

<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= BASE_URL("/") ?>">Đơn hàng</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- [ breadcrumb ] end -->

<div class="row">
    <!-- [ sample-page ] start -->
    <div class="card">
        <div class="card-header">
            <h4>
                <i class="ti ti-device-desktop-analytics"></i>
                <b>Danh sách đơn hàng</b>
            </h4>
        </div>
        <div class="card-body">
            <div class="card-body">
                <div class="dt-responsive table-responsive overflow-x-scroll">
                    <table id="listKh" class="table table-striped" style="width:100%; white-space: nowrap;">
                        <thead>
                            <tr>
                                <th>Mã Sản Phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Người mượn</th>
                                <th>Trạng thái đơn</th>
                                <th>Chú ý từ người mượn</th>
                                <th>Ngày thuê</th>
                                <th>Ngày trả</th>
                                <th style="width: 90px">Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($history as $item) { ?>
                            <tr>
                                <td class="text-info">#<?=$item['msp'] ?></td>
                                <td><?= $item['pname'] ?></td>  
                                <td><?= $item['uname'] ?></td>
                                <td><?= textStatus($item['status']) ?></td>
                                <td style="max-width: 200px; overflow-x: scroll; scrollbar-width: none;">
                                <textarea class="form-control" readonly=""><?= $item['mota'] ?></textarea></td>
                                <td class="text-secondary"><?= $item['start_date'] ?></td>
                                <td class="text-secondary"><?= $item['end_date'] ?></td>
                                <td class="text-end"><a href="javascript: void(0)" class="btn btn-info btn-sm btn-edit"
                                        data-id="<?= $item['id'] ?>" data-status="<?= $item['status'] ?>">Cập
                                        nhật</a>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>

                            </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- [ sample-page ] end -->
</div>

<div class="modal fade" id="editOrder" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modal-detail-title">Cập nhật đơn hàng</h5>
                <a href="javascript:;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>
            <div class="modal-body">
                <input type="hidden" id="txtId">
                <div class="mb-3">
                    <label for="txtStatus" class="form-label"><b>Tình trạng đơn hàng</b></label>
                    <select class="form-control" id="txtStatus">
                        <option value="pending">Chờ Duyệt</option>
                        <option value="success">Xác Nhận Cho Mượn</option>
                        <option value="paid">Đã Trả</option>
                        <option value="cancel">Xác Nhận Hủy</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger closed-btn" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-success btn-update" data-bs-dismiss="modal">Cập nhật</button>
            </div>
        </div>
    </div>
</div>
<script>
$(document).on('click', '.btn-edit', function() {
    var id = $(this).data('id');
    $('#txtId').val(id);
    $('#txtStatus').val($(this).data('status')).change();
    $('#editOrder').modal('show');
});

$('.btn-update').on('click', function() {
    Swal.fire({
        title: 'Đang xử lý',
        text: 'Vui lòng đợi trong khi chúng tôi xử lý yêu cầu của bạn.',
        icon: 'info',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    $.ajax({
        url: '<?= BASE_URL("/ajaxs/admin/order?submit=update") ?>',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({
            id: $('#txtId').val(),
            status: $('#txtStatus').val(),
        }),
        success: function(data) {
            data = JSON.parse(data);
            if (data.error != 0) {
                Swal.fire({
                    icon: "error",
                    title: "Thất bại!",
                    text: data.message,
                    confirmButtonText: 'Thử lại'
                });
            } else {
                Swal.fire({
                    icon: "success",
                    title: "Thành công!",
                    text: data.message,
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({
                title: 'Đã xảy ra lỗi!',
                text: error,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });

});

$(document).ready(function() {
    var table = $('#listKh').DataTable({
        order: [],
        lengthMenu: [5, 10, 25, 50, 100],
        language: {
            lengthMenu: "Hiển thị _MENU_ bản ghi",
            zeroRecords: "Không tìm thấy bản ghi nào",
            info: "Hiển thị từ _START_ đến _END_ trong tổng số _TOTAL_ bản ghi",
            infoEmpty: "Không có bản ghi nào",
            infoFiltered: "(Lọc từ _MAX_ tổng số bản ghi)",
            search: "Tìm kiếm:",
            paginate: {
                first: "Đầu tiên",
                last: "Cuối cùng",
                next: "Tiếp theo",
                previous: "Trước"
            }
        }
    });
});

</script>
<?php
include_once(__DIR__ . "/footer.php");
?>