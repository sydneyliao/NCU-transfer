<?php
function get_mail($department, $grade, $prof_name, $course){

$API_KEY = 'AIzaSyCbEml5W5ippVg0V-5LIz9iPJRPR76IgNg';

// AI 需要的資料
$data = json_encode(array(
    "contents" => array(
        array(
            "parts" => array(
                array("text" => "以信件的格式向教授請求一張選課密碼卡"),
                array("text" => "科系: 經濟系"),
                array("text" => "年級: 一年級"),
                array("text" => "教授姓名: 王大衛"),
                array("text" => "課程名稱: 服務學習"),
                array("text" => "output: 尊敬的王大衛教授：\n\n您好！我是OOO，就讀於經濟系一年級。在這學期，我計畫參加您的服務學習課程，需要使用到服務學習密碼卡，因此，我想請您提供一張服務學習密碼卡給我使用。\n\n我相信您已經知道服務學習對於學生的重要性，透過參與服務學習活動，我們可以培養社會關懷的精神，並實際了解社區的需求與問題，同時提升自我價值與技能。因此，我很樂意參加相關課程或活動，並貢獻我的力量。\n\n如果您能提供一張服務學習密碼卡，我將不勝感激。\n\n感謝您撥冗閱讀我的信件，期待您的回覆。如果您有任何疑問或需要進一步了解，請隨時與我聯繫。\n\n敬祝安康，\nOOO敬上"),
                array("text" => "科系: 財金系"),
                array("text" => "年級: 大二"),
                array("text" => "教授姓名: 王曉南"),
                array("text" => "課程名稱: 計量財金"),
                array("text" => "output: 尊敬的王曉南教授：\n\n我是OOO，就讀於財金系二年級。目前想要選修您的計量財金課程，需要向您索取一張選課密碼卡。\n\n我瞭解到計量財金對於財金領域的重要性，希望透過您的課程，提升自己在量化分析和統計建模方面的能力。我相信這門課程將有助於我未來在投行或資產管理公司的工作。\n\n如果您能提供一張選課密碼卡，我將非常感謝。\n\n謝謝您撥冗閱讀我的信件，期待您的回覆。若您有任何疑問或需要進一步了解，請隨時與我聯繫。\n\n此致，\nOOO敬上"),
                array("text" => "科系: 數學系"),
                array("text" => "年級: 二年級"),
                array("text" => "教授姓名: 陳依免"),
                array("text" => "課程名稱: 線性代數"),
                array("text" => "output: 尊敬的陳依免教授：\n\n您好！\n\n我是OOO，就讀於數學系二年級，目前想選修您的線性代數課程。由於該課程限制人數，需要選課密碼卡才能選課，因此，希望您能提供一張密碼卡給我使用。\n\n我相當感興趣線性代數在數學和各種應用領域的重要性，尤其是在資料科學和機器學習領域。我相信透過這門課程，我將能奠定堅實的數學基礎，並加強我在線性代數方面的能力。\n\n若您能提供一張選課密碼卡，我將不勝感激。\n\n感謝您撥冗閱讀我的信件，並期待您的回覆。如果您有任何疑問或需要進一步了解，請隨時與我聯繫。\n\n敬祝安好，\n\nOOO敬上"),
                array("text" => "科系: $department"),
                array("text" => "年級: $grade"),
                array("text" => "教授姓名: $prof_name"),
                array("text" => "課程名稱: $course"),
                array("text" => "output: ")
            )
        )
    ),
    "generationConfig" => array(
        "temperature" => 0.9,
        "topK" => 1,
        "topP" => 1,
        "maxOutputTokens" => 2048,
        "stopSequences" => []
    ),
    "safetySettings" => array(
        array("category" => "HARM_CATEGORY_HARASSMENT", "threshold" => "BLOCK_MEDIUM_AND_ABOVE"),
        array("category" => "HARM_CATEGORY_HATE_SPEECH", "threshold" => "BLOCK_MEDIUM_AND_ABOVE"),
        array("category" => "HARM_CATEGORY_SEXUALLY_EXPLICIT", "threshold" => "BLOCK_MEDIUM_AND_ABOVE"),
        array("category" => "HARM_CATEGORY_DANGEROUS_CONTENT", "threshold" => "BLOCK_MEDIUM_AND_ABOVE")
    )
));

// 以下由AI生成程式碼  執行cURL請求
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.0-pro-001:generateContent?key=' . $API_KEY);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
$response = curl_exec($ch);
curl_close($ch);

return $response;
}

//以下程式碼是參考AI生成的
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 獲取請求的原始内容（JSON）
    $json_data = file_get_contents('php://input');

    // 解析 JSON 資料為 PHP 陣列
    $data = json_decode($json_data, true);

    // 檢查是否接收到了名為 department 的參數
    $res = get_mail($data['department'], $data['grade'], $data['prof_name'],$data['course']);
    echo $res;
}


?>
