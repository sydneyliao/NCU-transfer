<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>論壇首頁</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!--import bootstrap icons-->
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

    .pink-area {
      background-color: #f4adaf !important;
    }

    .card-footer {
      background-color: #f4adaf !important;
    }

    .pink-btn {
      margin-top: 5px;
      margin-bottom: 5px;
    }

    h2 {
      text-align: center;
      font-weight: bold;
    }

    body {
      background-color: white;
    }

    .text-container {
      max-width: 100%;
      /* 设置容器的最大宽度 */
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
    <div class="container mt-3">
      <div class="d-flex bd-highlight mb-2 text-left">
        <div class="me-auto p-1">
          <h3><b>論壇首頁</b></h3>
        </div>
        <a href="post.html" class="btn border border-2 border-black shadow"
          style="margin-top: auto; background-color: #eab238">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
</svg><span
            ><b>撰寫文章</b></span>
        </a>
      </div>
      <!--大家都在聊-->
      
        <div class="card border border-black border-3 pink-area">
          <div class="card-body text-center ">
            <h2><b>大家都在聊</b><i class="bi bi-chat-left-dots-fill ms-2"
                style="color:#2ac8b6;width: 30px;height: 30px;"></i>
            </h2>
            <!--熱門話題-->
            <div class="card-group ">
              <div class="card border border-0 pink-area">
                <img src="Sydney'sImage/one.png" class="card-img-top mx-auto d-block" style="width: 40px; height: 40px;"
                  alt="...">
                <div class="card-body btn" onclick="scrollToElement('#targetTitle1')">
                  <h5 class="card-title text-center">轉系分享</h5>
                </div>
                <p class="card-text">111303509</p>
                <div class=" card card-footer border border-0 pink-area">
                  <small class="text-body-secondary">2024-03-22</small>
                </div>
              </div>
              <div class="card border border-0 pink-area">
                <img src="Sydney'sImage/two (2).png" class="card-img-top mx-auto d-block"
                  style="width: 40px; height: 40px;" alt="...">
                <div class="card-body btn" onclick="scrollToElement('#targetTitle2')">
                  <h5 class="card-title">拿推薦信不用怕</h5>
                </div>
                <p class="card-text">111408512</p>
                <div class="card card-footer border border-0 pink-area">
                  <small class="text-body-secondary">2024-03-29</small>
                </div>
              </div>
              <div class="card border border-0 pink-area">
                <img src="Sydney'sImage/three.png" class="card-img-top mx-auto d-block"
                  style="width: 40px; height: 40px;" alt="...">
                <div class="card-body btn" onclick="scrollToElement('#targetTitle3')">
                  <h5 class="card-title">學校附近的食物
                  </h5>
                </div>
                <p class="card-text">112402531</p>
                <div class=" card card-footer border border-0">
                  <small class="text-body-secondary">2023-12-06</small>
                </div>
              </div>
              <div class="card border border-0 pink-area">
                <img src="Sydney'sImage/four.png" class="card-img-top mx-auto d-block"
                  style="width: 40px; height: 40px;" alt="...">
                <div class="card-body btn" onclick="scrollToElement('#targetTitle4')">
                  <h5 class="card-title">大眾運輸</h5>
                </div>
                <p class="card-text">112306202</p>
                <div class="card card-footer border border-0">
                  <small class="text-body-secondary">2024-05-15</small>
                </div>
              </div>
              <div class="card border border-0 pink-area">
                <img src="Sydney'sImage/five.png" style="width: 40px;height: 40px;" class="card-img-top mx-auto d-block"
                  alt="...">
                <div class="card-body btn " onclick="scrollToElement('#targetTitle5')">
                  <h5 class="card-title">轉學準備</h5>
                </div>
                <p class="card-text">111206205</p>
                <div class="card card-footer border border-0">
                  <small class="text-body-secondary">2024-04-27</small>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    </div>
    <br>
    <div class="container">
      <!--綜合貼文標題-->
      <div class="row justify-content-center">
        <div class="card border border-0" style="background-color: rgb(255, 255, 255);">
          <div class="card-title text-left">
            <h3><b>所有文章</b></h3>
          </div>
        </div>
      </div>
      <!--新的文章-->

      <!--文章框框 待處理:按讚重新整理也可以顯示數字而非0-->
      
        <div class="card  w-100 mb-3 border border-3 border-black" style="background-color:rgb(255, 238, 242);">
          <div class="card-body " id="targetTitle1">
          <div class ="container">
            <div class="d-flex">
              <div class="flex-shrink-0 ">
                <h1><i class="bi bi-person-circle" style="color: orange;"></i></h1>
              </div>
              <div class="flex-grow-1 ms-3">
                111303509<p style="font-size: smaller;">2024-03-22 12:22:53</p>
              </div>
            </div>
            <h5 class="card-title"><b>轉系分享</b></h5>
            <div class="text-container" id="textContainer1">
              <div class="text-content " id="textContent1">
                <P><?php include "paragraph1.php"; ?>
                </P>
              </div>
            </div>
            <button style="border: 0cm; color:gray;background-color:rgb(255, 238, 242);" id="showMoreBtn1"
              onclick="toggleCollapse('textContent1', 'showMoreBtn1')">顯示更多...</button>
          </div>
          <div class="d-grid gap-2 d-md-block"> 
            <button class="btn btn-white flex-roll align-items-center mb-3 ms-3" type="button" style="font-size:20px;" id="like1" onclick="like(1)">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
  <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
</svg>
            <span><b id="count_1"></b></span>
            </button>
          </div>
        </div>
    </div>
      
      <!--第二個預設的card-->
      
        <div class="card w-100 mb-3 border border-3 border-black" style="background-color:rgb(255, 238, 242);">
          <div class="card-body " id="targetTitle2" style="background-color:rgb(255, 238, 242);">
          <div class ="container">
          <div class="d-flex">
              <div class="flex-shrink-0 ">
                <h1><i class="bi bi-person-circle" style="color: orange;"></i> </h1>
              </div>

              <div class="flex-grow-1 ms-3">
                111408512<p style="font-size: smaller;">2024-03-29 12:06:19</p>
              </div>
            </div>
            <h5 class="card-title"><b>拿推薦信不用怕</b><br></h5>
            <div class="text-container" id="textContainer2">
              <div class="text-content " id="textContent2">
                <p><?php include  "paragraph2.php";?></p>
              </div>
            </div>
            <button style="border: 0cm; color:gray; background-color:rgb(255, 238, 242);" id="showMoreBtn2"
              onclick="toggleCollapse('textContent2', 'showMoreBtn2')">顯示更多...</button>
          </div>
          <div class="d-grid gap-2 d-md-block">
            <button class="btn btn-white flex-roll align-items-center mb-3 ms-3" type="button" style="font-size:20px;" id="like2" onclick="like(2)">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
  <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
</svg>
            <span><b id="count_2"></b></span>
        </button>
          </div>
        </div>
    </div>
      

      <!--第三個預設的card-->
      
        <div class="card w-100 mb-3 border border-3 border-black" style="background-color:rgb(255, 238, 242);">
          <div class="card-body " id="targetTitle3">
          <div class ="container">
            <div class="d-flex">
              <div class="flex-shrink-0 ">
                <h1><i class="bi bi-person-circle" style="color: orange;"></i> </h1>
              </div>

              <div class="flex-grow-1 ms-3">
              112402531<p style="font-size: smaller;">2024-12-06 15:29:03</p>
              </div>
            </div>
            <h5 class="card-title"><b>學校附近的食物</b><br></h5>
            <div class="text-container" id="textContainer3">
              <div class="text-content " id="textContent3">
                <P><?php include "paragraph3.php";?>
                </P>
              </div>
            </div>
            <button style="border: 0cm; color:gray;background-color:rgb(255, 238, 242);" id="showMoreBtn3"
              onclick="toggleCollapse('textContent3', 'showMoreBtn3')">顯示更多...</button>
          </div>
          <div class="d-grid gap-2 d-md-block">
          <button class="btn btn-white flex-roll align-items-center mb-3 ms-3" type="button" style="font-size:20px;" id="like3" onclick="like(3)">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
  <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
</svg>
            <span ><b id="count_3"></b></span>
            </button>
          </div>
        </div>
    </div>
      
      <!--第四個預設的card-->
      
        <div class="card w-100 mb-3 border border-3 border-black" style="background-color:rgb(255, 238, 242);">
          <div class="card-body " id="targetTitle4">
          <div class ="container">
            <div class="d-flex">
              <div class="flex-shrink-0 ">
                <h1><i class="bi bi-person-circle" style="color: orange;"></i> </h1>
              </div>

              <div class="flex-grow-1 ms-3">
                112306202<p style="font-size: smaller;">2024-05-15 12:25:20</p>
              </div>
            </div>
            <h5 class="card-title"><b>大眾運輸</b><br></h5>
            <div class="text-container" id="textContainer4">
              <div class="text-content " id="textContent4">
                <P><?php include "paragraph4.php";?>
                </P>
              </div>
            </div>
            <button style="border: 0cm; color:gray;background-color:rgb(255, 238, 242);" id="showMoreBtn4"
              onclick="toggleCollapse('textContent4', 'showMoreBtn4')">顯示更多...</button>
          </div>
          <div class="d-grid gap-2 d-md-block">
          <button class="btn btn-white flex-roll align-items-center mb-3 ms-3" type="button" style="font-size:20px;" id="like4" onclick="like(4)">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
  <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
</svg>
            <span ><b id="count_4"></b></span>
            </button>
          </div>
        </div>
    </div>
     
      <!--第五個預設的card-->
      
        <div class="card w-100 mb-3 border border-3 border-black" style="background-color:rgb(255, 238, 242);">
          <div class="card-body " id="targetTitle5">
          <div class ="container">
            <div class="d-flex">
              <div class="flex-shrink-0 ">
                <h1><i class="bi bi-person-circle" style="color: orange;"></i> </h1>
              </div>

              <div class="flex-grow-1 ms-3">
                111206205<p style="font-size: smaller;">2024-04-27 12:22:15</p>
              </div>
            </div>
            <h5 class="card-title"><b>轉學準備</b><br></h5>
            <div class="text-container" id="textContainer5">
              <div class="text-content " id="textContent5">
                <P><?php include "paragraph5.php";?>
                </P>
              </div>
            </div>
            <button style="border: 0cm; color:gray;background-color:rgb(255, 238, 242);" id="showMoreBtn5"
              onclick="toggleCollapse('textContent5', 'showMoreBtn5')">顯示更多...</button>
          </div>
          <div class="d-grid gap-2 d-md-block">
          <button class="btn btn-white flex-roll align-items-center mb-3 ms-3" type="button" style="font-size:20px;" id="like5" onclick="like(5)">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
  <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
</svg>
            <span><b id="count_5"></b></span>
            </button>
            </div>
          </div>
        </div>
    <?php include "fetch_pagination.php"; ?>
    
    
    <script>
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
    //定位
    function scrollToElement(selector) {
      var targetElement = document.querySelector(selector);
      if (targetElement) {
        targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    }
    //get latest article
    function fetchLatestArticle() {
      $.ajax({
        url: "fetch_pagination.php",
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
//like_clicked_count from chat gpt
    function like(id) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "like5.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById("count_" + id).innerHTML = xhr.responseText;
                }
            };
            xhr.send("id=" + id);
        }


   function like2(cardId) {          //其他的card的按讚
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
