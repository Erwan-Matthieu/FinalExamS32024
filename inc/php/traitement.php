<?php
if(isset($_POST['email']) && isset($_POST['password'])) {

} else {
    
    header('Location: login.php');
    exit;
}


$dsn = 'mysql:host=nom_hôte;dbname= project;charset=utf8';
$utilisateur = '';
$mot_de_passe = '';

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
                header('Location: admin.php');
                exit;
            } else {
                // Redirection vers la page utilisateur.php pour les autres utilisateurs
                header('Location: utilisateur.php');
                exit;
            }
        } else {
            // Mot de passe incorrect, redirection vers login.php avec un message d'erreur
            header('Location: login.php?error=incorrect_password');
            exit;
        }
    } else {
        // Pseudo inexistant, redirection vers login.php avec un message d'erreur
        header('Location: login.php?error=user_not_found');
        exit;
    }
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}
 else {
// Redirection vers login.php si les données email et password ne sont pas envoyées
header('Location: login.php');
exit;
}


$sql = "INSERT INTO serenitea_farms_utilisateurs (nom, prenom, pseudo, mot_de_passe, date_de_naissance, date_d_inscription, admin) VALUES
        ('Dupont', 'Jean', 'jean.dupont', 'chat1', '1990-05-15', '2023-01-01', false),
        ('Martin', 'Sophie', 'sophie.martin', 'chat2', '1985-08-23', '2023-08-05', false),
        ('Lefebvre', 'Paul', 'paul.lefebvre', 'chat3', '1978-12-10', '2024-10-02', false),
        ('Dubois', 'Marie', 'marie.dubois', 'chat4', '1995-03-28', '2023-06-15', true)";
 

try {
    $pdo->exec($sql);
    echo "Données insérées avec succès.";

    $hashed_password1 = sha1('chat1');
    $hashed_password2 = sha1('chat2');
    $hashed_password3 = sha1('chat3');
    $hashed_password4 = sha1('chat4');

    echo "Mots de passe hashés : <br>";
    echo "chat1 : $hashed_password1 <br>";
    echo "chat2 : $hashed_password2 <br>";
    echo "chat3 : $hashed_password3 <br>";
    echo "chat4 : $hashed_password4 <br>";

} catch (PDOException $e) {
    echo 'Erreur lors de l\'insertion des données : ' . $e->getMessage();
}

?>
