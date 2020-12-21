<?php
    session_start();
    if(!isset($_SESSION['email'])) {
        header("Location: index.php");
    }
    $videoid = number_format(substr($_SERVER['REQUEST_URI'],strpos($_SERVER['REQUEST_URI'],'?')+1));
    $host="localhost";
    $dbUsername="root";
    $dbPassword="";
    $index = 0;
    $dbname="videodatabase";
    $thumbnail = array();
    $filename = array();
    $videolink = array();
    $keywords = array();
    $dlink = array();
    $nature = array();
    $architecture = array();
    $animal = array();
    $others = array();
    $technology = array();
    $landscape = array();
    $category = "";
    $views = array();
    $downloads = array();
    $likes = array();
    $dislikes = array();
    $conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);
    if(mysqli_connect_error()) {
        echo "Connection Error";
        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
    }
    else {
        $sql = "select * from video where id = ".$videoid;
        $result = $conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                array_push($thumbnail,$row["thumbnail"]);
                array_push($dlink,$row["downloadlink"]);
                array_push($filename,$row["filename"]);
                array_push($views,$row["views"]);
                array_push($downloads,$row["downloads"]);
                array_push($likes,$row["likes"]);
                array_push($dislikes,$row["dislikes"]);
                array_push($videolink,$row["fileid"]);
            }
        }
        else {
            echo "0 results";
        }
        $sql = "select * from keywords where videoid = ".$videoid;
        $result = $conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                array_push($keywords,array($row["videoid"],$row["keyword"]));
            }
        }
        $sql = "select * from category where videoid = ".$videoid;
        $result = $conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $category = ucfirst($row["category"]);
            }
        }
        $sql = "UPDATE video set views = views + 1 where id = ".$videoid;
        $result = $conn->query($sql);
        $conn->close();
    }
    $userid = $_SESSION["userid"];
    $host="localhost";
    $dbUsername="root";
    $dbPassword="";
    $dbname="user_database";
    $conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);
    if(mysqli_connect_error()) {
        echo "Connection Error";
        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
    }
    else {
        $timestamp = date("Y-m-d H:i:s");
        $endTime = strtotime("+270 minutes", strtotime($timestamp));
        $timestamp = date('Y-m-d H:i:s', $endTime);
        $sql = "insert into ".$userid."wh(videoid, ts) values ('$videoid', '$timestamp')";
        $result = $conn->query($sql);
        $sql = "select * from ".$userid."lh where videoid=".$videoid;
        $result = $conn->query($sql);
        $status = "";
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $status = $row["status"];
        }
        else {
            $status = "null";
        }
        $conn->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title id="title">Video Playback</title>
