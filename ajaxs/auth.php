<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_GET) && !empty($_GET['submit'])) {
    $data = json_decode(file_get_contents("php://input"), true);
    if (is_array($data)) {
        $_POST = xss_array($data);
    }

    function Login($data)
    {
        global $db, $session;
        $account = ($data['account']) ?? null;
        $password = ($data['password']) ?? null;
        if ((empty($account) && empty($email)) || empty($password)) {
            exit(json_encode(returnData(null, "Chưa Nhập Tài khoản hoặc mật khẩu thử lại sau!")));
        }
        $dataUser = $db->fetch_assoc("SELECT `id`, `active` FROM users WHERE `username` = '$account' AND `password` = '" . md5($password) . "'", 1);
        if (empty($dataUser)) {
            exit(json_encode(returnData(null, "Tài Khoản hoặc Mật Khẩu không chính xác!")));
        }

        if ($dataUser['active'] != "active") {
            exit(json_encode(returnData(null, "Tài Khoản đã bị khóa!")));
        }

        $session->send('account', $dataUser['id']);
        exit(json_encode(returnData($dataUser, "Đăng Nhập thành công!")));
    }

    switch ($_GET['submit']) {
        case "login":
            Login($_POST);
    }
}