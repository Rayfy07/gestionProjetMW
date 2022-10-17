<?php

require_once __DIR__."/require/navbar.php";
require "Autoloader.php";

use App\connection\DataBaseConnection;
use App\class\Customer;
use App\validators\CustomerValidation;
use App\updates\CustomerUpdate;

$database = DataBaseConnection::connect();

$name = $code = $notes = $validate = $error = $errorFounding = "";

if(isset($_GET["id"]))
{
    $id = $_GET["id"];

    $select = $database -> prepare("SELECT * FROM customer WHERE id = ?");
    $select -> execute(array($id));
    if($rowSelect = $select -> fetch())
    {
        $name = $rowSelect["name"];
        $code = $rowSelect["code"];
        $notes = $rowSelect["notes"];
    }
    else
    {
        $errorFounding = "Ce client n'existe pas";
    }
}
else
{
    $errorFounding = "Un problème a été rencontré dans le chargement de la page";
}

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
            $error = "Erreur dans la modification du client";
        }
    }
    else
    {
        $error = "Un des champs est mal rempli";
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

        <?php

        if($errorFounding != "")
        {
            echo'   <div class="alert alert-danger" role="alert">
                            <p>'.$errorFounding.'</p>
                        </div>
                    ';
        }
        else
        {
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
                    <button class="btn btn-secondary mb-3" type="reset">Annuler la modification du client</button>
                    <button class="btn btn-primary mb-3" name="edit" type="submit">Modifier le client</button>';
        
            if($validate != "") {
                echo'   <div class="alert alert-success" role="alert">
                            <p>'.$validate.'</p>
                        </div>
                    ';
            }
            else if($error != "") {
                echo'   <div class="alert alert-danger" role="alert">
                            <p>'.$error.'</p>
                        </div>
                    ';
            }
            echo'   </form>';
        }

        ?>
    </div>

    <div id="contact">
        <h2>Contact</h2>
    </div>
    
</section>

<script src="/gestionProjetMW/javaScript/client.js"></script>

<?php require_once __DIR__."/require/footer.php"; ?>