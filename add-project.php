<?php

require_once __DIR__."/require/navbar.php";
require "Autoloader.php";

use App\
{
    class\Project,
    validators\ProjectValidation,
    repository\ProjectRepository,
    repository\CustomerRepository,
    repository\HostRepository,
    connection\DataBaseConnection
};

$code = "";
$validate = "";
$error = "";

if (isset($_POST["add-project"]))
{
    $customer = CustomerRepository::selectByName($_POST["customer_id"]);
    $host = HostRepository::selectByName($_POST["host_id"]);

    $project = new Project(
        0,
        $_POST["name-project"],
        $code,
        $_POST["lastpass_folder"],
        $_POST["link_mock_ups"],
        0,
        $_POST["note-project"],
        $host,
        $customer
    );

    // var_dump($project);

    // if(ProjectValidation::isValid($project))
    // {
        if (ProjectRepository::insert($project))
        {
            $validate = "Le projet a bien été ajouté";
            $code = "";
            
            // header("Location: update-project.php?id=".$project->getId());
        } else {
            $error = "Erreur dans l'ajout du projet";
            // var_dump($project->getId()); 
            // var_dump($project->getName()); 
            // var_dump($project->getCode());
            // var_dump($project->getLastPassFolder());
            // var_dump($project->getLinkMockUps());
            // var_dump($project->getManagedServer());
            // var_dump($project->getNotes());
            // var_dump($project->getHost()->getId());
            // var_dump($project->getCustomer()->getId());
        }
    // } else {
    //     $error = "Le nom doit être renseigné";
    // }
}

$customers = CustomerRepository::selectAll();
$hosts = HostRepository::selectAll();

?>


<section class="add-project">
    <h1>Nouveau projet</h1>
    <div class="flex-add-project">
        <ul>
            <li id="infoBtn" class="btn btn-link">
                Informations générales
            </li>
            <li id="contactBtn" class="btn btn-link">
                Environnement
            </li>
        </ul>
    </div>  
    
    <div id="info">
        <form action="" method="post">
            <div class="form-floating mb-3">
                <input type="text" name="name-project" class="form-control" id="floatingName" placeholder="Jean Dupont">
                <label for="floatingName">Nom du projet</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="code-intra" class="form-control" id="floatingCode" disabled placeholder=" ">
                <label for="floatingCode">Code interne généré automatiquement</label>
            </div>
            <label for="listCustomer" class="form-label">Liste des clients</label>
            <input class="form-control mb-3" name="customer_id" list="datalistOptionsCustomer" id="listCustomer" placeholder="Rechercher un client">
            <datalist id="datalistOptionsCustomer">
                <?php
                    foreach ($customers as $value) {
                        echo '<option value="'.$value->getName().'"></option>';
                    }
                ?>
            </datalist>
            <label for="listHost" class="form-label">Liste des hébergeurs</label>
            <input class="form-control mb-3" name="host_id" list="datalistOptionsHost" id="listHost" placeholder="Rechercher un hébergeur">
            <datalist id="datalistOptionsHost">
                <?php
                    foreach ($hosts as $value) {
                        echo '<option value="'.$value->getName().'"></option>';
                    }
                ?>
            </datalist>
            <div class="form-check">
                <input class="form-check-input" name="managed_server" type="checkbox" id="flexCheckServer">
                <label class="form-check-label mb-3" for="flexCheckServer">Serveur infogéré</label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" name="note-project" placeholder="Notes/Remarques" id="floatingNote" style="height: 100px"></textarea>
                <label for="floatingNote">Notes ou remarques</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="lastpass_folder" class="form-control" id="floatingFolder" placeholder="Client\FFD\...">
                <label for="floatingFolder">Dossier lastpass</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="link_mock_ups" class="form-control" id="floatingLink" placeholder="https://">
                <label for="floatingLink">Lien maquettes</label>
            </div>
            <button class="btn btn-secondary mb-3" type="reset">Annuler l'ajout du projet</button>
            <button class="btn btn-primary mb-3" name="add-project" type="submit">Ajouter le projet</button>

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