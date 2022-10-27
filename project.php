<?php

require_once __DIR__."/require/navbar.php";
require "Autoloader.php";

use App\
{
    class\Project,
    validators\ProjectValidation,
    repository\ProjectRepository,
    repository\CustomerRepository,
    repository\HostRepository
};

$code = "";
$validate = "";
$error = "";

if (isset($_POST["delete-project"])) {

    $id = $_POST["id"];
    $name = $_POST["name-project"];
    $code = $_POST["code"];
    $lastFolder = $_POST["lastpass_folder"];
    $linkMock = $_POST["link_mock_ups"];
    $managedServer = $_POST["managed_server"];
    $notes = $_POST["note-project"];

    $cust = CustomerRepository::selectByName($_POST["cust"]);
    $host = HostRepository::selectByName($_POST["hostt"]);
    
    $project = new Project(
        $id,
        $name,
        $code,
        $lastFolder,
        $linkMock,
        $managedServer,
        $notes,
        $host,
        $cust
    );

    if(ProjectRepository::delete($project))
    {
        $validate = "Le projet a bien été supprimé";
    } else {
        $error = "Echec de la suppression du projet";
    }
}

$projects = ProjectRepository::selectAll();
?>


<section class="add-project">
    <h1>Liste des projets <a href="add-project.php"><i class="bi bi-plus-circle" title="Ajouter un nouvel hébergeur"></i></a></h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Code Interne</th>
                <th scope="col">Nom</th>
                <th scope="col">Notes/remarques</th>
                <th scope="col">Options</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if ($validate != "") {
                echo'<div class="alert alert-success" role="alert">
                        <p>'.$validate.'</p>
                    </div>';
            } elseif ($error != "") {
                echo'<div class="alert alert-danger" role="alert">
                        <p>'.$error.'</p>
                    </div>';
            }

            foreach ($projects as $value) {
                echo '
                <tr>
                    <th scope="row">'.$value->getCode().'</th>
                    <td>'.$value->getName().'</td>
                    <td>'.$value->getNotes().'</td>
                    <td>
                        <a href="update-project.php?id='.$value->getId().'" class="btn btn-link">Modifier</a> 
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal'.$value->getId().'">Supprimer le projet</button>
                            <div class="modal fade" id="deleteModal'.$value->getId().'" tabindex="-1" aria-labelledby="deleteModalLabel'.$value->getId().'" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel'.$value->getId().'">Supperssion de le projet</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h3>Êtes-vous sûr de vouloir supprimer le projet n°'.$value->getId().'</h3>
                                            <p>Le projet '.$value->getName().'</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-link" data-bs-dismiss="modal">Annuler la suppression</button>
                                            <form method="post">
                                                <input type="hidden" name="id" value="'.$value->getId().'">
                                                <input type="hidden" name="name-project" value="'.$value->getName().'">
                                                <input type="hidden" name="code" value="'.$value->getCode().'">
                                                <input type="hidden" name="lastpass_folder" value="'.$value->getLastPassFolder().'">
                                                <input type="hidden" name="link_mock_ups" value="'.$value->getLinkMockUps().'">
                                                <input type="hidden" name="managed_server" value="'.$value->getManagedServer().'">
                                                <input type="hidden" name="note-project" value="'.$value->getNotes().'">
                                                <input type="hidden" name="hostt" value="'.$value->getHost()->getName().'">
                                                <input type="hidden" name="cust" value="'.$value->getCustomer()->getName().'">
                                                <button class="btn btn-danger" name="delete-project" type="submit" data-bs-toggle="modal" data-bs-target="#deleteModal'.$value->getId().'">Supprimer le projet</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </td>
                </tr>
                ';
            }
        ?>
        </tbody>
    </table>
</section>

<?php require_once __DIR__."/require/footer.php"; ?>
