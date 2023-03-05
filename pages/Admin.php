<?php
$id;
if (isset($_GET['idUser'])) {
    $data = simplexml_load_file('../data/data.xml');
    $id = $_GET['idUser'];
    $result = $data->xpath("//Admin[@IdUser='" . $id . "']");
    $ensg = $data->xpath("//Enseignants/*");
    $agents = $data->xpath("//Agents/*");
    $matieres = $data->xpath("//Matieres/*");
    $etuds = $data->xpath("//Etudiants/*");
}
$choix = "";
if (!empty($_POST["choix"])) {
    $choix = $_POST["choix"];
}
include("Header.php");
?>
<ul class="nav-option">
    <li><a href="Admin.php?idUser=<?php echo $id; ?>">Page Principale</a></li>
    <li><a href="../controllers/AjouterEnseignant.php?idUser=<?php echo $id; ?>">ajouter ensiengant</a></li>
    <li><a href="../controllers/AjouterEtudiant.php?idUser=<?php echo $id; ?>">ajouter etudiant</a></li>
    <li><a href="../controllers/AjouterAgent.php?idUser=<?php echo $id; ?>">ajouter Agent</a></li>
    <li><a href="../controllers/AjouterMatiere.php?idUser=<?php echo $id; ?>">ajouter Matiere</a></li>
</ul>
<div>
    <form action="" method="post" class="nav-form">
        <div>
            <label for="ens1">Enseignants</label>
            <input type="radio" id="ens1" name="choix" value="Enseignant" <?php if ($choix == "Enseignant") {
                                                                                echo "checked";
                                                                            } else {
                                                                                if (empty($choix)) {
                                                                                    echo "checked";
                                                                                }
                                                                            } ?>>
        </div>
        <div>
            <label for="etud">Etudiant</label>
            <input type="radio" id="etud" value="Etudiant" name="choix" <?php if ($choix == "Etudiant") {
                                                                            echo "checked";
                                                                        } ?>>
        </div>
        <div>
            <label for="agent">Agents</label>
            <input type="radio" id="agent" value="Agents" name="choix" <?php if ($choix == "Agents") {
                                                                            echo "checked";
                                                                        } ?>>
        </div>
        <div>
            <label for="mtr">Matiere</label>
            <input type="radio" id="mtr" value="Matiere" name="choix" <?php if ($choix == "Matiere") {
                                                                            echo "checked";
                                                                        } ?>>
        </div>

        <input type="submit" name="submitAff" value="afficher">
    </form>
