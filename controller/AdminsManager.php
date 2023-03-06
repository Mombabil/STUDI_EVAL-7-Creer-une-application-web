<?php

require './model/Admin.php';

class AdminsManager
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


    // read
    public function get(int $id)
    {
        $req = $this->db->prepare('SELECT * FROM admin WHERE id = :id');
        $req->execute([':id' => $id]);
        $data = $req->fetch();
        $admin = new Admin($data);
        return $admin;
    }

    // readAll
    public function getAll(): array
    {
        $admins = [];
        $req = $this->db->query('SELECT * FROM admin ORDER BY id');
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $admin = new Admin($data);
            $admins[] = $admin;
        }

        return $admins;
    }
}
