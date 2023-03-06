<?php

require_once './model/Contact.php';


class ContactsManager
{
    private $db;

    // On crée un constructeur sans parametres qui gerera la connection a la bdd et a la table contact
    public function __construct()
    {
        $dbName = "studikgb";
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
    public function create(Contact $contact)
    {
        $req = $this->db->prepare('INSERT INTO contact (name, firstname, dateOfBirth, codename, nationality) VALUES (:name, :firstname, :dateOfBirth, :codename, :nationality)');

        $req->bindValue(":name", $contact->getName(), PDO::PARAM_STR);
        $req->bindValue(":firstname", $contact->getFirstname(), PDO::PARAM_STR);
        $req->bindValue(":dateOfBirth", $contact->getDateOfBirth(), PDO::PARAM_STR);
        $req->bindValue(":codename", $contact->getCodename(), PDO::PARAM_STR);
        $req->bindValue(":nationality", $contact->getNationality(), PDO::PARAM_STR);

        $req->execute();
    }
    // read
    public function get(int $id)
    {
        $req = $this->db->prepare('SELECT * FROM contact WHERE id = :id');
        $req->execute([':id' => $id]);
        $data = $req->fetch();
        $contact = new Contact($data);
        return $contact;
    }

    // readAll
    public function getAll(): array
    {
        $contacts = [];
        $req = $this->db->query('SELECT * FROM contact ORDER BY id');
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $contact = new Contact($data);
            $contacts[] = $contact;
        }

        return $contacts;
    }

    // readAll
    public function getAllByDesc(): array
    {
        $contacts = [];
        $req = $this->db->query('SELECT * FROM contact ORDER BY id DESC');
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $contact = new Contact($data);
            $contacts[] = $contact;
        }

        return $contacts;
    }

    public function getAllByNationality(string $nationality): array
    {
        $contacts = [];
        $req = $this->db->prepare('SELECT * FROM contact WHERE nationality LIKE :nationality');
        $req->bindValue(":nationality", $nationality, PDO::PARAM_STR);
        $req->execute();
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $contact = new Contact($data);
            $contacts[] = $contact;
        }
        return $contacts;
    }

    // read5LastDatas
    public function getFiveLast(): array
    {
        $contacts = [];
        $req = $this->db->query('SELECT * FROM contact ORDER BY id DESC LIMIT 5');
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $contact = new Contact($data);
            $contacts[] = $contact;
        }

        return $contacts;
    }

    public function update(Contact $contact, int $id)
    {
        $req = $this->db->prepare("UPDATE `contact` SET name = :name, firstname = :firstname, dateOfBirth = :dateOfBirth, codename = :codename, nationality = :nationality WHERE id = :id");

        $req->bindValue(":name", $contact->getName(), PDO::PARAM_STR);
        $req->bindValue(":firstname", $contact->getfirstname(), PDO::PARAM_STR);
        $req->bindValue(":dateOfBirth", $contact->getDateOfBirth(), PDO::PARAM_STR);
        $req->bindValue(":codename", $contact->getCodename(), PDO::PARAM_STR);
        $req->bindValue(":nationality", $contact->getNationality(), PDO::PARAM_STR);
        $req->bindValue(":id", $id, PDO::PARAM_INT);


        $req->execute();
    }

    public function delete(int $id)
    {
        $req = $this->db->prepare("DELETE FROM `contact` WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();
    }
}
