<?php
    session_start();
    if(isset($_SESSION["signup_email"])) {
        $email = $_SESSION["signup_email"];
        $password = $_SESSION["signup_password"];
        $otp = $_SESSION["otp"];
    }
    else if(isset($_POST['email'])) {
        $email=$_POST['email'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        $otp = rand(100000,999999);
        $_SESSION["otp"] = $otp;
    }
    $_SESSION["signup_email"] = $email;
    $_SESSION["signup_password"] = $password;
    $_SESSION["otp"] = "$otp";
    $invalidOTP = "false";
    if(isset($_SESSION["invalidOTP"])) {
        $invalidOTP = "true";
    }
    $host="localhost";
    $dbUsername="root";
    $dbPassword="";
    $index = 0;
    $dbname="user_database";
    $fname = "";
    $conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);
    if(mysqli_connect_error()) {
        echo "Connection Error";
        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
    }
    else {
        $sql = "SELECT * from USERS where email = '$email';";
        $result = $conn->query($sql);
        if(mysqli_num_rows($result)>0) {
            while($row = mysqli_fetch_assoc($result)) {
                $fname = $row["FULLNAME"];
            }
        }
        $conn->close();
    }
    if($invalidOTP == "false") {
        system("python send_email.py ".$email." \"".$fname."\" ".$otp);
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" href="verifystyle.css">
    <title>Meta Stream</title>
</head>
<body>
    <div class="showcase-top">
        <a href="../index.php"><img src="Logo.png" alt="Meta Stream"></a>
    </div>
    <div class="login-box">
        <h1>Verify Account</h1>
        <form class="digit-group" action="check.php" method="POST" onsubmit="return validate();">
            <p>An E-mail with a verification code was just sent to <?php echo $email;?>.
                Please enter the 6-digit verification code.
            </p>
            <div id="otp">
                <input type="text" id="digit-1" name="digit-1" data-next="digit-2" />
                <span class="splitter">&ndash;</span>
                <input type="text" id="digit-2" name="digit-2" data-next="digit-3" data-previous="digit-1" />
                <span class="splitter">&ndash;</span>
                <input type="text" id="digit-3" name="digit-3" data-next="digit-4" data-previous="digit-2" />
                <span class="splitter">&ndash;</span>
                <input type="text" id="digit-4" name="digit-4" data-next="digit-5" data-previous="digit-3" />
                <span class="splitter">&ndash;</span>
                <input type="text" id="digit-5" name="digit-5" data-next="digit-6" data-previous="digit-4" />
                <span class="splitter">&ndash;</span>
                <input type="text" id="digit-6" name="digit-6" data-previous="digit-5" />
                <input id="submit" type="submit" name="submit" value="Verify">
            </div>
        </form>
        <p id="invalidOTP"></p>
    </div>
</body>
    <script>
        var invalidOTP = <?php echo $invalidOTP?>;
        if(invalidOTP) {
            document.getElementById("invalidOTP").innerText = "Invalid Code! Please try again";
        }
        else {
            document.getElementById("invalidOTP").innerText = "";
        }
        $('.digit-group').find('input').each(function() {
            $(this).attr('maxlength', 1);
            $(this).on('keyup', function(e) {
                var parent = $($(this).parent());
                
                if(e.keyCode === 8 || e.keyCode === 37) {
                    var prev = parent.find('input#' + $(this).data('previous'));
                    
                    if(prev.length) {
                        $(prev).select();
                    }
                }
                else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
                    var next = parent.find('input#' + $(this).data('next'));
                    if(next.length) {
                        $(next).select();
                    }
                    else {
                        document.getElementById("submit").click();
                    }
                }
            });
        });
    </script>
</html>