<?php

require './model/Agent.php';

class AgentsManager
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
            $this->db = new PDO("mysql:host=heroku_298e4adb9d2b508;dbname=$dbName;port=$port", $username, $password);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // CREATION DU CRUD POUR LA TABLE
    // create
    public function create(Agent $agent)
    {
        $req = $this->db->prepare('INSERT INTO `agent` (name, firstname, dateOfBirth, code, nationality, speciality) VALUES (:name, :firstname, :dateOfBirth, :code, :nationality, :speciality)');

        $req->bindValue(":name", $agent->getName(), PDO::PARAM_STR);
        $req->bindValue(":firstname", $agent->getFirstname(), PDO::PARAM_STR);
        $req->bindValue(":dateOfBirth", $agent->getDateOfBirth(), PDO::PARAM_STR);
        $req->bindValue(":code", $agent->getCode(), PDO::PARAM_INT);
        $req->bindValue(":nationality", $agent->getNationality(), PDO::PARAM_STR);
        $req->bindValue(":speciality", $agent->getSpeciality());

        $req->execute();
    }

    // read
    public function get(int $id)
    {
        $req = $this->db->prepare('SELECT * FROM agent WHERE id = :id');
        $req->execute([':id' => $id]);
        $data = $req->fetch();
        $agent = new Agent($data);
        return $agent;
    }

    // readAll
    public function getAll(): array
    {
        $agents = [];
        $req = $this->db->query('SELECT * FROM agent ORDER BY id');
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $agent = new Agent($data);
            $agents[] = $agent;
        }

        return $agents;
    }

    // readAll
    public function getAllByDesc(): array
    {
        $agents = [];
        $req = $this->db->query('SELECT * FROM agent ORDER BY id DESC');
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $agent = new Agent($data);
            $agents[] = $agent;
        }

        return $agents;
    }

    // read5LastDatas
    public function getFiveLast(): array
    {
        $agents = [];
        $req = $this->db->query('SELECT * FROM agent ORDER BY id DESC LIMIT 5');
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $agent = new Agent($data);
            $agents[] = $agent;
        }

        return $agents;
    }

    public function update(Agent $agent, int $id)
    {
        $req = $this->db->prepare("UPDATE `agent` SET name = :name, firstname = :firstname, dateOfBirth = :dateOfBirth, code = :code, nationality = :nationality, speciality = :speciality WHERE id = :id");

        $req->bindValue(":name", $agent->getName(), PDO::PARAM_STR);
        $req->bindValue(":firstname", $agent->getfirstname(), PDO::PARAM_STR);
        $req->bindValue(":dateOfBirth", $agent->getDateOfBirth(), PDO::PARAM_STR);
        $req->bindValue(":code", $agent->getCode(), PDO::PARAM_INT);
        $req->bindValue(":nationality", $agent->getNationality(), PDO::PARAM_STR);
        $req->bindValue(":speciality", $agent->getSpeciality(), PDO::PARAM_STR);
        $req->bindValue(":id", $id, PDO::PARAM_INT);


        $req->execute();
    }

    public function delete(int $id)
    {
        $req = $this->db->prepare("DELETE FROM `agent` WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();
    }
}
