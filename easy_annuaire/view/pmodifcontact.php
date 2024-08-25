<?php 
require("../model/pmodel.php");
session_start();
if(isset($_SESSION['user'])){
    $user_id = $_SESSION['user_id'];
    $contacts = recupcontact($user_id);
    if (!empty($contacts)) {
        // Get the contact_id from the URL
        $contact_id = isset($_GET['contact_id']) ? intval($_GET['contact_id']) : null;
        $contact = null;

        // Find the contact with the given contact_id
        if ($contact_id !== null) {
            foreach ($contacts as $c) {
                if ($c['contacts_id'] == $contact_id) {
                    $contact = $c;
                    break;
                }
            }
        }

        // If no contact is found with the given contact_id, use the first contact
        if ($contact === null) {
            $contact = $contacts[0];
            $contact_id = $contact['contacts_id'];
        }
    } else {
        // Handle the case where no contacts are found
        die("No contacts found for this user.");
    }
    ?>
    <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Modification de Profil</title>
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
            <h3>Modification Contact</h3>
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
            <a href="#"><i class="fa-solid fa-xmark"></i></a>
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

<section class="section_modif_mdp">
    <div class="container_form_modifmdp">
        <form action="../controller/pcontroller.php" method="POST">
            <input type="hidden" name="users_id" value="<?php echo $_SESSION['user_id'] ?>">
            <input type="hidden" name="contact_id" value="<?php echo $contact_id; ?>">
            <span>Nouveau nom</span>
            <div class="mdp_input">
                <input type="text" name="contact_name" placeholder="Nom" autofocus>
            </div>

            <span>Nouveau prénom</span>
            <div class="mdp_input">
                <input type="text" name="contact_firstname" placeholder="Prénom">
            </div>
            <span>Nouveau mail</span>
            <div class="mdp_input">
                <input type="text" name="contact_mail" placeholder="Email">
            </div>
            <span>Premier numéro</span>
            <div class="mdp_input">
                <input type="text" name="contact_phone" placeholder="Numéro de téléphone">
            </div>
            <span>Deuxième numéro</span>
            <div class="mdp_input">
                <input type="text" name="contact_phone2" placeholder="Deuxième numéro">
            </div>
            <span>Adresse</span>
            <div class="mdp_input">
                <input type="text" name="contact_adress" placeholder="Adresse">
            </div>
            <input type="submit" name="bmodifcontact" value="Modifier contact">
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
    <?php
}else{
    header("Location: pconnexion.php");
}

?>
