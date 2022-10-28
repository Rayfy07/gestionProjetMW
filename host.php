<?php

require_once __DIR__."/require/navbar.php";
require "Autoloader.php";

use App\
{
    class\Host,
    validators\HostValidation,
    repository\HostRepository
};

$code = "";
$validate = "";
$error = "";

if (isset($_POST["delete-host"])) {

    $id = $_POST["id"];
    $code = $_POST["code"];
    $name = $_POST["name"];
    $notes = $_POST["notes"];

    $host = new Host(
        $id,
        $code,
        $name,
        $notes
    );

    if(HostRepository::hasProject($id))
    {
        $error = "L'hébergeur est lié à un projet et ne peut être supprimer";
    } elseif (HostRepository::delete($host)) {
        $validate = "L'hébergeur a bien été supprimé";
    } else {
        $error = "Echec de la suppression de l'hébergeur";
    }
}

$hosts = HostRepository::selectAll();
?>


<section class="add-host">
    <h1>Liste des hébergeurs <a href="add-host.php"><i class="bi bi-plus-circle" title="Ajouter un nouvel hébergeur"></i></a></h1>

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

            foreach ($hosts as $value) {
                echo '
                <tr>
                    <th scope="row">'.$value->getCode().'</th>
                    <td>'.$value->getName().'</td>
                    <td>'.$value->getNotes().'</td>
                    <td>
                        <a href="update-host.php?id='.$value->getId().'" class="btn btn-link">Modifier</a> 
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal'.$value->getId().'">Supprimer l\'hébergeur</button>
                            <div class="modal fade" id="deleteModal'.$value->getId().'" tabindex="-1" aria-labelledby="deleteModalLabel'.$value->getId().'" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel'.$value->getId().'">Supperssion de l\'hébergeur</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h3>Êtes-vous sûr de vouloir supprimer l\'hébergeur n°'.$value->getId().'</h3>
                                            <p>L\'hébergeur '.$value->getName().'</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-link" data-bs-dismiss="modal">Annuler la suppression</button>
                                            <form method="post">
                                                <input type="hidden" name="id" value="'.$value->getId().'">
                                                <input type="hidden" name="code" value="'.$value->getCode().'">
                                                <input type="hidden" name="name" value="'.$value->getName().'">
                                                <input type="hidden" name="notes" value="'.$value->getNotes().'">
                                                <button class="btn btn-danger" name="delete-host" type="submit" data-bs-toggle="modal" data-bs-target="#deleteModal'.$value->getId().'">Supprimer l\'hébergeur</button>
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