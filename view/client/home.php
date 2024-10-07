<?php
$title = "Trang Chủ";
$header = "";
$script = "";

include_once(__DIR__ . "/header.php");

$perPage = 10; // Số sản phẩm mỗi trang
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Số trang hiện tại
$offset = ($page - 1) * $perPage; // Tính toán offset

// Lọc theo danh mục, thương hiệu và tìm kiếm từ khóa
$category = isset($_GET['category']) ? trim($_GET['category']) : null;
$brand = isset($_GET['brand']) ? trim($_GET['brand']) : null;
$search = isset($_GET['search']) ? trim($_GET['search']) : null;

// Khởi tạo câu truy vấn cơ bản
$sql = "SELECT * FROM products WHERE 1=1";

// Lọc theo danh mục
if (!empty($category)) {
    $ctg = $db->fetch_assoc("SELECT * FROM `categories` WHERE `name` = '$category'", 1);
    if (isset($ctg['id'])) {
        $sql .= " AND `category_id` = '" . $ctg['id'] . "'";
    }
}

// Lọc theo thương hiệu
if (!empty($brand)) {
    $sql .= " AND `brand` = '$brand'";
}

// Tìm kiếm theo từ khóa
if (!empty($search)) {
    $sql .= " AND (`msp` LIKE '%$search%' OR `name` LIKE '%$search%' OR `description` LIKE '%$search%')";
}

// Truy vấn tổng số sản phẩm sau khi lọc
$totalProduct = $db->num_rows($sql);
$totalPages = ceil($totalProduct / $perPage); // Tính tổng số trang

// Áp dụng phân trang
$sql .= " LIMIT $offset, $perPage";

// Truy vấn lấy dữ liệu sản phẩm
$products = $db->fetch_assoc($sql, 0);
$categories = $db->fetch_assoc("SELECT * FROM `categories`", 0);

$categories = $db->fetch_assoc("SELECT * FROM `categories`", 0);
$brands = $db->fetch_assoc("SELECT brand FROM products group by brand ", 0);
?>

<!-- Bootstrap Container -->
<div class="container mt-4">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">

                <div class="row align-items-center justify-content-center mb-4">
                    <h2 class="col-auto">Danh sách thiết bị</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Form tìm kiếm sản phẩm -->
    <div>
        <h3>Phân Loại</h3>
    </div>

    <form class="mb-4">
        <div class="row">
            <!-- Ô chọn danh mục -->
            <div class="col-md-3">
                <div class="form-group position-relative">
                    <select class="form-control" name="category">
                        <option value="">Chọn danh mục</option>
                        <?php foreach ($categories as $cate) { ?>
                            <option value="<?= $cate['name'] ?>"
                                <?= (isset($_GET['category']) && strtolower(trim($cate['name'])) == strtolower(trim($_GET['category']))) ? 'selected' : 'sa' ?>>
                                <?= $cate['name'] ?></option>
                        <?php } ?>
                        <!-- Điền thêm các option cho danh mục ở đây -->
                    </select>
                    <!-- Icon danh mục -->
                    <i class="bi bi-list position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%);"></i>
                </div>
            </div>

            <!-- Ô chọn thương hiệu -->
            <div class="col-md-3">
                <div class="form-group position-relative">
                    <select class="form-control" name="brand">
                        <option value="">Chọn thương hiệu</option>
                        <?php
                        foreach ($brands as $brand) { ?>
                            <option value="<?= $brand['brand'] ?>"
                                <?= (isset($_GET['brand']) && strtolower(trim($brand['brand'])) == strtolower(trim($_GET['brand']))) ? 'selected' : '' ?>>
                                <?= $brand['brand'] ?></option>
                        <?php } ?>
                        <!-- Điền thêm các option cho thương hiệu ở đây -->
                    </select>
                    <!-- Icon thương hiệu -->
                    <i class="bi bi-tags position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%);"></i>
                </div>
            </div>

            <!-- Ô tìm kiếm sản phẩm -->
            <div class="col-md-4">
                <div class="form-group position-relative">
                    <input type="text" class="form-control" name="search" placeholder="Tìm kiếm sản phẩm" value="<?php echo $search; ?>">
                    <!-- Icon tìm kiếm -->
                    <i class="bi bi-search position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%);"></i>
                </div>
            </div>

            <!-- Nút tìm kiếm -->
            <div class="col-md-2">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary w-100">
                        Tìm kiếm <i class="bi bi-arrow-right-circle ms-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>

    <div>
        <h3>Sản phẩm</h3>
    </div>
    <!-- Hiển thị sản phẩm -->
    <div class="row">
        <?php if (empty($products)): ?>
            <!-- Nếu không có sản phẩm nào -->
            <div class="col-12">
                <div class="alert alert-warning text-center" role="alert">
                    Không tìm thấy sản phẩm nào phù hợp với tiêu chí tìm kiếm của bạn.
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($products as $product): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 <?php echo $product['quantity'] == 0 ? 'bg-light text-dark' : ''; ?>">
                        <div class="card-img-top" style="border: 1px solid #ddd; padding: 5px; height: 200px; display: flex; align-items: center; justify-content: center;">
                            <img
                                src="<?php echo $product['image']; ?>"
                                alt="<?php echo $product['name']; ?>"
                                onerror="this.onerror=null; this.src='path/to/default-image.jpg';"
                                style="height: 100%; object-fit: cover; width: 100%;">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo $product['name']; ?></h5>
                            <p class="card-text">
                                <?php if ($product['quantity'] > 0): ?>
                                    Số lượng: <?php echo $product['quantity']; ?>
                                <?php else: ?>
                                    <span class="text-danger">Hết hàng</span>
                                <?php endif; ?>
                            </p>
                            <?php if ($product['quantity'] > 0): ?>
                                <button class="btn btn-primary mt-auto buy-now" data-id="<?= $product['id'] ?>"
                                    data-name="<?= $product['name'] ?>"
                                    data-quantity="<?= $product['quantity'] ?>"
                                    data-desc="<?= $product['description'] ?>"
                                    data-brand="<?= $product['brand'] ?>">Mượn</button>
                            <?php else: ?>
                                <button class="btn btn-secondary mt-auto" disabled>Hết hàng</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
        <?php endforeach;
        endif; ?>
    </div>
    <!-- Hiển thị phân trang -->
    <?php if ($totalPages > 1): ?>
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>&category=<?php echo $category; ?>&brand=<?php echo $brand; ?>&search=<?php echo $search; ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    <?php endif; ?>

