<?php

require_once __DIR__."/require/navbar.php";
require "Autoloader.php";

use App\connection\DataBaseConnection;
use App\class\Customer;
use App\validators\CustomerValidation;
use App\updates\CustomerUpdate;

$database = DataBaseConnection::connect();

$name = $code = $notes = $validate ="";

$id = $_GET["id"];

$select = $database -> prepare("SELECT * FROM customer WHERE id = ?");
$select -> execute(array($id));
$rowSelect = $select -> fetch();

$name = $rowSelect["name"];
$code = $rowSelect["code"];
$notes = $rowSelect["notes"];

if (isset($_POST["edit"])) {

    $customer = new Customer($id, $_POST["name-customer"], $_POST["name-customer"], $_POST["note-customer"]);

    if(CustomerValidation::isValid($customer))
    {
        if (CustomerUpdate::update($customer))
        {
            $validate = "Le Client a bien été modifié";
            $name = $customer->getName();
            $code = $customer->getCode();
            $notes = $customer->getNotes();
        }
        else
        {
            $validate = "Erreur dans la modification du client";
        }
    }
    else
    {
        $validate = "Un des champs est mal rempli";
    }

}

$database = DataBaseConnection::disconnect();

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
        <form action="" method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="name-customer" id="floatingName" placeholder="Jean Dupont" value="<?php echo $name ?>">
                <label for="floatingName">Nom du client</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="code-intra" id="floatingCode" placeholder="CUST-FEDERATION-FRANCAISE-DE-DANSE" disabled value="<?php echo $code ?>">
                <label for="floatingCode">Code interne</label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Notes/Remarques" name="note-customer" id="floatingNote" style="height: 100px"><?php echo $notes ?></textarea>
                <label for="floatingNote">Notes ou remarques</label>
            </div>
            <button class="btn btn-secondary mb-3" type="reset">Annuler la modification du client</button>
            <button class="btn btn-primary mb-3" name="edit" type="submit">Modifier le client</button>

            <span><?php echo $validate?></span>
        </form>
    </div>

    <div id="contact">
        <h2>Contact</h2>
    </div>
    
</section>

<script src="/gestionProjetMW/javaScript/client.js"></script>

<?php require_once __DIR__."/require/footer.php"; ?>