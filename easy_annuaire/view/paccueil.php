
<?php
    session_start();
    if(isset($_SESSION['user'])){  
        if ($_SESSION['user']['role'] == 1) { //si l'user à le role 1 (admin) on affiche
            echo '<div><a href="padmin.php">Page admin</a></div>';
        }
        ?>
        
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Accueil</title>
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
        
            <div class="logo">
                <a href="paccueil.php"><img src="../assets/logo.png" alt="Logo"></a>
            </div>

            <div class="user_icon_btn">
                <a href="pprofil.php"><i class="fa-solid fa-user fa-2x"></i></a>
            </div>

            <div class="bars_btn" onclick="sidebar()">
            <a href="#"><i class="fa-solid fa-bars fa-2x" style="color: var(--clr-white)"></i></a>
            </div>
        </div>
    </header>

<section class="section_one">
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

    <div class="section_one_container">

        <div class="big_image_container">
            <img src="../assets/image_1.jpg" alt="annuaire">
        </div>    

        <div class="text_h1">
            <h1>Vos contacts en un clic.</h1>
            <h1>Trouvez rapidement</h1>
            <h1>ceux qui comptent pour vous</h1>
        </div>
        <div></div>
    </div>
</section>

<section class="section_three">
    <div class="section_three_container"> 
        <div class="create_contact_container">
            <a href="pcontact_create.php">
                <div class="create_contact">
                <h2>Votre répèrtoire personnel</h2>
                </div>
            </a>
            
        </div>

        <div class="choix_contact">
            <div class="contact_param">
                <div>
                    <p>Ajoutez vos contactes facilement.</p>
                </div>
            </div>

            <div class="contact_param">
                <div>
                    <p>Retrouvez rapidement les numéros de vos proches.</p>
                </div>
            </div>
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
            <div>
                <p>Copyright &copy 2024 EASYANNUAIRE</p>
            </div>

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
    }else{
        ?>
        <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Accueil</title>
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
        
            <div class="logo">
                <a href="paccueil.php"><img src="../assets/logo.png" alt="Logo"></a>
            </div>

            <div class="user_icon_btn">
                <a href="pprofil.php"><i class="fa-solid fa-user fa-2x"></i></a>
            </div>

            <div class="bars_btn" onclick="sidebar()">
            <a href="#"><i class="fa-solid fa-bars fa-2x" style="color: var(--clr-white)"></i></a>
            </div>
        </div>
    </header>

<section class="section_one">
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

    <div class="section_one_container">

        <div class="big_image_container">
            <img src="../assets/image_1.jpg" alt="annuaire">
        </div>    

        <div class="text_h1">
            <h1>Vos contacts en un clic.</h1>
            <h1>Trouvez rapidement</h1>
            <h1>ceux qui comptent pour vous</h1>
        </div>
        <div></div>
    </div>
</section>

<section class="section_three">
    <div class="section_three_container"> 
        <div class="create_contact_container">
            <a href="contact_create.php">
                <div class="create_contact">
                <h2>Votre répèrtoire personnel</h2>
                </div>
            </a>
            
        </div>

        <div class="choix_contact">
            <div class="contact_param">
                <div>
                    <p>Ajoutez vos contactes facilement.</p>
                </div>
            </div>

            <div class="contact_param">
                <div>
                    <p>Retrouvez rapidement les numéros de vos proches.</p>
                </div>
            </div>
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
            <div>
                <p>Copyright &copy 2024 EASYANNUAIRE</p>
            </div>

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
    }
?>



    
   
