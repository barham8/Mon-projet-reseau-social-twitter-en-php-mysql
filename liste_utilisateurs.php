<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tweety";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

// Récupérer tous les utilisateurs
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Créer un fichier pour stocker les utilisateurs
    $fichier = fopen("utilisateurs.txt", "w");

    // Parcourir les utilisateurs et les écrire dans le fichier
    while ($row = $result->fetch_assoc()) {
        $ligne = $row['nom'] . "," . $row['email'] . "\n";
        fwrite($fichier, $ligne);
    }

    // Fermer le fichier
    fclose($fichier);
    echo "Les utilisateurs ont été récupérés et enregistrés dans le fichier utilisateurs.txt.";
} else {
    echo "Aucun utilisateur trouvé dans la base de données.";
}

// Fermer la connexion à la base de données
$conn->close();
?>
