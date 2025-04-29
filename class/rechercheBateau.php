<?php

function rechercheGeneral(string $search) {

    $pdo = require_once __DIR__ . '/../lib/mypdo.php';

    if (isset($_POST['search'])) {
        $recherche = $_POST['search'];

        $stmt = $pdo->prepare("SELECT * FROM Bateau WHERE bat_matricule LIKE :search OR bat_nom LIKE :search OR bat_type LIKE :search OR bat_pays LIKE :search OR bat_ville LIKE :search");
        $stmt->execute(['search' => "%$recherche%"]);

        $resultats = $stmt->fetchAll();

        if (empty($resultats)) {
            echo "Aucun résultat trouvé.";
        } 
        else {
            return $resultats ;
        }
    } 
    else {
        echo "Aucun mot-clé de recherche fourni.";
    }
}