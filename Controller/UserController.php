<?php
require 'Controller/Controller.php';

/**
 * Created by PhpStorm.
 * User: criquier
 * Date: 23/10/15
 * Time: 09:36
 */

class UserController extends Controller
{
    protected $dataBase;
    public $_FORMERROR;

    public function __construct(DataBase $dataBase)
    {
        $this->dataBase = $dataBase;
    }

    public function indexAction(Request $request): array
    {
        return [
            'message' => 'Hello World from user controller',
            'sendMeHello' => "Hello"
        ];
    }




    /**
     * Validation des la saisie utilisateur
     * 
     */
    public function validateCreateUserForm()
    {
        if (
            $this->validateField("email") &&
            $this->validateField("prenom") &&
            $this->validateField("nom") &&
            $this->validateField("password") &&
            $this->validateField("repeatPassword") &&
            $this->validateField("dateNaissance")
        ) {
            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $this->_FORMERROR["err"]["email"][0] = "Invalid email format";
            }
            if (strlen($_POST["email"]) < 10) {
                $this->_FORMERROR["err"]["email"][1] = "email trop court !";
            }
            if (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["prenom"])) {
                $this->_FORMERROR["err"]["prenom"] = "Mauvais format";
            }
            if (strlen($_POST["prenom"]) > 25) {
                $this->_FORMERROR["err"]["prenom"] = "Trop long";
            }
            if (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["nom"])) {
                $this->_FORMERROR["err"]["nom"] = "Mauvais format";
            }
            if (strlen($_POST["nom"]) > 25) {
                $this->_FORMERROR["err"]["nom"] = "Trop long";
            }
            if ($_POST["password"] !== $_POST["repeatPassword"]) {
                $this->_FORMERROR["err"]["password"] = "Les password ne correspondent pas";
            }
        } else {
            $this->_FORMERROR["err"]["form"] = "Formulaire incomplet";
        }


        if (isset($this->_FORMERROR["err"])) {
            //Erreur dans le forumulaire donc retourne les erreurs
            return $this->_FORMERROR;
        }


        //Creation car aucune erreurs dans le formulaire
        $userModel = new UserModel($this->dataBase);
        $userModel->setEmail($_POST["email"]);
        $userModel->setPassword($_POST["password"]);
        $userModel->setPrenom($_POST["prenom"]);
        $userModel->setNom($_POST["nom"]);
        $userModel->setDate_naissance($_POST["dateNaissance"]);

        $userFromDB = $userModel->selectByEmail($userModel->getEmail());


        if ($userFromDB > 0) {
            //Email déja présent
            $this->_FORMERROR["err"]["form"] = "Email déjà pris !";
            return $this->_FORMERROR;
        }

        if ($userModel->create()) {
            var_dump("Created");
            header("Location: login.php");
            exit();
        }
    }
}
