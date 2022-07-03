<?php

require_once "actions/database.php";

$getAllQuestions = $bdd->prepare("SELECT id, titre, description FROM questions WHERE id_auteur = ? ORDER BY id DESC");
$getAllQuestions->execute(array($_SESSION['id']));