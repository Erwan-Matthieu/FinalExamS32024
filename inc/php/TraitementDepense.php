<?php

if (isset($_POST['name'])) {
    $name = $_POST['name'];

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
        header('Location: ../../pages/admin/AdminHome.php?error=variety_already_exist&body=pay');
        exit;
    } else {
        $sql_insert = "INSERT INTO serenitea_farms_categories_depenses VALUES (:nom_depense)";
        $stmt = $pdo->prepare($sql_insert);
        $stmt->execute(array(':nom_depense' => $name));

        header('Location: ../../pages/admin/AdminHome.php?mes=successfully_insert&body=pay');
        exit;
    }
}

function isVarietyExists($pdo,$variete) {
    $sql_select = "SELECT nom_depense FROM serenitea_farms_categories_depenses WHERE nom_depense = :variete";
    $stmt = $pdo->prepare($sql_select);
    $stmt->execute(array(':variete' => $variete));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row !== false;
}