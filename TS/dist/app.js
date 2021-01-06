"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = __importDefault(require("express"));
const mysql = require('mysql');
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'root',
    database: 'nba2kode',
    port: 8889
});
let json;
const request = require('request');
let url = "http://localhost:8888/nba2kode/PHP/?page=json";
let options = { json: true };
request(url, options, (error, res, body) => {
    if (error) {
        return console.log(error);
    }
    ;
    if (!error && res.statusCode == 200) {
        //json=JSON.parse(body)
        //json=body
        //console.log(body)
        json = JSON.parse(JSON.stringify(body));
        console.log(typeof (json));
    }
    ;
});
const app = express_1.default();
const port = 3000;
app.get('/', (req, res) => {
    let x = "";
    for (var i = 0; i < json.length; i++) {
        x += "<h1>" + json[i]['teams_name'] + "</h1>" + json[i]['teams_city'];
        console.log(json[i]);
    }
    console.log(json);
    res.send(x + '<body> <h1>Ajouter une equipe</h1> <form method="post" id="myform" action="localhost:3000/add/"> <br> <label>Nom de l equipe</label> <input type="text" name="teams_name"> <label>Ville</label> <input type="text" name="teams_city"> <input type="submit" value="Ajouter"> </form> </body>');
    //res.send('<body> <h1>Ajouter une equipe</h1> <form method="post" action="ajouter_equipe.php"> <br> <label>Nom de l equipe</label> <input type="text" name="teams_name"> <label>Ville</label> <input type="text" name="teams_city"> <input type="submit" value="Ajouter"> </form> </body>')
});
app.get('/add/:nom/:ville', (req, res) => {
    let data = { teams_name: req.params.nom, teams_city: req.params.ville };
    let sql = 'Insert into teams SET ?';
    let query = db.query(sql, data, (err, result) => {
        if (err)
            throw err;
        return res.send(result);
    });
});
app.listen(port, () => {
    console.log("ca marche");
});
//# sourceMappingURL=app.js.map