<?php

require_once './model/Cible.php';


class CiblesManager
{
    private $db;

    // On crée un constructeur sans parametres qui gerera la connection a la bdd et a la table contact
    public function __construct()
    {
        $dbName = "perret-morgan_evaluation-studi-creer-une-application-web";
        $port = 3306;
        $username = "302852_";
        $password = "3FPgmA3i2T!aFAK";

        // On utilise un try/catch pour tester la connection
        try {
            $this->db = new PDO("mysql:host=mysql-perret-morgan.alwaysdata.net;dbname=$dbName;port=$port", $username, $password);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // CREATION DU CRUD POUR LA TABLE
    // create
    public function create(Cible $cible)
    {
        $req = $this->db->prepare('INSERT INTO cible (name, firstname, dateOfBirth, codename, nationality) VALUES (:name, :firstname, :dateOfBirth, :codename, :nationality)');

        $req->bindValue(":name", $cible->getName(), PDO::PARAM_STR);
        $req->bindValue(":firstname", $cible->getFirstname(), PDO::PARAM_STR);
        $req->bindValue(":dateOfBirth", $cible->getDateOfBirth(), PDO::PARAM_STR);
        $req->bindValue(":codename", $cible->getCodename(), PDO::PARAM_STR);
        $req->bindValue(":nationality", $cible->getNationality(), PDO::PARAM_STR);

        $req->execute();
    }
    // read
    public function get(int $id)
    {
        $req = $this->db->prepare('SELECT * FROM cible WHERE id = :id');
        $req->execute([':id' => $id]);
        $data = $req->fetch();
        $cible = new Cible($data);
        return $cible;
    }

    // readAll
    public function getAll(): array
    {
        $cibles = [];
        $req = $this->db->query('SELECT * FROM cible ORDER BY id');
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $cible = new Cible($data);
            $cibles[] = $cible;
        }

        return $cibles;
    }

    // readAll
    public function getAllByDesc(): array
    {
        $cibles = [];
        $req = $this->db->query('SELECT * FROM cible ORDER BY id DESC');
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $cible = new Cible($data);
            $cibles[] = $cible;
        }

        return $cibles;
    }

    // read5LastDatas
    public function getFiveLast(): array
    {
        $cibles = [];
        $req = $this->db->query('SELECT * FROM cible ORDER BY id DESC LIMIT 5');
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $cible = new Cible($data);
            $cibles[] = $cible;
        }

        return $cibles;
    }

    public function update(Cible $cible, int $id)
    {
        $req = $this->db->prepare("UPDATE `cible` SET name = :name, firstname = :firstname, dateOfBirth = :dateOfBirth, codename = :codename, nationality = :nationality WHERE id = :id");

        $req->bindValue(":name", $cible->getName(), PDO::PARAM_STR);
        $req->bindValue(":firstname", $cible->getfirstname(), PDO::PARAM_STR);
        $req->bindValue(":dateOfBirth", $cible->getDateOfBirth(), PDO::PARAM_STR);
        $req->bindValue(":codename", $cible->getCodename(), PDO::PARAM_STR);
        $req->bindValue(":nationality", $cible->getNationality(), PDO::PARAM_STR);
        $req->bindValue(":id", $id, PDO::PARAM_INT);


        $req->execute();
    }

    public function delete(int $id)
    {
        $req = $this->db->prepare("DELETE FROM `cible` WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();
    }
}
