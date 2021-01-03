let data  = "";

 fetch('http://localhost:8888/nba2kode/?page=json')
  .then(function(response) {
    return response.json();
  })
  .then(function(myJson) {

    data=myJson
 console.log(data)
  });