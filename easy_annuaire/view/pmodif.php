<?php 
require("../model/pmodel.php");
session_start();
if(isset($_SESSION['user'])){  
    ?>
    <h2>Modification du profil</h2>
    <form action="../controller/pcontroller.php" method="POST">
        <input type="text" name="name" size="20" placeholder="Nom"  autofocus>
        <br>
        <input type="text" name="firstname" size="20" placeholder="Prénom" >
        <br>
        <input type="text" name="email" size="20" placeholder="Email" >
        <br>
        <label for="">Date de naissance</label>
        <br>
        <input type="date" name="date_n" size="20" placeholder="Date de naissance" >
        <br>
        <input type="submit" name="bmodif" value="Modification">
        <br>
        </form>
        <a href="pmodifpsw">Modifier le mot de passe</a>
        <br>
    <a href="pprofil.php">retour au profil</a>
    <br><br>
    <form action="pdeco.php" method="POST">
        <input type="submit" name="bConnexion" value="Deconnexion">
    </form>
    <?php
}else{
    header("Location: pconnexion.php");
}

?>