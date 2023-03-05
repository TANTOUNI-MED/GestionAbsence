<?php
$data = simplexml_load_file('../data/data.xml');
$idAgent = $_POST['idUser'];
$idEtudiant = $_POST['idEtud'];
$result = $data->xpath("//Agent_S[@IdUser='" . $idAgent . "']");
$Etudiant = $data->xpath("//Etudiant[@IdUser = '" . $idEtudiant . "']");
$r = (array)$Etudiant[0];
$Absences = $data->xpath("//Absence[@Etudiant='" . $r['@attributes']['IdUser'] . "']");
$nbAbssences = count((array)$Absences);
/********Delete Absence******************/
if (isset($_POST['DelAbs'])) {
    $idAbs = $_POST['IdAbs'];
    $ABB = $data->xpath("//Absences/*");
    $i = 0;
    foreach ($ABB as $Abs) {
        $Abss = (array)$Abs;
        if ($Abss['@attributes']['IdAbsence'] == $idAbs) {
            unset($data->Absences->Absence[$i]);
            file_put_contents('../data/data.xml', $data->asXML());
            $nbAbssences -= 1;
            break;
        } else {
            $i++;
        }
    }
}
$Absence;
$modif = false;
$idAbs;
if (isset($_POST['ModAbs'])) {
    $idAbs = $_POST['IdAbs'];
    $Absence = $data->xpath("//Absence[@IdAbsence = '" . $idAbs . "']");
    $modif = true;
}
if (isset($_POST['AffecterModif'])) {
    $idAbs = $_POST['idAbs'];
    $Justifier = $_POST['Justifier'];
    $Justification = $_POST['Justification'];
    $ABB = $data->xpath("//Absences/*");
    $i = 0;
    foreach ($ABB as $Abs) {
        $Abss = (array)$Abs;
        if ($Abss['@attributes']['IdAbsence'] == $idAbs) {
            $Abs->Justifier = $Justifier;
            $Abs->Comm_abs = $Justification;
            file_put_contents('../data/data.xml', $data->asXML());
            break;
        } else {
            $i++;
        }
    }
    $modif = false;
} else {
    if (isset($_POST['Cancel'])) {

        $modif = false;
    }
}
include('../pages/Header.php');
?>
<div style="background-color:#3D4756;width:100px;text-align:center;margin:10px;border-radius:5px;cursor:pointer;">
    <a style="text-decoration: none;color:white;font-size:1.2rem;" href="../pages/Agent.php?idUser=<?php echo $idAgent; ?>">Retour</a>
</div>
<div class="info">

    <h1>Liste d'absences Pour L'etudiant <?php echo $Etudiant[0]->Nom . " " . $Etudiant[0]->Prenom ?></h1>

</div>
<?php if (!$modif) { ?>
    <table id="example" class="display" style="width:100%">
        <thead>
            <th>Matiere</th>
            <th>Date seance</th>
            <th>Heure debut</th>
            <th>Heure Fin</th>
            <th>Type seance</th>
            <th>Justifiee</th>
            <th>Commantaire</th>
            <th>Modifier/Supprimer</th>
        </thead>
        <tbody>

            <?php
            if ($nbAbssences != 0) {
                foreach ($Absences as $abs) {
            ?>
                    <tr>
                        <?php
                        $n = (array)$abs;
                        $Seances = $n['@attributes']['Seance'];
                        $SeancesInfo = $data->xpath("//Seance[@IdSeance = '" . $Seances . "']");

                        ?>
                        <td>
                            <?php
                            $ss = (array)$SeancesInfo[0];
                            $matiere = $data->xpath("//Matiere[@CodeMatiere = '" . $ss['@attributes']['Matiere'] . "']");
                            echo $matiere[0]->Intitule;
                            ?>
                        </td>
                        <td><?php echo $SeancesInfo[0]->DateS; ?></td>
                        <td><?php echo $SeancesInfo[0]->HeureDebut; ?></td>
                        <td><?php echo $SeancesInfo[0]->HeureFin; ?></td>
                        <td><?php echo $SeancesInfo[0]->TypeS ?></td>
                        <td><?php
                            if ($abs->Justifier == 1) {
                                echo "Oui";
                            } else {
                                echo "Non";
                            }
                            ?></td>
                        <td>
                            <?php
                            $comm = (array)$abs->Comm_abs;
                            if ($comm != array()) {
                                echo $comm[0];
                            } else {
                                echo "None";
                            }
                            ?>
                        </td>
                        <td>
                            <form method="post" action="">
                                <input type="text" name="idUser" value="<?php echo $idAgent;  ?>" hidden>
                                <input type="text" name="idEtud" value="<?php echo $idEtudiant;  ?>" hidden>
                                <input type="text" name="IdAbs" value="<?php
                                                                        $abss = (array)$abs;
                                                                        echo $abss['@attributes']['IdAbsence']
                                                                        ?>" hidden>
                                <button class="cour" name="ModAbs">
                                    <img src="../images/edit-button.png" alt="Modifer">
                                </button>
                                <button class="cour" name="DelAbs" type="submit">
                                    <img src="../images/delete.png" alt="Supprimer">
                                </button>
                            </form>
                        </td>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>
<?php }
if ($modif) { ?>
    <div class="Form-ModifAbs">
        <form action="" method="post">
            <input type="text" name="idUser" value="<?php echo $idAgent;  ?>" hidden>
            <input type="text" name="idEtud" value="<?php echo $idEtudiant;  ?>" hidden>
            <input type="text" name="idAbs" value="<?php echo $idAbs;  ?>" hidden>
            <div>
                <select name="Justifier" id="Justifier">
                    <option selected disabled>Absence Justifier ?</option>
                    <option value="1">Oui</option>
                    <option value="0">Non</option>
                </select>
            </div>
            <div>
                <input type="text" name="Justification" placeholder="Justification d'absence">
            </div>
            <div>
                <input type="submit" value="Modifier" name="AffecterModif">
            </div>
            <input type="submit" value="Cancel" name="Cancel" style="background-color:grey;">
        </form>
    </div>
<?php } ?>
</body>

</html>