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

if (isset($_POST["add-customer"]))
{
    $customer = new Customer(
        0,
        $_POST["name-customer"],
        $_POST["name-customer"],
        $_POST["note-customer"]
    );

    if (CustomerValidation::isValid($customer)) {
        $nameExist = CustomerRepository::nameExist($customer->getName());
        if ($nameExist === false) {
            if (CustomerRepository::insert($customer)) {
                $validate = "Le Client a bien été ajouté";
                $code = "";
                header("Location: update-customer.php?id=".$customer->getId());
            } else {
                $error = "Erreur dans l'ajout du client";
            }
        } elseif ($nameExist === null) {
            $error = "Problème de connexion";
        } else {
            $error = "Ce client existe déjà";
        }
    } else {
        $error = "Le nom doit être renseigné";
    }
}
?>


<section class="add-customer">
    <h1>Nouveau client</h1>
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
        <form action="" method="post">
            <div class="form-floating mb-3">
                <input type="text" name="name-customer" class="form-control" id="floatingName" placeholder="Jean Dupont">
                <label for="floatingName">Nom du client</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="code-intra" class="form-control" id="floatingCode" disabled placeholder=" ">
                <label for="floatingCode">Code interne généré automatiquement</label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" name="note-customer" placeholder="Notes/Remarques" id="floatingNote" style="height: 100px"></textarea>
                <label for="floatingNote">Notes ou remarques</label>
            </div>
            <button class="btn btn-secondary mb-3" type="reset">Annuler l'ajout du client</button>
            <button class="btn btn-primary mb-3" name="add-customer" type="submit">Ajouter le client</button>

            <?php 
                if($validate != "") {
                    echo'<div class="alert alert-success" role="alert">
                            <p>'.$validate.'</p>
                        </div>';
                }
                else if($error != "") {
                    echo'<div class="alert alert-danger" role="alert">
                            <p>'.$error.'</p>
                        </div>';
                }
            ?>
        </form>
    </div>
    <div id="contact">
        <form action="" method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="name-contact" id="floatingName" placeholder="Jean Dupont">
                <label for="floatingName">Nom du contact</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="role-contact" id="floatingRole" placeholder="Chef de projet">
                <label for="floatingRole">Role du contact</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" name="mail-contact" id="floatingMail" placeholder="Jean.Dupont@gmail.com">
                <label for="floatingMail">Mail du contact</label>
            </div>
            <div class="form-floating mb-3">
                <input type="phone" class="form-control" name="phone-contact" id="floatingPhone" placeholder="0102030405">
                <label for="floatingPhone">Téléphone du contact</label>
            </div>
            <button class="btn btn-secondary mb-3" name="dont-add-contact" type="reset">Annuler l'ajout du contact</button>
            <button class="btn btn-primary mb-3" name="add-contact" type="submit">Ajouter le contact</button>
        </form>
    </div>
</section>

<script src="/gestionProjetMW/javaScript/infoContact.js"></script>

<?php require_once __DIR__."/require/footer.php"; ?>