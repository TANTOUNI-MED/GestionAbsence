<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../Scripts/JQuery-3.6.2.js"></script>
    <script src="../Scripts/jquery.dataTables.min.js"></script>
    <script src="../Scripts/code.js"></script>
    <link rel="stylesheet" href="../Styles/Admin.css">
    <link rel="stylesheet" href="../Styles/DataTable.css">
    <link rel="stylesheet" href="../Styles/Etudiant.css">
    <title>Absences</title>
</head>

<body>
    <div class="header-info">
        <h1>Gestion des Absences</h1>
        <div style="display: flex;align-items:center;">
            <h4>Vous êtes connecté en tant que <?php echo $result[0]->Nom . " "; ?></h4>
            <div class="logout"><a href="../index.php"> Logout</a></div>
        </div>
    </div>