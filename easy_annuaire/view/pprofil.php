<?php
require("../model/pmodel.php");
session_start();
if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user_id'];
    $infos = recupinfo($user_id);
    $contactinfo = recupcontact($user_id);
    $date_naissance = new DateTime($infos[0]['birthdate']);
    $date_actuelle = new DateTime();
    $diff = $date_actuelle->diff($date_naissance);
    $age = $diff->y;
        ?> 
    </div>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            <title>Votre Profil</title>
            <link rel="shortcut icon" type="icon" href="../assets/logo.png">
            <script src="../js/sidebar.js"></script>
            <link rel="stylesheet" href="../css/style.css">
        </head>
        <body>
            <header>
                <div class="header_profil">
                    <div class="deco">
                        <form action="pdeco.php" method="POST">
                            <input type="submit" name="bConnexion" value="Deconnexion">
                        </form>
                    </div>

                    <div class="logo">
                        <a href="paccueil.php"><img src="../assets/logo.png" alt="Logo"></a>
                    </div>
                    
                    <div class="bars_btn" onclick="sidebar()">
                       <a href="#"><i class="fa-solid fa-bars fa-2x" style="color: var(--clr-white)"></i></a>
                    </div>
                </div>
            </header>

            <section class="section_profil">
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
            
                <div class="profil_container">
                    <div class="profil_infos">
                        <div class="infos">
                            <p>Nom : <?php echo htmlspecialchars($infos[0]['name']); ?></p>
                            <p>Prénom : <?php echo htmlspecialchars($infos[0]['firstname']); ?></p>
                            <p>Email: <?php echo htmlspecialchars($infos[0]['email']); ?></p>
                            <p>Date de Naissance : <?php echo htmlspecialchars($infos[0]['birthdate']); ?></p>
                            <a href="pmodifmdp.php">Modifier Profil</a>
                        </div>
                    </div>
                
                    <div class="contact_list">
                        <h2>Vos Contacts</h2>
                            <div class="contact">
                                <div class="contact_infos">
                                    <?php

                                    if (!empty($contactinfo) && is_array($contactinfo) && isset($contactinfo[0]['contact_name'])) { ?>
                                        <p>Nom : <?php echo htmlspecialchars($contactinfo[0]['contact_name']); ?></p>
                                        <p>Prénom : <?php echo htmlspecialchars($contactinfo[0]['contact_firstname']); ?></p>
                                        <p>Email : <?php echo htmlspecialchars($contactinfo[0]['contact_mail']); ?></p>
                                        <p>Numéro de téléphone : <?php echo htmlspecialchars($contactinfo[0]['contact_phone']); ?></p>
                                        <p>Deuxième Numéro : <?php echo htmlspecialchars($contactinfo[0]['contact_phone2']); ?></p>
                                        <p>Adresse : <?php echo htmlspecialchars($contactinfo[0]['contact_adress']); ?></p>
                                    <?php } else { ?>
                                        <p>Nom : Aucun contact</p>
                                        <p>Prénom : Aucun contact</p>
                                        <p>Email : Aucun contact</p>
                                        <p>Numéro de téléphone : Aucun contact</p>
                                        <p>Deuxième Numéro : Aucun contact</p>
                                        <p>Adresse : Aucun contact</p>
                                    <?php } ?>
                                </div>
                            </div>
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
            <?php
} else {
    header("Location: pconnexion.php");
}
?>