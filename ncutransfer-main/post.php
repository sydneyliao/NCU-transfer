<!--create database and insert fontend data to database-->
<?php
$servername = "localhost";
$username = "root";
$password = "5253";
$conn = mysqli_connect($servername, $username, $password);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

/*$sql = "CREATE DATABASE post";
if (mysqli_query($conn, $sql)) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . mysqli_error($conn);
}*/
$dbname = "post";
$conn1 = new mysqli($servername, $username, $password, "post");

// 檢查連接
/*if ($conn1->connect_error) {
    die("Connection to db1 failed: " . $conn1->connect_error);
}

// 創建連接到資料庫 db2 的連接
//$conn2 = new mysqli($servername, $username, $password, "accounts_db");

// 檢查連接
if ($conn2->connect_error) {
    die("Connection to db2 failed: " . $conn2->connect_error);
}*/
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to create table
$sql = "CREATE TABLE IF NOT EXISTS article (
    cardId INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    board TEXT NOT NULL,
    title TEXT NOT NULL,
    paragraph TEXT NOT NULL,
    upload_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
/*$sql="ALTER TABLE article
ADD COLUMN authorId VARCHAR(9) NOT NULL DEFAULT 0" ;
$sql="ALTER TABLE article
ADD COLUMN likes INT NOT NULL DEFAULT 0" ;

if ($conn->query($sql) === TRUE) {
    echo "Column 'likes' added successfully or already exists.<br>";
} else {
    echo "Error adding column: " . $conn->error . "<br>";
}*/



$errorMessage = "";
//插入板、標題與文章至資料庫
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected_board = $_POST["selected_board"];
    $title = $_POST["title"];
    $paragraph = $_POST["paragraph"];
    $AuthorId = $_POST["AuthorId"];
    $likes = 0;

    // Insert data into the database using prepared statements
    if (!empty($selected_board) && !empty($title) && !empty($paragraph)) {
        $stmt = $conn->prepare(
            "INSERT INTO article (board, title, paragraph,likes,AuthorId) VALUES (?, ?, ?,?,?)"
        );

        if ($stmt) {
            $stmt->bind_param(
                "sssii",
                $selected_board,
                $title,
                $paragraph,
                $likes,
                $AuthorId
            );

            if ($stmt->execute()) {
                header("Location: homePageDcard.php"); // Redirect on success
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        $errorMessage = "欄位不可為空"; // Echo error message
    }

    if (!empty($errorMessage)) {
        header("Location: post.html?error=" . urlencode($errorMessage));
        exit();
    }
}

$sql = "CREATE TABLE IF NOT EXISTS likeNum (
    card_id INT UNSIGNED AUTO_INCREMENT,
    like_count INT DEFAULT 0,
    PRIMARY KEY (card_id)
)";

// 執行創建表的查詢
if ($conn->query($sql) === true) {
    echo "Table likeNum created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();


?>
