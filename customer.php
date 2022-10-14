<?php

require_once __DIR__."/require/navbar.php";
require "Autoloader.php";

use App\connection\DataBaseConnection;
use App\class\Customer;
use App\validators\CustomerValidation;
use App\inserts\CustomerInsertion;

$database = DataBaseConnection::connect();

$code = $validate = "";

if (isset($_POST["submit"]))
{
    $select = $database -> prepare("SELECT id FROM customer ORDER BY id DESC limit 1");
    $select -> execute();
    $id = $select -> fetch();

    $customer = new Customer($id["id"]+1, $_POST["name-customer"], $_POST["name-customer"], $_POST["note-customer"]);

    if(CustomerValidation::isValid($customer))
    {
        if (CustomerInsertion::insert($customer))
        {
            $validate = "Le Client a bien été ajouté";
            $code = "";
        }
        else
        {
            $validate = "Erreur dans l'ajout du client";
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
            <button class="btn btn-primary mb-3" name="submit" type="submit">Ajouter le client</button>

            <span><?php echo $validate?></span>
        </form>
    </div>

    <div id="contact">
        <h2>Contact</h2>
    </div>
    
</section>

<script src="/gestionProjetMW/javaScript/client.js"></script>

<?php require_once __DIR__."/require/footer.php"; ?>