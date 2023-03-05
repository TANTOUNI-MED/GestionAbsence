<?php
if (isset($_GET['idUser'])) {
    $data = simplexml_load_file('../data/data.xml');
    $idUser = $_GET['idUser'];
    $type = $_GET['type'];
    $user = $_GET['user'];
    $result = $data->xpath("//Admin[@IdUser='" . $idUser . "']");
    $Depts = $data->xpath("//Depts/*");
    $Filieres = $data->xpath("//Filieres/*");
    $U = $data->xpath("//" . $type . "[@IdUser = '" . $user . "']");
}
if (isset($_POST['submitModifEns'])) {
    $Sexe = $_POST["Sexe"];
    $CIN = $_POST["CIN"];
    $Nom = $_POST["Nom"];
    $Prenom = $_POST["Prenom"];
    $Phone = $_POST["Phone"];
    $Email = $_POST["Email"];
    $Specialite = $_POST["Specialite"];
    $Login = $_POST["Login"];
    $MotPass = $_POST["MotPass"];
    $dept = $_POST["dept"];
    $ENSS = $data->xpath("//Enseignants/*");
    $i = 0;
    foreach ($ENSS as $ens) {
        if ($ens->attributes()['IdUser'] == $user) {
            $data->Enseignants->Enseignant[$i]->CIN = $CIN;
            $data->Enseignants->Enseignant[$i]->Nom = $Nom;
            $data->Enseignants->Enseignant[$i]->Prenom = $Prenom;
            $data->Enseignants->Enseignant[$i]->Phone = $Phone;
            $data->Enseignants->Enseignant[$i]->Email = $Email;
            $data->Enseignants->Enseignant[$i]->Specialite = $Specialite;
            $data->Enseignants->Enseignant[$i]->Login = $Login;
            $data->Enseignants->Enseignant[$i]->MotPass = $MotPass;
            $data->Enseignants->Enseignant[$i]->attributes()['dept'] = $dept;
            $data->Enseignants->Enseignant[$i]->attributes()['Sexe'] = $Sexe;
            file_put_contents('../data/data.xml', $data->asXML());
            break;
        } else {
            $i++;
        }
    }
}
if (isset($_POST['submitModifEtu'])) {
    $Sexe = $_POST["Sexe"];
    $CIN = $_POST["CIN"];
    $Nom = $_POST["Nom"];
    $Prenom = $_POST["Prenom"];
    $Phone = $_POST["Phone"];
    $Email = $_POST["Email"];
    $Login = $_POST["Login"];
    $MotPass = $_POST["MotPass"];
    $filiere = $_POST["Filiere"];
    $ENSS = $data->xpath("//Etudiants/*");
    $i = 0;
    foreach ($ENSS as $ens) {
        if ($ens->attributes()['IdUser'] == $user) {
            $data->Etudiants->Etudiant[$i]->CIN = $CIN;
            $data->Etudiants->Etudiant[$i]->Nom = $Nom;
            $data->Etudiants->Etudiant[$i]->Prenom = $Prenom;
            $data->Etudiants->Etudiant[$i]->Phone = $Phone;
            $data->Etudiants->Etudiant[$i]->Email = $Email;
            $data->Etudiants->Etudiant[$i]->Login = $Login;
            $data->Etudiants->Etudiant[$i]->MotPass = $MotPass;
            $data->Etudiants->Etudiant[$i]->attributes()['Filiere'] = $filiere;;
            $data->Etudiants->Etudiant[$i]->attributes()['Sexe'] = $Sexe;
            file_put_contents('../data/data.xml', $data->asXML());
            break;
        } else {
            $i++;
        }
    }
}
if (isset($_POST['submitModifAgent'])) {
    $Sexe = $_POST["Sexe"];
    $CIN = $_POST["CIN"];
    $Nom = $_POST["Nom"];
    $Prenom = $_POST["Prenom"];
    $Phone = $_POST["Phone"];
    $Email = $_POST["Email"];
    $Login = $_POST["Login"];
    $MotPass = $_POST["MotPass"];
    $dept = $_POST["dept"];
    $ENSS = $data->xpath("//Agents/*");
    $i = 0;
    foreach ($ENSS as $ens) {
        if ($ens->attributes()['IdUser'] == $user) {
            $data->Agents->Agent_S[$i]->CIN = $CIN;
            $data->Agents->Agent_S[$i]->Nom = $Nom;
            $data->Agents->Agent_S[$i]->Prenom = $Prenom;
            $data->Agents->Agent_S[$i]->Phone = $Phone;
            $data->Agents->Agent_S[$i]->Email = $Email;
            $data->Agents->Agent_S[$i]->Login = $Login;
            $data->Agents->Agent_S[$i]->MotPass = $MotPass;
            $data->Agents->Agent_S[$i]->attributes()['dept'] = $dept;
            $data->Agents->Agent_S[$i]->attributes()['Sexe'] = $Sexe;
            file_put_contents('../data/data.xml', $data->asXML());
            break;
        } else {
            $i++;
        }
    }
}
include("../Pages/Header.php");
?>
<a href="../Pages/Admin.php?idUser=<?php echo $idUser; ?>">Retour</a>
<div class="info">
    <h1>Modifier un <?php echo $type ?></h1>
