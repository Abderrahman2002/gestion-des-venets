        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Liste des produits</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

            <style>
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                th, td {
                    border: 1px solid #ddd;
                    padding: 8px;
                    text-align: left;
                }
                th {
                    background-color: #f2f2f2;
                }
                .product-image {
                    max-width: 100px; /* Largeur maximale de l'image */
                    max-height: 100px; /* Hauteur maximale de l'image */
                }
                button {
                    color: #fff;
                    border: none;
                    margin:5px;
                    border-radius: 4px;
                    padding: 5px 10px;
                    cursor: pointer;
                    transition: background-color 0.3s;
                }
                button:hover {
                    background-color:wheat;
                }
                /* Styles pour chaque icône */
                button .fas.fa-eye {
                    color: green; /* Couleur verte pour l'icône "eye" */
                }
                button .fas.fa-sync-alt {
                    color: blue; /* Couleur bleue pour l'icône "refresh" */
                }
                button .fas.fa-trash-alt {
                    color: red; /* Couleur rouge pour l'icône "trash" */
                }
                /* Style pour le bouton "Ajouter un produit" */
            button.add-product-button {
                background-color: #000; /* Couleur de fond noire */
                color: #fff; /* Couleur du texte */
                border: none; /* Pas de bordure */
                border-radius: 5px; /* Coins arrondis */
                padding: 10px 20px; /* Ajouter un espace autour du texte */
                cursor: pointer; /* Curseur de souris */
                transition: background-color 0.3s; /* Transition douce */
            }

            button.add-product-button:hover {
                background-color: #333; /* Changement de couleur au survol */
            }
            </style>
        </head>
        <body>
            <h1>Liste des produits</h1>
            <a href="ajouter.php"><button class="add-product-button">Ajouter un produit</button></a>

            <table>
                <thead>
                    <tr>
                        <th>Référence</th>
                        <th>Libellé</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'cnxDatabase.php';


                    // Requête SQL pour sélectionner tous les produits
                    $sql = "SELECT * FROM produit";
                    $result = $conn->query($sql);

                    // Afficher les produits dans le tableau
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["RefPdt"] . "</td>";
                            echo "<td>" . $row["libPdt"] . "</td>";
                            echo "<td>" . $row["Prix"] . "</td>";
                            echo "<td>" . $row["Qte"] . "</td>";
                            echo "<td>" . $row["description"] . "</td>";
                            echo "<td><img src='" . $row["image"] . "' alt='Image produit' class='product-image'></td>";
                            echo "<td>" . $row["type"] . "</td>";
                            echo "<td>";
                            echo "<a href='afficher_produit.php?id=" . $row["RefPdt"] . "'><button><i class='fas fa-eye'></i></button></a>"; // Lien pour afficher les détails du produit
                            echo "<a href='supprimer.php?id=" . $row["RefPdt"] . "'<button><i class='fas fa-trash-alt'></i></button><a>"; // Icone pour l'action de suppression
                            echo "</td>";

                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>Aucun produit trouvé.</td></tr>";
                    }

                    // Fermer la connexion
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </body>
        </html>
