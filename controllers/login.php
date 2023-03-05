<?php
if (isset($_POST['log'])) {
    $data = simplexml_load_file('../data/data.xml');
    $login = $_POST['login'];
    $pass = $_POST['password'];
    $type = $_POST['type'];
    $result = $data->xpath("//" . $type . "/*");
    foreach ($result as $r) {
        if ($r->Login == $login && $r->MotPass == $pass) {
            $array = (array)$r;

            if ($type == "Admins") {
                header('location:../Pages/Admin.php?idUser=' . $array['@attributes']['IdUser']);
            } else {
                if ($array['Active'] == 1) {
                    if ($type == "Enseignants") {
                        header('location:../Pages/Enseignant.php?idUser=' . $array['@attributes']['IdUser']);
                    } else {
                        if ($type == "Agents") {
                            header('location:../Pages/Agent.php?idUser=' . $array['@attributes']['IdUser']);
                        } else {
                            if ($type == "Etudiants") {
                                header('location:../Pages/Etudiant.php?idUser=' . $array['@attributes']['IdUser']);
                            }
                        }
                    }
                } else {
                    header('location:../index.php?CompteNonActive');
                }
            }

            break;
        } else {
            header('location:../index.php?erreur');
        }
    }
}
