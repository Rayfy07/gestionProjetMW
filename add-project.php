<?php

require_once __DIR__."/require/navbar.php";
require_once __DIR__."/vendor/autoload.php";

use App\
{
    class\Project,
    validators\ProjectValidation,
    repository\ProjectRepository,
    repository\CustomerRepository,
    repository\HostRepository,
    connection\DataBaseConnection
};

$name = "";
$code = "";
$lastpass_folder = "";
$link_mock_ups = "";
$managedServer = "";
$notes = "";
$customerName = "";
$hostName = "";
$validate = "";
$error = "";

if (isset($_POST["add-project"]))
{
    if (isset($_POST["managed_server"]))
    {
        $managedServer = true;
    } else {
        $managedServer = false;
    }

    $name = $_POST["name-project"];
    $lastpass_folder = $_POST["lastpass_folder"];
    $link_mock_ups = $_POST["link_mock_ups"];
    $notes = $_POST["note-project"];

    if (
        !empty($_POST["customer_id"]) 
        && !empty($_POST["host_id"])
        && CustomerRepository::nameExist($_POST["customer_id"])
        && HostRepository::nameExist($_POST["host_id"])
    )
    {
        $customer = CustomerRepository::selectByName($_POST["customer_id"]);
        $host = HostRepository::selectByName($_POST["host_id"]);
        $customerName = $customer->getName();
        $hostName = $host->getName();

        $project = new Project(
            0,
            $name,
            $name,
            $lastpass_folder,
            $link_mock_ups,
            $managedServer,
            $notes,
            $host,
            $customer
        );

        if(ProjectValidation::isValid($project))
        {
            if (ProjectRepository::insert($project))
            {
                $validate = "Le projet a bien été ajouté";
                $code = "";
                header("Location: update-project.php?id=".$project->getId());
            } else {
                $error = "Erreur dans l'ajout du projet";
            }
        } else {
            $error = "Le nom doit être renseigné";
        }
    } else {
        $error = "L'hébergeur et le client doivent être renseigné et valide";
    }
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
        </ul>
    </div>  
    
    <div id="info">
        <form action="" method="post">
            <div class="form-floating mb-3">
                <input type="text" name="name-project" class="form-control" id="floatingName" placeholder="Site public" value=<?php echo $name ?>>
                <label for="floatingName">Nom du projet</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="code-intra" class="form-control" id="floatingCode" disabled placeholder=" ">
                <label for="floatingCode">Code interne généré automatiquement</label>
            </div>
            <label for="listCustomer" class="form-label">Liste des clients</label>
            <input class="form-control mb-3" name="customer_id" list="datalistOptionsCustomer" id="listCustomer" placeholder="Rechercher un client" value=<?php echo $customerName ?>>
            <datalist id="datalistOptionsCustomer">
                <?php
                    foreach ($customers as $value) {
                        echo '<option value="'.$value->getName().'"></option>';
                    }
                ?>
            </datalist>
            <label for="listHost" class="form-label">Liste des hébergeurs</label>
            <input class="form-control mb-3" name="host_id" list="datalistOptionsHost" id="listHost" placeholder="Rechercher un hébergeur" value=<?php echo $hostName ?>>
            <datalist id="datalistOptionsHost">
                <?php
                    foreach ($hosts as $value) {
                        echo '<option value="'.$value->getName().'"></option>';
                    }
                ?>
            </datalist>
            <div class="form-check">
                <input class="form-check-input" name="managed_server" type="checkbox" id="flexCheckServer"
                <?php 
                if ($managedServer){
                    echo 'checked';
                }
                ?>>
                <label class="form-check-label mb-3" for="flexCheckServer">Serveur infogéré</label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" name="note-project" placeholder="Notes/Remarques" id="floatingNote" style="height: 100px"><?php echo $notes ?></textarea>
                <label for="floatingNote">Notes ou remarques</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="lastpass_folder" class="form-control" id="floatingFolder" placeholder="Client\FFD\..." value=<?php echo $lastpass_folder ?>>
                <label for="floatingFolder">Dossier lastpass</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="link_mock_ups" class="form-control" id="floatingLink" placeholder="https://" value=<?php echo $link_mock_ups ?>>
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
</section>

<?php require_once __DIR__."/require/footer.php"; ?>