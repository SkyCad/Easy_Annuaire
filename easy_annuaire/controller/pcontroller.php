<?php
session_start();
require("../model/pmodel.php");
$error_code = "";
$error_code2 = "";
if(isset($_POST['binscription'])){
    $name = htmlspecialchars(strtolower(trim($_POST['name'])));
    $first_name = htmlspecialchars(trim($_POST['firstname']));
    $email = htmlspecialchars(trim($_POST['email']));
    $cemail = htmlspecialchars(strtolower(trim($_POST['cemail'])));
    $psw = htmlspecialchars(trim($_POST['psw']));
    $cpsw = htmlspecialchars(trim($_POST['cpsw']));
    $date_n = htmlspecialchars(trim($_POST['date_n']));
    $timestamp_inscription = date("Y-m-d H:i:s");

    if(!preg_match('/\d/', $psw)) { 
        $error_code = "err_chiffre";
    }
    elseif (strlen($psw) < 12) {
        $error_code = "err_petit";
    }
    elseif($email!=$cemail || $psw!=$cpsw){
        $error_code = "err_confirm";
    }
    elseif(emailExists($email)==true){ 
        $error_code = "err_exist";
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_code = "err_validate";
    }

    switch ($error_code) {
        case "err_chiffre":
            $_SESSION['Erreurin'] = "Le mot de passe doit contenir au moins un chiffre." ;
            header("Location: ../view/pinscription.php");
            break;
        case "err_petit":
            $_SESSION['Erreurin'] = "Mot de passe trop court" ;
            header("Location: ../view/pinscription.php");
            break;
        case "err_confirm":
            $_SESSION['Erreurin'] = "Confirmation incorrecte" ;
            header("Location: ../view/pinscription.php");
            break;
        case "err_exist":
            $_SESSION['Erreurin'] = "Votre compte existe déjà" ;
            header("Location: ../view/pinscription.php");
            break;
        case "err_validate":
            $_SESSION['Erreurin'] = "L'adresse email n'est pas valide." ;
            header("Location: ../view/pinscription.php");
            break;
        default:
            session_destroy();
            $psw = password_hash($psw, PASSWORD_DEFAULT);
            inscription_db($name, $first_name, $email, $psw, $date_n, $timestamp_inscription);
            $token = generateConfirmationToken();
            saveConfirmationToken($email, $token);
            sendConfirmationEmail($email, $token);
            header("Location: ../view/pconfirmation.php");
            break;
    }
}
function sendConfirmationEmail($email, $token) {
    $confirmationLink = "http://votresite.com/confirm.php?token=" . $token;
    $subject = 'Confirmation de votre adresse email';
    $message = 'Merci de confirmer votre adresse email en cliquant sur le lien suivant : ' . $confirmationLink;
    $headers = 'From: test@easyannuaire.com' . "\r\n" .
               'Reply-To: test@easyannuaire.com' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();
    
    mail($email, $subject, $message, $headers);
}
if(isset($_POST['bconnexion'])){
    $email = htmlspecialchars(strtolower(trim($_POST['email'])));
    $psw = htmlspecialchars(trim($_POST['psw']));
    if (login($email, $psw)) {
        $_SESSION['firstname'] = get_firstname($email);
        header("Location: ../view/paccueil.php");
        exit();
    } else {
        $_SESSION['Erreurco'] = "Nom d'utilisateur ou mot de passe incorrect.";
        header("Location: ../view/pconnexion.php");
        exit();
    }
}
if(isset($_POST['bmodif'])){
    if(isset($_SESSION['user'])){  
        $user_id = $_SESSION['user_id'];
        $new_name = !empty($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : null;
        $new_firstname = !empty($_POST['firstname']) ? htmlspecialchars(trim($_POST['firstname'])) : null;
        $new_email = !empty($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : null;
        $new_date_n = !empty($_POST['date_n']) ? htmlspecialchars(trim($_POST['date_n'])) : null;
        $new_psw = !empty($_POST['psw']) ? htmlspecialchars(trim($_POST['psw'])) : null;
        $new_cpsw = !empty($_POST['cpsw']) ? htmlspecialchars(trim($_POST['cpsw'])) : null;
        $error_code2 = null;

        if ($new_psw !== null) {
            if (!preg_match('/\d/', $new_psw)) { 
                $error_code2 = "err_chiffre";
            } elseif (strlen($new_psw) < 12) {
                $error_code2 = "err_petit";
            }elseif( $new_psw!=$new_cpsw){
                $error_code2 = "err_confirm";
            }
        }

        switch ($error_code2) {
            case "err_chiffre":
                $_SESSION['Erreurpsw'] = "Le mot de passe doit contenir au moins un chiffre.";
                header("Location: ../view/pmodifpsw.php");
                exit(); 
            case "err_petit":
                $_SESSION['Erreurpsw'] = "Mot de passe trop court.";
                header("Location: ../view/pmodifpsw.php");
                exit(); 
            case "err_confirm":
                $_SESSION['Erreurpsw'] = "Confirmation incorrecte";
                header("Location: ../view/pmodifpsw.php");
                exit(); 
            default:
                if ($new_psw !== null) {
                    // Hacher le mot de passe avant de le stocker
                    $new_psw = password_hash($new_psw, PASSWORD_DEFAULT);
                }
                if ($new_name !== null || $new_firstname !== null || $new_email !== null || $new_date_n !== null || $new_gender !== null || $new_psw !== null) {
                    // Si au moins 1 champ est modifié
                    update_profile($user_id, $new_name, $new_firstname, $new_email, $new_date_n, $new_psw);
                }
                header("Location: ../view/pprofil.php");
                exit(); 
        }
        
    } else {
        header("Location: ../view/pconnexion.php");
    }
}

if(isset($_POST['bcontactcreate'])){
    $user_id = htmlspecialchars(strtolower(trim($_POST['user_id'])));
    $contact_mail = htmlspecialchars(strtolower(trim($_POST['contact_mail'])));
    $contact_name = htmlspecialchars(trim($_POST['contact_name']));
    $contact_firstname = htmlspecialchars(trim($_POST['contact_firstname']));
    $contact_phone = htmlspecialchars(trim($_POST['contact_phone']));
    $contact_phone_2 = htmlspecialchars(trim($_POST['contact_phone_2']));
    $contact_adress = htmlspecialchars(trim($_POST['contact_adress']));
    setContact($user_id, $contact_mail, $contact_name, $contact_firstname, $contact_phone, $contact_phone_2, $contact_adress);
    header("Location: ../view/pprofil.php");
}

//admin
if(isset($_POST['bSuppmembre'])){
    $user_id = $_POST['delete_user_id'];
    suppmembre($user_id);
    // Redirigez vers la page admin ou affichez un message de succès
    header("Location: ../view/padmin.php");
    exit();
}

?>