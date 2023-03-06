<?php session_start() ?>
<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CDN BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/index.css">
    <title>Evaluation Studi - KGB</title>
</head>

<?php
require_once './controller/AdminsManager.php';
// On crée un nouvel objet Agent via le controller AgentsManager et on le push dans la bdd
$adminsManager = new AdminsManager();
$admin = $adminsManager->get(1);

require_once './controller/CiblesManager.php';
// On crée un nouvel objet Mission via le controller MissionsManager
$ciblesManager = new CiblesManager();
$cibleDisplay = $ciblesManager->getAllByDesc();
// on recupere les missions en les affichant de la plus récente à la plus ancienne
?>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="./index.php"><img src="./img/spy.png" alt="logo du site" style="width: 75%"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="./index.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./agents.php">Agents</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="./cibles.php">Cibles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./contacts.php">Contacts</a>
                        </li>
                    </ul>

                    <?php
                    $_SESSION['login'] = $_POST['login'];
                    $_SESSION['password'] = $_POST['password'];
                    $cryptedPwd = crypt($_SESSION['password'], $admin->getPassword());
                    if ($_SESSION['login'] == $admin->getEmail()) {
                        if ($cryptedPwd == $admin->getPassword()) {
                    ?>
                            <div style="display: block">
                                <p style="color:white">Bienvenue <?= $admin->getFirstname() . " " . $admin->getName() ?></p>
                                <div>
                                    <button><a href="./admin.php">Admin</a></button>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <form class="d-flex" role="search" method="post">
                                <input class="form-control me-2" type="search" placeholder="E-mail de connexion" aria-label="Search" name="login" id="login">
                                <input class="form-control me-2" type="search" placeholder="Mot de passe" aria-label="Search" name="password" id="password">
                                <button class="btn btn-outline-success" type="submit">Rechercher</button>
                            </form>
                        <?php
                        }
                    } else {
                        ?>
                        <form class="d-flex" role="search" method="post">
                            <input class="form-control me-2" type="search" placeholder="E-mail de connexion" aria-label="Search" name="login" id="login">
                            <input class="form-control me-2" type="search" placeholder="Mot de passe" aria-label="Search" name="password" id="password">
                            <button class="btn btn-success" type="submit">Connexion</button>
                        </form>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </nav>
    </header>

    <main>

        <div class="missionsDisplay">
            <table class="table table-striped table-bordered table-dark">
                <h2>LISTING DES CIBLES</h2>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date de naissance</th>
                        <th>Code</th>
                        <th>Nationalité</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- pour l'affichage des agents, cibles, et contacts, on recupere la chaine de caractères de la bdd et on la transforme en tableau pour gerer l'affichage -->
                    <?php
                    foreach ($cibleDisplay as $cible) : ?>
                        <tr>
                            <td>
                                <?php
                                if ($_SESSION['login'] == $admin->getEmail()) {
                                    if ($cryptedPwd == $admin->getPassword()) {
                                ?>
                                        <a href="./updateCible.php?id=<?= $cible->getId() ?>">Modifier</a>
                                <?php
                                    }
                                }
                                ?>
                                <?= $cible->getId() ?>
                            </td>
                            <td><?= $cible->getName() ?></td>
                            <td><?= $cible->getFirstname() ?></td>
                            <td><?= $cible->getDateOfBirth() ?></td>
                            <td><?= $cible->getCodename() ?></td>
                            <td><?= $cible->getNationality() ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

    </main>
    <!-- CDN BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>