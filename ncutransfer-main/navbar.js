/* Written by Nicole Q and 碩甫 */

//分頁名稱高亮顯示
$(document).ready(function(){
    // 檢查當前文件名是否為 index
    if (window.location.pathname.includes("index")) {
        // 如果是 index 文件，則為具有 .nav-link 類的第一個元素添加 active 類
        var link = $(".nav-link").eq(0); // 使用 eq() 方法選擇第一個元素
        link.addClass("active fw-bold"); // 添加 active 類
    }else if(window.location.pathname.includes("find")||window.location.pathname.includes("transD")){
        var link = $(".nav-link").eq(1);
        link.addClass("active fw-bold"); 
    }else if(window.location.pathname.includes("php")||window.location.pathname.includes("post.html")){
        var link = $(".nav-link").eq(3);
        link.addClass("active fw-bold"); 
    }else if(window.location.pathname.includes("link")){
        var link = $(".nav-link").eq(4);
        link.addClass("active fw-bold"); 
    }else if(window.location.pathname.includes("trans")||window.location.pathname.includes("dormitory")){
    var link = $(".nav-link").eq(2);
    link.addClass("active fw-bold"); }
});

//Function to update navbar
function updateNavbar(data) {
    const navbar = $('#load');

    if (data.isLoggedIn) {
        navbar.html(`
        <div class="btn-group">
        <div class="dropdown">
        <button type="button" class="btn btn-primary3 bg-hover-primary3 dropdown-toggle" data-bs-toggle="dropdown">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle me-1" viewBox="0 0 16 16">
          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
          <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
        </svg></i>${data.id}
        </button>
          <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#" onclick="setConfirmPwdId(${data.id})">設定</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item text-danger" href="#" onclick="logout()">登出</a></li>
          </ul>
        </div>
        </div>`);
    } else {
        navbar.html(`
        <button id="triggerLoginPopup" class="btn btn-primary3 bg-hover-primary3" data-bs-toggle="modal" data-bs-target="#loginPopup" aria-controls="loginErrorMsg">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
  <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
</svg> 登入
        </button>`);
    }
}

function logout()
{
  //Remove jwt_token and refresh the page upon clicking 登出
  sessionStorage.removeItem('jwt_token');
  localStorage.removeItem('jwt_token');
  location.reload();
}

function setConfirmPwdId(id)
{
  //Set the id when displaying the password reset form
  $('#confirmPwdPopup').modal('toggle');
  $('#confirmId').val(id);
}

// Function to retrieve token from local storage
function getToken()
{
  //localStorage for stay login, sessionStorage for not stay login (removed upon closing the window)
  return localStorage.getItem('jwt_token') || sessionStorage.getItem('jwt_token');
}

// Check if token is already stored
let token = getToken();
var studentId;

//Fetch data (Code revised from online resources)
fetch('api/isloggedin.php', {
  headers: {
    'Authorization': `Bearer ${token}`
  }
})
.then(response => response.json())
.then(data => {
  // Handle the JSON response data
  if (data.id)
  {
    studentId = data.id;
    // 根據API傳回的結果更新導覽欄
    updateNavbar(data);
    if (studentId != "No Login")
    {
      $('#triggerLoginPopup').html(studentId);
    }
    else
    {
      localStorage.setItem('jwt_token', token);
    }
  }
})
.catch(error => {
  console.error('Error fetching API:', error);
});
        
