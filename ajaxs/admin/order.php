<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_GET) && !empty($_GET['submit'])) {
    $data = json_decode(file_get_contents("php://input"), true);
    if (is_array($data)) {
        $_POST = xss_array($data);
    }

    function update($data)
    {
        global $db;
        if (empty($data['id']) || empty($data['status'])) {
            exit(json_encode(returnData([], "Vui lòng nhập đầy đủ thông tin!")));
        }

        $db->update('rental_requests', ['status' => $data['status']], "`id`='" . $data['id'] . "'");
        $info = $db->fetch_assoc("SELECT * FROM rental_requests where `id`='" . $data['id'] . "'", 1);
        $pro = $db->fetch_assoc("select * from products where `id`='" . $info['product_id'] . "'", 1);
        if ($data['status'] == 'refuse' || $data['status'] == "paid") {
            $db->update('products', ['quantity' => $pro['quantity'] + 1], "`id`='" . $info['product_id'] . "'");
        }
        if ($data['status'] != 'pending') {
            $status = $data['status'] == 'success' ? 'đã được xác nhận' : 'đã bị hủy';
            $text = 'Đơn hàng #' . $info['id'] . ' của bạn ' . $status . ' bởi quản trị viên.';
            $db->insert("message", ['user_id' => $info['user_id'], 'text' => $text, 'title' => 'Đơn hàng']);
        }
        exit(json_encode(returnData($data, "Cập nhật thành công!")));
    }

    function updateCategory($data)
    {
        global  $db;
        if (empty($data['name']) || empty($data['id'])) {
            exit(json_encode(returnData([], "Vui lòng nhập đầy đủ thông tin!")));
        }

        $check = $db->num_rows("select * from `categories` where `name`='" . trim($data['name']) . "' and `id` <> '" . $data['id'] . "'");
        if ($check != 0) {
            exit(json_encode(ReturnData([], "Danh mục đã tồn tại!"), 400));
        }

        $db->update('categories', ['name' => trim($data['name'])], "`id`='" . $data['id'] . "'");
        exit(json_encode(ReturnData($data, "Cập nhật thành công!"), 200));
    }

    function addCategory($data)
    {
        global $db;
        if (empty($data['name'])) {
            exit(json_encode(ReturnData([], "Tên danh mục không được để trống!"), 400));
        }

        $check = $db->num_rows("select * from `categories` where `name`='" . trim($data['name']) . "'");
        if ($check != 0) {
            exit(json_encode(ReturnData([], "Danh mục đã tồn tại!"), 400));
        }

        $db->insert('categories', ['name' => trim($data['name'])]);
        exit(json_encode(ReturnData($data, "Thêm thành công!"), 200));
    }

    function deleteProduct($data, $table)
    {
        global $db;
        $db->remove($table, "`id`='" . $data['id'] . "'");
        exit(json_encode(ReturnData($data, 'Xóa thành công!')));
    }

    function addProduct($data)
    {
        global $db;

        if (empty($data['idCate']) || empty($data['name']) || empty($data['quantity'])  || empty($data['brand']) || empty($data['desc'])) {
            exit(json_encode(ReturnData([], 'Vui lòng nhập đầy đủ thông tin!')));
        }

        if ($data['quantity'] <= 0) {
            exit(json_encode(ReturnData([], 'Số lượng tối thiểu là 1!')));
        }

        if (isset($_FILES['image'])) {
            $fileName = $_FILES['image']['name'];
            $fileTmp = $_FILES['image']['tmp_name'];
            $uploadDir =  __DIR__ . '\uploads\\';
            $uploadFile = $uploadDir . basename($fileName);

            if (!move_uploaded_file($fileTmp, $uploadFile)) {
                exit(json_encode(ReturnData([], 'Không thể upload ảnh!')));
            }
        } else {
            exit(json_encode(ReturnData([], 'Chưa có ảnh được chọn!')));
        }

        $db->insert('products', [
            'category_id' => $data['idCate'],
            'name' => $data['name'],
            'quantity' => $data['quantity'],
            'image' => BASE_URL('/ajaxs/admin/uploads/' . basename($fileName)),
            'brand' => $data['brand'],
            'description' => $data['desc']
        ]);
        exit(json_encode(ReturnData($data, 'Thêm mới thành công!')));
    }

    function updateProduct($data)
    {
        global $db;

        if (empty($data['id']) || empty($data['idCate']) || empty($data['name']) || empty($data['quantity'])  || empty($data['brand']) || empty($data['desc'])) {
            exit(json_encode(ReturnData([], 'Vui lòng nhập đầy đủ thông tin!')));
        }
        if ($data['quantity'] <= 0) {
            exit(json_encode(ReturnData([], 'Số lượng tối thiểu là 1!')));
        }

        $check = $db->num_rows("SELECT * FROM products where `name`='" . $data['name'] . "' and `id` <> '" . $data['id'] . "'");
        if ($check != 0) {
            exit(json_encode(ReturnData([], "Sản phẩm đã tồn tại!"), 400));
        }


        if (isset($_FILES['image'])) {
            $fileName = $_FILES['image']['name'];
            $fileTmp = $_FILES['image']['tmp_name'];
            $uploadDir =  __DIR__ . '\uploads\\';
            $uploadFile = $uploadDir . basename($fileName);

            if (!move_uploaded_file($fileTmp, $uploadFile)) {
                exit(json_encode(ReturnData([], 'Không thể upload ảnh!')));
            }
            $image = true;

            $db->update('products', [
                'image' => BASE_URL('/ajaxs/admin/uploads/' . basename($fileName)),
            ], "`id`='" . $data['id'] . "'");
        }

        $db->update('products', [
            'category_id' => $data['idCate'],
            'name' => $data['name'],
            'quantity' => $data['quantity'],
            'brand' => $data['brand'],
            'description' => $data['desc']
        ], "`id`='" . $data['id'] . "'");
        exit(json_encode(ReturnData($data, 'Cập nhật thành công!')));
    }

    function updateUser($data)
    {
        global $db;
        if (empty($data['id']) || empty($data['user']) || empty($data['role'])) {
            exit(json_encode(ReturnData([], 'Vui lòng điền đầy đủ thông tin!')));
        }

        if (!empty($data['email']) && !CheckData($data['email'], 'email')) {
            exit(json_encode(ReturnData([], 'Sai định dạng email!')));
        }

        if (!empty($data['phone']) && !CheckData($data['phone'], 'phone')) {
            exit(json_encode(ReturnData([], 'Số điện thoại không hợp lệ!')));
        }
        if (!empty($data['password'])) {
            $db->update('users', [
                'email' => $data['email'],
                'phone' => $data['phone'],
                'name' => $data['name'],
                'active' => $data['active'],
                'password' => md5($data['active']),
                'role_id' => $data['role'],
            ], "`id`='" . $data['id'] . "'");
        } else {
            $db->update('users', [
                'email' => $data['email'],
                'phone' => $data['phone'],
                'name' => $data['name'],
                'active' => $data['active'],
                'role_id' => $data['role'],
            ], "`id`='" . $data['id'] . "'");
        }
        exit(json_encode(ReturnData($data, 'Cập nhật thành công!')));
    }
    function addUser($data)
    {
        global $db;

        // Kiểm tra các trường bắt buộc
        if (empty($data['username']) || empty($data['email']) || empty($data['name']) || empty($data['phone']) || empty($data['password']) || empty($data['role'])) {
            exit(json_encode(ReturnData([], 'Vui lòng nhập đầy đủ thông tin!')));
        }

        // Kiểm tra định dạng email
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            exit(json_encode(ReturnData([], 'Email không hợp lệ!')));
        }

        // Kiểm tra nếu số điện thoại có độ dài hợp lệ
        if (strlen($data['phone']) < 10) {
            exit(json_encode(ReturnData([], 'Số điện thoại không hợp lệ!')));
        }

        // Mã hóa mật khẩu bằng MD5
        $hashedPassword = md5($data['password']);

        // Chèn thông tin người dùng vào cơ sở dữ liệu
        $db->insert('users', [
            'username' => $data['username'],
            'email' => $data['email'],
            'name' => $data['name'],
            'phone' => $data['phone'],
            'password' => $hashedPassword,  // Sử dụng mật khẩu đã mã hóa MD5
            'role_id' => $data['role'],
        ]);

        // Trả về kết quả thành công
        exit(json_encode(ReturnData(['status'=>true], 'Thêm người dùng thành công!', 0)));
    }


    switch ($_GET['submit']) {
        case "update":
            update($_POST);
        case "updateCategory":
            updateCategory($_POST);
        case "addCategory":
            addCategory($_POST);
        case "deleteCategory":
            deleteProduct($_POST, 'categories');
        case "deleteProduct":
            deleteProduct($_POST, 'products');
        case "addProduct":
            addProduct($_POST);
        case "updateProduct":
            updateProduct($_POST);
        case "updateUser":
            updateUser($_POST);
        case "deleteUser":
            deleteProduct($_POST, 'users');
        case "addUser":
            addUser($_POST);
    }
}
