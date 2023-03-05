<?php
if (isset($_GET['idUser'])) {
    $data = simplexml_load_file('../data/data.xml');
    $id = $_GET['idUser'];
    $result = $data->xpath("//Admin[@IdUser='" . $id . "']");
    $Depts = $data->xpath("//Depts/*");
    $Filieres = $data->xpath("//Filieres/*");
}
include("../Pages/Header.php");
?>
<ul class="nav-option">
    <li><a href="../Pages/Admin.php?idUser=<?php echo $id; ?>">Page Principale</a></li>
    <li><a href="../controllers/AjouterEnseignant.php?idUser=<?php echo $id; ?>">ajouter ensiengant</a></li>
    <li><a href="../controllers/AjouterEtudiant.php?idUser=<?php echo $id; ?>">ajouter etudiant</a></li>
    <li><a href="../controllers/AjouterAgent.php?idUser=<?php echo $id; ?>">ajouter Agent</a></li>
    <li><a href="../controllers/AjouterMatiere.php?idUser=<?php echo $id; ?>">ajouter Matiere</a></li>
</ul>
<div class="info">
    <h1>Ajouter un matiere</h1>
</div>
<form action="../controllers/Ajouter.php" method="post" class="Form-ModifAbs">
    <input type="hidden" name="idUser" value="<?php echo $id ?>">

    <div>
        <input type="text" name="Intitule" placeholder="Intitule..." required class="input">
    </div>
    <div>
        <input type="number" name="Coeffecient" step="0.1" placeholder="Coeffecient..." required class="input">
    </div>
    <div>
        <select name="Filiere" required class="input">
            <option selected disabled>--choisir une Filiere--</option>
            <?php
            foreach ($Filieres as $filiere) {
                $flr = (array) $filiere;
            ?>

                <option value="<?php echo $flr["@attributes"]["nom"] ?>"><?php echo $flr["@attributes"]["nom"] ?></option>
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

                <option value="<?php echo $dp["@attributes"]["idDept"] ?>"><?php echo $dp["@attributes"]["nom"] ?></option>
            <?php
            }
            ?>

        </select>
    </div>
    <input type="submit" name="submitAjoutMtr" value="Ajouter">
</form>