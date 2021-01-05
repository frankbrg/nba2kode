
import express from 'express'
const mysql = require('mysql')

let json:Array<JSON>;

const request = require('request');

let url = "http://localhost:8888/nba2kode/PHP/?page=json";

let options = {json: true};

request(url, options, (error, res, body) => {
    if (error) {
        return  console.log(error)
    };

    if (!error && res.statusCode == 200) {
        //json=JSON.parse(body)
        //json=body
        //console.log(body)
        json = JSON.parse(JSON.stringify(body))
    };
});

const app = express()
const port = 3000

app.get('/',(req,res) => {
    let x ="";
    for (var i=0; i<json.length;i++) {
        x += "<h1>" + json[i]+ "</h1>" + json[i];
        }
    console.log(json)
    res.send(json);
    //res.send('<body> <h1>Ajouter une equipe</h1> <form method="post" action="ajouter_equipe.php"> <br> <label>Nom de l equipe</label> <input type="text" name="teams_name"> <label>Ville</label> <input type="text" name="teams_city"> <input type="submit" value="Ajouter"> </form> </body>')
})

  app.listen(port, () => {
    console.log("ca marche");
  });
