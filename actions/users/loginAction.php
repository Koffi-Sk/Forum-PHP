<?php

session_start();
require_once "actions/database.php";

if (isset($_POST['validate'])){
    // Vérifier si l'user a bien complété tous les champs
    if(!empty($_POST['pseudo']) AND !empty($_POST['password'])){

        // Les données de l'user
        $user_pseudo = htmlspecialchars($_POST['pseudo']);
        $user_password  = htmlspecialchars($_POST['password']);

        // Vérifier si le user existe (si le pseudo est correct)
        $checkIfUserExists = $bdd->prepare("SELECT * FROM users WHERE pseudo = ?");
        $checkIfUserExists->execute(array($user_pseudo));

        if ($checkIfUserExists->rowCount() > 0){
            
            // Récupérer les données du user
            $usersInfos = $checkIfUserExists->fetch();

            // Vérifier si le mot de passe est correct
            if(password_verify($user_password, $usersInfos['mdp'])){
                
                 // Authentifier le user sur le site et récupérer ses données dans des variables globales sessions
                $_SESSION["auth"] = true;
                $_SESSION["id"] = $usersInfos["id"];
                $_SESSION["lastname"] = $usersInfos["nom"];
                $_SESSION["firstname"] = $usersInfos["prenom"];
                $_SESSION["pseudo"] = $usersInfos["pseudo"];

                 // Rediriger le user vers page d'accueil
                header("Location: index.php");
                
            }else{
                $errorMsg = "Votre mot de passe est incorrect";
            }

        }else{
            $errorMsg = "Votre pseudo est incorrect..";
        }

    }else{
        $errorMsg = "Veuillez compléter tous les champs...";
    }

}