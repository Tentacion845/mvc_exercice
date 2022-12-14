<?php

/**
 * Connection BDD
 * 
 */


class UserModel
{
    function __construct($conn)
    {
        $this->conn = $conn;
    }
    private $conn;
    protected $id;
    protected $email;
    protected $nom;
    protected $prenom;
    protected $date_naissance;
    protected $password;


    /**
     * Getters
     */
    public function getId()
    {
        return $this->id;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getNom()
    {
        return $this->nom;
    }
    public function getPrenom()
    {
        return $this->prenom;
    }
    public function getDate_naissance()
    {
        return $this->date_naissance;
    }
    public function getPassword()
    {
        return $this->password;
    }


    /**
     * Setters
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }
    public function setNom(string $nom)
    {
        $this->nom = $nom;
    }
    public function setPrenom(string $prenom)
    {
        $this->prenom = $prenom;
    }
    public function setDate_naissance(string $date_naissance)
    {
        $this->date_naissance = $date_naissance;
    }
    public function setPassword(string $password)
    {
        $hash = password_hash(
            $password,
            PASSWORD_DEFAULT
        );
        $this->password = $hash;
    }


    /**
     * Cruds
     * Insertion d'un new user
     * 
     */
    public function create()
    {
        $sql = "INSERT INTO `users` ( `email`, 
        `password`,`prenom`,`nom`,`date_naissance`) VALUES ('{$this->getEmail()}', 
        '{$this->getPassword()}','{$this->getPrenom()}','{$this->getNom()}','{$this->getDate_naissance()}' )";

        return mysqli_query($this->conn, $sql);
    }

    public function selectById(int $id)
    {
        $sql = "Select * from users where id='$id'";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_num_rows($result);
    }
    public function selectByEmail(string $email)
    {
        $sql = "Select * from users where email='$email'";
        $result = mysqli_query($this->conn, $sql);
        return  mysqli_num_rows($result);
    }
    public function selectByEmailAndPassword()
    {
        $sql = "Select * from users where email='$this->email' ";
        $result = mysqli_query($this->conn, $sql);
        $row = $result->fetch_assoc();
        if (isset($row["password"]) && password_verify($_POST['password'], $row["password"])) {
            // echo 'Password is valid!';
            return $row;
        } else {
            // echo 'Invalid password.';
            return false;
        }
    }

    public function update(int $id, array $data)
    {
    }

    public function delete(int $id)
    {
    }
}
