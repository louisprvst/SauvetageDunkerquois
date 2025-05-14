<?php

function rechercheGeneral(string $sort_mer_matricule) {

    $pdo = require_once __DIR__ . '/../lib/mypdo.php';

    $sql = "SELECT * FROM Sortie_en_mer WHERE sort_mer_matricule = :sort_mer_matricule";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':sort_mer_matricule' => $sort_mer_matricule]);
    $sortie = $stmt->fetch(PDO::FETCH_ASSOC);



    $sql = "SELECT sauve.pers_matricule , pers.pers_nom , pers.pers_prenom1 FROM Participe_sauvetage AS sauve 
            JOIN Sortie_en_mer AS sortmer ON sauve.sort_mer_matricule = sortmer.sort_mer_matricule
            JOIN Personne AS pers ON sauve.pers_matricule = pers.pers_matricule
            WHERE sauve.sort_mer_matricule = :sort_mer_matricule";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':sort_mer_matricule' => $sort_mer_matricule]);
    $participe = $stmt->fetchAll(PDO::FETCH_ASSOC);



    $sql = "SELECT sauve.pers_matricule , pers.pers_nom , pers.pers_prenom1 FROM Etre_sauve AS sauve 
            JOIN Sortie_en_mer AS sortmer ON sauve.sort_mer_matricule = sortmer.sort_mer_matricule
            JOIN Personne AS pers ON sauve.pers_matricule = pers.pers_matricule
            WHERE sauve.sort_mer_matricule = :sort_mer_matricule";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':sort_mer_matricule' => $sort_mer_matricule]);
    $etre_sauve = $stmt->fetchAll(PDO::FETCH_ASSOC);



    $sql = "SELECT deces.pers_matricule , pers.pers_nom , pers.pers_prenom1 FROM Deces AS deces 
            JOIN Sortie_en_mer AS sortmer ON deces.sortie_en_mer_matricule = sortmer.sort_mer_matricule
            JOIN Personne AS pers ON deces.pers_matricule = pers.pers_matricule
            WHERE deces.sortie_en_mer_matricule = :sort_mer_matricule";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':sort_mer_matricule' => $sort_mer_matricule]);
    $deces = $stmt->fetchAll(PDO::FETCH_ASSOC);



    $sql = "SELECT DISTINCT deco.pers_matricule , pers.pers_nom , pers.pers_prenom1 FROM Etre_decore AS deco 
            JOIN Sortie_en_mer AS sortmer ON deco.sort_mer_matricule = sortmer.sort_mer_matricule
            JOIN Personne AS pers ON deco.pers_matricule = pers.pers_matricule
            WHERE deco.sort_mer_matricule = :sort_mer_matricule";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':sort_mer_matricule' => $sort_mer_matricule]);
    $deco = $stmt->fetchAll(PDO::FETCH_ASSOC);


    
    $resultats = [
        'sortie' => $sortie,
        'participe' => $participe,
        'sauve' => $etre_sauve,
        'deces' => $deces,
        'deco' => $deco
    ];

    if (!empty($resultats)) {
        return $resultats ;
    } 
}