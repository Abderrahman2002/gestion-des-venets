<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du produit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex; /* Utiliser flexbox pour aligner les éléments sur la ligne */
            align-items: center; /* Centrer les éléments verticalement */
            flex-direction: column; /* Aligner les éléments en colonne */
        }

        .product-details {
            flex-grow: 1; /* Faire en sorte que cette partie prenne tout l'espace disponible */
            padding-left: 20px; /* Ajouter un espacement à gauche */
        }

        h1 {
            color: #333;
            margin-top: 0; /* Supprimer la marge supérieure par défaut */
        }

        p {
            color: #666;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-top: 20px;
            border-radius: 5px; /* Ajouter une bordure arrondie à l'image */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
         /* Style pour le bouton de retour */
        .back-button {
            margin-bottom: 20px; /* Ajout d'une marge en bas pour séparer le bouton du tableau */
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff; /* Couleur de fond */
            color: #fff; /* Couleur du texte */
            border: none; /* Pas de bordure */
            border-radius: 5px; /* Coins arrondis */
            text-decoration: none; /* Pas de soulignement */
            transition: background-color 0.3s ease; /* Transition douce */
            cursor: pointer; /* Curseur de souris */
        }

        .back-button:hover {
            background-color: #0056b3; /* Changement de couleur au survol */
        }
    </style>    
</head>
<body>
    <div class="container">
        <?php
        // Inclure le fichier contenant la connexion à la base de données
        include 'cnxDatabase.php';

        // Récupérer l'identifiant du produit depuis l'URL
        $refPdt = $_GET['id'];

        // Effectuer une requête SQL pour obtenir les détails du produit en fonction de son identifiant
        // Assumez que vous avez déjà une connexion à la base de données $conn

        $sql = "SELECT * FROM produit WHERE RefPdt = '$refPdt'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Afficher les détails du produit
            $row = $result->fetch_assoc();
            echo "<img src='" . $row["image"] . "' alt='Image du produit'>";

            // Afficher les autres détails du produit dans une section distincte
            echo "<div class='product-details'>";
            
            echo "<table>";
            echo "<tr>";
            echo "<th>Libellé</th>";
            echo "<td>" . $row["libPdt"] . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<th>Référence</th>";
            echo "<td>" . $row["RefPdt"] . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<th>Prix</th>";
            echo "<td>$" . $row["Prix"] . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<th>Quantité en stock</th>";
            echo "<td>" . $row["Qte"] . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<th>Description</th>";
            echo "<td>" . $row["description"] . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<th>Type</th>";
            echo "<td>" . $row["type"] . "</td>";
            echo "</tr>";
            echo "</table>";
            echo "</div>";

        } else {
            echo "Produit non trouvé";
        }
        ?>
        <a href="liste.php" class="back-button">Retour à la liste des produits</a>
    </div>

</body>
</html>
        