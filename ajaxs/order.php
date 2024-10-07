<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_GET) && !empty($_GET['submit'])) {
    $data = json_decode(file_get_contents("php://input"), true);
    if (is_array($data)) {
        $_POST = xss_array($data);
    }

    function store($data)
    {
        global $db, $User_data;
        // Kiểm tra dữ liệu đầu vào
        if (empty($data['id']) || empty($data['startDate']) || empty($data['endDate']) || empty($data['contactInfo'])) {
            exit(json_encode(returnData([], "Vui lòng điền đầy đủ thông tin!")));
        }
        // Tính số ngày đặt
        $startDate = strtotime($data['startDate']);
        $endDate = strtotime($data['endDate']);
        // Kiểm tra ngày bắt đầu phải lớn hơn hoặc bằng ngày hiện tại
        if ($startDate < time()) {
            exit(json_encode(returnData([], "Ngày thuê phải lớn hơn hoặc bằng ngày hiện tại!")));
        }
        // Kiểm tra ngày kết thúc phải lớn hơn ngày bắt đầu
        if ($endDate <= $startDate) {
            exit(json_encode(returnData([], "Ngày trả phải lớn hơn ngày thuê!")));
        }
        $product = $db->fetch_assoc("SELECT * from `products` where `id`='" . $data['id'] . "'", 1);
        if ($product['quantity'] == 0) {
            exit(json_encode(returnData([], "Hết hàng!")));
        }
        // Chèn yêu cầu thuê vào cơ sở dữ liệu
        $db->insert('rental_requests', [
            'user_id' => $User_data['id'],
            'product_id' => $data['id'],
            'mota' => $data['contactInfo'], // Lưu thông tin liên hệ
            'start_date' => $data['startDate'],
            'end_date' => $data['endDate'],
        ]);

        // Cập nhật số lượng sản phẩm
        $db->update('products', ['quantity' => $product['quantity'] - 1], "`id`='" . $data['id'] . "'");
        exit(json_encode(returnData($data, "Đặt thành công!")));
    }



    switch ($_GET['submit']) {
        case "store":
            store($_POST);
    }
}
