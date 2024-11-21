<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Inscription</title>
        <link rel="shortcut icon" type="icon" href="../assets/logo.png">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
    <?php session_start();?>
    <header class="header_inscription">
    <div class="header_container">
        <div class="logo">
            <img src="../assets/logo.png" alt="Logo">
        </div>

        <div class="modif_mdp">
            <h1>Inscription</h1>
        </div>
</header>
<section class="section_inscription">
    <div class="container_form_inscription">
        <form action="../controller/pcontroller.php" method="POST">
            <div class="input">
                <span>Nom</span>
                <input type="text" name="name" size="20" placeholder="Nom" required autofocus>
            </div>
            <br>

            <div class="input">
                <span>Prénom</span>
                <input type="text" name="firstname" size="20" placeholder="Prénom" required>
            </div>
            <br>

            <div class="input">
                <span>Email</span>
                <input type="text" name="email" size="20" placeholder="Email" required>
            </div>
            <br>

            <div class="input">
                <span>Confirmation Email</span>
                <input type="text" name="cemail" size="20" placeholder="Confirmation Email" required>
            </div>
            <br>

            <div class="input">
                Mot de Passe
                <input type="password" name="psw" size="20" placeholder="Mot de passe" required>
            </div>
            <br>

            <div class="input">
                <span>Confirmation Mot de Passe</span>
                <input type="password" name="cpsw" size="20" placeholder="Confirmation mot de passe" required>
            </div>
            <br>

            <div class="input">
                <label for="">Date de naissance</label>
                <br>
                <input type="date" name="date_n" size="20" placeholder="Date de naissance" required>
            </div>
            <br>

            <div class="align">
                <input type="submit" name="binscription" value="S'inscrire">
            </div>

            <div class="align">
                <a href="pconnexion.php">Déjà Inscris ?</a>
            </div>

            <?php
            if(isset($_SESSION['Erreurin'])) {
                echo $_SESSION['Erreurin'];
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