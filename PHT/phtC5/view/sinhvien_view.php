<?php
// Tệp View CHỈ chứa HTML và logic hiển thị (echo, foreach)
// Tệp View KHÔNG chứa câu lệnh SQL
?>
<!DOCTYPE html>
<html lang="vi">
<head>
 <meta charset="UTF-8">
 <title>PHT Chương 5 - MVC</title>
 <style>
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid #ddd; padding: 8px; }
    th { background-color: #f2f2f2; }
 </style>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">

    <h2 class="text-primary mb-4">Thêm Sinh Viên Mới</h2>

    <!-- FORM THÊM SINH VIÊN -->
    <form action="index.php" method="POST" class="row g-3 p-3 bg-white shadow rounded">

        <div class="col-md-4">
            <label class="form-label">Tên sinh viên</label>
            <input type="text" name="ten_sinh_vien" class="form-control" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-success w-100">Thêm mới</button>
        </div>

    </form>

    <h2 class="text-primary mt-5">Danh Sách Sinh Viên</h2>

    <table class="table table-bordered table-striped mt-3 bg-white shadow-sm">
        <thead class="table-secondary">
            <tr>
                <th>ID</th>
                <th>Tên Sinh Viên</th>
                <th>Email</th>
                <th>Ngày Tạo</th>
            </tr>
        </thead>

        <tbody>
            <!-- // TODO 4: Dùng vòng lặp foreach để duyệt qua biến $danh_sach_sv
            // (Biến $danh_sach_sv này sẽ được Controller truyền sang)
            // Gợi ý: foreach ($danh_sach_sv as $sv) { ... } -->
        <?php foreach ($danh_sach_sv as $sv): ?>
            <tr>
                <td><?= htmlspecialchars($sv["id"]) ?></td>
                <td><?= htmlspecialchars($sv["ten_sinh_vien"]) ?></td>
                <td><?= htmlspecialchars($sv["email"]) ?></td>
                <td><?= htmlspecialchars($sv["ngay_tao"]) ?></td>
            </tr>
            <!-- // TODO 5: In (echo) các dòng <tr> và <td> chứa dữ liệu $sv
            // Gợi ý: echo "<tr><td>" . htmlspecialchars($sv['id']) .
           
            // Đóng vòng lặp -->
        <?php endforeach; ?>
        </tbody>
    </table>

</div>
</body>
</html> 
