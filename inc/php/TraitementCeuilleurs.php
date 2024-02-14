<?php

if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['first_name']) && isset($_POST['birth_date']) && isset($_POST['hire_date'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $first_name = $_POST['first_name'];
    $birth_date = $_POST['birth_date'];
    $hire_date = $_POST['hire_date'];

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

    if (isVarietyExists($pdo,$id)) {
        header('Location: ../../pages/admin/AdminHome.php?error=variety_already_exist&body=person');
        exit;
    } else {
        $sql = "INSERT INTO serenitea_farms_ceuilleurs (id_ceuilleur,nom, prenom, date_de_naissance, date_d_embauche) 
            VALUES (:id_ceuilleur,:nom, :prenom, :birth_date, :hire_date)"; // Date de départ par défaut
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':id_ceuilleur' => $id, ':nom' => $name, ':prenom' => $first_name, ':birth_date' => $birth_date, ':hire_date' => $hire_date));

        header('Location: ../../pages/admin/AdminHome.php?mes=successfully_insert&body=person');
        exit;
    }
}

function isVarietyExists($pdo,$id) {
    $sql_select = "SELECT id_ceuilleur FROM serenitea_farms_ceuilleurs WHERE id_ceuilleur = :variete";
    $stmt = $pdo->prepare($sql_select);
    $stmt->execute(array(':variete' => $id));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row !== false;
}