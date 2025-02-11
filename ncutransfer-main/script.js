function make_course_info(jsonData){
    // 創建<tr>元素
    var tr = document.createElement("tr");
    var courseTypeBadge = jsonData.courseType === "ELECTIVE" ? '<span class="badge rounded-pill p-2 bg-secondary fs-6">選</span>' : '<span class="badge rounded-pill p-2 bg-brown1 fs-6">必</span>';

    tr.innerHTML = `
        <td>${courseTypeBadge}</td>
        <td><a target="_blank" href="https://cis.ncu.edu.tw/Course/main/support/courseDetail.html?crs=${jsonData.serialNo}">${jsonData.title}</a></td>
        <td>${jsonData.teachers[0]}</td>
        <td>
            <span class="fs-4">${jsonData.credit}</span>
            <small>學分</small>
        </td>
        <td>
            ${jsonData.classTimes.map(time => `<span class="badge rounded-pill bg-primary3 font-monospace m-1 text-dark">${time}</span>`).join('')}
        </td>
        <td>
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#contentModal" ${jsonData.passwordCard === "NONE" ? 'disabled' : ''} onclick="get_mail_content(this, '${jsonData.teachers[0]}', '${jsonData.title}')">${jsonData.passwordCard === "NONE" ? '<i class="bi bi-ban d-md-none"></i><span class="d-none d-md-inline">不使用</span>' : '<i class="bi bi-pencil-fill"></i><span class="d-none d-md-inline">生成</span>'}</button>
        </td>
    `;
    // 將<tr>元素添加到表格中
    document.getElementById("courseTable").appendChild(tr);
}

function sendSelectedDepartment() {
    // 取得系所
    var selectedDepartment = document.getElementById('departmentSelect').value;
    // 建立要傳送給 API 的資料對象
    var data = {
        department: selectedDepartment
    };
    document.getElementById("courseTable").innerHTML = `
    <tr>
        <td colspan="6">
            <div class="spinner-border text-brown2" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </td>
    </tr>`;
    // 使用 Fetch API 發送 POST 請求給 API (此段參考AI生成程式碼)
    fetch('api/getCourse.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById("courseTable").innerHTML = '';
        data.forEach(course => {
            make_course_info(course);
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });
}





function setButtonLoading(button) {
    button.classList.add('disabled');
    // 變更按鈕原本的內容
    button.innerHTML = '<span class="spinner-grow spinner-grow-sm" role="status"></span><span class="d-none d-md-inline">寫作中...</span>';
}

function resetButton(button) {
    button.innerHTML = '<i class="bi bi-pencil-fill"></i><span class="d-none d-md-inline">生成</span>';
    button.classList.remove('disabled');
}

function get_mail_content(button, prof_name, course) {
    var contentArea = document.getElementById("ai-content");
    // 取得系所名稱
    var selectedDepartment = document.getElementById('departmentSelect').value;
    var selectedGrade = document.getElementById('gradeSelect').value;
    var btn = document.getElementById("copyBtn").classList.add("disabled");
    // 將按鈕添加 Bootstrap 的 disabled class
    setButtonLoading(button);
    //建立AI生成文字中的動畫效果
    contentArea.innerHTML = `    
        <p class="card-text placeholder-wave">
        <span class="placeholder col-12 bg-brown2"></span>
        <span class="placeholder col-7 bg-brown2"></span>
        <span class="placeholder col-4 bg-brown2"></span>
        <span class="placeholder col-3 bg-brown2"></span>
        <span class="placeholder col-8 bg-brown2"></span>
        <span class="placeholder col-10 bg-brown2"></span>
        <span class="placeholder col-5 bg-brown2"></span>
        </p>`;

    // 建立要發送給AI的內容
    var data = {
        "department": selectedDepartment,
        "grade": selectedGrade,
        "prof_name": prof_name,
        "course": course
    };

    // 使用 Fetch API 發送 POST 請求
    fetch('api/gemini.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(data => {
            var text = data.candidates[0].content.parts[0].text;
            var btn = document.getElementById("copyBtn").classList.remove("disabled");
            //text放置到modal box
            contentArea.innerHTML = `<p id="content">${text.replace(/\n/g, '<br>')}</P>`;
            resetButton(button)
            
        })
        .catch(error => {
            console.error('Error:', error);
        });
}


//處理複製到剪貼板
function copy(elementId) {
const content = document.getElementById(elementId).innerText;

navigator.clipboard.writeText(content)
    .then(() => {
    alert("內容已複製到剪貼簿！");
    })
    .catch((error) => {
    alert("複製到剪貼簿失敗，請手動複製");
    });
}
  


