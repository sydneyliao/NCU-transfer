<?php
//Start a session
session_start();
$_SESSION['redirect_source'] = 'resetPwd.php';
$error_occurred = false;

//Connect to MySQL Database
include "setup.php";
$connect = mysqli_connect($DB_SERVER, $DB_USER, $DB_PASS) or die("MySQL connection failed");
$db = mysqli_select_db($connect, $DB_NAME) or die ("Fail to select a database");

//Verify token
if(isset($_GET['token']))
{
    $token = mysqli_real_escape_string($connect, $_GET['token']);
    $_SESSION['resetPwdToken'] = $token;

    //Execute MySQL Query
    $stmt = mysqli_stmt_init($connect);
    mysqli_stmt_prepare($stmt, "SELECT user_id FROM reset_pwd_tokens_tb WHERE token = ? AND used = '0'");
    mysqli_stmt_bind_param($stmt, "s", $token);
    if (mysqli_stmt_execute($stmt))
    {
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $user_id);
        if (mysqli_stmt_num_rows($stmt) == 1)
	    {
            mysqli_stmt_fetch($stmt);
            $_SESSION['resetId'] = $user_id;
        }
        else
        {
            $error_occurred = true;
            $_SESSION['error'] = "此連結已失效<br><br>請點擊登入->忘記密碼再試一次";
        }
    }
    else
    {
        $error_occurred = true;
        $_SESSION['error'] = "發生錯誤<br><br>請稍後重新點擊信件中的連結完成重設密碼";
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
                // Store data to be passed to redirect_url
                var errorMessage = "<?php echo isset($_SESSION['error']) ? addslashes($_SESSION['error']) : ''; ?>";
                sessionStorage.setItem('errorMessage', errorMessage);
            }
            else
            {
                var resetId = "<?php echo isset($_SESSION['resetId']) ? addslashes($_SESSION['resetId']) : ''; ?>";
                sessionStorage.setItem('resetId', resetId);
                <?php unset($_SESSION['resetId']); ?>
            }
            <?php
            unset($_SESSION['redirect_source']);
            ?>

            //Redirect to redirect_url
            window.location.href = "<?php echo 'index.html'; ?>";
        </script>
    </head>
</html>