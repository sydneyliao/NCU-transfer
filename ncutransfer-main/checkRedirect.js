/* This Javascript determines post-redirect actions */
/* Reference: Bootstrap modals and jQuery */
function checkRedirect()
{
    const redirectSource = sessionStorage.getItem('redirectSource');
    
    if (redirectSource == "login.php")
    {
        const errorMsg = sessionStorage.getItem('errorMessage');
        const loggedInId = sessionStorage.getItem('loggedInId');
        if (errorMsg)
        {
            $('#loginPopup').modal('toggle');
            $("#loginErrorMsg").html(errorMsg);
            sessionStorage.removeItem('errorMessage');
        }
        else if (loggedInId)
        {
            $('#loginSuccessPopup').modal('toggle');
            $('#showLoggedInId').html(loggedInId);
            sessionStorage.removeItem('loggedInId');
        }
    }
    else if (redirectSource == "register.php")
    {
        const errorMsg = sessionStorage.getItem('errorMessage');
        const registeredId = sessionStorage.getItem('registeredId');
        if (errorMsg)
        {
            $('#registerPopup').modal('toggle');
            $("#registerErrorMsg3").html(errorMsg);
            sessionStorage.removeItem('errorMessage');
        }
        else
        {
            $('#registerEmailPopup').modal('show');
            $('#studentEmail1').html(registeredId + '@cc.ncu.edu.tw');
            sessionStorage.removeItem('registeredId');
        }
    }
    else if (redirectSource == "finishRegister.php")
    {
        const errorMsg = sessionStorage.getItem('errorMessage');
        $('#finishRegisterPopup').modal('show');
        if (errorMsg)
        {
            $("#finishRegisterPopupLabel").html("發生錯誤");
            $("#finishRegisterMsg").html(errorMsg);
            sessionStorage.removeItem('errorMessage');
        }
    }
    else if (redirectSource == "forgotPwd.php")
    {
        const errorMsg = sessionStorage.getItem('errorMessage');
        const forgotId = sessionStorage.getItem('forgotId');
        if (errorMsg)
        {
            $('#forgotPwdPopup').modal('toggle');
            $('#forgotPwdSent').hide();
            $('#forgotPwdForm').show();
            $("#forgotPwdErrorMsg").html(errorMsg);
            sessionStorage.removeItem('errorMessage');
        }
        else if (forgotId)
        {
            $('#forgotPwdForm').hide();
            $('#forgotPwdSent').show();
            $('#forgotPwdPopupMsg2').hide();
            $('#forgotPwdPopupMsg1').show();
            $('#studentEmail2').html(forgotId + '@cc.ncu.edu.tw');
            $('#forgotPwdPopup').modal('toggle');
            sessionStorage.removeItem('forgotId');
        }
    }
    else if (redirectSource == "resetPwd.php")
    {
        const errorMsg = sessionStorage.getItem('errorMessage');
        const resetId = sessionStorage.getItem('resetId');
        if (errorMsg)
        {
            $('#forgotPwdPopup').modal('show');
            $('#forgotPwdForm').hide();
            $('#forgotPwdSent').show();
            $('#forgotPwdPopupMsg2').html(errorMsg);
            $('#forgotPwdPopupMsg1').hide();
            $('#forgotPwdPopupMsg2').show();
            sessionStorage.removeItem('errorMessage');
        }
        else if (resetId)
        {
            $('#resetPwdPopup').modal('toggle');
            $('#idToResetPwd').html(resetId);
            sessionStorage.removeItem('resetId');
        }
    }
    else if (redirectSource == "confirmPwd.php")
    {
        const errorMsg = sessionStorage.getItem('errorMessage');
        const confirmId = sessionStorage.getItem('confirmId');
        if (errorMsg)
        {
            $('#confirmPwdPopup').modal('show');
            $('#confirmPwdErrorMsg').html(errorMsg);
            sessionStorage.removeItem('errorMessage');
        }
        else if (confirmId)
        {
            $('#resetPwdPopup').modal('toggle');
            $('#idToResetPwd').html(confirmId);
            sessionStorage.removeItem('confirmId');
        }
    }
    else if (redirectSource == "updatePwd.php")
    {
        const errorMsg = sessionStorage.getItem('errorMessage');
        $('#finishResetPwdPopup').modal('show');
        if (errorMsg)
        {
            $("#finishResetPwdPopupLabel").html("發生錯誤");
            $("#finishResetPwdMsg").html(errorMsg);
            sessionStorage.removeItem('errorMessage');
        }
        else
        {
            //Logout the user
            sessionStorage.removeItem('jwt_token');
            localStorage.removeItem('jwt_token');
        }
    }
    sessionStorage.removeItem("redirectSource");
}