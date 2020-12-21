<?php
    session_start();
    if(!isset($_POST['email'])) {
        header("Location: myaccount.php");
    }
    $email=$_POST['email'];
    $otp = rand(100000,999999);
    $_SESSION["otp"] = $otp;
    
    $_SESSION["changeEmail"] = $email;
    $_SESSION["otp"] = "$otp";
    $invalidOTP = "false";

    if(isset($_SESSION["invalidOTP"])) {
        $invalidOTP = "true";
    }
    if($invalidOTP == "false") {
        // unset($_SESSION["changeEmail"]);
        $fname = $_SESSION["username"];
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
        <a href="../home/index.php"><img src="Logo.png" alt="Meta Stream"></a>
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