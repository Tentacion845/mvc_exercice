<?php

class DataBase
{

    private $conn;
    public function __construct($host, $dbname, $username, $password)
    {
        try {
            // $this->conn = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $username, $password);
            // $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
            // $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);

            $servername = "localhost";
            $username = "root";
            $password = "";

            $database = "mvc_exercice";

            // Create a connection 
            $this->conn = mysqli_connect(
                $servername,
                $username,
                $password,
                $database
            );
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function getConnecter()
    {
        return $this->conn;
    }
}
