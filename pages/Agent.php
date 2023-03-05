<?php
if (isset($_GET['idUser'])) {
    $data = simplexml_load_file('../data/data.xml');
    $id = $_GET['idUser'];
    $result = $data->xpath("//Agent_S[@IdUser='" . $id . "']");
    $r = (array)$result[0];
    $Filiers = $data->xpath("//Filiere[@dept = '" . $r['@attributes']['dept'] . "']");
    $etuds;
    $i = 0;
    foreach ($Filiers as $fil) {
        $f = (array)$fil;
        $etuds[$i] = $data->xpath("//Etudiant[@Filiere = '" . $f['@attributes']['nom'] . "']");
        $i++;
    }
}
include("Header.php");
?>

</body>
<div class="Etudiants">
    <h1>Liste des Etudiants</h1>
    <table id="example" class="display" style="width:100%">

        <thead>
            <th>NOM</th>
            <th>PRENOM</th>
            <th>PHONE</th>
            <th>EMAIL</th>
            <th>Filiere</th>
            <th>Afficher</th>
        </thead>
        <tbody><?php
                $etuds = (array)$etuds;
                foreach ($etuds as $etudss) {
                    foreach ($etudss as $etud) {
                        if ($etud != array()) {
                ?>
                        <tr>
                            <td><?php echo $etud[0]->Nom ?></td>
                            <td><?php echo $etud[0]->Prenom ?></td>
                            <td><?php echo $etud[0]->Phone  ?></td>
                            <td><?php echo $etud[0]->Email  ?></td>
                            <td>
                                <?php $etudArray = (array) $etud[0];
                                $filiere = $etudArray["@attributes"]["Filiere"];
                                $FFName = $data->xpath("//Filieres/Filiere[@nom='" . $filiere . "']/@nom");
                                $filiereName = (array)$FFName[0];
                                echo $filiereName['@attributes']['nom'];
                                ?>
                            </td>
                            <td>
                                <form method="post" action="../controllers/AgentController.php">
                                    <input type="text" value="<?php echo $r['@attributes']['IdUser']; ?>" name="idUser" hidden>
                                    <input type="text" value="<?php echo $etudArray['@attributes']['IdUser']; ?>" name="idEtud" hidden>
                                    <button class="cour" type="submit" name="Affiche">
                                        <img src="../images/eye.png" alt="Afficher">
                                    </button>
                                </form>
                            </td>
                        </tr>
            <?php
                        }
                    }
                }
            ?>
        </tbody>

    </table>
</div>

</html>