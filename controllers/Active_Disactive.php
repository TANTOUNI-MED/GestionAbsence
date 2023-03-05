<?php
if (isset($_POST['ActiveUser'])) {
    $type = $_POST['type'];
    $id = $_POST['id'];
    $idUser = $_POST['idUser'];
    $data = simplexml_load_file('../data/data.xml');
    $users = $data->xpath("//" . $type);
    $i = 0;
    foreach ($users as $user) {
        $u = (array)$user;
        if ($u['@attributes']['IdUser'] == $id) {
            if ($type == "Enseignant") {
                $data->Enseignants->Enseignant[$i]->Active = 1;
                break;
            } else {
                if ($type == "Etudiant") {
                    $data->Etudiants->Etudiant[$i]->Active = 1;
                    break;
                } else {
                    if ($type == "Agent_S") {
                        $data->Agents->Agent_S[$i]->Active = 1;
                        break;
                    }
                }
            }
        } else {
            $i++;
        }
    }
    file_put_contents('../data/data.xml', $data->asXML());
    header('location:../Pages/Admin.php?idUser=' . $idUser);
}
if (isset($_POST['DisactiveUser'])) {
    $type = $_POST['type'];
    $id = $_POST['id'];
    $idUser = $_POST['idUser'];
    $data = simplexml_load_file('../data/data.xml');
    $users = $data->xpath("//" . $type);
    $i = 0;
    foreach ($users as $user) {
        $u = (array)$user;
        if ($u['@attributes']['IdUser'] == $id) {
            if ($type == "Enseignant") {
                $data->Enseignants->Enseignant[$i]->Active = 0;
                break;
            } else {
                if ($type == "Etudiant") {
                    $data->Etudiants->Etudiant[$i]->Active = 0;
                    break;
                } else {
                    if ($type == "Agent_S") {
                        $data->Agents->Agent_S[$i]->Active = 0;
                        break;
                    }
                }
            }
        } else {
            $i++;
        }
    }
    file_put_contents('../data/data.xml', $data->asXML());
    header('location:../Pages/Admin.php?idUser=' . $idUser);
}