</head>
<body>
    <div id="showcaseTop" class="showcase-top" oncontextmenu="return false" >
        <a oncontextmenu="return false" href="index.php"><img src="Logo.png" alt="Meta Stream"></a>
        <div id="search">
            <form>
                <input type="text" id="search-input" name="search" autocomplete="off">
            </form>
            <a href="#" onclick="fetch_keywords()" ><i class="fa fa-search fa-xs" id="search-icon"></i></a>
        </div>
        <button id="userlogout" oncontextmenu="return false" onclick="signOut()" alt="Sign Out">Sign Out</button>
        <a id="myaccount" href="../myaccount/dashboard.php"><img id="avatar" src="avatar.png" alt=""></a>
    </div>
    <div id="container">

        <iframe id="myframe"src="" width="1280" height="600" frameborder="0" scrolling="no" seamless="" allowfullscreen></iframe>
  
        <div style="width: 200px; height: 200px; position: absolute; background: white; opacity: 0; right: 0px; top: 0px;">&nbsp;</div>
    </div>
    <div id="details">
        <div id="box">
            <div id="thumbnail">
                <img id="thumb" src="" alt="">
                <div style="display: inline-block;">
                    <button onclick="like();" id="likes"><i id="like" class="fa fa-thumbs-up fa-3x" aria-hidden="true"></i><p id="lcount"></p></button>
                    <button onclick="dislike();" id="dislikes"><i id="dislike" class="fa fa-thumbs-down fa-3x" aria-hidden="true"></i><p  id="dlcount"></p></button>
                </div>
            </div>
            <div id="description">
                <h1 id="filename"></h2>
                <h3 id="category"></h3>
                <h3 id="views"></h3>
                <h3 id="downloads"></h3>
                <h3 id="keydesc"></h3>
                <div id="btnid">
                    <a oncontextmenu="return false;" target="_blank" id="downlink" onclick="Download()" href=""><button class="btn"><i class="fas fa-download"></i>Download</button></a>    
                </div>
            </div>
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
            <h2>
                About Developers
            </h2><br>
            <a target="_blank" href="https://github.com/ChitturiSaiSuman">Chitturi Sai Suman</a><br>
            <a target="_blank" href="https://github.com/300-iq">Praneeth Kapila</a>
        </div>
    </footer>
  <script>
      console.log("<?php echo $_SERVER['REQUEST_URI']?>");
      console.log("<?php echo $videoid;?>");
    $(document).ready(function() {
        var email = "<?php if(isset($_SESSION['email'])) echo $_SESSION['email']; else echo 'null'?>";
        if(email == "null") {
            console.log("User not logged in, please log in");
        }
        else {
            document.getElementById("userlogout").style.visibility = 'visible';
            document.getElementById("search").style.visibility = 'visible';
        }
    });
    var links = <?php echo json_encode($videolink);?>;
    var downloadlink = <?php echo json_encode($dlink);?>;
    var thumbnail = <?php echo json_encode($thumbnail);?>;
    var storage = <?php echo json_encode($keywords);?>;
    var views = <?php echo json_encode($views);?>;
    var downloads = <?php echo json_encode($downloads);?>;
    var likes = <?php echo json_encode($likes);?>;
    var dislikes = <?php echo json_encode($dislikes);?>;
    console.log(links);
    var vid_id = parent.document.URL.substring(parent.document.URL.indexOf('?')+1, parent.document.URL.length);
    var ind = parseInt(vid_id);
    console.log(ind);
    var filenames = <?php echo json_encode($filename);?>;
    document.getElementById("myframe").src=links[0];
    document.getElementById("downlink").href=downloadlink[0];
    var name = filenames[0];
    name = name.substring(0,name.length-4);
    function hasUpperCase(str) {
        return (/[A-Z]/.test(str));
    }
    var newName = "";
    for(var i=0;i<name.length;i++) {
        if(hasUpperCase(name.substring(i,i+1))) {
            newName += " "+name.substring(i,i+1);
        }
        else {
            newName += name.substring(i,i+1);
        }
    }
    keydesc = "";
    for(var i=0;i<storage.length;i++) {
        if(storage[i][0]==ind) {
            keydesc += storage[i][1]+", ";
        }
    }
    keydesc = keydesc.substring(0,keydesc.length-2);
    category = "<?php echo $category;?>";
    var likeStatus = "<?php echo $status;?>";
    document.getElementById("filename").innerText = newName;
    document.getElementById("title").innerText = newName;
    document.getElementById("thumb").src = thumbnail[0];
    document.getElementById("category").innerText = "Category: "+category;
    document.getElementById("views").innerText = "Views: "+views[0];
    document.getElementById("downloads").innerText = "Downloads: "+downloads[0];
    document.getElementById("keydesc").innerText = "Tags: "+keydesc;
    document.getElementById("lcount").innerText = likes[0];
    document.getElementById("dlcount").innerText = dislikes[0];
    if(likeStatus == "liked") {
        document.getElementById("like").style.color = "#4287f5";
    }
    else if(likeStatus == "disliked") {
        document.getElementById("dislike").style.color = "#4287f5";
    }
    function like() {
        var data = [vid_id];
        $.post('like.php', {'data' : JSON.stringify(data)}, function(response) {
            location.reload();
        });
    }
    function dislike() {
        var data = [vid_id];
        $.post('dislike.php', {'data' : JSON.stringify(data)}, function(response) {
            location.reload();
        });
    }
    function signOut() {
        window.location.href='http://localhost/Meta-Stream/home/logout.php'
    }
    function Download() {
        var downloadlink = document.getElementById("downlink").href;
        window.open(downloadlink);
        window.location.href = "http://localhost/Meta-Stream/home/download.php?"+vid_id;
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
    } else {
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
</script>
</body>
</html>