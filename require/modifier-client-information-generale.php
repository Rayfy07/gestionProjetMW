<?php

require_once __DIR__."/navbar.php";
use App\connection\DataBaseConnect;
use App\validators\CustomerValidator;
use App\updates\CustomerUpdate;

$database = DataBaseConnect::connect();

$name = $code = $notes = "";
$id = $_GET["id"];

$select = $database -> prepare("SELECT * FROM customer WHERE id = ?");
$select -> execute(array($id));
$rowSelect = $select -> fetch();

$name = $rowSelect["name"];
$code = $rowSelect["code"];
$notes = $rowSelect["notes"];

if (isset($_POST["edit"])) {
    $code = "CUST_".$_POST["name-customer"];
    $code = strtoupper($code);
    $code = str_replace(" ", "_", $code);

    $customer = new Customer($id, $code, $_POST["name-customer"], $_POST["note-customer"]);

    if(CustomerValidator::isValid($customer))
    {
        if (CustomerUpdate::update($customer))
        {
            $validate = "Le Client a bien été modifié";
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

$database = DataBaseConnect::disconnect();

?>


<section class="add-customer">
    <h1>Nouveau client</h1>
    <div class="flex-add-customer">
        <ul>
            <li class="btn btn-link" onclick="show()">
                Informations générales
            </li>
            <li class="btn btn-link" onclick="show()">
                Contact
            </li>
        </ul>
    </div>
    
    <div id="info">
        <form action="" method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingName" placeholder="Jean Dupont" value="<?php echo $name ?>">
                <label for="floatingName">Nom du client</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingCode" placeholder="CUST-FEDERATION-FRANCAISE-DE-DANSE" disabled value="<?php echo $code ?>">
                <label for="floatingCode">Code interne</label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Notes/Remarques" id="floatingNote" style="height: 100px"><?php echo $notes ?></textarea>
                <label for="floatingNote">Notes ou remarques</label>
            </div>
            <button class="btn btn-secondary mb-3" type="reset">Annuler l'ajout du client</button>
            <button class="btn btn-primary mb-3" type="submit">Ajouter le client</button>
        </form>
    </div>

    <div id="contact">
        <h2>Contact</h2>
    </div>
    
</section>

<script src="/phpPoo/tp/javaScript/client.js"></script>

<?php require_once __DIR__."/footer.php"; ?>