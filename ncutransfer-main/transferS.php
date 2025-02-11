<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>轉學板</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  import bootstrap icons
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="checkRedirect.js"></script>
  <style>
    .info-container {
      margin-top: 20px;
      width: 80%;
    }

    body {
      background-color: white;
    }

    .text-container {
      max-width: 100%;/* 設置容器最大寬度*/
      overflow: hidden;
      font-size: 15px;
      line-height: 1.5;
    }

    .text-content {
      white-space: pre-line; /*保留換行符*/
      overflow: hidden;
      max-height: 6em;
      transition: max-height 1.5s;
    }

    .collapsed {
      max-height: none;
    }
  </style>

</head>

<body>
  <!--navbar start-->
  <div id="nav"></div>
   <script>
   $(document).ready(function(){
     $("#nav").load("navbar.html", function(){
         // Code executed after content is loaded
         checkRedirect(); // Refer to checkRedirect.js
     });
     $('#triggerLoginPopup').click(function(){
         $('#loginPopup').modal('toggle');
         $('#loginErrorMsg').html(' ');
     });});
   </script>
<!--the end of navbar-->
  <div class="container">
          <div class="d-flex bd-highlight mb-2 text-left">
            <div class="me-auto p-2 bd-highlight"><h3><b>轉學板</b></h3></div>
            <a href="post.html" class="btn border border-2 border-black shadow"style="margin-top: auto; background-color: #eab238">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
</svg><span
            ><b>撰寫文章</b></span>
            </a>
          </div>
      <!--新的文章-->  
        <?php include('fetch_paginationS.php'); ?>
    <script>
    // 切換折疊狀態的通用函數
    function toggleCollapse(contentId, buttonId) {
      var textContent = document.getElementById(contentId);
      var showMoreBtn = document.getElementById(buttonId);

      if (textContent.classList.contains('collapsed')) {
        textContent.classList.remove('collapsed');
        showMoreBtn.textContent = '顯示更多...';
      } else {
        textContent.classList.add('collapsed');
        showMoreBtn.textContent = '顯示較少';
      }
    }

   
    //get latest article
    function fetchLatestArticle() {
      $.ajax({
        url: "fetch_paginationS.php",
        type: "GET",
        dataType: "html",
        success: function (response) {
          $("#latestArticle").append(response); // Update the latestArticle div with the fetched content  
        },
        error: function (xhr, status, error) {
          console.error("Error fetching latest article:", error);
        }
      });
    }
    $(document).ready(function () {
      fetchLatestArticle();
    });

    function like2(cardId) {                //其他的card的按讚
    $.ajax({
        url: 'like.php',
        type: 'POST',
        data: { cardId: cardId },
        success: function(response) {
            if (response.success) {
                var likeCountElem = document.getElementById('likeCount_' + cardId);
                likeCountElem.innerText = response.likes;
            } else {
                console.error('Error updating likes:', response.message);
            }
        },
        error: function() {
            console.error('Error in AJAX request');
        }
    });
}
  </script>


</body>

</html>
