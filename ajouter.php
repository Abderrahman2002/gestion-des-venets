        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Ajouter un nouveau produit</title>
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        </head>
        <body>
            <div class="container">
                <h1 class="mt-5">Ajouter un nouveau produit</h1>
                <form action="" method="post" enctype="multipart/form-data" class="mt-4">
                    <div class="form-group">
                        <label for="reference">Référence:</label>
                        <input type="text" id="reference" name="reference" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="libelle">Libellé:</label>
                        <input type="text" id="libelle" name="libelle" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="prix">Prix:</label>
                        <input type="number" id="prix" name="prix" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="quantite">Quantité en stock:</label>
                        <input type="number" id="quantite" name="quantite" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" rows="4" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="type">Type:</label>
                        <input type="text" id="type" name="type" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" id="image" name="image" accept="image/*" class="form-control-file" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>

            <!-- Bootstrap JS (optional) -->
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
        </html>

        <?php
session_start();

// Vérifiez si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclure le fichier de connexion à la base de données
    include 'cnxDatabase.php';

    // Récupérer les données du formulaire
    $reference = $_POST['reference'];
    $libelle = $_POST['libelle'];
    $prix = $_POST['prix'];
    $quantite = $_POST['quantite'];
    $description = $_POST['description'];
    $type = $_POST['type'];

    // Vérifier si le type de produit existe dans la table "type_produit"
    $check_type_query = "SELECT * FROM type_produit WHERE type = '$type'";
    $check_type_result = $conn->query($check_type_query);
    if ($check_type_result->num_rows > 0) {
        // Le type de produit existe, continuer avec l'ajout du produit
        // Récupérer les détails du fichier
        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];

        // Définir le répertoire cible pour déplacer le fichier téléchargé
        $target_dir = "images/";
        $target_file = $target_dir . basename($file_name);

        // Vérifier si le répertoire cible existe, sinon le créer
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Déplacer le fichier téléchargé vers le répertoire cible
        if (move_uploaded_file($file_tmp, $target_file)) {
            // Fichier déplacé avec succès, insérer les données dans la base de données
            $sql = "INSERT INTO produit (RefPdt, libPdt, Prix, Qte, description, type, image) VALUES ('$reference', '$libelle', '$prix', '$quantite', '$description', '$type', '$target_file')";
            if ($conn->query($sql) === TRUE) {
                echo "Produit ajouté avec succès.";
            } else {
                echo "Erreur lors de l'ajout du produit: " . $conn->error;
            }
        } else {
            echo "Erreur lors du téléchargement de l'image.";
        }
    } else {
        // Le type de produit n'existe pas dans la table "type_produit"
        echo "Le type de produit spécifié n'existe pas.";
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
?>


