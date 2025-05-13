<?php

function rechercheGeneral(string $sort_mer_matricule) {

    $pdo = require_once __DIR__ . '/../lib/mypdo.php';

    $sql = "SELECT * FROM Sortie_en_mer WHERE sort_mer_matricule = :sort_mer_matricule";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':sort_mer_matricule' => $sort_mer_matricule]);
    $sortie = $stmt->fetch(PDO::FETCH_ASSOC);



    $sql = "SELECT sauve.pers_matricule FROM Participe_sauvetage AS sauve 
            JOIN Sortie_en_mer AS sortmer ON sauve.sort_mer_matricule = sortmer.sort_mer_matricule
            WHERE sauve.sort_mer_matricule = :sort_mer_matricule";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':sort_mer_matricule' => $sort_mer_matricule]);
    $participe = $stmt->fetchAll(PDO::FETCH_ASSOC);


    
    $resultats = [
        'sortie' => $sortie,
        'participe' => $participe,
    ];

    if (!empty($resultats)) {
        return $resultats ;
    } 
}