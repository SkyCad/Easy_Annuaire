<?php
session_start();
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Ajout Contact</title>
        <link rel="shortcut icon" type="icon" href="../assets/logo.png">
        <script src="../js/sidebar.js"></script>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>

<header class="primary_header">
    <div class="header_container">
        <div class="deco">
                <form action="pdeco.php" method="POST">
                        <input type="submit" name="bConnexion" value="Deconnexion">
                </form>
            </div>

        <div class="modif_mdp">
            <h3>Ajout Contacte</h3>
        </div>

        <div class="user_icon_btn">
            <a href="pprofil.php"><i class="fa-solid fa-user fa-2x"></i></a>
        </div>

        <div class="bars_btn" onclick="sidebar()">
           <a href="#"><i class="fa-solid fa-bars fa-2x" style="color: var(--clr-white)"></i></a>
        </div>
    </div>
</header>

<div id="sidebar">
        <div class="off" onclick="sidebar()">
            <a href="paccueil.php"><i class="fa-solid fa-xmark"></i></a>
        </div>
        <nav>
            <ul>
                <li><a href="paccueil.php">Accueil</a></li>
                <li><span>|</span></li>
                <li><a href="pmodifmdp.php">Modifier mon Profil</a></li>
                <li><span>|</span></li>
                <li><a href="pcontact_create.php">ajouter un contacte</a></li>
            </ul>
        </nav>
    </div>

<section class="section_contact_create">
    <div class="container_form_create_contact">
        <form action="../controller/pcontroller.php" method="post">
        <input type="hidden" name="users_id" value="<?php echo $user_id; ?>">
            <span>Contact Mail</span>
            <div class="contact_input">
                <input type="email" name="contact_mail" id="contact_mail" placeholder="mail du contact">
            </div>
            <span>Nom Contact</span>
            <div class="contact_input">
                <input type="text" name="contact_name" id="contact_name" placeholder="Nom du contact">
            </div>
            <span>Prénom Contact</span>
            <div class="contact_input">
                <input type="text" name="contact_firstname" id="contact_firstname" placeholder="Prénom du contact">
            </div>

            <span>Numéro Téléphone Contact</span>
            <div class="contact_input">
                <input type="tel" name="contact_phone" id="contact_phone" placeholder="Numéro de téléphone du contact">
            </div>
            <span>deuxième Numéro Téléphone Contact</span>
            <div class="contact_input">
                <input type="tel" name="contact_phone2" id="contact_phone" placeholder="Numéro de téléphone du contact">
            </div>
            <span>Adresse Contact</span>
            <div class="contact_input">
                <input type="text" name="contact_adress" id="contact_adress" placeholder="Adresse du contact">
            </div>

            <input type="submit" name="bcontactcreate" value="Ajouter Contact">
        </form>
    </div>
</section>
<footer>
    <div class="footer_container">
        <div class="logo_copyright">
            <div class="logo">
                <a href="paccueil.php"><img src="../assets/logo.png" alt="Logo"></a>
            </div>
            <p>Copyright &copy 2024 EASYANNUAIRE</p>
        </div>

        <div class="form_contact">
            <div class="CTA">
                <h2>Nous Contacter :</h2>
            </div>
            
            <div class="mail_input">
                <input type="email" placeholder="Entrez votre Email">
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