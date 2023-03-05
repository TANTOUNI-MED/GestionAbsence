<?php
$id;
if (isset($_POST['idUser'])) {
    $data = simplexml_load_file('../data/data.xml');
    $id = $_POST['idUser'];
    $Filiere = $_POST['Filiere'];
    $Seance = $_POST['Seance'];
    $result = $data->xpath("//Enseignant[@IdUser='" . $id . "']");
    $etuds = $data->xpath("//Etudiant[@Filiere='" . $Filiere . "']");
}
if (isset($_POST["submitJustif"])) {
    $id = $_POST['idUser'];
    $filiere = $_POST['Filiere'];
    $idEtud = $_POST["idEtud"];
    $Seance = $_POST["Seance"];
    $Justif = $_POST["justif"];
    $IdAbsence = uniqid('AB');
    $data = simplexml_load_file('../data/data.xml');
    $ab = $data->Absences->addChild('Absence');
    $ab->addAttribute('IdAbsence', $IdAbsence);
    $ab->addAttribute('Etudiant', $idEtud);
    $ab->addAttribute('Seance', $Seance);
    $ab->addChild('Justifier', $Justif);
    $ab->addChild('Comm_abs', '');
    file_put_contents('../data/data.xml', $data->asXML());
}
include('../Pages/Header.php');
?>
<div style="background-color:#3D4756;width:100px;text-align:center;margin:10px;border-radius:5px;cursor:pointer;">
    <a style="text-decoration: none;color:white;font-size:1.2rem;" href="../Pages/Enseignant.php?idUser=<?php echo $id; ?>">Retour </a>
</div>
<h1>les listes des etudiants </h1>
<table id="example" class="display" style="width:100%">

    <thead>
        <th>NOM</th>
        <th>PRENOM</th>
        <th>PHONE</th>
        <th>EMAIL</th>
        <th>AFFECTER UNE ABSENCE</th>

    </thead>
    <tbody><?php
            foreach ($etuds as $etud) {

            ?>
            <tr>
                <?php $etudArray = (array) $etud;
                $idEtud = $etudArray["@attributes"]["IdUser"];
                ?>
                <td><?php echo $etud->Nom ?></td>
                <td><?php echo $etud->Prenom ?></td>
                <td><?php echo $etud->Phone  ?></td>
                <td><?php echo $etud->Email  ?></td>
                <td>
                    <?php
                    $tr = false;
                    $ab = $data->xpath("//Absence[@Etudiant='" . $idEtud . "' and @Seance='" . $Seance . "']");
                    if ($ab) {
                        $abb = (array) $ab['0'];
                        $abs = $abb["@attributes"]["Seance"];
                        $tr = true;
                        echo "absent";
                    }



                    if (!$tr) {
                    ?>
                        <form action="" method="post">
                            <input type="hidden" name="idUser" value="<?php echo $id ?>">
                            <input type="hidden" name="idEtud" value="<?php echo $idEtud ?>">
                            <input type="hidden" name="Seance" value="<?php echo $Seance ?>">
                            <input type="hidden" name="Filiere" value="<?php echo $Filiere ?>">
                            <label for="ens1">OUI</label>
                            <input type="radio" id="ens1" name="justif" value="0">
                            <input type="submit" name="submitJustif" value="ajouter">
                        </form>


                    <?php } ?>
                </td>
            </tr>
        <?php
            }
        ?>
    </tbody>

</table>

</body>

</html>