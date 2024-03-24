<?php
// Inclure le fichier contenant la connexion à la base de données
include 'cnxDatabase.php';

// Vérifier si l'identifiant du produit est passé dans la requête
if(isset($_GET['id'])) {
    // Récupérer l'identifiant du produit à supprimer
    $refPdt = $_GET['id'];

    // Effectuer une requête SQL pour obtenir le nom du fichier image associé au produit
    $sql_image = "SELECT image FROM produit WHERE RefPdt = '$refPdt'";
    $result_image = $conn->query($sql_image);
    $row_image = $result_image->fetch_assoc();
    $image_produit = $row_image['image'];

    // Effectuer une requête SQL pour supprimer le produit de la base de données
    $sql_delete = "DELETE FROM produit WHERE RefPdt = '$refPdt'";
    if ($conn->query($sql_delete) === TRUE) {
        // Supprimer le fichier image du dossier
        $chemin_image = "images/" . $image_produit;
        if (file_exists($chemin_image)) {
            unlink($chemin_image); // Supprime le fichier image
            // Rediriger vers la page de liste des produits avec un message de succès
            header("Location: liste.php?success=Product successfully deleted");
            exit();
        } else {
            // Rediriger vers la page de liste des produits avec un message d'erreur si l'image n'a pas été trouvée
            header("Location: liste.php?error=Product image not found");
            exit();
        }
    } else {
        // Rediriger vers la page de liste des produits avec un message d'erreur si la suppression a échoué
        header("Location: liste.php?error=Error deleting product: " . $conn->error);
        exit();
    }
} else {
    // Rediriger vers la page de liste des produits si l'identifiant du produit n'est pas spécifié
    header("Location: liste.php?error=Product ID not specified");
    exit();
}

