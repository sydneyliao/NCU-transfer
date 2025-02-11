/* JavaScript code used in popup.html */
$(document).ready(function(){
    //Toggle the Forget Password Popup
    $("#forgotPwdLink").click(function(){
        $('#loginPopup').modal('hide');
        $('#forgotPwdSent').hide();
        $('#forgotPwdForm').show();
        $('#forgotPwdPopup').modal('show');
    });
    //Toggle the Register Popup
    $("#registerLink").click(function(){
        $('#loginPopup').modal('hide');
        $('#registerPopup').modal('show');
    });
    //Close the Register Popup and go back to Login Popup
    $("#closeRegisterPopup").click(function(){
        $('#loginPopup').modal('show');
        $('#registerPopup').modal('hide');
    });
    //The eye icon of the first password field in the Register Popup and Reset Password Popup
    $(".togglePassword1").click(function(){
        if($(".togglePassword1").attr("class") == "far fa-lg fa-eye togglePassword1")
        {
            $(".togglePassword1").attr("class", "far fa-lg fa-eye-slash togglePassword1");
            $(".pwd1").attr("type", "text");
        }
        else if ($(".togglePassword1").attr("class") == "far fa-lg fa-eye-slash togglePassword1")
        {
            $(".togglePassword1").attr("class", "far fa-lg fa-eye togglePassword1");
            $(".pwd1").attr("type", "password");
        }
    });
    //The eye icon of the second password field in the Register Popup and Reset Password Popup
    $(".togglePassword2").click(function(){
        if($(".togglePassword2").attr("class") == "far fa-lg fa-eye togglePassword2")
        {
            $(".togglePassword2").attr("class", "far fa-lg fa-eye-slash togglePassword2");
            $(".pwd2").attr("type", "text");
        }
        else if ($(".togglePassword2").attr("class") == "far fa-lg fa-eye-slash togglePassword2")
        {
            $(".togglePassword2").attr("class", "far fa-lg fa-eye togglePassword2");
            $(".pwd2").attr("type", "password");
        }
    });
    //Clear error messages upon closing popup windows
    $('.modal').on('hidden.bs.modal', function () {
        $('.errorMsg').html('');
        $('.popup-text-field').removeClass("border-danger border-2");
        $('.popup-text-field').val("");
    });
    //Reload the window upon finishing reseting password
    $('#finishResetPwdPopup').on('hidden.bs.modal', function () {
        location.reload();
    });
});
//The function to submit redirectUrl1 upon attempting to log in
function submitRedirectUrlUponLogin()
{
    var currentPageUrl = window.location.href; //For Redirecting
    $('#redirectUrl1').val(currentPageUrl);
    return true;
}
//The function to check if the register form is valid before the user submits it
function validateRegisterForm()
{
    var registerId = $("#registerId").val();
    var idPattern = /^1[01][0-9]{7}$/; //The Regular Expression for: 1st digit-1, 2nd digit-0 or 1, 3rd to 9th digits are numbers
    var newPwd = $("#newPwd").val();
    var pwdPattern = /^[a-zA-Z0-9]{6,12}$/; //The Regular Expression for: 6-12 characters (numbers and alphabets only)
    var confirmPwd = $("#confirmPwd").val();
    var formIsValid = false;
    var errorMsg = "";
    var currentPageUrl = window.location.href; //For Redirecting
    if (!idPattern.test(registerId)) //Student ID not fitting the pattern
    {
        errorMsg = "學號的格式錯誤!";
        $("#registerErrorMsg1").html(errorMsg);
        $("#registerId").addClass("border-danger border-2");
        $("#registerErrorMsg2").html("");
        $("#newPwd").removeClass("border-danger border-2");
        $("#registerErrorMsg3").html("");
        $("#confirmPwd").removeClass("border-danger border-2");
    }
    else if (!pwdPattern.test(newPwd)) //Password not fitting the pattern
    {
        errorMsg = "密碼須為6~12字元!";
        $("#registerErrorMsg2").html(errorMsg);
        $("#newPwd").addClass("border-danger border-2");
        $("#registerErrorMsg1").html("");
        $("#registerId").removeClass("border-danger border-2");
        $("#registerErrorMsg3").html("");
        $("#confirmPwd").removeClass("border-danger border-2");
    }
    else if (newPwd != confirmPwd) //Password and Confirm Password are not the same
    {
        errorMsg = "您兩次輸入的密碼不一致!";
        $("#registerErrorMsg3").html(errorMsg);
        $("#newPwd").addClass("border-danger border-2");
        $("#confirmPwd").addClass("border-danger border-2");
        $("#registerErrorMsg1").html("");
        $("#registerErrorMsg2").html("");
        $("#registerId").removeClass("border-danger border-2");  
    }
    else //Submit the form and redirect the user back to this html
    {
        formIsValid = true;
        $('#redirectUrl2').val(currentPageUrl);
    }
    return formIsValid;
}
function validateStudentId()
{
    var forgotId = $("#forgotId").val();
    var idPattern = /^1[01][0-9]{7}$/; //The Regular Expression for: 1st digit-1, 2nd digit-0 or 1, 3rd to 9th digits are numbers
    var formIsValid = false;
    var errorMsg = "";
    var currentPageUrl = window.location.href; //For Redirecting
    if (!idPattern.test(forgotId)) //Student ID not fitting the pattern
    {
        errorMsg = "學號的格式錯誤!";
        $("#forgotPwdErrorMsg").html(errorMsg);
        $("#forgotId").addClass("border-danger border-2");
    }
    else //Submit the form and redirect the user back to this html
    {
        formIsValid = true;
        $('#redirectUrl3').val(currentPageUrl);
    }
    return formIsValid;
}
function submitRedirectUrlUponConfirmPwd()
{
    var currentPageUrl = window.location.href; //For Redirecting
    $('#redirectUrl4').val(currentPageUrl);
    if (localStorage.getItem('stayLogin') == 'false')
    {
        window.onbeforeunload = function(){
            sessionStorage.setItem('justReload', 'true');
            localStorage.setItem('stayLogin', 'true');
        };
    }
    return true;
}
function validateResetPwd()
{
    var newPwd = $("#newResetPwd").val();
    var pwdPattern = /^[a-zA-Z0-9]{6,12}$/; //The Regular Expression for: 6-12 characters (numbers and alphabets only)
    var confirmPwd = $("#confirmResetPwd").val();
    var formIsValid = false;
    var errorMsg = "";
    var currentPageUrl = window.location.href; //For Redirecting

    if (!pwdPattern.test(newPwd)) //Password not fitting the pattern
    {
        errorMsg = "密碼須為6~12字元!";
        $("#resetPwdErrorMsg1").html(errorMsg);
        $("#newResetPwd").addClass("border-danger border-2");
        $("#resetPwdErrorMsg2").html("");
        $("#confirmResetPwd").removeClass("border-danger border-2");
    }
    else if (newPwd != confirmPwd) //Password and Confirm Password are not the same
    {
        errorMsg = "您兩次輸入的密碼不一致!";
        $("#resetPwdErrorMsg2").html(errorMsg);
        $("#confirmResetPwd").addClass("border-danger border-2");
        $("#resetPwdErrorMsg1").html("");
        $("#newResetPwd").removeClass("border-danger border-2");
    }
    else //Submit the form and redirect the user back to this html
    {
        formIsValid = true;
        var resetPwd = $('#idToResetPwd').html();
        $('#resetId').val(resetPwd);
        $('#redirectUrl5').val(currentPageUrl);
    }
    return formIsValid;
}