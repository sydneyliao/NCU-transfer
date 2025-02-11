<?php
session_start();
$_SESSION['redirect_source'] = 'register.php';
$error_occurred = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //Connect to MySQL
    include "setup.php";
    $connect = mysqli_connect($DB_SERVER, $DB_USER, $DB_PASS) or die("MySQL connection failed");
    $db = mysqli_select_db($connect, $DB_NAME) or die ("Fail to select a database");

    //Store data with sanitized user inputs (to prevent SQL Injection)
    $id = mysqli_real_escape_string($connect, $_POST['registerId']);
    $new_pwd = mysqli_real_escape_string($connect, $_POST['newPwd']);
    if (isset($_POST['redirectUrl']))
    {
        $_SESSION['redirect_url'] = mysqli_real_escape_string($connect, $_POST['redirectUrl']);
    }

    //Execute MySQL Query
    $stmt = mysqli_stmt_init($connect);
    mysqli_stmt_prepare($stmt, "SELECT count(*) FROM id_pwd_tb WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "s", $id);
    if (mysqli_stmt_execute($stmt))
    {
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);

        //Check if $id is the same as any id in id_pwd_tb
        if ($count == 1)
        {
            $error_occurred = true;
            $_SESSION['error'] = "此學號已經被註冊過了，請重新輸入。";
        }
        else //Valid Registration Data -> Send email to the user
        {
            //Reference: https://meetanshi.com/blog/send-mail-from-localhost-xampp-using-gmail/
            //Necessary changes have to be made in php.ini and sendmail.ini first.
            
            $to_email = $id.'@cc.ncu.edu.tw';
            $subject = "Email Verification for Registration";
            $token = bin2hex(random_bytes(32)); // Generate a unique token for verification
            $verification_link = "http://localhost:8080/project/finishRegister.php?token=$token";
            $body = "您好， \n\n請點擊以下的連結完成註冊。\n\n$verification_link\n\n\n中大轉系轉學知訊網 管理員";
            
            $headers = "From: 中大轉系轉學知訊網帳號管理員 <$HOST_EMAIL>\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
            
            if (mail($to_email, $subject, $body, $headers))
            {
                //Store $id and $new_pwd for finishRegister.php
                $_SESSION['registerId'] = $id;
                $_SESSION['pwd'] = password_hash($new_pwd, PASSWORD_DEFAULT); //Hash the password before putting it into a session

                //Add the new token to verification_tokens_tb
                $stmt = mysqli_stmt_init($connect);
                mysqli_stmt_prepare($stmt, "INSERT INTO verification_tokens_tb (token, user_id, used) VALUES (?, ?, '0')");
                mysqli_stmt_bind_param($stmt, "ss", $token, $id);
                if (!mysqli_stmt_execute($stmt))
                {
                    $error_occurred = true;
                    $_SESSION['error'] = "伺服器發生錯誤。<br>請稍後再開啟一次完成註冊的連結。";
                }
            }
            else
            {
                $error_occurred = true;
                $_SESSION['error'] = "寄出認證信件失敗<br>請稍後再試";
            }
        }
    }
    else
    {
        $error_occurred = true;
        $_SESSION['error'] = "伺服器發生錯誤。<br>請稍後再試。";
    }
}
?>
<!DOCTYPE HTML>
<!-- Redirect the user back to where he or she was -->
<html>
    <head>
        <script>
            //Output the error message
            var errorOccurred = <?php echo $error_occurred ? 'true' : 'false'; ?>;
            sessionStorage.setItem('redirectSource', '<?php echo isset($_SESSION['redirect_source']) ? $_SESSION['redirect_source'] : '' ?>');
            if (errorOccurred)
            {
                var errorMessage = "<?php echo isset($_SESSION['error']) ? addslashes($_SESSION['error']) : ''; ?>";
                // Store errorMessage to be passed to redirect_url
                sessionStorage.setItem('errorMessage', errorMessage);
                <?php unset($_SESSION['error']); ?>
            }
            else
            {
                sessionStorage.setItem('registeredId', '<?php echo isset($_SESSION['registerId']) ? $_SESSION['registerId'] : '' ?>');
            }
            <?php unset($_SESSION['redirect_source']);?>

            //Redirect to redirect_url
            window.location.href = "<?php echo isset($_SESSION['redirect_url']) ? $_SESSION['redirect_url'] : 'index.html'; ?>";
        </script>
    </head>
</html>