</div>
<?php
if (!isset($_POST["submitAff"]) || $choix == "Enseignant") {


?>
    <h1>les listes des ensiengant</h1>
    <table id="example" class="display" style="width:100%">

        <thead>
            <th>NOM</th>
            <th>PRENOM</th>
            <th>PHONE</th>
            <th>EMAIL</th>
            <th>Dept</th>
            <th>Affecter à un cours</th>
            <th>Activé/Disactivé</th>
            <th>Modifier/Supprimer</th>
        </thead>
        <tbody><?php
                foreach ($ensg as $ens) {

                ?>
                <tr>
                    <td><?php echo $ens->Nom ?></td>
                    <td><?php echo $ens->Prenom ?></td>
                    <td><?php echo $ens->Phone  ?></td>
                    <td><?php echo $ens->Email  ?></td>
                    <td>
                        <?php $ensArray = (array) $ens;
                        $dept = $ensArray["@attributes"]["dept"];
                        $DEptName = $data->xpath("//Depts/Dept[@idDept='" . $dept . "']/@nom");
                        $deptName = (array)$DEptName[0];
                        echo $deptName['@attributes']['nom'];
                        ?>
                    </td>
                    <td>

                        <a class="cour" href="../controllers/AffecterCour.php?idUser=<?php echo $id ?>&Ens=<?php echo $ensArray['@attributes']['IdUser'];  ?>">
                            <img src="../images/notebooks.png" alt="notebook">
                        </a>

                    </td>
                    <td>
                        <form method="post" action="../controllers/Active_Disactive.php">
                            <input type="text" name="type" value="Enseignant" hidden>
                            <input type="text" name="idUser" value="<?php echo $id; ?>" hidden>
                            <input type="text" name="id" value="<?php echo $ensArray['@attributes']['IdUser']; ?>" hidden>
                            <button class="cour" name="ActiveUser">
                                <img src="../images/active-user.png" alt="Activé">
                            </button>
                            <button class="cour" name="DisactiveUser">
                                <img src="../images/inactive.png" alt="Disctivé">
                            </button>
                        </form>
                    </td>
                    <td>
                        <form method="post" action="../controllers/Supp_Modif.php">
                            <input type="text" name="type" value="Enseignant" hidden>
                            <input type="text" name="idUser" value="<?php echo $id; ?>" hidden>
                            <input type="text" name="id" value="<?php echo $ensArray['@attributes']['IdUser']; ?>" hidden>
                            <button class="cour" name="Modifier">
                                <img src="../images/edit-button.png" alt="Modifie">
                            </button>
                            <button class="cour" name="supprimerUser">
                                <img src="../images/delete.png" alt="Supprimer">
                            </button>
                        </form>
                    </td>
                </tr>
            <?php
                }
            ?>
        </tbody>

    </table>
    <?php } else {
    if ($_POST["choix"] == "Etudiant") {

    ?>
        <h1>les listes des Etudiants</h1>
        <table id="example" class="display" style="width:100%">

            <thead>
                <th>NOM</th>
                <th>PRENOM</th>
                <th>PHONE</th>
                <th>EMAIL</th>
                <th>Filiere</th>
                <th>Activé/Disactivé</th>
                <th>Modifier/Supprimer</th>
            </thead>
            <tbody><?php
                    foreach ($etuds as $etud) {

                    ?>
                    <tr>
                        <td><?php echo $etud->Nom ?></td>
                        <td><?php echo $etud->Prenom ?></td>
                        <td><?php echo $etud->Phone  ?></td>
                        <td><?php echo $etud->Email  ?></td>
                        <td>
                            <?php $etudArray = (array) $etud;
                            $filiere = $etudArray["@attributes"]["Filiere"];
                            $FFName = $data->xpath("//Filieres/Filiere[@nom='" . $filiere . "']/@nom");
                            $filiereName = (array)$FFName[0];
                            echo $filiereName['@attributes']['nom'];
                            ?>
                        </td>
                        <td>
                            <form method="post" action="../controllers/Active_Disactive.php">
                                <input type="text" name="type" value="Etudiant" hidden>
                                <input type="text" name="idUser" value="<?php echo $id; ?>" hidden>
                                <input type="text" name="id" value="<?php echo $etudArray['@attributes']['IdUser']; ?>" hidden>
                                <button class="cour" name="ActiveUser">
                                    <img src=" ../images/active-user.png" alt="Active">
                                </button>
                                <button class="cour" name="DisactiveUser">
                                    <img src="../images/inactive.png" alt="Disactivé">
                                </button>
                            </form>
                        </td>
                        </td>
                        <td>
                            <form method="post" action="../controllers/Supp_Modif.php">
                                <input type="text" name="type" value="Etudiant" hidden>
                                <input type="text" name="idUser" value="<?php echo $id; ?>" hidden>
                                <input type="text" name="id" value="<?php echo $etudArray['@attributes']['IdUser']; ?>" hidden>
                                <button class="cour" name="Modifier">
                                    <img src=" ../images/edit-button.png" alt="Modifer">
                                </button>
                                <button class="cour" name="supprimerUser">
                                    <img src="../images/delete.png" alt="Supprimer">
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>

        </table>
    <?php } elseif ($_POST["choix"] == "Agents") {
    ?>
        <h1>les listes des Agents</h1>
        <table id="example" class="display" style="width:100%">

            <thead>
                <th>NOM</th>
                <th>PRENOM</th>
                <th>PHONE</th>
                <th>EMAIL</th>
                <th>Filiere</th>
                <th>Activé/Disactivé</th>
                <th>Modifier/Supprimer</th>
            </thead>
            <tbody><?php
                    foreach ($agents as $agent) {

                    ?>
                    <tr>
                        <td><?php echo $agent->Nom ?></td>
                        <td><?php echo $agent->Prenom ?></td>
                        <td><?php echo $agent->Phone  ?></td>
                        <td><?php echo $agent->Email  ?></td>
                        <td>
                            <?php
                            $ensArray = (array) $agent;
                            $dept = $ensArray["@attributes"]["dept"];
                            $DEptName = $data->xpath("//Depts/Dept[@idDept='" . $dept . "']/@nom");
                            $deptName = (array)$DEptName[0];
                            echo $deptName['@attributes']['nom'];
                            ?>
                        </td>
                        <td>
                            <form method="post" action="../controllers/Active_Disactive.php">
                                <input type="text" name="type" value="Agent_S" hidden>
                                <input type="text" name="idUser" value="<?php echo $id; ?>" hidden>
                                <input type="text" name="id" value="<?php echo $ensArray['@attributes']['IdUser']; ?>" hidden>
                                <button class="cour" name="ActiveUser">
                                    <img src="../images/active-user.png" alt="Activé">
                                </button>
                                <button class="cour" name="DisactiveUser">
                                    <img src="../images/inactive.png" alt="Disactivé">
                                </button>
                            </form>
                        </td>
                        <td>
                            <form method="post" action="../controllers/Supp_Modif.php">
                                <input type="text" name="type" value="Agent_S" hidden>
                                <input type="text" name="idUser" value="<?php echo $id; ?>" hidden>
                                <input type="text" name="id" value="<?php echo $ensArray['@attributes']['IdUser']; ?>" hidden>
                                <button class="cour" name="Modifier">
                                    <img src="../images/edit-button.png" alt="Modifer">
                                </button>
                                <button class="cour" name="supprimerUser">
                                    <img src="../images/delete.png" alt="Supprimer">
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>

        </table>
    <?php
    } elseif ($_POST["choix"] == "Matiere") {
    ?>
        <h1>les listes des Matiers</h1>
        <table id="example" class="display" style="width:100%">

            <thead>
                <th>Intitule</th>
                <th>Coeff</th>
                <th>ensiengant</th>
                <th>Filiere</th>
                <th>Modifier/Supprimer</th>

            </thead>
            <tbody><?php
                    foreach ($matieres as $matiere) {

                    ?>
                    <tr>
                        <td><?php echo $matiere->Intitule ?></td>
                        <td><?php echo $matiere->Coeffecient ?></td>
                        <td> <?php $matiereArray = (array) $matiere;
                                $ensss = $matiereArray["@attributes"]["Enseignant"];
                                $FFName = $data->xpath("//Enseignants/Enseignant[@IdUser='" . $ensss . "']/Nom");
                                if ($FFName) {
                                    $ensar = (array)$FFName[0];
                                    echo $ensar['0'];
                                } else {
                                    echo "NULL";
                                }

                                ?>
                        </td>
                        <td><?php $mat = (array)$matiere;
                            //print_r($mat);
                            echo $mat['@attributes']['Filiere'];
                            ?>
                        </td>
                        <td>
                            <form method="post" action="../controllers/Supp_Modif.php">
                                <input type="text" name="type" value="Matiere" hidden>
                                <input type="text" name="idUser" value="<?php echo $id; ?>" hidden>
                                <input type="text" name="id" value="<?php echo $mat['@attributes']['CodeMatiere']; ?>" hidden>
                                <button class="cour" name="Modifier">
                                    <img src="../images/edit-button.png" alt="Modifer">
                                </button>
                                <button class="cour" name="supprimerUser">
                                    <img src="../images/delete.png" alt="Supprimer">
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>

        </table>
<?php
    }
} ?>

</body>

</html>