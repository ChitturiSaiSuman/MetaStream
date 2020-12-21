var Nature = [2,3,14,33,47,48,49,58,68,91,93];
var Animal = [6,11,12,19,20,21,22,37,38,39,42,43,44,53,54,59,72,73,74,81,83,84,85,96,97];
var Technology = [23,25,29,35,62,64,65,66,71,77,90,95];
var Architecture = [1,4,9,13,15,16,17,26,27,55,75,89,100];
var landscape = [7,8,30,34,46,57,67,70,78,79,80,86,94];
var Others = [5, 10, 18, 24, 28, 31, 32, 36, 40, 41, 45, 50, 51, 52, 56, 60, 61, 63, 69, 76, 82, 87, 88, 92, 98, 99];
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
var sql = "TRUNCATE TABLE category;";
con.query(sql,function(err,result) {
    if(err) throw err;
    console.log("Truncated");
})
var id = 1;
for(var i = 0; i< Nature.length;i++) {
    var sql = "INSERT INTO category (id, videoid, category) VALUES ?";
    var values = [[id,Nature[i],"nature"]];
    con.query(sql, [values], function (err, result) {
        if (err) throw err;
    });
    id++;
}
for(var i=0;i<Architecture.length;i++) {
    var sql = "INSERT INTO category (id, videoid, category) VALUES ?";
    var values = [[id,Architecture[i],"architecture"]];
    con.query(sql, [values], function (err, result) {
        if (err) throw err;
    });
    id++;
}
for(var i =0; i<Animal.length;i++) {
    var sql = "INSERT INTO category (id, videoid, category) VALUES ?";
    var values = [[id,Animal[i],"animal"]];
    con.query(sql, [values], function (err, result) {
        if (err) throw err;
    });
    id++;
}
for(var i =0 ;i<Technology.length;i++) {
    var sql = "INSERT INTO category (id, videoid, category) VALUES ?";
    var values = [[id,Technology[i],"technology"]];
    con.query(sql, [values], function (err, result) {
        if (err) throw err;
    });
    id++;
}
for(var i =0;i<landscape.length;i++) {
    var sql = "INSERT INTO category (id, videoid, category) VALUES ?";
    var values = [[id,landscape[i],"landscape"]];
    con.query(sql, [values], function (err, result) {
        if (err) throw err;
    });
    id++;
}
for(var i =0;i<Others.length;i++) {
    var sql = "INSERT INTO category (id, videoid, category) VALUES ?";
    var values = [[id,Others[i],"others"]];
    con.query(sql, [values], function (err, result) {
        if (err) throw err;
    });
    id++;
}