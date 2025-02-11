<?php
//find courses by department id
function find_courses($courses, $department_id) {
    $result = [];
    foreach ($courses as $course) {
        if (in_array($department_id, $course["departmentIds"])) {
            $result[] = $course;
        }
    }
    return $result;
}
//find department id by department name
function find_department_id($departments, $department_name) {
    foreach ($departments as $department) {
        if ($department['departmentName'] == $department_name) {
            return $department['departmentId'];
        }
    }
    return null;
}

// 以下程式碼部分是由AI生成
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 獲取請求的原始內容（JSON 資料）
    $json_data = file_get_contents('php://input');

    // 解析 JSON 資料為 PHP 陣列
    $data = json_decode($json_data, true);

    // 檢查是否收到名為 department 的參數
    if (isset($data['department'])) {
        // 獲取參數值
        $department = $data['department'];

        // 檢查是否已經有快取資料
        $cache_file = sys_get_temp_dir() . '/cached_data.json'; //使用暫存目錄
        $cached_data = [];

        if (file_exists($cache_file)) {
            $cached_data = json_decode(file_get_contents($cache_file), true);
        }

        // 檢查快取資料是否有效
        $cache_valid = isset($cached_data['timestamp']) && time() - $cached_data['timestamp'] < 3600; // 1小時有效期

        if (!$cache_valid) {
            // 如果快取無效，重新獲取外部資源並更新快取資料
            //以下獲取中央大學課程的API是由https://github.com/zetaraku/NCU-Course-Finder-v6 提供
            $jsonData = file_get_contents('https://ncucf-data.s3.amazonaws.com/data/dynamic/all.json');
            $Course_data = json_decode($jsonData, true);

            $cached_data['courses'] = $Course_data['courses'];
            $cached_data['departments'] = $Course_data['departments'];
            $cached_data['timestamp'] = time();

            file_put_contents($cache_file, json_encode($cached_data));
        }

        
        $dept_id = find_department_id($cached_data['departments'], $department);

        // 返回篩選後的課程資料
        header('Content-Type: application/json; charset=utf-8');
        $response = find_courses($cached_data['courses'], $dept_id);
        
        if ($response == []) {
            http_response_code(204); 
            echo json_encode(["error message" => "department name not found!"]);
        } else {
            echo json_encode($response);
        }
        
        

    }
}
