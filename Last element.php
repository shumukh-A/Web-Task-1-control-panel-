<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "task1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// استرجاع آخر عنصر تم إدخاله
$sql = "SELECT * FROM data ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<br>ID: " . $row["id"];
    echo "<br>القيمة: " . $row["Direction"];
} else {
    echo "لا توجد بيانات في قاعدة البيانات.";
}

$conn->close();
?>
