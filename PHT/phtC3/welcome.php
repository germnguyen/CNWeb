<?php
// Khởi động session (BẮT BUỘC ở mọi trang cần dùng SESSION)
session_start();

// Kiểm tra xem SESSION (lưu tên đăng nhập) có tồn tại không?
if (isset($_SESSION['username'])) {

    // Nếu tồn tại, lấy username từ SESSION ra (và escape để tránh XSS)
    $loggedInUser = htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');

    // In ra lời chào mừng
    echo "<h1>Chào mừng trở lại, $loggedInUser!</h1>";
    echo "<p>Bạn đã đăng nhập thành công.</p>";

    // (Tạm thời) Tạo 1 link để "Đăng xuất" (chỉ là quay về login.html)
    echo '<a href="login.html">Đăng xuất (Tạm thời)</a>';
} else {

    // Nếu không tồn tại SESSION (chưa đăng nhập) -> Chuyển hướng người dùng về trang login.html
    header('Location: login.html');
    exit;
}
?>