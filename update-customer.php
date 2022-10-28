<?php

require_once __DIR__."/require/navbar.php";
require "Autoloader.php";

use App\
{
    class\Customer,
    validators\CustomerValidation,
    repository\CustomerRepository
};

$name = "";
$code = "";
$notes = "";
$validate = "";
$error = "";
$errorFounding = "";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    
    if (is_numeric($id)) {
        if ($customer = CustomerRepository::selectById($id)) {
            $name = $customer->getName();
            $code = $customer->getCode();
            $notes = $customer->getNotes();
        } else {
            $errorFounding = "Ce client n'existe pas";
        }
    } else {
        $errorFounding = "Impossible de faire une modification sur un ID n'étant pas un entier";
    }
} else {
    $errorFounding = "Un problème a été rencontré dans le chargement de la page";
}

if (isset($_POST["edit"])) {

    $customer = new Customer(
        $id,
        $_POST["name-customer"],
        $_POST["name-customer"],
        $_POST["note-customer"]
    );

    if (CustomerValidation::isValid($customer))
    {
        if (CustomerRepository::update($customer)) {
            $validate = "Le Client a bien été modifié";
            $name = $customer->getName();
            $code = $customer->getCode();
            $notes = $customer->getNotes();
        } else {
            $error = "Erreur dans la modification du client";
        }
    } else {
        $error = "Un des champs est mal rempli";
    }
}

if (isset($_POST['dont-edit-contact'])) {
    header('Location: customer.php');
    exit;
}

if (isset($_POST['dont-edit-customer'])) {
    header('Location: customer.php');
    exit;
}

?>

<section class="add-customer">
    <h1>Modifier un client</h1>
    <div class="flex-add-customer">
        <ul>
            <li id="infoBtn" class="btn btn-link">
                Informations générales
            </li>
            <li id="contactBtn" class="btn btn-link">
                Contact
            </li>
        </ul>
    </div>
    
    <div id="info">
        <h2>Informations générales</h2>
        <?php

            if ($errorFounding != "") {
                echo'   <div class="alert alert-danger" role="alert">
                                <p>'.$errorFounding.'</p>
                            </div>
                        ';
            } else {
                echo'   <form action="" method="post">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="name-customer" id="floatingName" placeholder="Jean Dupont" value="'.$name.'">
                                <label for="floatingName">Nom du client</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="code-intra" id="floatingCode" placeholder="CUST-FEDERATION-FRANCAISE-DE-DANSE" disabled value="'.$code.'">
                                <label for="floatingCode">Code interne</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Notes/Remarques" name="note-customer" id="floatingNote" style="height: 100px">'.$notes.'</textarea>
                                <label for="floatingNote">Notes ou remarques</label>
                            </div>
                            <button class="btn btn-secondary mb-3" name="dont-edit-customer" type="submit">Ne pas modifier le client</button>
                            <button class="btn btn-primary mb-3" name="edit" type="submit">Modifier le client</button>
                        </form>';

                if ($validate != "") {
                    echo'   <div class="alert alert-success" role="alert">
                                <p>'.$validate.'</p>
                            </div>
                        ';
                } elseif($error != "") {
                    echo'   <div class="alert alert-danger" role="alert">
                                <p>'.$error.'</p>
                            </div>
                        ';
                }
            }
        ?>
    </div>

    <div id="contact">
        <h2>Contact</h2>
        
        <?php

            if ($errorFounding != "") {
                echo'   <div class="alert alert-danger" role="alert">
                                <p>'.$errorFounding.'</p>
                            </div>
                        ';
            } else {
                echo'   <form action="" method="post">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="name-contact" id="floatingName" placeholder="Jean Dupont" value="'.$name.'">
                                <label for="floatingName">Nom du contact</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="role-contact" id="floatingRole" placeholder="Chef de projet" value="'.$code.'">
                                <label for="floatingRole">Role du contact</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="mail-contact" id="floatingMail" placeholder="Jean.Dupont@gmail.com" value="'.$name.'">
                                <label for="floatingMail">Mail du contact</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="phone" class="form-control" name="phone-contact" id="floatingPhone" placeholder="0102030405" value="'.$name.'">
                                <label for="floatingPhone">Téléphone du contact</label>
                            </div>
                            <button class="btn btn-secondary mb-3" name="dont-edit-contact" type="submit">Ne pas modifier le contact</button>
                            <button type="button" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#deleteModal">Supprimer le contact</button>
                            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Supperssion du contact</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h3>Êtes-vous sûr de vouloir supprimer le contact n° </h3>
                                            <p>Le contact ...</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-link" data-bs-dismiss="modal">Annuler la suppression</button>
                                            <button type="button" class="btn btn-danger" name="delete-contact" type="submit" data-bs-toggle="modal" data-bs-target="#deleteModal">Supprimer le contact</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary mb-3" name="edit" type="submit">Modifier le contact</button>
                        </form>';

                if ($validate != "") {
                    echo'<div class="alert alert-success" role="alert">
                            <p>'.$validate.'</p>
                        </div>';
                } elseif($error != "") {
                    echo'<div class="alert alert-danger" role="alert">
                            <p>'.$error.'</p>
                        </div>';
                }
            }

        ?>
    </div>
    
</section>

<script src="/gestionProjetMW/javaScript/infoContact.js"></script>

<?php require_once __DIR__."/require/footer.php"; ?>
