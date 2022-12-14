<?php
require "Entity/UserModel.php";
require 'Controller/Controller.php';


class DefaultController extends Controller
{

    public function indexAction(Request $request): array
    {
        return [
            'message' => 'Hello World from default view'
        ];
    }
    public function loginAction(Request $request): array
    {
        // var_dump($request->get("email"));
        // var_dump($request->get("password"));
        // var_dump($request);
        $res = $this->validateLogin($request);
        return [
            'connected' => isset($res["id"]) || false,
            'message' => 'Hello World from login view'
        ];
    }

    private function validateField(Request $request, $name): Bool
    {
        $field = $request->get($name);
        return  isset($field) && !empty($field);
    }

    /**
     * Validation des la saisie utilisateur
     * 
     */
    public function validateLogin(Request $request)
    {
        if (
            $this->validateField($request, "email") &&
            $this->validateField($request, "password")
        ) {

            if (!filter_var($request->get("email"), FILTER_VALIDATE_EMAIL)) {
                $this->_FORMERROR["err"]["email"] = "Invalid email format";
            }



            if (isset($this->_FORMERROR["err"])) {
                //Erreur dans le forumulaire donc retourne les erreurs
                return $this->_FORMERROR;
            }

            //Creation car aucune erreurs dans le formulaire
            $userModel = new UserModel($this->dataBase->getConnecter());
            $userModel->setEmail($request->get("email"));
            $userModel->setPassword($request->get("password"));
            $userFromDB = $userModel->selectByEmailAndPassword();


            if ($userFromDB) {
                //Email exist
                return  $_SESSION["user"] = $userFromDB;
            }
            $this->_FORMERROR["err"]["form"] = "Mot de passe incorrecte";
            return $this->_FORMERROR;
        }
    }
}
