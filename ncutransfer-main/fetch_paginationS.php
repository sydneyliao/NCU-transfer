<?php
$servername = "localhost";
$username = "root";
$password = "5253";
$dbname = "post";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 5; // 每頁文章數
$offset = ($page - 1) * $limit; // 偏移量

// 获取总记录数
$sql = "SELECT COUNT(*) AS total FROM article WHERE board = '轉學板'";
$result = $conn->query($sql);
$total = $result->fetch_assoc()['total'];
$total_pages = ceil($total / $limit); // 總頁數

// 獲取數據
$sql = "SELECT * FROM article where board='轉學板'ORDER BY upload_date DESC LIMIT $limit OFFSET $offset";

$articles = $conn->query($sql);

$conn->close();
?>
</head>

    <div class="container">
        <?php while ($row = $articles->fetch_assoc()): ?>
        <div class="row justify-content-center">
            <div class="card w-100 mb-3 border border-3 border-black" style="background-color:rgb(255, 238, 242);">
                <div class="card-body" id="targetTitle<?php echo $row["cardId"]; ?>">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <h1><i class="bi bi-person-circle" style="color: orange;"></i></h1>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <span>USERNAME</span>
                            <p style="font-size: smaller;"><?php echo $row["upload_date"]; ?></p>
                        </div>
                    </div>
                    <h5 class="card-title"><b><?php echo $row["title"]; ?></b></h5>
                    <div class="text-container" id="textContainer<?php echo $row["cardId"]; ?>">
                        <div class="text-content" id="textContent<?php echo $row["cardId"]; ?>">
                            <p><?php echo nl2br($row["paragraph"]); ?></p>
                        </div>
                    </div>
                    <button style="border: 0; color:gray; background-color:rgb(255, 238, 242);" id="showMoreBtn<?php echo $row["cardId"]; ?>"
                        onclick="toggleCollapse('textContent<?php echo $row["cardId"]; ?>', 'showMoreBtn<?php echo $row["cardId"]; ?>')">顯示更多...</button>
                </div>
                <div class="d-grid gap-2 d-md-block">
                <button class="btn btn-white flex-roll align-items-center mb-3 ms-3" type="button" style="font-size:20px;" id="<?php echo $row["cardId"]; ?>" onclick="like2(<?php echo $row["cardId"]; ?>)">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
  <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
</svg>
            <span><b id="likeCount<?php echo $row["cardId"]; ?>"><?php echo $row["likes"]; ?></b></span>
            </button>
                </div>
            </div>
        </div>
        <?php endwhile; ?>

        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center pagination-sm">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <?php if ($page < $total_pages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    

