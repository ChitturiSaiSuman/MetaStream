var mysql = require('mysql');
var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "videodatabase"
});
con.connect(function(err) {
  if (err) throw err;
  console.log("Connected!");
});
var arr = [['aerial','city','drone','building','buildings','top','view','urban'],
['aerial','crops','crop','fields','agriculture'],
['aerial','crops','crop','fields','agriculture'],
['aerial','city','drone','building','buildings','top','view','urban'],
['aeroplane','airplane','landing','airport','runway'],
['animal','fauna','meerkat','wildlife','life','wild','animals'],
['sea','beach','sand','aerial','water','ocean'],
['sea','beach','sand','aerial','water','ocean','coconut','tree'],
['animation','animated','bigben','ben','big','moon','time','lapse'],
['street','bike','ride','motor','cycle'],
['bird','birds','eating','nuts','animal','animals'],
['bird','sparrow','stream','puddle','drink','birds','animal','animals'],
['architecture','bridge','water','landscape'],
['flower','bud','leaf','blossom','time','lapse','flowers'],
['buddha','golden','gold','idol','god','buddhism'],
['buddha','golden','gold','idol','god','buddhism','sleeping','aerial','view'],
['buddha','golden','gold','idol','god','buddhism','sleeping','mountain'],
['ammunition','ammo','bullets','gun','pistol','guns','bullet'],
['animal','cat','cats','animals'],
['animal','cat','cats','tree','curios','animals'],
['animal','cat','cats','animals'],
['animal','cat','cats','animals'],
['code','monitor','javascript','java','html','coding','programming'],
['coffee','cup','pour','pouring','cups'],
['coffee','cup','pour','pouring','machine','vending','cups'],
['construction','machine','labour','crane'],
['construction','labour','machine','aerial','top','view'],
['cosmos','plasma','graphics','visual','effect','effects','graphic'],
['stopwatch','watch','ten','seconds','digital','time','second'],
['beach','couple','coconut','tree','trees','sea','water','walk'],
['cruise','ship','military','water'],
['boy','cycling','road','street','city'],
['dandelion','blossom','flower','bud','time','lapse','flowers'],
['desert','landscape','sand','earth'],
['digital','technology','draw','drawing','sketching','apple'],
['stunt','dirt','bike','aerial','view','drone'],
['dog','play','catch','ball','river','fun','animal','dogs','animals'],
['dog','play','animal','ball','dogs','animals'],
['dog','slow','motion','dogs'],
['earth','space','sun','india','planet','solar','system','celestial'],
['coffee','filter','pour'],
['aquarium','fish','fishes','water','animal','animals'],
['fish','aquatic','life','fishes','water','animals','animal'],
['fishes','ocean','sea','water','fish','under','animal','animals'],
['aerial','water','fly','view','river','lake'],
['fog','foggy','island','nature'],
['forest','wood','nature','tree','trees','woods'],
['couple','cycle','cycling','friend'],
['couple','cycle','cycling','friend'],
['glacier','train','express','aerial','view','transport'],
['gym','workout','work','exercise','exercize','trainer','weight','dumbbell'],
['time','hour','glass','hourglass','sand','bliss','stopwatch','watch'],
['humming','bird','fauna','fly','animal','animals'],
['humming','bird','slow','motion','slowmotion','flower','nectar','animal','animals'],
['intersection','aerial','view','road','city','buildings','urban'],
['race','kartracers','racers','racer','kart','track','racing'],
['lake','water','float'],
['leaves','wind'],
['fishes','lionfish','lion','aquarium','water','aqua','fish','animal','animals'],
['pistol','gun','load','bullets','bullet','arms','ammunition','ammo','guns'],
['london','tourism','bridge','tour','world','visit'],
['macro','gears','technology','clock','watch'],
['paper','draw','drawing','color','sketch','portrait'],
['matrix','animation','digital','green','text','code'],
['meeting','meetings','office','work','laptop','discussion','discuss','discussing'],
['mother','board','circuit','capacitor','chip','technology','chips','circuits'],
['mountains','clouds','nature','fog','hills','mountain'],
['wood','woods','forest','tour','walk','forests','trees','tree'],
['painting','brush','color','portrait','canvas'],
['peninsula','nature','sunset','sun','landscape','landscapes'],
['photo','studio','camera','capture','snap','photoshoot','shoot'],
['play','playing','dog','woman','happy','funny','animal','dogs','animals'],
['puppy','dog','beach','play','animal','dogs','animals'],
['mirror','puppy','dog','play','playing','funny','dogs','animal','animals'],
['pyramids','pyramid','eqypt','landscape','landscapes'],
['cam','camera','dashcam','rear','footage','car','travel','city'],
['technology','research','chemicals','experiment','conical','flask'],
['landscape','canyon','river','landscapes'],
['landscape','river','cliff','hill','mountain','waterfall','waterfalls','landscapes'],
['sea','waves','water','ocean'],
['seal','beach','animal','aquatic','marine','wildlife','animals'],
['pencil','sketch','draw','canvas','sketching','drawing','painting'],
['snail','small','tiny','slow','life','animals','animal'],
['snail','small','tiny','slow','animals','life','animal'],
['snake','animal','bush','snakes','plant','animals','animal'],
['landscape','mountain','snow','ice','glacier','landscapes'],
['space','shuttle','technology','science','rocket','launch','research','apollo','spacecraft','mission'],
['sea','surf','surfers','waves'],
['temple','devotion','devotional','sacred','temples'],
['timer','minute','one','seconds','second','sixty','60','digital','stopwatch','1'],
['tornado','nature','wind','calamity','calamities','disaster','natural'],
['city','traffic','light','road','night','roads'],
['car','vintage','forest','woods','journey','forests','trees','trip','tour'],
['waterfalls','water','fall','mountain','nature','landscape'],
['digital','welcome','hologram','graphics','technology','visual','effects'],
['white','tiger','whitetiger','animal','animals'],
['woman','carry','dog','animal','animals'],
['painting','paint','canvas','drawing','draw','art'],
['labour','machine','work','cutting','saw','cut','machines'],
['aerial','building','working','site','construction','view']
];
var sql = "TRUNCATE TABLE keywords;";
con.query(sql,function(err,result){
  if(err) throw err;
  console.log("Truncated");
  console.log("Now Inserting");
})
var id = 1;
for(var i=0;i<100;i++) {
    for(var j=0;j<arr[i].length;j++,id++) {
        var sql = "INSERT INTO keywords (id, videoid, keyword) VALUES ?";
        var values = [[id,i+1,arr[i][j]]];
        con.query(sql, [values], function (err, result) {
            if (err) throw err;
        });
    }
}