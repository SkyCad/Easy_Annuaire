<?php
$token = isset($_GET['token']) ? $_GET['token'] : null;
if ($token === null) {
    die('Token manquant');
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Confirmation d'email</title>
    </head>
    <body>
        <h1>Merci pour votre inscription!</h1>
        <p>Veuillez confirmer votre inscription en cliquant sur le bouton ci-dessous.</p>
        <form method="post" action="../view/psucces.php">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
            <input type="submit" name="bconfirmationmail" value="Créer">
        </form>
    </body>
</html>