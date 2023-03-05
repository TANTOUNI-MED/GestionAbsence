<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/login.css">
    <title>Absences</title>
</head>

<body>
    <div class="log-form">
        <h2>Connectez-vous à votre compte</h2>
        <form method="post" action="controllers/login.php">
            <select name="type" id="choix" required>
                <option selected disabled>--Votre Choix--</option>
                <option value="Agents">Secretaire</option>
                <option value="Admins">Admin</option>
                <option value="Enseignants">Enseignat</option>
                <option value="Etudiants">Etudiant</option>
            </select>
            <input type="text" id="login" name="login" title="login" placeholder="login" required />
            <input type="password" id="password" name="password" title="login" placeholder="password" required />
            <button type="submit" class="btn" name="log" id="log">Login</button>
        </form>
    </div>
    <?php
    if (isset($_GET['erreur'])) { ?>
        <div class="erreur">
            Login ou mot passe n'est pas correct !!! :(
        </div>

    <?php } ?>
    <?php if (isset($_GET['CompteNonActive'])) { ?>
        <div class="NonAtive">
            Votre compte est n'est pas activé pour le mement voiller consulté l'admin :)
        </div>

    <?php } ?>
</body>

</html>