</div>
<div class="modal fade" id="order" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thông tin sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <div class="col-md-6 product-info">
                    <input type="hidden" id="idProduct">
                    <div class="mb-3">
                        <label class="form-label"><b>Tên sản phẩm: </b></label>
                        <span id="txtName" class="text-info fs-5"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><b>Thương hiệu: </b></label>
                        <span id="txtBrand" class="text-danger fs-6"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><b>Kho: </b></label>
                        <span id="txtQuantity" class="text-danger fs-6"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><b>Mô tả: </b></label>
                        <textarea id="txtDesc" rows="5" class="form-control" readonly></textarea>
                    </div>
                    <div class="text-center">
                        <span id="add-status" class="text-danger"></span>
                    </div>
                </div>
                <div class="col-md-6 border-start border-secondary">
                    <div class="mb-3">
                        <label class="form-label"><b>Ngày Mượn: </b></label>
                        <input type="date" id="startDate" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><b>Ngày trả: </b></label>
                        <input type="date" id="endDate" disabled class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><b>Liên hệ: </b></label>
                        <textarea rows="4" placeholder="Nhập nội dung nếu cần liên hệ quản lý..." id="txtAdd" class="form-control"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary btn-add">Mượn</button>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        // Mở modal và hiển thị thông tin sản phẩm
        $(document).on('click', '.buy-now', function() {
            $('#idProduct').val($(this).data('id'));
            $('#txtName').text($(this).data('name'));
            $('#txtBrand').text($(this).data('brand'));
            $('#txtQuantity').text($(this).data('quantity'));
            $('#txtDesc').val($(this).data('desc')); // Sử dụng val() cho textarea
            $('#order').modal('show');
        });

        // Thiết lập ngày hiện tại và tối đa cho ngày Mượn
        const today = new Date();
        const minDate = today.toISOString().split('T')[0]; // Ngày hiện tại
        const maxDate = new Date(today.setDate(today.getDate() + 30)).toISOString().split('T')[0]; // 30 ngày sau

        $('#startDate').attr('min', minDate);
        $('#startDate').attr('max', maxDate);

        // Quản lý thay đổi trong ngày Mượn
        $('#startDate').on('change', function() {
            const startDate = $(this).val();
            const endDate = $('#endDate');

            if (startDate) {
                endDate.prop('disabled', false);
                // Đặt min cho ngày trả
                const minEndDate = new Date(startDate);
                minEndDate.setDate(minEndDate.getDate() + 1); // Ngày trả phải lớn hơn ngày Mượn
                endDate.attr('min', minEndDate.toISOString().split('T')[0]);
            } else {
                endDate.prop('disabled', true);
            }
        });

        // Xử lý sự kiện khi người dùng chọn ngày trả
        $('#endDate').on('change', function() {
            // Có thể thêm logic ở đây nếu cần
        });

        // Xử lý sự kiện nhấn nút "Mượn"
        $('.btn-add').on('click', function() {
            const id = $('#idProduct').val();
            const startDate = $('#startDate').val();
            const endDate = $('#endDate').val();
            const contactInfo = $('#txtAdd').val();

            if (!startDate) {
                alert('Vui lòng chọn ngày Mượn.');
                return;
            }
            if (!endDate) {
                alert('Vui lòng chọn ngày trả.');
                return;
            }
            $('#order').modal('hide');
            // Hiện thông báo đang xử lý
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
                url: '<?= BASE_URL("/ajaxs/order?submit=store") ?>',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    id: id,
                    startDate: startDate,
                    endDate: endDate,
                    contactInfo: contactInfo,
                }),
                success: function(data) {
                    data = JSON.parse(data);
                    if (data.error !== 0) {
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
    });
</script>
<?php include_once(__DIR__ . "/footer.php"); ?>