<?php
if (isset($_GET['idUser'])) {
    $data = simplexml_load_file('../data/data.xml');
    $id = $_GET['idUser'];
    $result = $data->xpath("//Admin[@IdUser='" . $id . "']");
    $Depts = $data->xpath("//Depts/*");
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
    <h1>Ajouter un agent</h1>
</div>
<form action="../controllers/Ajouter.php" method="post" class="Form-ModifAbs">
    <input type="hidden" name="idUser" value="<?php echo $id ?>">
    <div style="display:flex;width:100%;">
        <div style="width:50%;">
            <input type="text" name="CIN" placeholder="CIN..." required class="input">
        </div>
        <div style="width:50%;">
            <input type="text" name="Nom" placeholder="Nom..." required class="input">
        </div>
    </div>
    <div style="display:flex;width:100%;">
        <div style="width:50%;">
            <input type="text" name="Prenom" placeholder="Prenom..." required class="input">
        </div>
        <div style="width:50%;">
            <select name="Sexe" class="input">
                <option value="Masculin">Masculin</option>
                <option value="fiminin">fiminin</option>
            </select>

        </div>
    </div>
    <div style="display:flex;width:100%;">
        <div style="width:50%;">
            <input type="text" name="Phone" placeholder="Phone..." required class="input">
        </div>
        <div style="width:50%;">
            <input type="email" name="Email" placeholder="Email..." required class="input">
        </div>
    </div>
    <div style="display:flex;width:100%;">
        <div style="width:50%;">
            <input type="text" name="Login" placeholder="Login..." required class="input">
        </div>
        <div style="width:50%;">
            <input type="text" name="MotPass" placeholder="MotPass..." required class="input">
        </div>
    </div>
    <div>
        <select name="dept" required style="width:95%;" class="input">
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
    <input style="width:95%;" type="submit" name="submitAjoutAgent" value="Ajouter">
</form>