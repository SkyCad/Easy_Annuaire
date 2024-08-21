<?php
require("../model/pmodel.php");

if (isset($_POST['bconfirmationmail'])) {
    $token = htmlspecialchars($_POST['token']);
    if (verifyConfirmationToken($token)) {
        echo "Email confirmé avec succès!";
        // Rediriger vers une page de succès ou la page de connexion
        header("Location: ../view/pconnexion.php");
        exit();
    } else {
        echo "Token invalide ou expiré.";
        var_dump($token);
    }
} else {
    echo "Token non fourni.";
}
?>