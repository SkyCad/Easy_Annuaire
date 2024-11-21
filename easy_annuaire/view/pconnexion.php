
<?php session_start();?>    
        <?php
        if(isset($_SESSION['user'])){  
            header("Location: paccueil.php");
        }
        else {
            ?>
            
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Connexion</title>
        <link rel="shortcut icon" type="icon" href="../assets/logo.png">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>

    <header class="header_connexion">
    <div class="header_container">
        <div class="logo">
            <img src="../assets/logo.png" alt="Logo">
        </div>
        <div class="modif_mdp">
            <h1>Connexion</h1>
        </div>
    </div>
</header>

<section class="section_connexion">
    <div class="container_form_connexion">
            <form action="../controller/pcontroller.php" method="POST" align="center">
            <div class="input">
                <span>Email</span>
                <input type="text" name="email" size="20" placeholder="Email" required>
            </div>
            <br>
            <div class="input">
                <span>Mot de Passe</span>
                <input type="password" name="psw" size="20" placeholder="Mot de passe" required>
            </div>
            <br>
            <div class="align">
                <a href="pinscription.php">Pas de compte?</a>
            </div>
            <br>

            <div class="align">
                <input type="submit" name="bconnexion" value="Se Connecter">
            </div>

            <br>
            <?php
            if(isset($_SESSION['Erreurco'])) {
                echo $_SESSION['Erreurco'];
            }
            ?>
            </form>
            </div>
</section>

<footer>
    <div class="footer_container">
        <div class="logo_copyright">
            <div class="logo">
                <img src="../assets/logo.png" alt="Logo">
            </div>
            <p>Copyright &copy 2024 EASYANNUAIRE</p>
        </div>

        <div class="form_contact">
            <div class="CTA">
                <h2>Nous Contacter :</h2>
            </div>
            
            <div class="mail_input">
                <form action="paccueil.php" method="post">
                    <input type="email" placeholder="Entrez votre Email">
                </form>
            </div>
        </div>

        <div class="media">
            <a href="#"><i class="fa-brands fa-facebook fa-2x"></i></a>
            <a href="#"><i class="fa-brands fa-instagram fa-2x"></i></a>
            <a href="#"><i class="fa-brands fa-x-twitter fa-2x"></i></a>
        </div>
    </div>
</footer>
</body>
</html>
<?php }?>