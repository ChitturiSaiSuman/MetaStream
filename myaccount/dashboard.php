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
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="showcaseTop" class="showcase-top">
        <a href="../home/index.php"><img src="../home/Logo.png" alt="Meta Stream"></a>
        <button id="userlogout" onclick="signOut()" alt="Sign Out">Sign Out</button>
    </div>
    <div id="userinfo">
        <h1 id="message">Welcome, <?php echo $_SESSION['username'];?></h1>
        <h2 id="text">Manage your Account info and Activity with these simple steps</h2>
    </div>
    <div class="container-holder">
        <div class="container">
            <div class="item item--1">
                <p>Account</p>
                <img src="account.png" alt="">
                <hr>
                <div id="credentials">
                    <a href="account/myaccount.php"><h3>Manage Your Credentials</h3></a>
                </div>
            </div>
            <div class="item item--2">
            <p>Search History</p>
            <img src="search.png" alt="">
                <hr>
                <div id="search">
                    <a href="search_history/searchhistory.php"><h3>Manage Search History</h3></a>
                </div>
            </div>
            <div class="item item--3">
            <p>Watch History</p>
            <img src="watch.png" alt="">
                <hr>
                <div id="watch">
                    <a href="watch_history/watchhistory.php"><h3>Manage Watch History</h3></a>
                </div>
            </div>
            <div class="item item--4">
            <p>Download History</p>
            <img src="download.png" alt="">
                <hr>
                <div id="download">
                    <a href="download_history/downloadhistory.php"><h3>Manage Download History</h3></a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script language="JavaScript" type="text/javascript">
        $(document).ready(function() {
            var email = "<?php echo $_SESSION['email'];?>";
            var username = "<?php echo $_SESSION['username'];?>";
            var userid = "<?php echo $_SESSION['userid'];?>";
        });
        function signOut() {
            window.location.href='http://localhost/Meta-Stream/home/logout.php';
        }
    </script>
</body>
</html>