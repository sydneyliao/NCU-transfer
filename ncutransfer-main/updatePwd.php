<?php
//Start a session
session_start();
$_SESSION['redirect_source'] = 'updatePwd.php';
global $error_occurred;
$error_occurred = false;

//Connect to MySQL Database
include "setup.php";
$connect = mysqli_connect($DB_SERVER, $DB_USER, $DB_PASS) or die("MySQL connection failed");
$db = mysqli_select_db($connect, $DB_NAME) or die ("Fail to select a database");

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //Obtain POST data
    $postId = mysqli_real_escape_string($connect, $_POST['resetId']);
    $postPwd = mysqli_real_escape_string($connect, $_POST['newResetPwd']);
    if (isset($_POST['redirectUrl']))
    {
        $_SESSION['redirect_url'] = mysqli_real_escape_string($connect, $_POST['redirectUrl']);
    }

    // Mark token as used (if the user resets his or her password via reset password link)
    if (isset($_SESSION['resetPwdToken']))
    {
        $token = $_SESSION['resetPwdToken'];
        $stmt = mysqli_stmt_init($connect);
        mysqli_stmt_prepare($stmt, "UPDATE reset_pwd_tokens_tb SET used = '1' WHERE token = ?");
        mysqli_stmt_bind_param($stmt, "s", $token);
        if (!mysqli_stmt_execute($stmt))
        {
            $error_occurred = true;
            $_SESSION['error'] = "伺服器發生錯誤<br><br>請稍後重新點擊信件中的連結完成重設密碼";
        }
        else
        {
            sqlUpdatePwd($connect, $postId, $postPwd);
        }
    }
    else //if the user resets his or her password when logged in (no token)
    {
        sqlUpdatePwd($connect, $postId, $postPwd);
    }
}
else
{
    $error_occurred = true;
    $_SESSION['error'] = "連結無效<br>請稍後再試";
}

function sqlUpdatePwd($connect, $postId, $postPwd)
{
    //Update data in id_pwd_tb
    $hashedPwd = password_hash($postPwd, PASSWORD_DEFAULT); //Hash the new password
        
    $stmt = mysqli_stmt_init($connect);
    mysqli_stmt_prepare($stmt, "UPDATE id_pwd_tb SET pwd = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "ss", $hashedPwd, $postId);
    if (!mysqli_stmt_execute($stmt))
    {
        $error_occurred = true;
        $_SESSION['error'] = "伺服器發生錯誤<br><br>請稍後重新點擊信件中的連結完成重設密碼";
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
            }

            //Unset Session Variables
            <?php 
            unset($_SESSION['redirect_source']);
            unset($_SESSION['resetPwdToken']);
            unset($_SESSION['resetId']);
            ?>

            //Redirect to redirect_url
            window.location.href = "<?php echo isset($_SESSION['redirect_url']) ? $_SESSION['redirect_url'] : 'index.html'; ?>";
        </script>
    </head>
</html>