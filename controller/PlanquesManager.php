<?php

require_once './model/Planque.php';


class PlanquesManager
{
    private $db;

    // On crée un constructeur sans parametres qui gerera la connection a la bdd et a la table contact
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
    public function create(Planque $planque)
    {
        $req = $this->db->prepare('INSERT INTO planque (code, adress, country, type) VALUES (:code, :adress, :country, :type)');

        $req->bindValue(":code", $planque->getCode(), PDO::PARAM_INT);
        $req->bindValue(":adress", $planque->getAdress(), PDO::PARAM_STR);
        $req->bindValue(":country", $planque->getCountry(), PDO::PARAM_STR);
        $req->bindValue(":type", $planque->getType(), PDO::PARAM_STR);

        $req->execute();
    }
    // read
    public function get(int $id)
    {
        $req = $this->db->prepare('SELECT * FROM planque WHERE id = :id');
        $req->execute([':id' => $id]);
        $data = $req->fetch();
        $planque = new Planque($data);
        return $planque;
    }

    // readAll
    public function getAll(): array
    {
        $planques = [];
        $req = $this->db->query('SELECT * FROM planque ORDER BY id');
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $planque = new Planque($data);
            $planques[] = $planque;
        }

        return $planques;
    }

    public function getAllByCountry(string $country): array
    {
        $planques = [];
        $req = $this->db->prepare('SELECT * FROM planque WHERE country LIKE :country');
        $req->bindValue(":country", $country, PDO::PARAM_STR);
        $req->execute();
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $planque = new Planque($data);
            $planques[] = $planque;
        }
        return $planques;
    }

    // read5LastDatas
    public function getFiveLast(): array
    {
        $planques = [];
        $req = $this->db->query('SELECT * FROM planque ORDER BY id DESC LIMIT 5');
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $planque = new Planque($data);
            $planques[] = $planque;
        }

        return $planques;
    }

    public function delete(int $id)
    {
        $req = $this->db->prepare("DELETE FROM `planque` WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();
    }
}
