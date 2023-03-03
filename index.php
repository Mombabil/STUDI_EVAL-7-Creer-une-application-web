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
// On crée un nouvel objet Agent via le controller AgentsManager
$adminsManager = new AdminsManager();
$admin = $adminsManager->get(1);

require_once './controller/MissionsManager.php';
// On crée un nouvel objet Mission via le controller MissionsManager
$missionsManager = new MissionsManager();
$missionsDisplay = $missionsManager->getAllByDesc();
// on recupere les missions en les affichant de la plus récente à la plus ancienne

require_once './controller/AgentsManager.php';
// On crée un nouvel objet Agent via le controller AgentsManager
$agentsManager = new AgentsManager();

require_once './controller/CiblesManager.php';
// On crée un nouvel objet Cible via le controller CiblesManager
$ciblesManager = new CiblesManager();

require_once './controller/ContactsManager.php';
// On crée un nouvel objet Contact via le controller ContactsManager
$contactsManager = new ContactsManager();

require_once './controller/PlanquesManager.php';
// On crée un nouvel objet Planque via le controller PlanquesManager
$planquesManager = new PlanquesManager();
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
                            <a class="nav-link active" aria-current="page" href="./index.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./agents.php">Agents</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./cibles.php">Cibles</a>
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
                                    <button><a href="http://localhost/eval-php/bdd-kgb/admin.php" class="nav-link">Admin</a></button>
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
                <h2>LISTING DES MISSIONS</h2>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Code</th>
                        <th>Pays</th>
                        <th>Agent(s)</th>
                        <th>Contact(s)</th>
                        <th>Cible(s)</th>
                        <th>Type</th>
                        <th>Planque</th>
                        <th>Specialité</th>
                        <th>Début</th>
                        <th>Fin</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- pour l'affichage des agents, cibles, et contacts, c'est l'id de l'agent, cible, ou contact qui est stocké dans la table mission -->
                    <!-- on crée donc une liaison entre la table mission et la table agent, cible, contact via l'id pour afficher le nom et prénom correspondant, cela permet de modifier les données dynamiquement en cas d'update des tables agents, cibles, et contacts -->
                    <?php
                    foreach ($missionsDisplay as $mission) : ?>
                        <tr>
                            <td><?= $mission->getId() ?></td>
                            <td><?= $mission->getTitle() ?></td>
                            <td><?= $mission->getDescription() ?></td>
                            <td><?= $mission->getCodename() ?></td>
                            <td><?= $mission->getCountry() ?></td>
                            <!-- agent -->
                            <td><?php
                                $agents = explode(" - ", $mission->getAgents());
                                foreach ($agents as $agent) : ?>
                                    <?php
                                    $agentDisplay = $agentsManager->get($agent);
                                    ?>
                                    <ul>
                                        <li><?= $agentDisplay->getName() . " " . $agentDisplay->getFirstname() ?></li>
                                    </ul>
                                <?php endforeach ?>
                                <!-- contact -->
                            </td>
                            <td><?php
                                $contacts = explode(" - ", $mission->getContacts());
                                foreach ($contacts as $contact) : ?>
                                    <?php
                                    $contactDisplay = $contactsManager->get($contact);
                                    ?>
                                    <ul>
                                        <li><?= $contactDisplay->getName() . " " . $contactDisplay->getFirstname() ?></li>
                                    </ul>
                                <?php endforeach ?>
                                <!-- cible -->
                            </td>
                            <td><?php
                                $cibles = explode(" - ", $mission->getCibles());
                                foreach ($cibles as $cible) : ?>
                                    <?php
                                    $cibleDisplay = $ciblesManager->get($cible);
                                    ?>
                                    <ul>
                                        <li><?= $cibleDisplay->getName() . " " . $cibleDisplay->getFirstname() ?></li>
                                    </ul>
                                <?php endforeach ?>
                            </td>
                            <td><?= $mission->getType() ?></td>
                            <!-- planque -->
                            <td><?php
                                $planqueDisplay = $planquesManager->get($mission->getPlanques());
                                echo $planqueDisplay->getType() ?></td>
                            <td><?= $mission->getSpeciality() ?></td>
                            <td><?= $mission->getStart() ?></td>
                            <td><?= $mission->getEnd() ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

    </main>
    <!-- CDN BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="./script.js"></script>
</body>

</html>