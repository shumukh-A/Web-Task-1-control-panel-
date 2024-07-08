<?php
// تفاصيل الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "task1";

// إنشاء اتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// التحقق من الطلب وحفظ البيانات في قاعدة البيانات
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $direction = $_POST["direction"];

    // إنشاء بيان تحضيري
    $stmt = $conn->prepare("INSERT INTO data (Direction) VALUES (?)");
    $stmt->bind_param("s", $direction);

    // تنفيذ البيان التحضيري
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // إغلاق البيان التحضيري
    $stmt->close();
}

// إغلاق الاتصال
$conn->close();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Direction Buttons</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
            margin: 0;
        }
        .container {
            display: grid;
            grid-template-columns: auto auto auto;
            grid-template-rows: auto auto auto;
            gap: 10px;
        }
        .button {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100px;
            height: 40px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 20px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #e0e0e0;
        }
        .button.stop {
            background-color: #ff4d4d;
            color: #fff;
        }
        .button.stop:hover {
            background-color: #e60000;
        }
        .empty {
            visibility: hidden;
        }
        form {
            display: contents;
        }
    </style>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="container">
            <div class="empty"></div>
            <input type="submit" name="direction" value="Up" class="button">
            <div class="empty"></div>
            <input type="submit" name="direction" value="Left" class="button">
            <input type="submit" name="direction" value="Stop" class="button stop">
            <input type="submit" name="direction" value="Right" class="button">
            <div class="empty"></div>
            <input type="submit" name="direction" value="Down" class="button">
            <div class="empty"></div>
        </div>
    </form>
</body>
</html>
