<?php
require("../model/pmodel.php");
session_start();
                
if ($_SESSION['user']['role'] == 1) {
    echo '<div ><a href="padmin.php">Page admin</a></div>';
}

?>
<form action="pdeco.php" method="POST">
    <input type="submit" name="bConnexion" value="Deconnexion">
</form>
<div class="sous_main"> 
    <div class="section1">

        <h2>Info personnel</h2>
        <?php
        //On récupère l'id via l'url pour afficher les informations propre à chaque user
        if (isset($_GET['id'])) {
            $user_id = $_GET['id'];
            $user_info = afficherInfosComplet($user_id);
            if ($user_info) {
                echo "<p>User_id : " . htmlspecialchars($user_info['users_id']) . "</p>";
                echo "<p>Email : " . htmlspecialchars($user_info['email']) . "</p>";
                echo "<p>Nom : " . htmlspecialchars($user_info['name']) . "</p>";
                echo "<p>Prénom : " . htmlspecialchars($user_info['firstname']) . "</p>";
            } else {
                echo "<p>Aucun utilisateur trouvé.</p>";
            }
        } else {
            echo "<p>ID utilisateur non spécifié.</p>";
        }

        ?>
        
        <h2>Modifier user</h2>     
        <form action="../controller/pcontroller.php" method="POST">
        <input type="hidden" name="user_id" value="<?php echo intval($_GET['id']); ?>">
        <input type="text" name="name" size="20" placeholder="Nom"  autofocus>
        <br>
        <input type="text" name="firstname" size="20" placeholder="Prénom" >
        <br>
        <input type="text" name="email" size="20" placeholder="Email" >
        <br>
        <input type="submit" name="bmodifuser" value="Modification">
        <br>
        </form>

    </div>
</div>
<?php
