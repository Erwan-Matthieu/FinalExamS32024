<?php

if(isset($_POST['username']) && isset($_POST['password'])) {
    $email = $_POST['username'];
    $password = $_POST['password'];
    
    $dsn = 'mysql:host=172.20.0.167;dbname=db_p16_ETU002402;charset=utf8';
    $utilisateur = 'ETU002402';
    $mot_de_passe = '2w7pFQI2KPTz';
    
    try {
        $pdo = new PDO($dsn, $utilisateur, $mot_de_passe);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'Erreur de connexion : ' . $e->getMessage();
        exit;
    }

    $sql_select = "SELECT mot_de_passe, admin FROM serenitea_farms_utilisateurs WHERE pseudo = :pseudo";
    
    try {
        $stmt = $pdo->prepare($sql_select);
        $stmt->execute(array(':pseudo' => $email));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Vérification si le pseudo existe
        if($row) {
            
            if($row['mot_de_passe'] === sha1($password)) {
                // Redirection vers la page admin.php si l'utilisateur est un admin
                if($row['admin']) {
                    header('Location: ../../pages/admin/AdminHome.php');
                    exit;
                } else {
                    // Redirection vers la page utilisateur.php pour les autres utilisateurs
                    header('Location: ../../pages/others/UserHome.php');
                    exit;
                }
            } else {
                // Mot de passe incorrect, redirection vers login.php avec un message d'erreur
                header('Location: ../../pages/Login.php?error=incorrect_password');
                exit;
            }
        } else {
            // Pseudo inexistant, redirection vers login.php avec un message d'erreur
            header('Location: ../../pages/Login.php?error=user_not_found');
            exit;
        }
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
} else {
    header('Location: ../../pages/Login.php');
    exit;
}
