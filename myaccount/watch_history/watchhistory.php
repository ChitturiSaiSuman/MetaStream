<?php
  session_start();
  if(!isset($_SESSION["email"])) {
    header("Location: ../../home/index.php");
  }

  $username = $_SESSION["username"];
  $user_id = $_SESSION["userid"];
  $email = $_SESSION["email"];

  define('DB_SERVER', 'localhost');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', '');
  define('DB_DATABASE', 'user_database');
  $conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

  $query = "select * from ".$user_id."wh";
  $sql=mysqli_query($conn,$query);
  $id=array();
  $video_ids=array();
  $ts=array();

  if ($sql->num_rows > 0) {
    while($row = $sql->fetch_assoc()) {
      array_push($id,$row["id"]);
      array_push($video_ids,$row["videoid"]);
      array_push($ts,$row["ts"]);
    }
  }
  $id = array_reverse($id);
  $video_ids = array_reverse($video_ids);
  $ts = array_reverse($ts);
  $thumbnail = array();
  $filename = array();

  $host="localhost";
  $dbUsername="root";
  $dbPassword="";
  $dbname="videodatabase";

  $conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);
  if(mysqli_connect_error()) {
      echo "Connection Error";
      die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
  }
  for($i=0;$i<sizeof($id);$i++) {
    $temp = $video_ids[$i];
    $sql = "select * from video where id = ".$temp;
    $result = $conn->query($sql);
    if(mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
        array_push($thumbnail,$row["thumbnail"]);
        array_push($filename,$row["filename"]);
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Watch history</title>
</head>
<body>
    <div id="showcaseTop" class="showcase-top">
        <a href="../../home/index.php"><img id="metastream" src="Logo.png" alt="Meta Stream"></a>
        <button id="userlogout" onclick="signOut()" alt="Sign Out">Sign Out</button>
        <a id="myaccount" href="../dashboard.php"><img id="avatar" src="avatar.png" alt=""></a>
        <div id="delete">
            <span id="selected">0 Selected</span>
            <button id="del-btn" onclick="del()">Delete</button>
        </div>
        <button id="prev-btn" onclick="prev()">Previous</button>
        <button id="next-btn" onclick="next()">Next</button>
    </div>
    <h1 id="title">Manage Your Watch History</h1>
    <h2 id="heading" style="visibility: hidden; text-align: center;"></h2>
    <div id="container">
      <div id="watchhistory">
      </div>
    </div>
    <h2 id="message" style="visibility: hidden; text-align: center;">
      Your Watch History is Empty.<br>Please come back later.
    </h2>
    <script>
        var url = window.location.href;
        var length = url.length;
        var page = 1;
        var prefix = "http://localhost/Meta-Stream/myaccount/watch_history/watchhistory.php";
        function hasUpperCase(str) {
          return (/[A-Z]/.test(str));
        }
        function beautify(name) {
          var newName = "";
          for(var i=0;i<name.length;i++) {
            if(hasUpperCase(name.substring(i,i+1))) {
              newName += " "+name.substring(i,i+1);
            }
            else {
              newName += name.substring(i,i+1);
            }
          }
          newName = newName.substring(0,newName.length-4);
          return newName;
        }
        if(url.substring(length-3,length)=="php") {
          window.location.href = url + "?page=1";
        }
        else {
          page = parseInt(url.substring(url.indexOf("=")+1,length));
        }
        t = document.getElementById("watchhistory");
        var ids=<?php echo json_encode($id)?>;
        var st = (page-1)*20+1;
        if((st<1 || st>ids.length) && ids.length!=0 ) {
          if(st<1)
            window.location.href = prefix + "?page=1";
          else
            window.location.href = prefix + "?page="+Math.ceil(ids.length/20);
          document.reload();
        }
        if(ids.length == 0) {
          document.getElementById("watchhistory").style.visibility = "hidden";
          document.getElementById("message").style.visibility = "visible";
        }
        else {
          document.getElementById("heading").style.visibility = "visible";
        }
        var n = ids.length;
        var video_ids=<?php echo json_encode($video_ids);?>;
        var ts=<?php echo json_encode($ts);?>;
        var thumbs = <?php echo json_encode($thumbnail);?>;
        var filenames = <?php echo json_encode($filename);?>;
        for(var i=0;i<n;i++) {
        var entry = document.createElement('div');
        entry.classList = "entry";
        entry.id = "entry"+(i+1);
        var checkbox = document.createElement('input');
        checkbox.type = "checkbox";
        checkbox.name = "checkbox";
        checkbox.classList = "checkbox";
        checkbox.value = ids[i];
        checkbox.id = "id"+(i+1);
        checkbox.onclick;
        var label = document.createElement('label');
        label.id = "label"+(i+1);
        label.classList = "label";
        var playLink = document.createElement('a');
        playLink.href = "../../home/videoplayback.php?"+ video_ids[i];
        var thumb = document.createElement('img');
        thumb.src = thumbs[i];
        thumb.id = "thumb"+(i+1);
        thumb.classList = "thumbnail";
        playLink.appendChild(thumb);
        var lb = document.createElement('br');
        lb.id = "lb"+(i+1);
        label.htmlFor = ids[i];
        label.appendChild(document.createTextNode('\u00A0\u00A0\u00A0'.concat(ts[i]).concat('\u00A0\u00A0\u00A0\u00A0\u00A0-\u00A0\u00A0\u00A0\u00A0\u00A0').concat(beautify(filenames[i]))));
        entry.appendChild(checkbox);
        entry.appendChild(label);
        entry.appendChild(playLink);
        entry.appendChild(lb);
        t.appendChild(entry);
      }
        
        var id_array = new Array();
        $(document).on('change', '[type=checkbox]', function(e) {
            var $c=0;
            var checked = $(this).val();
            if ($(this).is(':checked')) {
              id_array.push(checked);
            } 
            else {
              id_array.splice($.inArray(checked, id_array),1);
            }
            if(id_array.length>0) {
              document.getElementById('delete').style.visibility = 'visible';
              document.getElementById('del-btn').style.visibility = 'visible';
            }
            else {
              document.getElementById('del-btn').style.visibility = 'hidden';
              document.getElementById('delete').style.visibility = 'hidden';
            }
            $('#delete span').html(id_array.length+" Selected");
          });
          var limit = ids.length;
          var start = 20*(page-1)+1;
          var end = Math.min(20*page,ids.length);
          document.getElementById("heading").innerText = "Showing "+start+"-"+end+" of "+limit;
          if(!(end>=limit || end<1)) {
            document.getElementById("next-btn").style.visibility = "visible";
          }
          if(!(start<=1 || start>limit)) {
            document.getElementById("prev-btn").style.visibility = "visible";
          }
          for(var i=1;i<start;i++) {
            try {
              document.getElementById("entry"+i).style.display = 'none';
            }
            catch(err) {
              break;
            }
          }
          for(var i=end+1;i<=ids.length;i++) {
            try {
              document.getElementById("entry"+i).style.display = 'none';
            }
            catch(err) {
              break;
            }
          }
          function next() {
            page++;
            window.location.href = prefix+"?page="+page;
            document.reload();
          }
          function prev() {
            page--;
            window.location.href = prefix+"?page="+page;
            document.reload();
          }
          function del(){
            $.post('delete.php', {'data' : JSON.stringify(id_array)}, function(response){ 
              location.reload();
            });
          }
          function signOut() {
              window.location.href='http://localhost/Meta-Stream/home/logout.php';
              localStorage["pagescroll"] = "disabled";
          }
</script>
</body>
</html>