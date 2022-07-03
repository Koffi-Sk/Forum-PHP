<?php

session_start();
if(!isset($_SESSION['auth'])){
    header('Location: ../../login.php');
}
require_once "../database.php";

if (isset($_GET["id"]) AND !empty($_GET["id"])){

    $idOfTheQuestion = $_GET["id"];

    $checkIfQuestionExists = $bdd->prepare("SELECT id_auteur FROM questionS WHERE id = ?");
    $checkIfQuestionExists->execute(array($idOfTheQuestion));

    if($checkIfQuestionExists->rowCount() > 0){

        $usersInfos = $checkIfQuestionExists->fetch();

        if($usersInfos["id_auteur"] == $_SESSION["id"]){
            $deleteThisQuestion = $bdd->prepare("DELETE FROM questions WHERE id = ?");
            $deleteThisQuestion->execute(array($idOfTheQuestion));

            header("Location: ../../my-questions.php");
        }else{
            echo "Vous n'avez pas le droit de supprimer une question qui ne vous appartient pas!";
        }

    }else{
        echo "Aucune question n'a été trouvée...";
    }
}else{
    echo "Aucune question n'a été trouvée";
}