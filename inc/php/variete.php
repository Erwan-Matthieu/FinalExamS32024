<?php
$dsn = 'mysql:host=nom_hôte;dbname=project;charset=utf8';
$utilisateur = '';
$mot_de_passe = '';

try {
    $pdo = new PDO($dsn, $utilisateur, $mot_de_passe);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
    exit;
}

// Vérification si le formulaire a été soumis
if(isset($_POST['variete'])) {
    $variete = $_POST['variete'];

    // Vérification si la variété existe déjà dans la base de données
    $sql_select = "SELECT variete FROM serenitea_farms_the WHERE variete = :variete";
    $stmt = $pdo->prepare($sql_select);
    $stmt->execute(array(':variete' => $variete));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row) {
        echo "Erreur : La variété $variete existe déjà dans la base de données.";
    } else {
        // Insertion de la variété dans la base de données
        $occupation = $_POST['occupation'];
        $rendement = $_POST['rendement'];

        $sql_insert = "INSERT INTO serenitea_farms_the (variete, occupation, rendement) VALUES (:variete, :occupation, :rendement)";
        $stmt = $pdo->prepare($sql_insert);
        $stmt->execute(array(':variete' => $variete, ':occupation' => $occupation, ':rendement' => $rendement));

        echo "La variété $variete a été insérée avec succès dans la base de données.";
    }
}
?>

