<?php
  //les informations d'identification du base de données
  $host = 'localhost';
  $user = 'root';
  $pass = 'root';
  $db = 'nba2kode';
  //Créer une connexion à la base de données
  $conn = new mysqli($host, $user, $pass, $db);
  //Vérifier la connexion
  if ($conn->connect_errno) {
     print("Échec de la connexion à la base de données");
     exit();
  }
  //Récupérer les lignes de la table nba2kode
  $res = $conn->query("SELECT * FROM teams");
  $res1 = $conn->query("SELECT * FROM matches");
  //Initialiser un tableau
  $data = array();
  $data1 = array();
  //Récupérer les lignes
  while ( $row = $res->fetch_assoc())  {
     $data[] = $row;
  }
  while ( $row1 = $res1->fetch_assoc())  {
   $data1[] = $row1 ; 
}

  //Afficher le tableau au format JSON
  echo json_encode($data), "\n";
  echo json_encode($data1), "\n";

  //echo json_encode($data);
 
?>