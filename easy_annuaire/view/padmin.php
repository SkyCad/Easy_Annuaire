<link rel="stylesheet" href="../css/style.css">
<header class="header_connexion">
        <div class="header_container">
            <div class="logo">
                <img src="../assets/logo.png" alt="Logo">
            </div>
            <div class="modif_mdp">
                <h1>Page Admin</h1>
            </div>
            <div class="bars_btn">
                <a href="#"><i class="fa-solid fa-bars fa-2x" style="color: var(--clr-white)"></i></a>
            </div>
        </div>
    </header>
<?php
require("../model/pmodel.php");
session_start();
unset($_SESSION['program_id']);
if($_SESSION['user']['role']==1){
    ?>
    <body class="admin_body">
    <link rel="stylesheet" href="../css/style.css">
    <a href="paccueil.php">Retour accueil</a>
    <form action="pdeco.php" method="POST">
        <input type="submit" name="bConnexion" value="Deconnexion">
    </form>
    <div class="admin_container">
        <div class="admin_liste_user">
            <h2 class="admin_secondary_title">Liste Utilisateurs Inscris</h2>
            <!-- faudra remplacer ici par les utilisateurs en bdd -->
             <?php
            $membres = affichermembres();
            if (!empty($membres)) {
                echo "<ul>";
                // On parcours les membres et on affiche
                foreach ($membres as $membre) {
                    echo "<li>" . htmlspecialchars($membre['firstname']);
                    echo '<div style="background-image:none; height:30px;"><a href="pinfo.php?id=' . $membre['users_id'] . '">Voir les infos perso</a></div>';
                    ?>
                    <form action="../controller/pcontroller.php" method="POST" >
                        <?PHP
                        echo "<input type='hidden' name='delete_user_id' value='" . $membre['users_id'] . "'>";
                        ?>
                        <input type="submit" name="bSuppmembre" value="Supprimer">
                    </form>

                    <?php
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>Aucun membre trouvé.</p>";
            }
            ?>
        </div>
        <div class="admin_creation_contact">
    <div class="admin_contact_form">
    <h2 class="admin_secondary_title">Ajouter un membre</h2>
        <form action="../controller/pcontroller.php" method="POST">
            <input type="text" name="name" size="20" placeholder="Nom" required autofocus>
            <br>
            <input type="text" name="firstname" size="20" placeholder="Prénom" required>
            <br>
            <input type="text" name="email" size="20" placeholder="Email" required>
            <br>
            <input type="text" name="cemail" size="20" placeholder="Confirmation Email" required>
            <br>
            <input type="password" name="psw" size="20" placeholder="Mot de passe" required>
            <br>
            <input type="password" name="cpsw" size="20" placeholder="Confirmation mot de passe" required>
            <br>
            <p>Date de naissance</p>
            <input type="date" name="date_n" size="20" placeholder="Date de naissance" required>
            <br>

            <input type="submit" name="binscriptionmembre" value="Ajouter">
            <br>
            <?php
            if (isset($_SESSION['Erreurin'])) {
                echo $_SESSION['Erreurin'];
                unset($_SESSION['Erreurin']); // Nettoyer le message après l'affichage
            }
            if (isset($_SESSION['SuccessMessage'])) {
                echo $_SESSION['SuccessMessage'];
                unset($_SESSION['SuccessMessage']); // Nettoyer le message après l'affichage
            }
            ?>
        </form>
    <?php
        if (isset($_SESSION['success_message'])) {
            echo '<p class="success-message" style="color: green;">' . $_SESSION['success_message'] . '</p>';
            unset($_SESSION['success_message']); // Détruire le message de succès après l'avoir affiché
        }
    ?>
        </div>
    </div>
</div>      
    <script>
            // Sélectionnez l'élément de message de succès
            const successMessage = document.querySelector('.success-message');
            const successMessage2 = document.querySelector('.success-message2');
            // Afficher le message de succès
            if (successMessage) {
                successMessage.style.display = 'block'; // Afficher le message

                // Effacer le message après 3 secondes
                setTimeout(() => {
                    successMessage.style.display = 'none'; // Masquer le message
                }, 3000); // 3000 millisecondes = 3 secondes
            }
            if (successMessage2) {
                successMessage2.style.display = 'block'; // Afficher le message

                // Effacer le message après 3 secondes
                setTimeout(() => {
                    successMessage2.style.display = 'none'; // Masquer le message
                }, 3000); // 3000 millisecondes = 3 secondes
            }
    </script>
        </div>
    <footer>
    </body>
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
    <?php
}else{
    header("Location: ../view/paccueil.php");
}
?>