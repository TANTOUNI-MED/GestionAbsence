<?php
if (isset($_POST["submitAjout"])) {
    $Enseignant = $_POST["Enseignant"];
    $Matiere = $_POST["Matiere"];
    $DateS = $_POST["DateS"];
    $HeureDebut = $_POST["HeureDebut"];
    $HeureFin = $_POST["HeureFin"];
    $TypeS = $_POST["TypeS"];
    $IdSeance = uniqid('S');

    $data = simplexml_load_file('../data/data.xml');
    $sc = $data->Seances->addChild('Seance');
    $sc->addAttribute('IdSeance', $IdSeance);
    $sc->addAttribute('Enseignant', $Enseignant);
    $sc->addAttribute('Matiere', $Matiere);
    $sc->addChild('DateS', $DateS);
    $sc->addChild('HeureDebut', $HeureDebut);
    $sc->addChild('HeureFin', $HeureFin);
    $sc->addChild('TypeS', $TypeS);
    file_put_contents('../data/data.xml', $data->asXML());
    header('location:../pages/Enseignant.php?idUser=' . $Enseignant);
}
if (isset($_POST["submitAjoutEns"])) {
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
    $idEns = uniqid('En');

    $data = simplexml_load_file('../data/data.xml');
    $ens = $data->Enseignants->addChild('Enseignant');
    $ens->addAttribute('IdUser', $idEns);
    $ens->addAttribute('Sexe', $Sexe);
    $ens->addAttribute('dept', $dept);
    $ens->addChild('CIN', $CIN);
    $ens->addChild('Nom', $Nom);
    $ens->addChild('Prenom', $Prenom);
    $ens->addChild('Phone', $Phone);
    $ens->addChild('Email', $Email);
    $ens->addChild('Specialite', $Specialite);
    $ens->addChild('Login', $Login);
    $ens->addChild('MotPass', $MotPass);
    file_put_contents('../data/data.xml', $data->asXML());
    header('location:../controllers/AjouterEnseignant.php?idUser=' . $_POST["idUser"]);
}

if (isset($_POST["submitAjoutEtud"])) {
    $Sexe = $_POST["Sexe"];
    $CIN = $_POST["CIN"];
    $Nom = $_POST["Nom"];
    $Prenom = $_POST["Prenom"];
    $Phone = $_POST["Phone"];
    $Email = $_POST["Email"];
    $Login = $_POST["Login"];
    $MotPass = $_POST["MotPass"];
    $Filiere = $_POST["Filiere"];
    $idEns = uniqid('Et');

    $data = simplexml_load_file('../data/data.xml');
    $ens = $data->Etudiants->addChild('Etudiant');
    $ens->addAttribute('IdUser', $idEns);
    $ens->addAttribute('Sexe', $Sexe);
    $ens->addAttribute('Filiere', $Filiere);
    $ens->addChild('CIN', $CIN);
    $ens->addChild('Nom', $Nom);
    $ens->addChild('Prenom', $Prenom);
    $ens->addChild('Phone', $Phone);
    $ens->Phone->addAttribute('Type', "Portable");
    $ens->addChild('Email', $Email);
    $ens->Email->addAttribute('Type', "Academique");
    $ens->addChild('Login', $Login);
    $ens->addChild('MotPass', $MotPass);
    file_put_contents('../data/data.xml', $data->asXML());
    header('location:../controllers/AjouterEtudiant.php?idUser=' . $_POST["idUser"]);
}
if (isset($_POST["submitAjoutAgent"])) {
    $Sexe = $_POST["Sexe"];
    $CIN = $_POST["CIN"];
    $Nom = $_POST["Nom"];
    $Prenom = $_POST["Prenom"];
    $Phone = $_POST["Phone"];
    $Email = $_POST["Email"];
    $Login = $_POST["Login"];
    $MotPass = $_POST["MotPass"];
    $dept = $_POST["dept"];
    $idEns = uniqid('Ag');

    $data = simplexml_load_file('../data/data.xml');
    $etud = $data->Agents->addChild('Agent_S');
    $etud->addAttribute('IdUser', $idEns);
    $etud->addAttribute('Sexe', $Sexe);
    $etud->addAttribute('dept', $dept);
    $etud->addChild('CIN', $CIN);
    $etud->addChild('Nom', $Nom);
    $etud->addChild('Prenom', $Prenom);
    $etud->addChild('Phone', $Phone);
    $etud->addChild('Email', $Email);
    $etud->addChild('Login', $Login);
    $etud->addChild('MotPass', $MotPass);
    file_put_contents('../data/data.xml', $data->asXML());
    header('location:../controllers/AjouterAgent.php?idUser=' . $_POST["idUser"]);
}
if (isset($_POST["submitAjoutMtr"])) {
    $Coeffecient = $_POST["Coeffecient"];
    $Intitule = $_POST["Intitule"];
    $Filiere = $_POST["Filiere"];
    $dept = $_POST["dept"];
    $CodeMatiere = uniqid('Mtr');

    $data = simplexml_load_file('../data/data.xml');
    $mtr = $data->Matieres->addChild('Matiere');
    $mtr->addChild('Intitule', $Intitule);
    $mtr->addChild('Coeffecient', $Coeffecient);
    $mtr->addAttribute('CodeMatiere', $CodeMatiere);
    $mtr->addAttribute('dept', $dept);
    $mtr->addAttribute('Filiere', $Filiere);
    $mtr->addAttribute('Enseignant', '');
    file_put_contents('../data/data.xml', $data->asXML());
    header('location:../controllers/AjouterMatiere.php?idUser=' . $_POST["idUser"]);
}
if (isset($_POST['AffecterMatiere'])) {
    $idAdmin = $_POST['idUser'];
    $idEns = $_POST['idEns'];
    $idMat = $_POST['Matiere'];
    $data = simplexml_load_file('../data/data.xml');
    $Matiers = $data->xpath("//Matieres/*");
    $i = 0;
    foreach ($Matiers as $mat) {
        $m = (array)$mat;
        if ($m['@attributes']['CodeMatiere'] == $idMat) {
            $data->xpath("//Matiere[@CodeMatiere = '" . $idMat . "']")[0]->attributes()['Enseignant'] = $idEns;

            break;
        } else {
            $i++;
        }
    }
    file_put_contents('../data/data.xml', $data->asXML());
    header('location:../Pages/Admin.php?idUser=' . $idAdmin);
}
