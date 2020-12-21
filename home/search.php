<?php
    session_start();
    if(!isset($_SESSION["email"])) {
        header("Location: index.php");
    }
    $host="localhost";
    $dbUsername="root";
    $dbPassword="";
    $index = 0;
    $dbname="videodatabase";
    $thumbnail = array();
    $videolink = array();
    $keywords = array();
    $conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);
    if(mysqli_connect_error()) {
        echo "Connection Error";
        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
    }
    else {
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
            }
            else {
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/require.js/2.3.6/require.min.js" integrity="sha512-c3Nl8+7g4LMSTdrm621y7kf9v3SDPnhxLNhcjFJbKECVnmZHTdo+IRO05sNLTH/D3vA6u1X32ehoLC7WFVdheg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/require.js/2.3.6/require.js" integrity="sha512-vRqhAr2wsn+/cSsyz80psBbCcqzz2GTuhGk3bq3dAyytz4J/8XwFqMjiAGFBj+WM95lHBJ9cDf87T3P8yMrY7A==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/searchstyle.css">
    <title>Results</title>
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
        <button id="userlogout" onclick="signOut()" alt="Sign Out">Sign Out</button>
        <a id="myaccount" href="../myaccount/dashboard.php"><img id="avatar" src="avatar.png" alt=""></a>
    </div>
    <!-- <div id="sb">
        <form id="shit" action="" class="search-bar">
            <input id="whatever" type="text" name="search" pattern=".*\S.*" required>
            <button class="search-btn" type="button" onclick="fetch_keywords()">
                <span>Search</span>
            </button>
        </form>
    </div> -->
    <div id="cat">
        <h2> Search Results</h2>
        <h3 id="zeroresults"></h3>
        <div id="results">
        </div>
        <br>
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
            <a target="_blank" href="https://github.com/300-iq">Praneeth Kapila</a> <br>
            <a target="_blank" href="https://github.com/ChitturiSaiSuman">Chitturi Sai Suman</a><br>
        </div>
        <!-- <a href="https://forms.gle/bhFKAbc1AEkBtntB6">Contribute</a> -->
    </footer>
    
    
    <script>
        var qqq;
        function redirect() {
            window.location.href = "videoplayback.html?" + arguments[0];
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
        var keys = (parent.document.URL.substring(parent.document.URL.indexOf('=')+1, parent.document.URL.length)).split('+');
        console.log(keys);
        var i;
        var ID = [];
        var storage = <?php echo json_encode($keywords);?>;
        var thumbnails = <?php echo json_encode($thumbnail);?>;
        var links = <?php echo json_encode($videolink);?>;
        var results = new Set();
        for(i=0;i<keys.length;i++)
        {
            for(var j=0;j<storage.length;j++) {
                if(keys[i] == storage[j][1]) {
                    results.add(storage[j][0]);
                }
            }
            // if (keys[i] in localStorage)
            // {
            //     var temp;
            //     var res = localStorage[keys[i]].split(",")
            //     console.log(res)
            //     for(temp=0; temp<res.length;temp++)
            //     {
            //         ID.push(res[temp]);

            // }
        }
        results = Array.from(results);
        console.log(results);
        for(var ind=0;ind<results.length;ind++) {
            console.log(thumbnails[results[ind]-1]);
        }
        var createClickHandler = function(arg) {
            return function () { location.href = 'videoplayback.php?' + arg;};
        }
            
        if (results.length>0)
        {
            var j;
            for(j=0;j<results.length;j+=1)
            {
                qqq = results[j];
                var thumb_nail="t" + qqq;
                var video_link = "id" + qqq;
                var img = document.createElement("img");
                img.src = thumbnails[results[j]-1];
                // console.log();
                img.onclick = createClickHandler(results[j]);
                img.width="180";
                img.style.margin="8px";
                var temp = document.getElementById("results");
                temp.appendChild(img);
            }
        }
        else {
            document.getElementById("zeroresults").style.display = "block";
            document.getElementById("zeroresults").innerHTML="Unfortunately your Search did not return any results.";
            var url = window.location.href;
            if(!url.includes("?query=")) {
                document.getElementById("zeroresults").innerHTML="It appears that you haven't searched anything.";
            }
        }
    </script>
</body>
</html>