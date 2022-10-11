<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="index.css">
    <title>Document</title>
</head>
    <body>
        <nav id="nav-backoffice-sub">
            <a href="#" id="img">
                <img src="./img/logo-mentalworks-blanc.png" alt="logo">
            </a>
            <button id="btn-offcanvas" class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="bi bi-filter-right"></i></button>

            <div class="offcanvas offcanvas-start show" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                <div class="offcanvas-header">
                    <a href="#">
                        <img src="./img/logo-mentalworks-blanc.png" alt="logo">
                    </a>
                </div>
                <div class="offcanvas-body">
                    <ul>
                        <br>
                        <li>
                            <i class="bi bi-house"></i>
                            <a href="#">Tableau de bord</a>
                        </li>
                        <li>
                        <i class="bi bi-person"></i>
                            <a href="#">Projets</a>
                        </li>
                        <li>
                            <i class="bi bi-building"></i>
                            <a href="#">Client</a>
                        </li>
                        <li>
                            <i class="bi bi-hdd-rack"></i>
                            <a href="#">Hébergeurs</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <script src="./javaScript/navbar.js"></script>