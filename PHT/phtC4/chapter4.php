<?php
    $host = '127.0.0.1';
    $dbname = 'cse485_web';
    $username = 'root';
    $password = '';
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

    try{
        // TODO 1: Tạo đối tượng PDO để kết nối CSDL
        // Gợi ý: $pdo = new PDO(...);
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Kết nối thành công!"; // (Bỏ comment để test)
    }catch (PDOException $e){
        die("Connection failed: " . $e->getMessage());
    }
    // === LOGIC THÊM SINH VIÊN (XỬ LÝ FORM POST) ===
    // TODO 2: Kiểm tra xem form đã được gửi đi (method POST) và có 'ten_sinh_vien' không
    // Gợi ý: Dùng isset($_POST['...'])
    if (isset($_POST['ten_sinh_vien'])) {
    // // TODO 3: Lấy dữ liệu 'ten_sinh_vien' và 'email' từ $_POST
    $ten = $_POST['ten_sinh_vien'];
    $email = $_POST['email'];
    // // TODO 4: Viết câu lệnh SQL INSERT với Prepared Statement (dùng dấu ?)
    $sql = "INSERT INTO sinhvien (ten_sinh_vien, email) VALUES (?,?)";

    // // TODO 5: Chuẩn bị (prepare) và thực thi (execute) câu lệnh
    // // Gợi ý: $stmt = $pdo->prepare($sql);
    // // Gợi ý: $stmt->execute([$ten, $email]);
    global $pdo;
    $pts = $pdo->prepare($sql);
    $pts->execute([ $ten ,$email]);
    // // TODO 6: (Tùy chọn) Chuyển hướng về chính trang này để "làm mới"
    // // Gợi ý: Dùng header('Location: chapter4.php');
    header('Location: chapter4.php');
    exit;
}
// === LOGIC LẤY DANH SÁCH SINH VIÊN (SELECT) ===
// TODO 7: Viết câu lệnh SQL SELECT *
$sql_select = "SELECT * FROM sinhvien ORDER BY ngay_tao DESC";
// TODO 8: Thực thi câu lệnh SELECT (không cần prepare vì không có tham số)
// Gợi ý: $stmt_select = $pdo->query($sql_select); 
$pts_select= $pdo->query($sql_select);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>PHT Chương 4 - Website hướng dữ liệu</title>
    <style>
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid #ddd; padding: 8px; }
    th { background-color: #f2f2f2; }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container-fluid">
        <!-- Header -->
        <div class="row bg-primary text-white p-3">
            <h2>Thêm Sinh Viên Mới (Chủ đề 4.3)</h2>
        </div>

        <div class="row" style="height: calc(100vh - 80px)">
            <!-- From Them SInh Vien -->
             <div class="col-3 bg-light p-3 border-end overflow-auto">
                <h5>Them sinh vien </h5>
                <form action="chapter4.php" class="form-inline"  method="POST">
                    <div class="form-group mb-3 ">
                        <label class="form-label">Tên sinh viên:</label>
                        <input class="form-control" type="text" name="ten_sinh_vien" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Email:</label>
                        <input class="form-control" type="email" name="email" required>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary text-center" type="submit">Thêm</button>
                    </div>
                </form>
             </div>
             <div class="col-9 p-3 overflow-auto">
                <h5>Danh Sách Sinh Viên (Chủ đề 4.2)</h5>
                <table class="table table-striped">
                    <tr>
                        <th>ID</th>
                        <th>Tên Sinh Viên</th>
                        <th>Email</th>
                        <th>Ngày Tạo</th>
                    </tr>
                    <?php
                    // TODO 9: Dùng vòng lặp (ví dụ: while) để duyệt qua kết quả
                    // Gợi ý: while ($row = $stmt_select->fetch(PDO::FETCH_ASSOC)) { ... }
                    while($row = $pts_select->fetch(PDO::FETCH_ASSOC))
                    {
                        // TODO 10: In (echo) các dòng <tr> và <td> chứa dữ liệu $row
                        // Gợi ý: echo "<tr>";
                        // Gợi ý: echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        // (htmlspecialchars là để bảo mật, tránh lỗi XSS - sẽ học ở Chương9)
                        echo "<tr>";
                            echo "<td>" . htmlentities($row['id']) . "</td>" ;
                            echo "<td>" . htmlentities($row['ten_sinh_vien']) . "</td>" ;
                            echo "<td>" . htmlentities($row['email']) . "</td>" ;
                            echo "<td>" . htmlentities($row['ngay_tao']) . "</td>" ;
                        echo "</tr>";
                        // Đóng vòng lặp
                    }
                    ?>
                </table>
             </div>
        </div>
    </div>
        
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</html> 