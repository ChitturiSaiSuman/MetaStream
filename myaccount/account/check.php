<?php
    session_start();
    $otp = $_SESSION["otp"];
    $userInput = "".$_POST["digit-1"]."".$_POST["digit-2"]."".$_POST["digit-3"]."".$_POST["digit-4"]."".$_POST["digit-5"]."".$_POST["digit-6"];
    echo $userInput;
    echo $otp;
    if($userInput == $otp) {
        echo "Done";
        header("Location: http://localhost/Meta-Stream/myaccount/account/updateEmail.php");
    }
    else {
        $_SESSION["invalidOTP"] = "true";
        header("Location: http://localhost/Meta-Stream/myaccount/account/verifyEmail.php");
        echo "Not Done";
    }
?>