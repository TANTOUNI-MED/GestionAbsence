<?php
if (isset($_GET['idUser'])) {
    $data = simplexml_load_file('../data/data.xml');
    $id = $_GET['idUser'];
    $seance = $data->xpath("//Seance[@Enseignant='" . $id . "']");
    $result = $data->xpath("//Enseignant[@IdUser='" . $id . "']");
    $matiere = $data->xpath("//Matiere[@Enseignant='" . $id . "']");
}
include('Header.php');
?>
<h1>Vos Matieres</h1>
<?php
foreach ($matiere as $mtr) {
?>
    <p><?php echo $mtr->Intitule ?> </p>
<?php
}
?>

<?php
if (isset($_GET["AjouterSeance"])) {  ?>
    <div class="info">
        <h1>Ajouter une Seance</h1>
    </div>
    <form action="../controllers/Ajouter.php" method="post" class="Form-ModifAbs">
        <div>
            <input type="hidden" name="Enseignant" value="<?php echo $id ?>">
        </div>
        <div>
            <input type="date" name="DateS" placeholder="date du seance...">
        </div>
        <div>
            <input type="time" name="HeureDebut" placeholder="Heure Debut..." step="2">
        </div>
        <div>
            <input type="time" name="HeureFin" placeholder="Heure Fin..." step="2">
        </div>
        <div>
            <input type="text" name="TypeS" placeholder="type du seance...">
        </div>
        <div>
            <select name="Matiere" required>
                <option selected disabled>--choisir une matiere--</option>
                <?php
                foreach ($matiere as $mtr) {
                    $mt = (array) $mtr;
                ?>

                    <option value="<?php echo $mt["@attributes"]["CodeMatiere"] ?>"><?php echo $mt['Intitule'] ?></option>
                <?php
                }
                ?>

            </select>
        </div>

        <input type="submit" name="submitAjout" value="Ajouter">
    </form>
<?php
} else {  ?>
    <a class="Ajouter" href="Enseignant.php?AjouterSeance&idUser=<?php echo $id ?>"> AJOOUTER SEANCE</a>
    <h1>les listes des seances </h1>
    <table id="example" class="display" style="width:100%">

        <thead>
            <th>Matiere</th>
            <th>DATE SEANCE</th>
            <th>HEURE DEBUT</th>
            <th>HEURE FIN</th>
            <th>TYPE SEANCE</th>
            <th>GERER L'ABSENCE</th>

        </thead>
        <tbody><?php
                foreach ($seance as $sc) {

                ?>
                <tr>
                    <td>
                        <?php
                        $ScArray = (array) $sc;
                        $mtr = $data->xpath("//Matiere[@CodeMatiere='" . $ScArray["@attributes"]["Matiere"] . "']");
                        $mtrName = (array) $mtr['0'];
                        echo $mtrName['Intitule'];
                        ?>
                    </td>
                    <td><?php echo $sc->DateS; ?></td>
                    <td><?php echo $sc->HeureDebut ?></td>
                    <td><?php echo $sc->HeureFin  ?></td>
                    <td><?php echo $sc->TypeS  ?></td>
                    <td>
                        <form action="../controllers/AjouterAbsence.php" method="post">
                            <input type="hidden" name="idUser" value="<?php echo $id ?>">
                            <input type="hidden" name="Seance" value="<?php echo $ScArray["@attributes"]["IdSeance"] ?>">
                            <input type="hidden" name="Filiere" value="<?php echo $mtrName["@attributes"]["Filiere"] ?>">
                            <button class="cour" type="submit">
                                <img src="../images/bid.png" alt="notebook">
                            </button>
                        </form>

                    </td>
                </tr>
            <?php
                }
            ?>
        </tbody>

    </table>
<?php } ?>

</body>

</html>