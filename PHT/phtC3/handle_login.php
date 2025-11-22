<?php
session_start();

// Nếu form được gửi (có trường username)
if (isset($_POST['username'])) {
    // Lấy dữ liệu từ POST
    $user = isset($_POST['username']) ? trim($_POST['username']) : '';
    $pass = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Kiểm tra đăng nhập (giả lập)
    if ($user === 'admin' && $pass === '123') {
        // Lưu username vào session
        $_SESSION['username'] = $user;

        // Chuyển hướng sang trang chào mừng
        header('Location: welcome.php');
        exit;
    } else {
        // Đăng nhập thất bại -> quay lại login kèm thông báo lỗi
        header('Location: login.html?error=1');
        exit;
    }
} else {
    // Truy cập trực tiếp -> trả về trang login
    header('Location: login.html');
    exit;
}