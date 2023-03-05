<?php
$idEns;
$id;
if (isset($_GET['idUser'])) {
    $data = simplexml_load_file('../data/data.xml');
    $id = $_GET['idUser'];
    $idEns = $_GET['Ens'];
    $Enseignant = $data->xpath("//Enseignant[@IdUser = '" . $idEns . "']");
    $result = $data->xpath("//Admin[@IdUser='" . $id . "']");
    $Matiers = $data->xpath("//Matieres/*");
}
include("../Pages/Header.php");
?>

<div>
    <header class="header">
        Affecter un Cour a l'enseignant <?php echo $Enseignant[0]->Nom . " " . $Enseignant[0]->Prenom; ?>
    </header>
    <div>
        <form action="Ajouter.php" method="post" class="Form-ModifAbs">
            <input type="text" name="idUser" value="<?php echo $id; ?>" hidden>
            <input type="text" name="idEns" value="<?php echo $idEns; ?>" hidden>
            <select name="Matiere" required class="input">
                <?php foreach ($Matiers as $m) {
                    $ma = (array)$m
                ?>
                    <option value="<?php echo $ma['@attributes']['CodeMatiere'] ?>"><?php echo $m->Intitule; ?></option>
                <?php } ?>
            </select>
            <input type="submit" name="AffecterMatiere" value="Affecter" />
        </form>
    </div>
</div>

</body>

</html>