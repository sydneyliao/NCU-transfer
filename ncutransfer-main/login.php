<?php

//Start a session and initialize $error_occurred
session_start();
$_SESSION['redirect_source'] = 'login.php';
$error_occurred = false;

//Connect to MySQL
include "setup.php";
$connect = mysqli_connect($DB_SERVER, $DB_USER, $DB_PASS) or die("MySQL connection failed");
$db = mysqli_select_db($connect, $DB_NAME) or die ("Fail to select a database");

//Store POST credentials and validate them
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $postId = mysqli_real_escape_string($connect, $_POST['loginId']);
    $postPwd = mysqli_real_escape_string($connect, $_POST['loginPwd']);
    if (isset($_POST['redirectUrl']))
    {
        $_SESSION['redirect_url'] = mysqli_real_escape_string($connect, $_POST['redirectUrl']);
    }
    if (isset($_POST['stayLogin']) && $_POST['stayLogin'] == 'on')
    {
        $_SESSION['stay_login'] = 'true';
    }
    else
    {
        $_SESSION['stay_login'] = 'false';
    }
    $loggedInId = validateCredentials($connect, "id_pwd_tb", $postId, $postPwd);
    if ($loggedInId != 'invalid')
    {
        require_once('api/jwt_init.php');
        generateJWTToken(true, $loggedInId);
    }
    else
    {
        $error_occurred = true;
        $_SESSION['error'] = "您的學號或密碼輸入錯誤，請重新輸入。";
    }
}

//Self-defined functions
function validateCredentials($connect, $table, $id, $pwd)
{
    $stmt = mysqli_stmt_init($connect);
    $invalid = 'invalid';
    mysqli_stmt_prepare($stmt, "SELECT pwd FROM $table WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    // If a matching user is found
    if (mysqli_stmt_num_rows($stmt) == 1)
	{
        // Bind the result variables
        mysqli_stmt_bind_result($stmt, $hashedPwd);
        mysqli_stmt_fetch($stmt);
        $_SESSION['fetchedPwd'] = $hashedPwd;
        
        // Verify the provided password against the hashed password in the database
        if (password_verify($pwd, $_SESSION['fetchedPwd']))
		{
            $_SESSION['loggedInId'] = $id;
            return $id; // Return the user ID if the credentials are valid
        }
        else
        {
            return $invalid; // Return false if credentials are invalid
        }
    }
    else
    {
        return $invalid; // Return false if credentials are invalid
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
                var jwtToken = "<?php echo isset($_SESSION['jwt']) ? addslashes($_SESSION['jwt']) : ''; ?>";
                sessionStorage.setItem('loggedInId', '<?php echo isset($_SESSION['loggedInId']) ? $_SESSION['loggedInId'] : ''; ?>');
                var stayLogin = '<?php echo isset($_SESSION['stay_login']) ? $_SESSION['stay_login'] : '' ?>';
                if (stayLogin == 'true')
                {
                    localStorage.setItem('jwt_token', jwtToken);
                    sessionStorage.removeItem('jwt_token');
                }
                else if (stayLogin == 'false')
                {
                    sessionStorage.setItem('jwt_token', jwtToken);
                    localStorage.removeItem('jwt_token');
                }
            }
            
            //Unset session variables
            <?php 
            unset($_SESSION['redirect_source']);
            unset($_SESSION['fetchedPwd']);
            unset($_SESSION['stay_login']);
            ?>

            //Redirect to redirect_url
            window.location.href = "<?php echo isset($_SESSION['redirect_url']) ? $_SESSION['redirect_url'] : 'index.html'; ?>";
        </script>
    </head>
</html>