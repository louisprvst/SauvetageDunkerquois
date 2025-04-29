<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$pdo = require_once '../lib/mypdo.php';

if (isset($_GET['search'])) {
    $recherche = $_GET['search'];

    $stmt = $pdo->prepare("SELECT * FROM Bateau WHERE bat_nom LIKE :search");
    $stmt->execute(['search' => "%$recherche%"]);

    $resultats = $stmt->fetchAll();

    if (empty($resultats)) {
        echo "Aucun résultat trouvé.";
    } 
    else {
        return $resultats;
    }
} 
else {
    echo "Aucun mot-clé de recherche fourni.";
}