</div>
<?php if ($type == 'Enseignant') { ?>
    <form action="" method="post" class="Form-ModifAbs" style="width:70%;margin-left:15%;">
        <input type="hidden" name="idUser" value="<?php echo $id ?>">

        <div style="display:flex;width:100%;">
            <div style="width:50%;">
                <input type="text" name="CIN" placeholder="CIN..." required class="input" value="<?php echo $U[0]->CIN; ?>">
            </div>
            <div style="width:50%;">
                <input type="text" name="Nom" placeholder="Nom..." required class="input" value="<?php echo $U[0]->Nom; ?>">
            </div>
        </div>
        <div style="display:flex;width:100%;">
            <div style="width:50%;">
                <input type="text" name="Prenom" placeholder="Prenom..." required class="input" value="<?php echo $U[0]->Prenom; ?>">
            </div>
            <div style="width:50%;">
                <select name="Sexe" class="input">
                    <option <?php if ($U[0]->attributes()['Sexe'] == 'Masculin') echo "selected"; ?> value="Masculin">Masculin</option>
                    <option <?php if ($U[0]->attributes()['Sexe'] == 'fiminin') echo "selected"; ?> value="fiminin">fiminin</option>
                </select>

            </div>
        </div>
        <div style="display:flex;width:100%;">
            <div style="width:50%;">
                <input type="text" name="Phone" placeholder="Phone..." required class="input" value="<?php echo $U[0]->Phone; ?>">
            </div>
            <div style="width:50%;">
                <input type="email" name="Email" placeholder="Email..." required class="input" value="<?php echo $U[0]->Email; ?>">
            </div>
        </div>
        <div style="display:flex;width:100%;">
            <div style="width:50%;">
                <input type="text" name="Specialite" placeholder="Specialite..." required class="input" value="<?php echo $U[0]->Specialite; ?>">
            </div>
            <div style="width:50%;">
                <input type="text" name="Login" placeholder="Login..." required class="input" value="<?php echo $U[0]->Login; ?>">
            </div>
        </div>
        <div style="display:flex;width:100%;">
            <div style="width:50%;">
                <input type="text" name="MotPass" placeholder="MotPass..." required class="input" value="<?php echo $U[0]->MotPass; ?>">
            </div>
            <div style="width:50%;">
                <select name="dept" required class="input">
                    <option selected disabled>--choisir une Dept--</option>
                    <?php
                    foreach ($Depts as $dpt) {
                        $dp = (array) $dpt;
                    ?>

                        <option <?php if ($U[0]->attributes()['dept'] == $dp["@attributes"]["idDept"]) echo "selected"; ?> value="<?php echo $dp["@attributes"]["idDept"] ?>"><?php echo $dp["@attributes"]["nom"] ?></option>
                    <?php
                    }
                    ?>

                </select>
            </div>
        </div>
        <input style="width:95%;" type="submit" name="submitModifEns" value="Ajouter">
    </form>
    <?php } else {
    if ($type == 'Etudiant') {
    ?>
        <form action="" method="post" class="Form-ModifAbs" style="width:70%;margin-left:15%;">
            <input type="hidden" name="idUser" value="<?php echo $id ?>">
            <div style="display:flex;width:100%;">
                <div style="width:50%;">
                    <input type="text" name="CIN" placeholder="CIN..." required class="input" value="<?php echo $U[0]->CIN; ?>">
                </div>
                <div style="width:50%;">
                    <input type="text" name="Nom" placeholder="Nom..." required class="input" value="<?php echo $U[0]->Nom; ?>">
                </div>
            </div>
            <div style=" display:flex;width:100%;">
                <div style="width:50%;">
                    <input type="text" name="Prenom" placeholder="Prenom..." required class="input" value="<?php echo $U[0]->Prenom; ?>">
                </div>
                <div style=" width:50%;">
                    <select name="Sexe" class="input">
                        <option <?php if ($U[0]->attributes()['Sexe'] == 'Masculin') echo "selected"; ?> value="Masculin">Masculin</option>
                        <option <?php if ($U[0]->attributes()['Sexe'] == 'fiminin') echo "selected"; ?> value="fiminin">fiminin</option>
                    </select>

                </div>
            </div>
            <div style="display:flex;width:100%;">
                <div style="width:50%;">
                    <input type="text" name="Phone" placeholder="Phone Portable ..." required class="input" value="<?php echo $U[0]->Phone; ?>">
                </div>
                <div style=" width:50%;">
                    <input type="email" name="Email" placeholder="Email Academique..." required class="input" value="<?php echo $U[0]->Email; ?>">
                </div>
            </div>
            <div style="display:flex;width:100%;">
                <div style="width:50%;">
                    <input type="text" name="Login" placeholder="Login..." required class="input" value="<?php echo $U[0]->Login; ?>">
                </div>
                <div style="width:50%;">
                    <input type="text" name="MotPass" placeholder="MotPass..." required class="input" value="<?php echo $U[0]->MotPass; ?>">
                </div>
            </div>
            <div style="display:flex;width:100%;">

                <div style="width:100%;">
                    <select name="Filiere" required class="input" style="width:95%;">
                        <option selected disabled>--choisir une Filiere--</option>
                        <?php
                        foreach ($Filieres as $filiere) {
                            $flr = (array) $filiere;
                        ?>

                            <option <?php if ($U[0]->attributes()['Filiere'] == $flr["@attributes"]["nom"]) echo "selected"; ?> value="<?php echo $flr["@attributes"]["nom"] ?>"><?php echo $flr["@attributes"]["nom"] ?></option>
                        <?php
                        }
                        ?>

                    </select>
                </div>
            </div>
            <input style="width:95%;" type="submit" name="submitModifEtu" value="Ajouter">
        </form>
    <?php } else { ?>
        <form action="" method="post" class="Form-ModifAbs">
            <input type="hidden" name="idUser" value="<?php echo $id ?>">
            <div style="display:flex;width:100%;">
                <div style="width:50%;">
                    <input type="text" name="CIN" placeholder="CIN..." required class="input" value="<?php echo $U[0]->CIN; ?>">
                </div>
                <div style="width:50%;">
                    <input type="text" name="Nom" placeholder="Nom..." required class="input" value="<?php echo $U[0]->Nom; ?>">
                </div>
            </div>
            <div style="display:flex;width:100%;">
                <div style="width:50%;">
                    <input type="text" name="Prenom" placeholder="Prenom..." required class="input" value="<?php echo $U[0]->Prenom; ?>">
                </div>
                <div style="width:50%;">
                    <select name="Sexe" class="input">
                        <option <?php if ($U[0]->attributes()['Sexe'] == 'Masculin') echo "selected"; ?> value="Masculin">Masculin</option>
                        <option <?php if ($U[0]->attributes()['Sexe'] == 'fiminin') echo "selected"; ?> value="fiminin">fiminin</option>
                    </select>

                </div>
            </div>
            <div style="display:flex;width:100%;">
                <div style="width:50%;">
                    <input type="text" name="Phone" placeholder="Phone..." required class="input" value="<?php echo $U[0]->Phone; ?>">
                </div>
                <div style="width:50%;">
                    <input type="email" name="Email" placeholder="Email..." required class="input" value="<?php echo $U[0]->Email; ?>">
                </div>
            </div>
            <div style="display:flex;width:100%;">
                <div style="width:50%;">
                    <input type="text" name="Login" placeholder="Login..." required class="input" value="<?php echo $U[0]->Login; ?>">
                </div>
                <div style="width:50%;">
                    <input type="text" name="MotPass" placeholder="MotPass..." required class="input" value="<?php echo $U[0]->MotPass; ?>">
                </div>
            </div>
            <div>
                <select name="dept" required style="width:95%;" class="input">
                    <option selected disabled>--choisir une Dept--</option>
                    <?php
                    foreach ($Depts as $dpt) {
                        $dp = (array) $dpt;
                    ?>

                        <option <?php if ($U[0]->attributes()['dept'] == $dp["@attributes"]["idDept"]) echo "selected"; ?> value="<?php echo $dp["@attributes"]["idDept"] ?>"><?php echo $dp["@attributes"]["nom"] ?></option>
                    <?php
                    }
                    ?>

                </select>
            </div>
            <input style="width:95%;" type="submit" name="submitModifAgent" value="Ajouter">
        </form>

<?php }
} ?>