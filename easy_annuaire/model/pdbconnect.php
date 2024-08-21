<?php
try{
  $bdd = new PDO('mysql:host=localhost;dbname=easy_annuaire', 'root', '');
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // On émet une alerte à chaque fois qu'une requête a échoué.
  global $bdd; //On défini notre variable globale
}
//retourne un message d'erreur lorsqu'une
// exception est levée
catch (\Exception $e){
 echo $e->getMessage();
}