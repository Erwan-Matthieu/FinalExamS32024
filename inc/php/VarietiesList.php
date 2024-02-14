<?php

    header("Content-Type: application/json");

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

    echo json_encode(getVarietiesList($pdo));

    function getVarietiesList($pdo) {
        $sql_select = "SELECT variete FROM serenitea_farms_the";
        $stmt = $pdo->prepare($sql_select);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }