<?php
//Start a session
session_start();
$_SESSION['redirect_source'] = 'finishRegister.php';
$error_occurred = false;

//Connect to MySQL Database
include "setup.php";
$connect = mysqli_connect($DB_SERVER, $DB_USER, $DB_PASS) or die("MySQL connection failed");
$db = mysqli_select_db($connect, $DB_NAME) or die ("Fail to select a database");

//Verify token
if(isset($_GET['token']))
{
    $token = mysqli_real_escape_string($connect, $_GET['token']);
    
    //Execute MySQL Query
    $stmt = mysqli_stmt_init($connect);
    mysqli_stmt_prepare($stmt, "SELECT count(*) FROM verification_tokens_tb WHERE token = ? AND used = '0'");
    mysqli_stmt_bind_param($stmt, "s", $token);

    if (mysqli_stmt_execute($stmt))
    {
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        if ($count == 1)
        {
            // Mark token as used
            $stmt = mysqli_stmt_init($connect);
            mysqli_stmt_prepare($stmt, "UPDATE verification_tokens_tb SET used = '1' WHERE token = ?");
            mysqli_stmt_bind_param($stmt, "s", $token);
            if (!mysqli_stmt_execute($stmt))
            {
                $error_occurred = true;
                $_SESSION['error'] = "發生錯誤<br><br>請稍後重新點擊信件中的連結完成註冊";
            }
            
            //Insert data into account_tb
            if ((isset($_SESSION['registerId']) && (isset($_SESSION['registerId']))))
            {
                $id = $_SESSION['registerId'];
                $pwd = $_SESSION['pwd']; //Note that this is the hashed password
                $stmt = mysqli_stmt_init($connect);
                mysqli_stmt_prepare($stmt, "INSERT INTO id_pwd_tb (id, pwd) VALUES (?, ?)");
                mysqli_stmt_bind_param($stmt, "ss", $id, $pwd);
                if (!mysqli_stmt_execute($stmt))
                {
                    $error_occurred = true;
                    $_SESSION['error'] = "發生錯誤<br><br>請稍後重新點擊信件中的連結完成註冊";
                }
            }
        }
        else
        {
            $error_occurred = true;
            $_SESSION['error'] = "此學號已經註冊完成<br><br>請點選右上角的登入按鈕登入";
        }
    }
    else
    {
        $error_occurred = true;
        $_SESSION['error'] = "發生錯誤<br><br>請稍後重新點擊信件中的連結完成註冊";
    }   
}
else
{
    $error_occurred = true;
    $_SESSION['error'] = "連結無效<br>請稍後再試";
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
            }
            <?php
            unset($_SESSION['registerId']);
            unset($_SESSION['pwd']);
            ?>

            //Redirect to redirect_url
            window.location.href = "<?php echo 'index.html'; ?>";
        </script>
    </head>
</html>