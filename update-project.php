<?php

require_once __DIR__."/require/navbar.php";
require_once __DIR__."/vendor/autoload.php";

use App\
{
    class\Project,
    validators\ProjectValidation,
    repository\ProjectRepository,
    repository\CustomerRepository,
    repository\HostRepository
};

$name = "";
$code = "";
$lastpass_folder = "";
$link_mock_ups = "";
$notes = "";
$hostName = "";
$customerName = "";
$validate = "";
$error = "";
$errorFounding = "";
$managedServer = "";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    
    if (is_numeric($id)) {
        if ($project = ProjectRepository::selectById($id)) {
            $name = $project->getName();
            $code = $project->getCode();
            $lastpass_folder = $project->getLastPassFolder();
            $link_mock_ups = $project->getLinkMockUps();
            $managedServer = $project->getManagedServer();
            $notes = $project->getNotes();
            $hostName = $project->getHost()->getName();
            $customerName = $project->getCustomer()->getName();
        } else {
            $errorFounding = "Ce projet n'existe pas";
        }
    } else {
        $errorFounding = "Impossible de faire une modification sur un ID n'étant pas un entier";
    }
} else {
    $errorFounding = "Un problème a été rencontré dans le chargement de la page";
}


if (isset($_POST["edit-project"])) {
    if (isset($_POST["managed_server"]))
    {
        $managedServer = true;
    } else {
        $managedServer = false;
    }

    if (!empty($_POST["customer_id"]) AND !empty($_POST["host_id"]))
    {
        $customer = CustomerRepository::selectByName($_POST["customer_id"]);
        $host = HostRepository::selectByName($_POST["host_id"]);

        $project = new Project(
            $id,
            $_POST["name-project"],
            $_POST["name-project"],
            $_POST["lastpass_folder"],
            $_POST["link_mock_ups"],
            $managedServer,
            $_POST["note-project"],
            $host,
            $customer
        );

        if (ProjectValidation::isValid($project))
        {
            if (ProjectRepository::update($project)) {
                $validate = "Le projet a bien été modifié";
                $name = $project->getName();
                $code = $project->getCode();
                $lastpass_folder = $project->getLastPassFolder();
                $link_mock_ups = $project->getLinkMockUps();
                $managedServer = $project->getManagedServer();
                $notes = $project->getNotes();
                $hostName = $project->getHost()->getName();
                $customerName = $project->getCustomer()->getName();
            } else {
                $error = "Erreur dans la modification du projet";
            }
        } else {
            $error = "Un des champs est mal rempli";
        }
    } else {
        $error = "L'hébergeur et le client doivent être renseigné";
    }
}

if (isset($_POST['dont-edit-contact'])) {
    header('Location: project.php');
    exit;
}

if (isset($_POST['dont-edit-project'])) {
    header('Location: project.php');
    exit;
}

$customers = CustomerRepository::selectAll();
$hosts = HostRepository::selectAll();

?>

<section class="add-project">
    <h1>Modifier le projet</h1>
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
                            <input type="text" name="name-project" class="form-control" id="floatingName" placeholder="Jean Dupont" value="'.$name.'">
                            <label for="floatingName">Nom du projet</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="code-intra" class="form-control" id="floatingCode" disabled placeholder=" " value="'.$code.'">
                            <label for="floatingCode">Code interne généré automatiquement</label>
                        </div>
                        <label for="listCustomer" class="form-label">Liste des clients</label>
                        <input class="form-control mb-3" name="customer_id" list="datalistOptionsCustomer" id="listCustomer" placeholder="Rechercher un client" value="'.$customerName.'">
                        <datalist id="datalistOptionsCustomer">';

            foreach ($customers as $value) {
                echo '      <option value="'.$value->getName().'"></option>';
            }

            echo '      </datalist>
                        <label for="listHost" class="form-label">Liste des hébergeurs</label>
                        <input class="form-control mb-3" name="host_id" list="datalistOptionsHost" id="listHost" placeholder="Rechercher un hébergeur" value="'.$hostName.'">
                        <datalist id="datalistOptionsHost">';

            foreach ($hosts as $value) {
                echo '      <option value="'.$value->getName().'"></option>';
            }

            echo'       </datalist>
                        <div class="form-check">
                            <input class="form-check-input" name="managed_server" type="checkbox" id="flexCheckServer"';
                            if ($managedServer == 1) {
                                echo "checked";
                            }
                            echo '>
                            <label class="form-check-label mb-3" for="flexCheckServer">Serveur infogéré</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" name="note-project" placeholder="Notes/Remarques" id="floatingNote" style="height: 100px">'.$notes.'</textarea>
                            <label for="floatingNote">Notes ou remarques</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="lastpass_folder" class="form-control" id="floatingFolder" placeholder="Client\FFD\..." value="'.$lastpass_folder.'">
                            <label for="floatingFolder">Dossier lastpass</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="link_mock_ups" class="form-control" id="floatingLink" placeholder="https://" value="'.$link_mock_ups.'">
                            <label for="floatingLink">Lien maquettes</label>
                        </div>
                        <button class="btn btn-secondary mb-3" type="submit" name="dont-edit-project">Annuler la modification du projet</button>
                        <button class="btn btn-primary mb-3" name="edit-project" type="submit">Modifier le projet</button>';

            if($validate != "") {
                echo'<div class="alert alert-success" role="alert">
                        <p>'.$validate.'</p>
                    </div>';
            } elseif ($error != "") {
                    echo'<div class="alert alert-danger" role="alert">
                        <p>'.$error.'</p>
                    </div>';
            }
        }

        echo'       </form>';
        ?>
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