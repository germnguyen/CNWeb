<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Chương 2 - PHP Căn Bản</title>
</head>
<body>
    <h1>Kết quả PHP Căn Bản</h1>
    <?php
        // TODO 1: Khai báo 3 biến 
        $hoTen = "Nguyễn Minh Đức";
        $diemTB = "8";
        $coDiHocChuyenCan = true;

        // TODO 2: In ra thông tin sinh viên
        echo "<h2>" . "Họ tên: " . $hoTen. "</h2>" . "<br>";
        echo "Điểm: " . $diemTB . "<br>";

        // TODO 3: Viết cấu trúc IF/ELSE IF/ELSE (2.2) 
        echo "Xếp loại: ";

        if ($diemTB >= 8.5 && $coDiHocChuyenCan == true )
            echo "giỏi";
        else if ($diemTB >= 6.5 && $coDiHocChuyenCan == true)
            echo "Khá";
        else if ($diemTB >= 5.0 &&$coDiHocChuyenCan == true )
            echo "Trung bình";
        else 
            echo "Yếu";

        echo "<br>";

        // TODO 4: Viết 1 hàm đơn giản (2.3) 
        function chaoMung():void {
            echo "Chúc mừng bạn đã hoàn thành PHT Chương 2!";
        }

        // TODO 5: Gọi hàm bạn vừa tạo 

        chaoMung();

        echo "<br>";
        $student = [
            "Ho ten" => "Nguyen Minh Duc",
            "Diem" => 8,
            "coDiHocChuyenCan" => true
        ];

        foreach($student as $key => $value){
            if ($key == "coDiHocChuyenCan")
                break;
            echo $key . ": " . $value . "<br>";
        };
    ?>
</body>
</html>