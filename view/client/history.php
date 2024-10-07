<?php
$title = "Sản phẩm đã thuê";
$header = "
    <script src='https://cdn.datatables.net/2.1.7/js/dataTables.min.js'></script>
    <link rel='stylesheet' href='https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.min.css'>
";
$script = "
";

$history = $db->fetch_assoc("SELECT rental_requests.*, products.name as pname, products.id as msp, products.description as description FROM `rental_requests`
                            INNER JOIN products ON products.id = rental_requests.product_id
                             where `user_id` ='" . $User_data['id'] . "'", 0);
include_once(__DIR__ . "/header.php");
?>
<div class="row">
    <!-- [ sample-page ] start -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>
                <i class="ti ti-device-desktop-analytics"></i>
                <b>Danh sách sản phẩm đã thuê</b>
            </h4>
        </div>
        <div class="card-body">
            <div class="dt-responsive table-responsive overflow-x-scroll">
                <table id="listKh" class="table table-striped" style="width:100%; white-space: nowrap;">
                    <thead>
                        <tr>
                            <th>Mã Sản Phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>mô tả</th>
                            <th>Trạng thái</th>
                            <th>Ngày thuê</th>
                            <th>Ngày trả</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($history as $item) { ?>
                            <tr>
                                <td class="text-info">#<?= $item['msp'] ?></td>
                                <td><?= $item['pname'] ?></td>
                                <td>
                                    <button class="btn btn-primary btn-sm view-details" data-desc="<?= $item['description'] ?>" data-name="<?= $item['pname'] ?>" data-msp="#<?= $item['msp'] ?>">
                                        Xem Ngay
                                    </button>
                                </td>
                                <td><?= textStatus($item['status']) ?></td>
                                <td class="text-secondary"><?= $item['start_date'] ?></td>
                                <td class="text-secondary"><?= $item['end_date'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>

                        </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- [ sample-page ] end -->
</div>

<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="buyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modal-detail-title" id="buyModalLabel">Gói: </h5>
                <a href="javascript:;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>
            <div class="modal-body">
                <textarea class="form-control" rows="10" id="proxyDetailsTextarea" readonly=""></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success copy-btn">Copy</button>
                <button type="button" class="btn btn-danger closed-btn" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#listKh').DataTable({
            "order": [[4, "asc"]],
            "language": {
                "sProcessing": "Đang xử lý...",
                "sLengthMenu": "Hiển thị _MENU_ mục",
                "sZeroRecords": "Không tìm thấy dòng nào phù hợp",
                "sInfo": "Đang hiển thị _START_ đến _END_ trong tổng số _TOTAL_ mục",
                "sInfoEmpty": "Đang hiển thị 0 đến 0 của 0 mục",
                "sInfoFiltered": "(được lọc từ _MAX_ mục)",
                "sInfoPostFix": "",
                "sSearch": "Tìm Kiếm:",
                "sUrl": "",
                "sEmptyTable": "Không có dữ liệu trong bảng",
                "sLoadingRecords": "Đang tải...",
                "sInfoThousands": ",",
                "oPaginate": {
                    "sFirst": "Đầu",
                    "sLast": "Cuối",
                    "sNext": "Tiếp",
                    "sPrevious": "Trước"
                },
                "oAria": {
                    "sSortAscending": ": Sắp xếp tăng dần",
                    "sSortDescending": ": Sắp xếp giảm dần"
                }
            }
        });
    });
    
    $(document).ready(function() {
        $(document).on('click', '.view-details', function() {
            var name = $(this).data('name');
            var msp = $(this).data('msp');
            var desc = $(this).data('desc');

            $('#buyModalLabel').text("Sản Phẩm: " + name + " || " + msp);
            $('#proxyDetailsTextarea').val(desc);
            $('#detailModal').modal('show');
        });
    });
</script>
<?php
include_once(__DIR__ . "/footer.php");
?>