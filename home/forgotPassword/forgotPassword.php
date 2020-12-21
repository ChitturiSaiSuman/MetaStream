<?php
    session_start();
    if(isset($_SESSION["email"])) {
        header("Location: http://localhost/Meta-Stream/home/index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">
    <link rel="mask-icon" href="safari-pinned-tab.svg" color="#de2222">
    <meta name="msapplication-TileColor" content="#603cba">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Forgot Password</title>
</head>
<body>
<div class="showcase-top">
        <a href="../index.php"><img src="Logo.png" alt="Meta Stream"></a>
    </div>
    <div class="login-box">
        <h1>Account Recovery</h1>
        <form action="verify.php" method="POST" onsubmit="return validate();">
            <!-- <p>Full Name</p>
            <input id="fname" type="text" name="fname" placeholder="Fullname" required> -->
            <div id="invalid1">Enter your Account's Email address to Recover your Password</div>
            <p>Email</p>
            <input id="email" type="text" name="email" placeholder="Enter Email" required>
            <div id="invalid2"></div>
            <p>New Password</p>
            <input id="password" type="password" name="password" placeholder="Enter New Password" required>
            <div id="invalid3"></div>
            <p>Confirm New Password</p>
            <input id="cpassword" type="password" name="cpassword" placeholder="Confirm New Password" required>
            <div id="invalid4"></div>
            <input type="submit" name="submit" value="Recover Account">
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            function alignModal(){
            var modalDialog = $(this).find(".modal-dialog");
            modalDialog.css("margin-top", Math.max(0, ($(window).height() - modalDialog.height()) / 2));
            }
            $(".modal").on("shown.bs.modal", alignModal);
            $(window).on("resize", function(){
            $(".modal:visible").each(alignModal);
             });   
        });
        function setVariable() {
            localStorage["previewLogin"] = "true";
        }
        function hasLowerCase(str) {
            return (/[a-z]/.test(str));
        }
        function hasUpperCase(str) {
            return (/[A-Z]/.test(str));
        }
        function validate_password(password) {
            if(password.length<8) {
                document.getElementById("password").style.marginBottom = "0px";
                document.getElementById("invalid3").innerText = "Password must have at least 8 Characters";
                return false;
            }
            if(!hasLowerCase(password) || !hasUpperCase(password)) {
                document.getElementById("password").style.marginBottom = "0px";
                document.getElementById("invalid3").innerText = "Weak Password!";
                return false;
            }
            else {
                pattern = /[0-9]/g;
                if(!password.match(pattern)) {
                    document.getElementById("password").style.marginBottom = "0px";
                    document.getElementById("invalid3").innerText = "Weak Password!";
                    return false;
                }
                else {
                    var format = /[ `!@#$%^&*()@_+\-=\[\]{};':"\\|,.<>\/?~]/;
                    if(!format.test(password)) {
                        document.getElementById("password").style.marginBottom = "0px";
                        document.getElementById("invalid3").innerText = "Weak Password!";
                        return false;
                    }
                }
            }
            if(document.getElementById("invalid3").innerText != "") {
                document.getElementById("invalid3").innerText = "";
            }
            return true;
        }
        function alreadyExists(email) {
            var rvalue = function() {
                var tmp = null;
                $.ajax({
                    'async': false,
                    'type': 'POST',
                    'global': false,
                    'dataType': 'html',
                    'url': 'checkExists.php',
                    'data': {'data': [email]},
                    'success': function(data) {
                        tmp = data == "true";
                    }
                });
                return tmp;
            }();
            return rvalue;
        }
        function validate() {
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            var cpassword = document.getElementById("cpassword").value;
            var valid = true;
            if(!alreadyExists(email)) {
                document.getElementById("email").style.marginBottom = "0px"
                document.getElementById("invalid2").innerText = "Account with this Email doesn't exist!";
                valid = false;
            }
            else if(document.getElementById("invalid2").innerText != "") {
                document.getElementById("invalid2").innerText = "";
            }
            valid = valid && (validate_password(password));
            if(password!=cpassword) {
                document.getElementById("cpassword").style.marginBottom = "0px";
                document.getElementById("invalid4").style.paddingBottom = "25px";
                document.getElementById("invalid4").innerText = "Passwords didn't match. Try again!";
            }
            valid = valid && (password==cpassword);
            if(password==cpassword) {
                if(document.getElementById("invalid4").innerText!="") {
                    document.getElementById("invalid4").innerText="";
                }
            }
            return valid;
        }
    </script>
</body>
</html>