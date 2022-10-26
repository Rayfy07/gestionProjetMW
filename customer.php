<?php

require_once __DIR__."/require/navbar.php";
require "Autoloader.php";

use App\
{
    class\Customer,
    validators\CustomerValidation,
    repository\CustomerRepository
};

$code = "";
$validate = "";
$error = "";

if (isset($_POST["delete-contact"])) {

    $id = $_POST["id"];
    $code = $_POST["code"];
    $name = $_POST["name"];
    $notes = $_POST["notes"];

    $customer = new Customer(
        $id,
        $code,
        $name,
        $notes
    );

    if(CustomerRepository::hasProject($id))
    {
        $error = "Le client est lié à un projet et ne peut être supprimer";
    } elseif (CustomerRepository::delete($customer)) {
        $validate = "Le Client a bien été supprimé";
    } else {
        $error = "Echec de la suppression du client (Peut etre lié à un contact)";
    }
}

$customers = CustomerRepository::selectAll();
?>


<section class="add-customer">
    <h1>Liste des clients <a href="add-customer.php"><i class="bi bi-plus-circle" title="Ajouter un nouveau contact"></i></a></h1>

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
            foreach ($customers as $value) {
                echo '
                <tr>
                    <th scope="row">'.$value->getCode().'</th>
                    <td>'.$value->getName().'</td>
                    <td>'.$value->getNotes().'</td>
                    <td>
                        <a href="update-customer.php?id='.$value->getId().'" class="btn btn-link">Modifier</a> 
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal'.$value->getId().'">Supprimer le client</button>
                            <div class="modal fade" id="deleteModal'.$value->getId().'" tabindex="-1" aria-labelledby="deleteModalLabel'.$value->getId().'" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel'.$value->getId().'">Supperssion du client</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h3>Êtes-vous sûr de vouloir supprimer le client n°'.$value->getId().'</h3>
                                            <p>Le client '.$value->getName().'</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-link" data-bs-dismiss="modal">Annuler la suppression</button>
                                            <form method="post">
                                                <input type="hidden" name="id" value="'.$value->getId().'">
                                                <input type="hidden" name="code" value="'.$value->getCode().'">
                                                <input type="hidden" name="name" value="'.$value->getName().'">
                                                <input type="hidden" name="notes" value="'.$value->getNotes().'">
                                                <button class="btn btn-danger" name="delete-contact" type="submit" data-bs-toggle="modal" data-bs-target="#deleteModal'.$value->getId().'">Supprimer le contact</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </td>
                </tr>
                ';
            }
            if ($validate != "") {
                echo'   <div class="alert alert-success" role="alert">
                            <p>'.$validate.'</p>
                        </div>
                    ';
            }
            elseif ($error != "") {
                echo'   <div class="alert alert-danger" role="alert">
                            <p>'.$error.'</p>
                        </div>
                    ';
            }
        ?>
        </tbody>
    </table>
</section>

<?php require_once __DIR__."/require/footer.php"; ?>
