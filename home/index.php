<?php
    session_start();
    $host="localhost";
    $dbUsername="root";
    $dbPassword="";
    $index = 0;
    $dbname="videodatabase";
    $thumbnail = array();
    $videolink = array();
    $keywords = array();

    $nature = array();
    $architecture = array();
    $animal = array();
    $others = array();
    $technology = array();
    $landscape = array();



    $conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);
    if(mysqli_connect_error()) {
        echo "Connection Error";
        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
    }
    else {
        $sql = "select * from category";
        $result = $conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                if($row["category"]=="animal") {
                    array_push($animal,$row["videoid"]);
                }
                if($row["category"]=="nature") {
                    array_push($nature,$row["videoid"]);
                }
                if($row["category"]=="architecture") {
                    array_push($architecture,$row["videoid"]);
                }
                if($row["category"]=="technology") {
                    array_push($technology,$row["videoid"]);
                }
                if($row["category"]=="landscape") {
                    array_push($landscape,$row["videoid"]);
                }
                if($row["category"]=="others") {
                    array_push($others,$row["videoid"]);
                }
            }
        }
        $id = 1;
        $sql = "select * from video";
        $result = $conn->query($sql);
        $limit = mysqli_num_rows($result);
        while($id<=$limit) {
            $sql = "select thumbnail from video where id = ".$id;
            $result = $conn->query($sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    array_push($thumbnail,$row["thumbnail"]);
                }
            } else {
                echo "0 results";
            }
            $sql = "select fileid from video where id = ".$id;
            $result = $conn->query($sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    array_push($videolink,$row["fileid"]);
                }
            }
            else {
                echo "0 results";
            }
            $id++;
        }
        $id = 1;
        $ind = 0;
        $sql = "select * from keywords";
        $result = $conn->query($sql);
        $limit = mysqli_num_rows($result);
        while($id<=$limit) {
            $sql = "select * from keywords where id = ".$id;
            $result = $conn->query($sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    array_push($keywords,array($row["videoid"],$row["keyword"]));
                }
            }
            $id++;
        }
        $conn->close();
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Meta Stream</title>
</head>
<body>
    <div id="showcaseTop" class="showcase-top">
        <a href="index.php"><img src="Logo.png" alt="Meta Stream"></a>
        <div id="search">
            <form>
                <input type="text" id="search-input" name="search" autocomplete="off">
                <a href="#" onclick="fetch_keywords()" ><i class="fa fa-search fa-xs" id="search-icon"></i></a>
            </form>
        </div>
        <button id="userlogin" onclick="hideShowcase()" data-toggle="modal" data-target="#loginModel" alt="Sign In">Sign In</button>
        <button id="userlogout" onclick="signOut()" alt="Sign Out">Sign Out</button>
        <a id="myaccount" href="../myaccount/dashboard.php"><img id="avatar" src="avatar.png" alt=""></a>
    </div>
    <div id="loginModel" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" role="content">
            <div class="modal-content" style="background-color: black;" >
                <div class="login-box">
                    <h1>Sign In </h1>
                    <form action="../signup/userlogin.php" method="POST">
                        <p>Email</p>
                        <input type="text" name="email" placeholder="Enter Email" required>
                        <p>Password</p>
                        <input type="password" name="password" placeholder="Enter Password" required>
                        <input type="submit" name="submit" value="Sign In">
                        <div id="invalid"></div>
                        <a href="forgotPassword/forgotPassword.php">Forgot Password?</a><br>
                        <a href="../signup/signup.php">Don't have an Account? Sign Up</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="showcaseContent"class="showcase-content">
        <h1>
            Stream High Quality Content
        </h1>
        <p>
            Hassle free Downloads. Cross-platform support
        </p>
        <a id="createAccount" onclick="showCarousel()" href="../signup/signup.php" class="btn btn-xl">Get Started ></a>
    </div>
    <div id="freespace" class="free-space"></div>
    <div id="explore"></div>
    <div id="container1" class="container">
		<h1>Nature</h1>
		<div class="logo-slider">
            <?php
                for($index = 0;$index< sizeof($nature);$index++) {
                    echo "<div class=\"item\"><a href=\"videoplayback.php?".$nature[$index]."\"><img src=\"".$thumbnail[$nature[$index]-1]."\" alt=\"\"></a></div>\n\t\t\t";
                }
            ?>
		</div>
	</div>
	<div id="container2" class="container">
		<h1>Animal</h1>
		<div class="logo-slider">
            <?php
                for($index = 0;$index< sizeof($animal);$index++) {
                    echo "<div class=\"item\"><a href=\"videoplayback.php?".$animal[$index]."\"><img src=\"".$thumbnail[$animal[$index]-1]."\" alt=\"\"></a></div>\n\t\t\t";
                }
            ?>
		</div>
    </div>
    <div id="container3" class="container">
		<h1>Architecture</h1>
		<div class="logo-slider">
            <?php
                for($index = 0;$index < sizeof($architecture);$index++) {
                    echo "<div class=\"item\"><a href=\"videoplayback.php?".$architecture[$index]."\"><img src=\"".$thumbnail[$architecture[$index]-1]."\" alt=\"\"></a></div>\n\t\t\t";
                }
            ?>
		</div>
    </div>
    <div id="container4" class="container">
		<h1>Landscapes</h1>
		<div class="logo-slider">
            <?php
                for($index = 0;$index < sizeof($landscape);$index++) {
                    echo "<div class=\"item\"><a href=\"videoplayback.php?".$landscape[$index]."\"><img src=\"".$thumbnail[$landscape[$index]-1]."\" alt=\"\"></a></div>\n\t\t\t";
                }
            ?>
		</div>
    </div>
    <div id="container5" class="container">
		<h1>Technology</h1>
		<div class="logo-slider">
            <?php
                for($index = 0;$index < sizeof($technology);$index++) {
                    echo "<div class=\"item\"><a href=\"videoplayback.php?".$technology[$index]."\"><img src=\"".$thumbnail[$technology[$index]-1]."\" alt=\"\"></a></div>\n\t\t\t";
                }
            ?>
		</div>
    </div>
    <div id="container6" class="container">
		<h1>Other Stock Videos</h1>
		<div class="logo-slider">
            <?php
                for($index = 0;$index < sizeof($others);$index++) {
                    echo "<div class=\"item\"><a href=\"videoplayback.php?".$others[$index]."\"><img src=\"".$thumbnail[$others[$index]-1]."\" alt=\"\"></a></div>\n\t\t\t";
                }
            ?>
		</div>
    </div>
    <footer id="footer">
        <div id="connect">
            <p>Connect with us</p>
            <a href="https://www.facebook.com/metastreamadmin/" target="_blank"><img id="facebook" src="fb.png" alt=""></a>
            <button id="contribute"><i class="fa fa-handshake-o fa-lg" aria-hidden="true"></i><a target="_blank" href="https://forms.gle/bhFKAbc1AEkBtntB6"> Contribute</a></button>
            <p id="rights">@Meta-Stream, All Rights Reserved</p>
        </div>
        <div id="aboutDevelopers">
            <h3>
                About Developers
            </h3>
            <a target="_blank" href="https://github.com/ChitturiSaiSuman">Chitturi Sai Suman</a><br>
            <a target="_blank" href="https://github.com/300-iq">Praneeth Kapila</a>
        </div>
    </footer>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        $(document).ready(function() {
            var email = "<?php if(isset($_SESSION['email'])) echo $_SESSION['email']; else echo 'null'?>";
            if(email != 'null') {
                document.getElementById("userlogin").style.visibility = 'hidden';
                document.getElementById("userlogout").style.visibility = 'visible';
                document.getElementById("createAccount").innerHTML = "Explore >";
                document.getElementById("createAccount").href = "#explore";
                document.getElementById("search").style.visibility = 'visible';
                document.getElementById("myaccount").style.visibility = 'visible';
            }
            else {
                document.getElementById("userlogin").style.visibility = 'visible';
                document.getElementById("userlogout").style.visibility = 'hidden';
                document.getElementById("createAccount").style.visibility = "visible";
                document.getElementById("createAccount").innerHTML = "Get Started >";
                document.getElementById("createAccount").href = "../signup/signup.php";
                localStorage["pagescroll"] = "disabled";   
            }
            for(var i=1;i<=6;i++) {
                document.getElementById("container"+i).style.visibility = "hidden";
            }
            function alignModal(){
                var modalDialog = $(this).find(".modal-dialog");
                modalDialog.css("margin-top", Math.max(0, ($(window).height() - modalDialog.height()) / 2));
            }
            $(".modal").on("shown.bs.modal", alignModal);
            $(window).on("resize", function(){
                $(".modal:visible").each(alignModal);
            });
            if(localStorage["pagescroll"]=="enabled") {
                $("body").css("overflow", "scroll");
                for(var i=1;i<=6;i++) {
                    document.getElementById("container"+i).style.visibility = "visible";
                }
            }
            if(localStorage["previewLogin"]=="true") {
                document.getElementById("userlogin").click();
            }
            localStorage["previewLogin"] = "false";
            localStorage["searchExpanded"] = "false";
            var invalidLogin = <?php if(isset($_SESSION["invalidLogin"])) echo $_SESSION["invalidLogin"]; else echo "false"?>;
            if(invalidLogin && localStorage["invalidLogin"]=="true") {
                localStorage["invalidLogin"] = "true";
                document.getElementById("invalid").innerText = "Invalid Username or Password";
                document.getElementById("userlogin").click();
            }
            else {
                localStorage["invalidLogin"] = "false";
                document.getElementById("invalid").innerText = "";
            }
        });
        $('.logo-slider').slick({
			slidesToShow: 5,
            slidesToScroll: 1,
			arrow: true,
			infinite: true,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        infinite: true,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: true,
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: true,
                    }
                }
            ]
		});
        function signOut() {
            window.location.href='http://localhost/Meta-Stream/home/logout.php';
            localStorage["pagescroll"] = "disabled";
        }
        const body = document.querySelector('body');
        const searchBtn = document.querySelector('#search');
        const searchInput = document.querySelector('#search-input');
        let active = false;

        body.addEventListener('click', (e) => {
        if(e.target.id === 'search' || e.target.id === 'search-input' || e.target.id === 'search-icon') {
            if(!active) {
            searchBtn.classList.add('active');
            searchInput.classList.add('active');
            active = true;
            }
        }
        else {
            searchBtn.classList.remove('active');
            searchInput.classList.remove('active');
            searchInput.value = '';
            active = false;
        }
        });
        window.addEventListener('keydown',function(e){if(e.keyIdentifier=='U+000A'||e.keyIdentifier=='Enter'||e.keyCode==13) {
            if(e.target.nodeName=='INPUT'&&e.target.type=='text') {
                    e.preventDefault();
                    fetch_keywords();
                }
            }
        },true);
        function fetch_keywords() {
            if(localStorage["searchExpanded"] == "false") {
                localStorage["searchExpanded"] = "true";
                return;
            }
            if(document.getElementById("search-input").value=="") {
                return;
            }
            var keywords = (document.getElementById("search-input").value).split(" ");
            var p = "searchdb.php?query=";
            var i;
            for(i=0;i<keywords.length-1;i++)
            {
                p+=keywords[i].toLowerCase();
                p+='+'
            }
            p+=keywords[i].toLowerCase();
            location.href=p;
        }
        function showCarousel() {
            var loggedin = <?php if(isset($_SESSION['email'])) echo "true"; else echo "false"?>;
            if(loggedin) {
                for(var i=1;i<=6;i++) {
                    document.getElementById("container"+i).style.visibility = "visible";
                }
            }
            $("body").css("overflow", "scroll");
            localStorage["pagescroll"] = "enabled";
        }
        function hideShowcase() {
            document.getElementById("showcaseContent").style.visibility = "hidden";
            document.getElementById("showcaseTop").style.visibility = "hidden";
            document.getElementById("createAccount").style.visibility = "hidden";
            document.getElementById("userlogin").style.visibility = "hidden";
            for(var i=1;i<=6;i++) {
                document.getElementById("container"+i).style.visibility = "hidden";
            }
            document.getElementById("footer").style.visibility = "hidden";
        }
        $('#loginModel').on('hidden.bs.modal', function () {
            document.getElementById("showcaseContent").style.visibility = "visible";
            document.getElementById("showcaseTop").style.visibility = "visible";
            document.getElementById("createAccount").style.visibility = "visible";
            document.getElementById("userlogin").style.visibility = "visible";
            if(document.getElementById("createAccount").innerHTML=="Explore >") {
                for(var i=1;i<=6;i++) {
                    document.getElementById("container"+i).style.visibility = "visible";
                }
            }
            document.getElementById("footer").style.visibility = "visible";
            localStorage["invalidLogin"] = "false";
            document.getElementById("invalid").innerText = "";
        })
    </script>
</body>
</html>