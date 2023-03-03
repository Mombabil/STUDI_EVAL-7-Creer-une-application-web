<?php

require './model/Mission.php';

class MissionsManager
{
    private $db;

    // On crée un constructeur sans parametres qui gerera la connection a la bdd et a la table agent
    public function __construct()
    {
        $dbName = "studikgb";
        $port = 3306;
        $username = "b13bd16b4d5f04";
        $password = "31e75708";

        // On utilise un try/catch pour tester la connection
        try {
            $this->db = new PDO("mysql:host=eu-ms-auto-fra-03-c.cleardb.net;dbname=$dbName;port=$port", $username, $password);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // CREATION DU CRUD POUR LA TABLE
    // create
    public function create(Mission $mission)
    {
        $req = $this->db->prepare('INSERT INTO `mission` (title, description, codename, country, agents, contacts, cibles, type, planques, speciality, start, end) VALUES (:title, :description, :codename, :country, :agents, :contacts, :cibles, :type, :planques, :speciality, :start, :end)');

        $req->bindValue(":title", $mission->getTitle(), PDO::PARAM_STR);
        $req->bindValue(":description", $mission->getDescription(), PDO::PARAM_STR);
        $req->bindValue(":codename", $mission->getCodename(), PDO::PARAM_STR);
        $req->bindValue(":country", $mission->getCountry(), PDO::PARAM_STR);
        $req->bindValue(":agents", $mission->getAgents(), PDO::PARAM_STR);
        $req->bindValue(":contacts", $mission->getContacts(), PDO::PARAM_STR);
        $req->bindValue(":cibles", $mission->getCibles(), PDO::PARAM_STR);
        $req->bindValue(":type", $mission->getType(), PDO::PARAM_STR);
        $req->bindValue(":planques", $mission->getPlanques(), PDO::PARAM_STR);
        $req->bindValue(":speciality", $mission->getSpeciality(), PDO::PARAM_STR);
        $req->bindValue(":start", $mission->getStart(), PDO::PARAM_STR);
        $req->bindValue(":end", $mission->getEnd(), PDO::PARAM_STR);

        $req->execute();
    }

    // read
    public function get(int $id)
    {
        $req = $this->db->prepare('SELECT * FROM mission WHERE id = :id');
        $req->execute([':id' => $id]);
        $data = $req->fetch();
        $mission = new Mission($data);
        return $mission;
    }

    // readAll
    public function getAll(): array
    {
        $missions = [];
        $req = $this->db->query('SELECT * FROM mission ORDER BY id');
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $mission = new Mission($data);
            $missions[] = $mission;
        }

        return $missions;
    }

    // readAll
    public function getAllByDesc(): array
    {
        $missions = [];
        $req = $this->db->query('SELECT * FROM mission ORDER BY id DESC');
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $mission = new Mission($data);
            $missions[] = $mission;
        }

        return $missions;
    }

    // read5LastDatas
    public function getFiveLast(): array
    {
        $missions = [];
        $req = $this->db->query('SELECT * FROM mission ORDER BY id DESC LIMIT 5');
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $mission = new Mission($data);
            $missions[] = $mission;
        }

        return $missions;
    }

    public function delete(int $id)
    {
        $req = $this->db->prepare("DELETE FROM `mission` WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();
    }
}
