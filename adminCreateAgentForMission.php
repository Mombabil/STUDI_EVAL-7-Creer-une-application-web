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
    <title>Evaluation Studi - Admin KBG</title>
</head>

<?php

require_once './controller/CiblesManager.php';
// On crée un nouvel objet Cible via le controller CiblesManager et on le push dans la bdd
$ciblesManager = new CiblesManager();
$ciblesMissionTargeted = $ciblesManager->getAll();


require_once './controller/ContactsManager.php';
// On crée un nouvel objet Contact via le controller ContactsManager et on le push dans la bdd
$contactsManager = new ContactsManager();
$contactsMissionTargeted = $contactsManager->getAll();

require_once './controller/PlanquesManager.php';
// On crée un nouvel objet Planque via le controller PlanquesManager et on le push dans la bdd
$planquesManager = new PlanquesManager();

require_once './controller/AgentsManager.php';
// On crée un nouvel objet Agent via le controller AgentsManager et on le push dans la bdd
$agentsManager = new AgentsManager();
$agentsMissionTargeted = $agentsManager->getAll();

require_once './controller/AdminsManager.php';
// On crée un nouvel objet Agent via le controller AgentsManager et on le push dans la bdd
$adminsManager = new AdminsManager();
$admin = $adminsManager->get(1);


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
                    <p style="color:white; margin-bottom: 0" class="adminSection"><?= $admin->getFirstname() . " " . $admin->getName() . " [" . $_SESSION['login'] . "]" ?></p>
                </div>
            </div>
        </nav>
    </header>

    <main class="container-fluid">
        <div class="category">
            <h1>Espace Administrateur - Créateur de missions</h1>

            <div class="mission">
                <h5>Nouvelle Mission :</h5>
                <!-- on stock les données fixes dans des variables, puis une fois enregistré, on affiche la suite du formulaire contenant les données modulables -->
                <?php
                $titleMission = htmlspecialchars($_POST['titleMission']);
                $descriptionMission = htmlspecialchars($_POST['descriptionMission']);
                $codenameMission = htmlspecialchars($_POST['codenameMission']);
                $countryMission = htmlspecialchars($_POST['countryMission']);

                $specialityRequireMission = htmlspecialchars($_POST['specialityRequireMission']);
                $startMission = htmlspecialchars($_POST['startMission']);
                $endMission = htmlspecialchars($_POST['endMission']);
                // On recupere le tableau de specialité des cibles et des contacts pour les réafficher dans la suite du formulaire
                $ciblesMission = $_POST['ciblesMission'];
                // On recupere le tableau de specialité des cibles et des contacts pour les réafficher dans la suite du formulaire
                $contactsMission = $_POST['contactsMission'];
                $planqueMission = htmlspecialchars($_POST['planquesMission']);

                var_dump($planqueMission);
                ?>
                <form method="post" action="admin.php">

                    <div class="line-form">
                        <label for="validatedTitleMission" class="form-label">Titre de la mission</label>
                        <input type="text" name="validatedTitleMission" id="validatedTitleMission" placeholder="Ex: Sabotage des élections" value="<?= $titleMission ?>" />
                    </div>

                    <div class="line-form">
                        <label for="validatedDescriptionMission" class="form-label">Description</label>
                        <textarea name="validatedDescriptionMission" id="validatedDescriptionMission" rows="10"><?= $descriptionMission ?></textarea>
                    </div>

                    <div class="line-form">
                        <label for="validatedCodenameMission" class="form-label">
                            Nom de code
                        </label>
                        <input type="text" name="validatedCodenameMission" id="validatedCodenameMission" placeholder="Ex: Sabotage des élections" value="<?= $codenameMission ?>">
                    </div>

                    <div class="line-form">
                        <label for="validatedCountryMission" class="form-label">
                            Pays
                        </label>
                        <select id="validatedCountryMission" name="validatedCountryMission">
                            <option value="<?= $countryMission ?>"><?= $countryMission ?></option>
                        </select>
                    </div>

                    <div class="line-form">
                        <label for="validatedSpecialityRequireMission">
                            Spécialité requise
                        </label>
                        <select name="validatedSpecialityRequireMission" id="validatedSpecialityRequireMission">
                            <option value="<?= $specialityRequireMission ?>"><?= $specialityRequireMission ?></option>
                        </select>
                    </div>

                    <div class="line-form">
                        <label for="validatedStartMission" class="form-label">
                            Début de la mission
                        </label>
                        <input type="date" name="validatedStartMission" id="validatedStartMission" value="<?= $startMission ?>">
                    </div>

                    <div class="line-form">
                        <label for="validatedEndMission" class="form-label">
                            Fin de la mission
                        </label>
                        <input type="date" name="validatedEndMission" id="validatedEndMission" value="<?= $endMission ?>">
                    </div>


                    <!-- CIBLE(s) -->
                    <!-- Regle métier : Sur une mission, la ou les cibles ne peuvent pas avoir la même nationalité que le ou les agents. -->
                    <div class="line-form">
                        <label for="validatedCiblesMission">Cible(s)</label>
                        <select name="validatedCiblesMission[]" id="validatedCiblesMission" multiple>
                            <?php
                            foreach ($ciblesMissionTargeted
                                as $cible) {
                                if (in_array($cible->getId(), $ciblesMission)) {
                            ?>
                                    <option value="<?= $cible->getId() ?>" selected="selected"><?= $cible->getName() . " " . $cible->getFirstname() . " : " . $cible->getCodename() . " - " . $cible->getNationality() ?></option>
                            <?php
                                }
                            } ?>
                        </select>
                    </div>
                    <p class="regleMetier">Sur une mission, la ou les cibles ne peuvent pas avoir la même nationalité que le ou les agents.</p>

                    <!-- CONTACT(s) -->
                    <!-- Regle métier : Sur une mission, les contacts sont obligatoirement de la nationalité du pays de la mission. -->
                    <div class="line-form">
                        <label for="validatedContactsMission">Contact(s)</label>
                        <select name="validatedContactsMission[]" id="validatedContactsMission" multiple>
                            <?php
                            foreach ($contactsMissionTargeted
                                as $contact) {
                                if (in_array($contact->getId(), $contactsMission)) {
                            ?>
                                    <option value="<?= $contact->getId() ?>" selected="selected"><?= $contact->getName() . " " . $contact->getFirstname() . " - " . $contact->getNationality() ?></option>
                            <?php
                                }
                            } ?>
                        </select>
                    </div>
                    <p class="regleMetier">Sur une mission, les contacts sont obligatoirement de la nationalité du pays de la mission.</p>

                    <!-- PLANQUE(s) -->
                    <!-- Regle métier : Sur une mission, la planque est obligatoirement dans le même pays que la mission. -->
                    <div class="line-form">
                        <label for="validatedPlanquesMission">Planque</label>
                        <select name="validatedPlanquesMission" id="validatedPlanquesMission">
                            <?php
                            if ($planqueMission != "Aucune") {

                                $planqueMissionTargeted = $planquesManager->get($planqueMission);
                            ?>
                                <option value="<?= $planqueMissionTargeted->getId() ?>" selected="selected">
                                    <?= $planqueMissionTargeted->getType()
                                        . " : " . $planqueMissionTargeted->getAdress()
                                        . " - " . $planqueMissionTargeted->getCountry()
                                    ?>
                                </option>
                            <?php
                            } else {
                            ?>
                                <option value="Aucune">Aucune</option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <p class="regleMetier">Sur une mission, si il y en a une, la planque est obligatoirement dans le même pays que la mission.</p>

                    <!-- AGENT(s) -->
                    <!-- Regle métier : Sur une mission, il faut assigner au moins 1 agent disposant de la spécialité requise. -->
                    <div class="line-form">
                        <label for="validatedAgentsMission">Agent(s)</label>
                        <select name="validatedAgentsMission[]" id="validatedAgentsMission" multiple>
                            <?php
                            foreach ($agentsMissionTargeted as $agents) {
                                // si la specialité de l'agent correspond a la specialité de la mission
                                if ($agents->getSpeciality() === $specialityRequireMission) {

                                    // si la nationalité de la cible est différente de celle de l'agent
                                    foreach ($contactsMissionTargeted
                                        as $contact) {
                                        if (in_array($contact->getId(), $contactsMission)) {
                                            if ($contact->getNationality() !== $agents->getNationality()) {

                            ?>
                                                <!-- on affiche les agents valide pour la mission -->
                                                <option value="<?= $agents->getId() ?>"><?= $agents->getName() . " " . $agents->getFirstname() . " [spécialité : " . $agents->getSpeciality() . "] - " . $agents->getNationality() ?></option>
                            <?php
                                            }
                                        }
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <p class="regleMetier">Sur une mission, il faut assigner au moins 1 agent disposant de la spécialité requise.</p>

                    <input type="submit" value="Créer une nouvelle mission" class="btn btn-success submit" id="suiteMission">
                </form>
            </div>

    </main>
    <!-- CDN BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="./scripts/admin.js"></script>
</body>

</html>