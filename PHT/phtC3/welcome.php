<?php
// Khởi động session (BẮT BUỘC ở mọi trang cần dùng SESSION)
session_start();

// Kiểm tra xem SESSION (lưu tên đăng nhập) có tồn tại không?
if (isset($_SESSION['username'])) {

    // Nếu tồn tại, lấy username từ SESSION ra (và escape để tránh XSS)
    $loggedInUser = htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chào mừng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <h1 class="card-title mb-3">Chào mừng trở lại, <?php echo $loggedInUser; ?>!</h1>
                        <p class="mb-4">Bạn đã đăng nhập thành công.</p>
                        <a href="login.html" class="btn btn-danger">Đăng xuất (Tạm thời)</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
} else {

    // Nếu không tồn tại SESSION (chưa đăng nhập) -> Chuyển hướng người dùng về trang login.html
    header('Location: login.html');
    exit;
}
?>