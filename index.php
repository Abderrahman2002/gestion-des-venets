<?php
session_start();
include 'cnxDatabase.php'; // Assurez-vous d'inclure le fichier contenant la connexion à la base de données

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données saisies dans le formulaire
    $input_login = $_POST['login'];
    $input_password = $_POST['password'];

    // Effectuer une requête SQL pour récupérer les informations de l'utilisateur
    $sql = "SELECT * FROM utilisateur WHERE login = '$input_login'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Utilisateur trouvé dans la base de données
        $row = $result->fetch_assoc();
        // Vérifier si le mot de passe correspond
        if ($input_password == $row['password']) {
            // Mot de passe correct, enregistrer l'utilisateur dans la session et rediriger vers une page de succès
            $_SESSION['login'] = $input_login;
            header("location: liste.php"); // Rediriger vers la page liste.php après la connexion réussie
            exit();
        } else {
            // Mot de passe incorrect, rediriger vers la page de connexion avec un message d'erreur
            header("location: index.html?error=invalid_credentials");
            exit();
        }
    } else {
        // Utilisateur non trouvé dans la base de données, rediriger vers la page de connexion avec un message d'erreur
        header("location: index.html?error=user_not_found");
        exit();
    }
}
?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page de Connexion</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
            }

            .container {
                max-width: 400px;
                margin: 100px auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .container h2 {
                text-align: center;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-group label {
                display: block;
                margin-bottom: 5px;
            }

            .form-group input {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 3px;
            }

            button {
                display: block;
                width: 100%;
                padding: 10px;
                background-color: #007bff;
                color: #fff;
                border: none;
                border-radius: 3px;
                cursor: pointer;
            }

            button:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Connexion</h2>
            <form action="index.php" method="post">
    <div class="form-group">
        <label for="login">Nom d'utilisateur :</label>
        <input type="text" id="login" name="login" required>
    </div>
    <div class="form-group">
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
    </div>
    <button type="submit">Se connecter</button>
</form>

        </div>
    </body>
    </html>
