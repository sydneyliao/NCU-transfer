<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {// 獲取前端數據
    
    $cardId = $_POST['cardId'];

    // 資料庫連線
    $servername = "localhost";
    $username = "root";
    $password = "5253";
    $dbname = "post";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("連接失敗: " . $conn->connect_error);
    }

    // 更新数据库中对应文章的点赞数量
    $sql_update = "UPDATE article SET likes = likes + 1 WHERE cardId = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("i", $cardId);
    $stmt_update->execute();
        // 獲取更新後的點贊數量
        $sql_select = "SELECT likes FROM article WHERE cardId = ?";
        $stmt_select = $conn->prepare($sql_select);
        $stmt_select->bind_param("i", $cardId);
        $stmt_select->execute();
        $result = $stmt_select->get_result();
        $row = $result->fetch_assoc();
        $likes = $row['likes'];
        echo $likes;

    $stmt_update->close();
    $stmt_select->close();
    $conn->close();
}

?>

