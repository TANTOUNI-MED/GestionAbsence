<?php
if (isset($_GET['idUser'])) {
    $data = simplexml_load_file('../data/data.xml');
    $id = $_GET['idUser'];
    $user = $_GET['user'];
    $result = $data->xpath("//Admin[@IdUser='" . $id . "']");
    $Depts = $data->xpath("//Depts/*");
    $Filieres = $data->xpath("//Filieres/*");
    $Matiers = $data->xpath("//Matieres/*");
    $m = $data->xpath("//Matiere[@CodeMatiere = '" . $user . "']");
}
if (isset($_POST["submitModiftMtr"])) {
    $Coeffecient = $_POST["Coeffecient"];
    $Intitule = $_POST["Intitule"];
    $Filiere = $_POST["Filiere"];
    $dept = $_POST["dept"];
    $i = 0;
    foreach ($Matiers as $mt) {
        if ($mt->attributes()['CodeMatiere'] == $user) {
            $data->Matieres->Matiere[$i]->Coeffecient = $Coeffecient;
            $data->Matieres->Matiere[$i]->Intitule = $Intitule;
            $data->Matieres->Matiere[$i]->attributes()['Filiere'] = $Filiere;
            $data->Matieres->Matiere[$i]->attributes()['dept'] = $dept;
            file_put_contents('../data/data.xml', $data->asXML());
            break;
        } else {
            $i++;
        }
    }
}
include("../Pages/Header.php");
?>
<a href="../Pages/Admin.php?idUser=<?php echo $id; ?>">Retour</a>
<div class="info">
    <h1>Ajouter un matiere</h1>
</div>
<form action="" method="post" class="Form-ModifAbs">

    <div>
        <input type="text" name="Intitule" placeholder="Intitule..." required class="input" value="<?php echo $m[0]->Intitule; ?>">
    </div>
    <div>
        <input type="number" name="Coeffecient" step="0.1" placeholder="Coeffecient..." required class="input" value="<?php echo $m[0]->Coeffecient; ?>">
    </div>
    <div>
        <select name="Filiere" required class="input">
            <option selected disabled>--choisir une Filiere--</option>
            <?php
            foreach ($Filieres as $filiere) {
                $flr = (array) $filiere;
            ?>

                <option <?php if ($m[0]->attributes()['Filiere'] == $flr["@attributes"]["nom"]) echo "selected"; ?> value="<?php echo $flr["@attributes"]["nom"] ?>"><?php echo $flr["@attributes"]["nom"] ?></option>
            <?php
            }
            ?>

        </select>
    </div>
    <div>
        <select name="dept" required class="input">
            <option selected disabled>--choisir une Dept--</option>
            <?php
            foreach ($Depts as $dpt) {
                $dp = (array) $dpt;
            ?>

                <option <?php if ($m[0]->attributes()['dept'] == $dp["@attributes"]["idDept"]) echo "selected"; ?> value="<?php echo $dp["@attributes"]["idDept"] ?>"><?php echo $dp["@attributes"]["nom"] ?></option>
            <?php
            }
            ?>

        </select>
    </div>
    <input type="submit" name="submitModiftMtr" value="Ajouter">
</form>