<?php
    
    $listHoa = [
        [
            "ten" => "do quyen",
            "mota" => "hoa do quyen",
            "image" => "images/doquyen.jpg"
        ],
        [
            "ten" => "hai duong", 
            "mota" => "hoa hai duong",
            "image" => "images/haiduong.jpg"
        ],
        [
            "ten" => "mai",
            "mota" => "hoa mai",
            "image" => "images/mai.jpg"
        ],
        [
            "ten" => "tuong vy",
            "mota"=> "hoa tuong vy",
            "image" => "images/tuongvy.jpg"
        ]
    ];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bai Tap 1</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-3">Danh sách những loài hoa đẹp</h2>
        <h3 class="text-info">Người dùng</h3>
        <ol class="list-group list-group-numbered mb-4">
            <?php foreach($listHoa as $hoa): ?>
                <li class="list-group-item">
                    <span class="fw-bold"> <?= htmlspecialchars($hoa["ten"]) ?> </span><br>
                    <p><?= htmlspecialchars($hoa["mota"]) ?></p>
                    <img src="<?= htmlspecialchars($hoa["image"]) ?>" class="img-thumbnail" style="max-width:150px; height:auto;">
                </li>
            <?php endforeach; ?>
        </ol>
        <h3 class="text-danger">Admin</h3>
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Tên loài hoa</th>
                    <th>Mô tả</th>
                    <th>Hình ảnh</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listHoa as $flower): ?>
                    <tr>
                        <td><?= htmlspecialchars($flower['ten']) ?></td>
                        <td><?= htmlspecialchars($flower["mota"]) ?></td>
                        <td><img src="<?= htmlspecialchars($flower["image"]) ?>" class="img-fluid rounded" style="max-width:100px; height:auto;"></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>