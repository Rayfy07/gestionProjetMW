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

if (isset($_POST["add-host"]))
{
    $host = new Host(
        0,
        $_POST["name-host"],
        $_POST["name-host"],
        $_POST["note-host"]
    );

    if(HostValidation::isValid($host))
    {
        if (HostRepository::insert($host))
        {
            $validate = "L'hébergeur a bien été ajouté";
            $code = "";
            header("Location: update-host.php?id=".$host->getId());
        } else {
            $error = "Erreur dans l'ajout de l'hébergeur";
        }
    } else {
        $error = "Le nom doit être renseigné";
    }
}
?>


<section class="add-customer">
    <h1>Nouveau hébergeur</h1>
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
                <input type="text" name="name-host" class="form-control" id="floatingName" placeholder="Jean Dupont">
                <label for="floatingName">Nom de l'hébergeur</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="code-intra" class="form-control" id="floatingCode" disabled placeholder=" ">
                <label for="floatingCode">Code interne généré automatiquement</label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" name="note-host" placeholder="Notes/Remarques" id="floatingNote" style="height: 100px"></textarea>
                <label for="floatingNote">Notes ou remarques</label>
            </div>
            <button class="btn btn-secondary mb-3" type="reset">Annuler l'ajout de l'hébergeur</button>
            <button class="btn btn-primary mb-3" name="add-host" type="submit">Ajouter l'hébergeur</button>

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
