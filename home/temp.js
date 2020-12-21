const fs = require('fs');
const readline = require('readline');
const {google} = require('googleapis');
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

        // If modifying these scopes, delete token.json.
        const SCOPES = ['https://www.googleapis.com/auth/drive',
        'https://www.googleapis.com/auth/drive.appdata',
        'https://www.googleapis.com/auth/drive.file',
        'https://www.googleapis.com/auth/drive.metadata',
        'https://www.googleapis.com/auth/drive.metadata.readonly',
        'https://www.googleapis.com/auth/drive.photos.readonly',
        'https://www.googleapis.com/auth/drive.readonly',];
        // The file token.json stores the user's access and refresh tokens, and is
        // created automatically when the authorization flow completes for the first
        // time.
        const TOKEN_PATH = 'token.json';

        // Load client secrets from a local file.
        fs.readFile('credentials.json', (err, content) => {
            if (err) return console.log('Error loading client secret file:', err);
            // Authorize a client with credentials, then call the Google Drive API.
            authorize(JSON.parse(content), listFiles);
        });

        /**
         * Create an OAuth2 client with the given credentials, and then execute the
         * given callback function.
         * @param {Object} credentials The authorization client credentials.
         * @param {function} callback The callback to call with the authorized client.
         */
        function authorize(credentials, callback) {
            const {client_secret, client_id, redirect_uris} = credentials.installed;
            const oAuth2Client = new google.auth.OAuth2(
            client_id, client_secret, redirect_uris[0]);

        // Check if we have previously stored a token.
            fs.readFile(TOKEN_PATH, (err, token) => {
                if (err) return getAccessToken(oAuth2Client, callback);
                oAuth2Client.setCredentials(JSON.parse(token));
                callback(oAuth2Client);
            });
        }

            /**
             * Get and store new token after prompting for user authorization, and then
             * execute the given callback with the authorized OAuth2 client.
             * @param {google.auth.OAuth2} oAuth2Client The OAuth2 client to get token for.
             * @param {getEventsCallback} callback The callback for the authorized client.
             */
            function getAccessToken(oAuth2Client, callback) {
                const authUrl = oAuth2Client.generateAuthUrl({
                access_type: 'offline',
                scope: SCOPES,
            });
            console.log('Authorize this app by visiting this url:', authUrl);
            const rl = readline.createInterface({
                input: process.stdin,
                output: process.stdout,
            });
            rl.question('Enter the code from that page here: ', (code) => {
                rl.close();
                oAuth2Client.getToken(code, (err, token) => {
                if (err) return console.error('Error retrieving access token', err);
                oAuth2Client.setCredentials(token);
                // Store the token to disk for later program executions
                fs.writeFile(TOKEN_PATH, JSON.stringify(token), (err) => {
                    if (err) return console.error(err);
                    console.log('Token stored to', TOKEN_PATH);
                });
                callback(oAuth2Client);
                });
            });
            }

            /**
             * Lists the names and IDs of up to 10 files.
             * @param {google.auth.OAuth2} auth An authorized OAuth2 client.
             */
            function listFiles(auth) {
            const drive = google.drive({version: 'v3', auth});
            drive.files.list({
                pageSize: 1000,
                fields: 'nextPageToken, files(id, name, hasThumbnail, webViewLink, iconLink, videoMediaMetadata)',
                orderBy: 'name',
            }, (err, res) => {
                if (err) return console.log('The API returned an error: ' + err);
                const files = res.data.files;
                if (files.length) {
                var source = "https://drive.google.com/uc?export=view&id=";
                var videoPrefix = "https://drive.google.com/file/d/";
                var videoSuffix = "/preview";
                var videofileid = "";
                var API_KEY = "AIzaSyBvDCj5zb5wC_55v9ir7mToce5zIN3j61M";
                var header = "https://www.googleapis.com/drive/v3/files/";
                var footer = "?alt=media&key=";
                var fileName = "";
                var fileid = "";
                var ind = 0;
                var count = 0;
                var thumb = "";
                var views = 0;
                var downloads = 0;
                var likes = 0;
                var dislikes = 0;
                var sql = "TRUNCATE TABLE video;";
                con.query(sql,function(err,result){
                    if(err) throw err;
                    console.log("Truncated");
                });
                files.map((file) => {
                    var nameOfFile = file.name;
                    if(nameOfFile.includes(".mp4")) {
                        fileName = file.name;
                        fileid = videoPrefix +  file.id + videoSuffix;
                        videofileid = file.id;
                        // console.log(file.webViewLink);
                    }
                    else if(nameOfFile.includes("_thumb.png")) {
                        thumb = source + file.id;
                        var dlink = header + videofileid + footer + API_KEY;
                        var sql = "INSERT INTO video (filename, fileid, thumbnail, downloadlink, views, downloads, likes, dislikes) VALUES ?";
                        var values = [[fileName, fileid, thumb, dlink, views, downloads, likes, dislikes]];
                        con.query(sql, [values], function (err, result) {
                            if (err) throw err;
                            // console.log(file.name);
                            count++;
                        });
                        // console.log(ind);
                    }
                    console.log(file.name);
                });
                } else {
                console.log('No files found.');
                }
                // console.log(count);
            });
        }