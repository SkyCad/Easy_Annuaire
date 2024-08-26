<?php
include("../model/pdbconnect.php");
function emailExists($email) {
    global $bdd;
    $query = "SELECT COUNT(*) FROM users WHERE email = :email";
    $stmt = $bdd->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    return $stmt->fetchColumn() > 0; // Retourne true si l'email existe déjà, false sinon
}
//VERIF AVANT
function inscription_db($name,$first_name,$email,$psw,$date_n,$timestamp_inscription){
    global $bdd;   
    $role = 0;
    if(isset($message)){return $message;}
    $querysqlData2 = "INSERT INTO users_info (birthdate) VALUES (:date_n)";
    $stmtUsersInsert2 = $bdd->prepare($querysqlData2);
    $stmtUsersInsert2->bindParam(":date_n",$date_n);
    try{
        $stmtUsersInsert2->execute();
     }catch(PDOException $e){
         $message = "Erreur 2";
    }

    $sqlLastUser = "SELECT users_info_id FROM users_info ORDER BY users_info_id DESC LIMIT 1";
    $stmtUsers = $bdd->prepare($sqlLastUser);
    $stmtUsers->execute();
    // On récupère l'id du dernier enregistrement
    $idUsers = $stmtUsers->fetchColumn();

    $querysqlData = "INSERT INTO users (email,password,name, firstname,role,date_create,users_info_id) VALUES (:email,:psw,:name, :first_name,:role,:timestamp_inscription,:users_info_id)";
    $stmtUsersInsert = $bdd->prepare($querysqlData);
    $stmtUsersInsert->bindParam(":email",$email);
    $stmtUsersInsert->bindParam(":psw", $psw);
    $stmtUsersInsert->bindParam(":name",$name);
    $stmtUsersInsert->bindParam(":first_name",$first_name);
    $stmtUsersInsert->bindParam(":role",$role);
    $stmtUsersInsert->bindParam(":timestamp_inscription", $timestamp_inscription);
    $stmtUsersInsert->bindParam(":users_info_id",$idUsers);
    try{
        $stmtUsersInsert->execute();
        $token = generateConfirmationToken();
        saveConfirmationToken($email, $token);
        header("Location: ../view/pconfirmation.php?token=" . urlencode($token));
        exit();
     }catch(PDOException $e){
         $message = "Erreur 2";
    }
}
function login($email,$psw){
    global $bdd;
    $sqlUser = "SELECT * FROM `users` where email= :email";
    $stmtUsers = $bdd->prepare($sqlUser);
    $stmtUsers->bindParam(":email",$email);
    if(isset($message)){return $message;}
    try{
        $stmtUsers->execute();
    }catch(PDOException $e){
         $message = "Erreur 2";
         return false;
    }
    $user = $stmtUsers->fetch();
    if ($user && password_verify($psw, $user['password'])) {
        $_SESSION["user"] = $user;
        $_SESSION["user_id"] = $user['users_id'];
        return true;
    }
}
function get_firstname($email){
    global $bdd;
    if(isset($message)){return $message;}
    $sqlUser = "SELECT firstname FROM `users` where email= :email";
    $stmtUsers = $bdd->prepare($sqlUser);
    $stmtUsers->bindParam(":email",$email);
    try{
        $stmtUsers->execute();
    }catch(PDOException $e){
         $message = "Erreur 2";
         return false;
    }
    $user = $stmtUsers->fetch(PDO::FETCH_ASSOC);
    return $user ? $user['firstname'] : null;
}
function recupinfo($user_id){
    global $bdd;
    $sqlUser = "SELECT u.*, ui.* FROM users u 
                INNER JOIN users_info ui ON u.users_info_id = ui.users_info_id
                WHERE u.users_id = :user_id";
    $stmt = $bdd->prepare($sqlUser);
    $stmt->bindParam(":user_id",$user_id);
    $stmt->execute();

    // Récupérez les résultats sous forme de tableau associatif
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function recupcontact($user_id) {
    global $bdd; // Use the global $bdd object for database connection

    // Prepare the SQL query
    $sqlUser = "SELECT * FROM contacts WHERE users_id = :users_id";
    
    // Prepare the statement
    $stmt = $bdd->prepare($sqlUser);
    
    // Bind the user ID parameter
    $stmt->bindParam(":users_id", $user_id, PDO::PARAM_INT);
    
    // Execute the query
    $stmt->execute();
    
    // Fetch the results as an associative array
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function setContact($user_id, $contact_mail, $contact_name, $contact_firstname, $contact_phone, $contact_phone2, $contact_adress) {
    global $bdd;

    // Input validation (basic example)
    if (empty($user_id) || empty($contact_mail) || empty($contact_name) || empty($contact_firstname) || empty($contact_phone) || empty($contact_adress)) {
        error_log("Invalid input parameters");
        return false; // Invalid input
    }

    $sql = "INSERT INTO contacts (users_id, contact_mail, contact_name, contact_firstname, contact_phone, contact_phone2, contact_adress) VALUES (:users_id, :contact_mail, :contact_name, :contact_firstname, :contact_phone, :contact_phone2, :contact_adress)";
    $stmt = $bdd->prepare($sql);

    // Bind parameters
    $stmt->bindParam(":users_id", $user_id);
    $stmt->bindParam(":contact_mail", $contact_mail);
    $stmt->bindParam(":contact_name", $contact_name);
    $stmt->bindParam(":contact_firstname", $contact_firstname);
    $stmt->bindParam(":contact_phone", $contact_phone);
    $stmt->bindParam(":contact_phone2", $contact_phone2);
    $stmt->bindParam(":contact_adress", $contact_adress);

    // Log the SQL query and parameters
    error_log("SQL Query: " . $sql);
    error_log("Parameters: " . json_encode([
        'users_id' => $user_id,
        'contact_mail' => $contact_mail,
        'contact_name' => $contact_name,
        'contact_firstname' => $contact_firstname,
        'contact_phone' => $contact_phone,
        'contact_phone2' => $contact_phone2,
        'contact_adress' => $contact_adress
    ]));

    // Execute and handle errors
    try {
        $stmt->execute();
        return true; // Success
    } catch (PDOException $e) {
        // Log error or handle it as needed
        error_log("Error inserting contact: " . $e->getMessage());
        return false; // Failure
    }
}
function supprimercontact($contact_id) {
    global $bdd;
    $sql = "DELETE FROM contacts WHERE contacts_id = :contacts_id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(":contacts_id", $contact_id);
    try {
        $stmt->execute();
        return true; // Success
    } catch (PDOException $e) {
        error_log("Error deleting contact: " . $e->getMessage());
        return false; // Failure
    }
}
function modifContact($user_id, $contact_mail, $contact_name, $contact_firstname, $contact_phone, $contact_phone2, $contact_adress, $contact_id) {
    global $bdd;
    $stmt = $bdd->prepare("UPDATE contacts SET  
        users_id = :user_id,
        contact_mail = :contact_mail, 
        contact_name = :contact_name, 
        contact_firstname = :contact_firstname, 
        contact_phone = :contact_phone, 
        contact_phone2 = :contact_phone2, 
        contact_adress = :contact_adress 
        WHERE contacts_id = :contact_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':contact_mail', $contact_mail);
    $stmt->bindParam(':contact_name', $contact_name);
    $stmt->bindParam(':contact_firstname', $contact_firstname);
    $stmt->bindParam(':contact_phone', $contact_phone);
    $stmt->bindParam(':contact_phone2', $contact_phone2);
    $stmt->bindParam(':contact_adress', $contact_adress);
    $stmt->bindParam(':contact_id', $contact_id);
    $stmt->execute();
}
function update_profile($user_id, $new_name, $new_firstname, $new_email, $new_date_n, $new_psw){
    global $bdd;
    $sql = "UPDATE users u
            INNER JOIN users_info ui ON u.users_info_id = ui.users_info_id
            SET ";
    $params = array();

    // On vérifie si chaque champs est null ou pas 
    if ($new_name !== null) {
        $sql .= "u.name = :new_name, ";
        $params['new_name'] = $new_name;
    }
    if ($new_firstname !== null) {
        $sql .= "u.firstname = :new_firstname, ";
        $params['new_firstname'] = $new_firstname;
    }
    if ($new_email !== null) {
        $sql .= "u.email = :new_email, ";
        $params['new_email'] = $new_email;
    }
    if ($new_psw !== null) {
        $sql .= "u.password = :new_psw, ";
        $params['new_psw'] = $new_psw;
    }
    if ($new_date_n !== null) {
        $sql .= "ui.birthdate = :new_date_n, ";
        $params['new_date_n'] = $new_date_n;
    }
    

    // On supprime la virgule finale et on ajoute la clause WHERE
    $sql = rtrim($sql, ", ");
    $sql .= " WHERE u.users_id = :user_id";
    $params['user_id'] = $user_id;
    $stmt = $bdd->prepare($sql);
    $stmt->execute($params);

}
function generateConfirmationToken() { 
    $token = bin2hex(random_bytes(16));
    $timestamp = time(); // Timestamp actuel en secondes 
    return $token . '_' . $timestamp; // Concaténation du jeton et du timestamp
}

function saveConfirmationToken($email, $token) {
    global $bdd;
    $timestamp = date("Y-m-d H:i:s");
    $stmt = $bdd->prepare("UPDATE users SET email_confirmation_token = :token, email_confirmation_timestamp = :timestamp WHERE email = :email");
    $stmt->bindValue(':token', $token);
    $stmt->bindValue(':timestamp', $timestamp);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
}

function verifyConfirmationToken($token) {
    global $bdd;
    $stmt = $bdd->prepare("SELECT email_confirmation_token, email_confirmation_timestamp FROM users WHERE email_confirmation_token = :token");
    $stmt->bindValue(':token', $token);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $tokenTimestamp = strtotime($result['email_confirmation_timestamp']);
        if (time() - $tokenTimestamp < 86400) {
            $stmt = $bdd->prepare("UPDATE users SET email_confirmed = 1, email_confirmation_token = NULL, email_confirmation_timestamp = NULL WHERE email_confirmation_token = :token");
            $stmt->bindValue(':token', $token);
            $stmt->execute();
            return true;
        } else {
            echo "Token expiré.";
            var_dump($token, $result['email_confirmation_timestamp'], $tokenTimestamp, time());
        }
    } else {
        echo "Token non trouvé.";
        var_dump($result );
        var_dump($token);
    }
    return false;
}
function modifpsw($user_id, $new_password) {
    global $bdd;
    $stmt = $bdd->prepare("UPDATE users SET password = :new_password WHERE users_id = :user_id");
    $stmt->bindParam(':new_password', $new_password);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
}
//crud admin
function affichermembres(){
    global $bdd;
    $stmt = $bdd->prepare("SELECT * FROM users");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function suppmembre($membre_id){
    global $bdd;

    // Delete from users_info first
    $stmt = $bdd->prepare("DELETE FROM users_info WHERE users_info_id = :membre_id");
    $stmt->bindParam(':membre_id', $membre_id);
    $stmt->execute();

    // Delete from contacts next
    $stmt = $bdd->prepare("DELETE FROM contacts WHERE users_id = :membre_id");
    $stmt->bindParam(':membre_id', $membre_id);
    $stmt->execute();

    // Finally, delete from users
    $stmt = $bdd->prepare("DELETE FROM users WHERE users_id = :membre_id");
    $stmt->bindParam(':membre_id', $membre_id);
    $stmt->execute();
}
function afficherInfosComplet($user_id) {
    global $bdd;
    $stmt = $bdd->prepare("
        SELECT * FROM users WHERE users_id = :user_id");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function modifuser($user_id, $new_name, $new_firstname, $new_email) {
    global $bdd;
    $stmt = $bdd->prepare("UPDATE users SET name = :new_name, firstname = :new_firstname, email = :new_email WHERE users_id = :user_id");
    $stmt->bindParam(':new_name', $new_name);
    $stmt->bindParam(':new_firstname', $new_firstname);
    $stmt->bindParam(':new_email', $new_email);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
}
?>