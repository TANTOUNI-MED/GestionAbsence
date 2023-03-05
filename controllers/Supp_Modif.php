<?php
if (isset($_POST['supprimerUser'])) {
    $type = $_POST['type'];
    $id = $_POST['id'];
    $idUser = $_POST['idUser'];
    $data = simplexml_load_file('../data/data.xml');
    $users = $data->xpath("//" . $type);
    $i = 0;
    foreach ($users as $user) {
        $u = (array)$user;
        if ($type != 'Matiere') {
            if ($u['@attributes']['IdUser'] == $id) {
                if ($type == "Enseignant") {
                    unset($data->Enseignants->Enseignant[$i]);
                    break;
                } else {
                    if ($type == "Etudiant") {
                        unset($data->Etudiants->Etudiant[$i]);
                        break;
                    } else {
                        if ($type == "Agent_S") {
                            unset($data->Agents->Agent_S[$i]);
                            break;
                        }
                    }
                }
            } else {
                $i++;
            }
        } else {
            if ($u['@attributes']['CodeMatiere'] == $id) {
                unset($data->Matieres->Matiere[$i]);
                break;
            } else {
                $i++;
            }
        }
    }
    file_put_contents('../data/data.xml', $data->asXML());
    header('location:../Pages/Admin.php?idUser=' . $idUser);
}
if (isset($_POST['Modifier'])) {
    $type = $_POST['type'];
    $idUser = $_POST['idUser'];
    $id = $_POST['id'];
    if ($type == "Matiere") {
        header('location:Modifier_Matiere.php?idUser=' . $idUser . '&user=' . $id . '&type=' . $type);
    } else {
        header('location:Modifier_User.php?idUser=' . $idUser . '&user=' . $id . '&type=' . $type);
    }
}
