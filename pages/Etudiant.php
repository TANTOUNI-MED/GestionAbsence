<?php
if (isset($_GET['idUser'])) {
    $data = simplexml_load_file('../data/data.xml');
    $id = $_GET['idUser'];
    $result = $data->xpath("//Etudiant[@IdUser='" . $id . "']");
    $r = (array)$result[0];
    $Absences = $data->xpath("//Absence[@Etudiant='" . $r['@attributes']['IdUser'] . "']");
}
include("Header.php");
?>

<div class="info">
    <h1>L'étudiant <?php echo $result[0]->Nom . " " . $result[0]->Prenom; ?></h1>
    <div class="box-info">
        <div style="background-color: white;width:45%;height:80%;">
            <img src="../images/graduated.png" alt="User">
        </div>
        <div>
            <p>CIN: <b><?php echo $result[0]->CIN; ?></b></p>
            <p>Nom: <b><?php echo $result[0]->Nom; ?></b></p>
            <p>Prenom: <b><?php echo $result[0]->Prenom; ?></b></p>
            <p>Téléphone: <b><?php echo $result[0]->Phone; ?></b></p>
            <p>Email: <b><?php echo $result[0]->Email; ?></b></p>
            <p>Filiere:
                <b><?php
                    echo $r['@attributes']['Filiere'];
                    ?></b>
            </p>
        </div>
    </div>
</div>
<div class="info">
    <h1>Table d'absence Pour l'étudiant <?php echo $result[0]->Nom . " " . $result[0]->Prenom; ?></h1>
</div>
<table id="example" class="display" style="width:100%">
    <thead>
        <th>Matiere</th>
        <th>Date seance</th>
        <th>Heure debut</th>
        <th>Heure Fin</th>
        <th>Type seance</th>
        <th>Justifiee</th>
        <th>Commantaire</th>
    </thead>
    <tbody>
        <?php foreach ($Absences as $abs) { ?>
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
            </tr>
        <?php } ?>
    </tbody>
</table>
</body>

</html>