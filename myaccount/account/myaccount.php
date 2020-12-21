<?php
    session_start();
    if(!isset($_SESSION["email"])) {
        header("Location: ../home/index.php");
    }
    $username = $_SESSION["username"];
    $userid = $_SESSION["userid"];
    $email = $_SESSION["email"];
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="myaccountstyle.css">
    <title>My Account</title>
</head>
<body>
    <div id="showcaseTop" class="showcase-top">
        <a href="http://localhost/Meta-Stream/home/index.php"><img src="Logo.png" alt="Meta Stream"></a>
        <button id="userlogout" onclick="signOut()" alt="Sign Out">Sign Out</button>
        <a id="myaccount" href="http://localhost/Meta-Stream/myaccount/dashboard.php"><img id="avatar" src="avatar.png" alt=""></a>
    </div>
    <h2 id="message">Welcome, <?php echo $_SESSION['username'];?></h2>
    <h4 id="sentence">Manage Your Credentials with these Simple Steps</h4>
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        Change Username
                    </button>
                </h2>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    <form action="changeUsername.php" method="POST" onsubmit="return validateUsername();">
                        <label>New Username</label>
                        <input id="username" type="text" name="username" placeholder="Enter Username" required>
                        <div class="error" id="invalidUsername"></div>
                        <button type="submit" class="btn btn-primary">Change Username</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Change Email Address
                    </button>
                </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    <span id="span">Current Email Address: <?php echo $_SESSION["email"];?></span>
                    <form action="verifyEmail.php" method="POST" onsubmit="return validateEmail();">
                        <label>Email</label>
                        <input id="email" type="text" name="email" placeholder="Enter Email" required>
                        <div class="error" id="invalid"></div>
                        <button type="submit" class="btn btn-primary">Change Email Address</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingThree">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Change Password
                    </button>
                </h2>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
                    <form action="changePassword.php" method="POST" onsubmit="return validatePassword();">
                        <label>Current Password</label>
                        <input id="oldpassword" type="password" name="opassword" placeholder="Enter Current Password" required>
                        <div class="error" id="invalid1"></div>
                        <label>New Password</label>
                        <input id="npassword" type="password" name="npassword" placeholder="Enter New Password" required>
                        <div class="error" id="invalid2"></div>
                        <label>Confirm New Password</label>
                        <input id="cpassword" type="password" name="cpassword" placeholder="Confirm New Password" required>
                        <div class="error" id="invalid3"></div>
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingFour">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Delete Account
                    </button>
                </h2>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                <div class="card-body">
                    <form action="deleteAccount.php" method="POST">
                        <label id="deleteAccount">Are you sure you want to Delete Account?</label> <br>
                        <input id="yes" type="radio" name="yesOrNo">Yes</input>
                        <input id="no" type="radio" name="yesOrNo" checked>No</input>
                        <button id="deleteButton" type="submit" class="btn btn-primary">Delete Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#deleteButton').hide();
            $('input[type="radio"]').click(function() {
                if($(this).attr('id') == 'yes') {
                    $('#deleteButton').show();
                }
                else {
                    $('#deleteButton').hide();
                }
            });
        });
        function signOut() {
            window.location.href='http://localhost/Meta-Stream/home/logout.php';
            localStorage["pagescroll"] = "disabled";
        }
        function isCorrectPassword(password) {
            var rvalue = function() {
                var tmp = null;
                $.ajax({
                    'async': false,
                    'type': 'POST',
                    'global': false,
                    'dataType': 'html',
                    'url': 'isCorrectPassword.php',
                    'data': {'data': [password]},
                    'success': function(data) {
                        tmp = data == "true";
                    }
                });
                return tmp;
            }();
            return rvalue;
        }
        function hasLowerCase(str) {
            return (/[a-z]/.test(str));
        }
        function hasUpperCase(str) {
            return (/[A-Z]/.test(str));
        }
        function validatePassword() {
            var oldPassword = document.getElementById("oldpassword").value;
            var password = document.getElementById("npassword").value;
            var cpassword = document.getElementById("cpassword").value;
            if(!isCorrectPassword(oldPassword)) {
                document.getElementById("oldpassword").style.marginBottom = "0px";
                document.getElementById("invalid1").innerText = "Invalid Current Password!";
                document.getElementById("invalid2").innerText = "";
                document.getElementById("invalid3").innerText = "";
                return false;
            }
            else if(document.getElementById("invalid1").innerText != "") {
                document.getElementById("invalid1").innerText = "";
            }
            if(oldPassword == password) {
                document.getElementById("npassword").style.marginBottom = "0px";
                document.getElementById("invalid2").innerText = "New Password cannot be same as Old Password!";
                document.getElementById("invalid1").innerText = "";
                document.getElementById("invalid3").innerText = "";
                return false;
            }
            else if(document.getElementById("invalid2").innerText != "") {
                document.getElementById("invalid2").innerText = "";
            }

            if(password!=cpassword) {
                document.getElementById("cpassword").style.marginBottom = "0px";
                document.getElementById("invalid1").innerText = "";
                document.getElementById("invalid2").innerText = "";
                document.getElementById("invalid3").innerText = "Passwords don't match!";
                return false;
            }
            else if(document.getElementById("invalid3").innerText != "") {
                document.getElementById("invalid3").innerText = "";
            }
            if(password.length<8) {
                document.getElementById("npassword").style.marginBottom = "0px";
                document.getElementById("invalid1").innerText = "";
                document.getElementById("invalid3").innerText = "";
                document.getElementById("invalid2").innerText = "Password must have at least 8 Characters";
                return false;
            }
            else if(document.getElementById("invalid2").innerText != "") {
                document.getElementById("invalid2").innerText = "";
            }
            if(!hasLowerCase(password) || !hasUpperCase(password)) {
                document.getElementById("npassword").style.marginBottom = "0px";
                document.getElementById("invalid1").innerText = "";
                document.getElementById("invalid3").innerText = "";
                document.getElementById("invalid2").innerText = "Weak Password!";
                return false;
            }
            else if(document.getElementById("invalid2").innerText != "") {
                document.getElementById("invalid2").innerText = "";
            }
            if(true) {
                pattern = /[0-9]/g;
                if(!password.match(pattern)) {
                    document.getElementById("npassword").style.marginBottom = "0px";
                    document.getElementById("invalid2").innerText = "Weak Password!";
                    document.getElementById("invalid1").innerText = "";
                    document.getElementById("invalid3").innerText = "";
                    return false;
                }
                else {
                    var format = /[ `!@#$%^&*()@_+\-=\[\]{};':"\\|,.<>\/?~]/;
                    if(!format.test(password)) {
                        document.getElementById("npassword").style.marginBottom = "0px";
                        document.getElementById("invalid1").innerText = "";
                        document.getElementById("invalid3").innerText = "";
                        document.getElementById("invalid2").innerText = "Weak Password!";
                        return false;
                    }
                }
            }
            if(document.getElementById("invalid2").innerText != "") {
                document.getElementById("invalid2").innerText = "";
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
        function validateEmail() {
            var email = document.getElementById("email").value;
            if(email == "<?php echo $email;?>") {
                document.getElementById("email").style.marginBottom = "0px"
                document.getElementById("invalid").innerText = "New Email Address cannot be same as Old Email Address!";
                return false;
            }
            var regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            var validEmail = regex.test(email);
            if(alreadyExists(email)) {
                document.getElementById("email").style.marginBottom = "0px"
                document.getElementById("invalid").innerText = "Email Already Exists!";
                return false;
            }
            else if(!validEmail) {
                document.getElementById("email").style.marginBottom = "0px"
                document.getElementById("invalid").innerText = "Invalid Email Address";
                return false;
            }
            else if(!email.includes("@gmail.com")) {
                document.getElementById("email").style.marginBottom = "0px"
                document.getElementById("invalid").innerText = "Must be a valid Gmail Address";
                return false;
            }
            else if(document.getElementById("invalid").innerText != "") {
                document.getElementById("invalid").innerText = "";
            }
            return true;
        }
        function validateUsername() {
            var name = document.getElementById("username").value;
            name = name.trim();
            if(name.length<3) {
                document.getElementById("username").style.marginBottom = "0px";
                document.getElementById("invalidUsername").innerText = "Invalid Name";
            }
            var regex = /^[a-zA-Z ]{3,30}$/;
            var valid = regex.test(name);
            if(!valid) {
                var regex = /\d/;
                var hasNum = regex.test(name);
                if(hasNum) {
                    document.getElementById("username").style.marginBottom = "0px";
                    document.getElementById("invalidUsername").innerText = "Name cannot contain digits";
                    valid = valid && (!hasNum);
                }
                else {
                    if(name.length<3) {
                        document.getElementById("username").style.marginBottom = "0px"
                        document.getElementById("invalidUsername").innerText = "Name should have at least 3 Characters";
                    }
                    else if(name.length>30) {
                        document.getElementById("username").style.marginBottom = "0px"
                        document.getElementById("invalidUsername").innerText = "Name should have at most 30 Characters";
                    }
                    else {
                        document.getElementById("username").style.marginBottom = "0px"
                        document.getElementById("invalidUsername").innerText = "Special Characters are not Allowed";
                    }
                }
            }
            else {
                if(document.getElementById("invalid1").innerText!="") {
                    document.getElementById("invalid1").innerText ="";
                }
            }
            return valid;
        }
    </script>
</body>
</html>