<?php

if (isset($_POST['name']) && isset($_POST['place']) && isset($_POST['yield'])) {
    $name = $_POST['name'];
    $place = $_POST['place'];
    $yield = $_POST['yield'];

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

    if (isVarietyExists($pdo,$name)) {
        header('Location: ../../pages/admin/AdminHome.php?error=variety_already_exist&body=variety');
        exit;
    } else {
        $sql_insert = "INSERT INTO serenitea_farms_the (variete, occupation, rendement) VALUES (:variete, :occupation, :rendement)";
        $stmt = $pdo->prepare($sql_insert);
        $stmt->execute(array(':variete' => $name, ':occupation' => $place, ':rendement' => $yield));

        header('Location: ../../pages/admin/AdminHome.php?mes=successfully_insert&body=variety');
        exit;
    }
}

function isVarietyExists($pdo,$variete) {
    $sql_select = "SELECT variete FROM serenitea_farms_the WHERE variete = :variete";
    $stmt = $pdo->prepare($sql_select);
    $stmt->execute(array(':variete' => $variete));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row !== false;
}