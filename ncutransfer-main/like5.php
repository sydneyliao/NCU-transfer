<?php
$servername = "localhost";
$username = "root";
$password = "5253";
$dbname = "post";

// 建立連接
$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查連接
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 創建 employee 資料表的 SQL 語句
$sql_employee = "CREATE TABLE IF NOT EXISTS like_clicked (
    id CHAR(1) PRIMARY KEY,
    clicked INT
)";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST["id"]);

    // 連接資料庫
    $conn = new mysqli("localhost", "root", "5253", "post");

    // 檢查連接
    if ($conn->connect_error) {
        die("連接失敗: " . $conn->connect_error);
    }

    // 更新點擊次數
    $stmt = $conn->prepare("UPDATE like_clicked SET clicked = clicked + 1 WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // 獲取更新後的點擊次數
        $stmt = $conn->prepare("SELECT clicked FROM like_clicked WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($clicked);
        $stmt->fetch();
        echo $clicked;
    } else {
        echo "Error: " . $stmt->error;
    }

    

    $stmt->close();
    $conn->close();
}
?>
