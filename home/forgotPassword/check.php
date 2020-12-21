<?php
    session_start();
    $otp = $_SESSION["otp"];
    if(!isset($_POST["digit-1"])) {
        header("Location: ../index.php");
    }
    $userInput = "".$_POST["digit-1"]."".$_POST["digit-2"]."".$_POST["digit-3"]."".$_POST["digit-4"]."".$_POST["digit-5"]."".$_POST["digit-6"];
    if($userInput == $otp) {
        header("Location: userdb.php");
    }
    else {
        $_SESSION["invalidOTP"] = "true";
        header("Location: verify.php");
    }
?>