<?php

function rechercheGeneral(string $pers_matricule, string $pers_nom, string $pers_prenomun, string $pers_nationalite, string $pers_naissance, string $pers_lieu_nai, string $pers_metier) {

    $pdo = require_once __DIR__ . '/../lib/mypdo.php';

    $sql = "SELECT * FROM Personne WHERE 1 = 1" ;

    $params = [];

    if (!empty($pers_matricule)) {
        $sql .= " AND pers_matricule LIKE :matricule";
        $params[':matricule'] = "%$pers_matricule%";
    }

    if (!empty($pers_nom)) {
        $sql .= " AND pers_nom LIKE :nom";
        $params[':nom'] = "%$pers_nom%";
    }

    if (!empty($pers_prenomun)) {
        $sql .= " AND pers_prenom1 LIKE :prenomun";
        $params[':prenomun'] = "%$pers_prenomun%";
    }

    if (!empty($pers_nationalite)) {
        $sql .= " AND pers_nationalite LIKE :nationalite";
        $params[':nationalite'] = "%$pers_nationalite%";
    }

    if (!empty($pers_naissance)) {
        $sql .= " AND pers_ddn LIKE :naissance";
        $params[':naissance'] = "%$pers_naissance%";
    }

    if (!empty($pers_lieu_nai)) {
        $sql .= " AND pers_lieu_naissance LIKE :lieu_nai";
        $params[':lieu_nai'] = "%$pers_lieu_nai%";
    }

    if (!empty($pers_metier)) {
        $sql .= " AND pers_metier LIKE :metier";
        $params[':metier'] = "%$pers_metier%";
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($resultats)) {
        return $resultats ;
    } 
}


function rechercheParMatricule(string $matricule) {
    $pdo = require_once __DIR__ . '/../lib/mypdo.php';

    $sql = "SELECT pers.* , fonc.fonction_sauvetage_description FROM Personne AS pers 
            LEFT JOIN Fonction_sauvetage AS fonc ON pers.pers_fonction_sauvetage_matricule = fonc.fonction_sauvetage_matricule 
            WHERE pers.pers_matricule = :matricule";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':matricule' => $matricule]);
    $resultats_pers = $stmt->fetch(PDO::FETCH_ASSOC);



    $sql = "SELECT deces.* FROM Deces AS deces 
            JOIN Personne AS pers ON deces.pers_matricule = pers.pers_matricule 
            WHERE deces.pers_matricule = :matricule";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':matricule' => $matricule]);
    $resultats_deces = $stmt->fetch(PDO::FETCH_ASSOC);



    $sql = "SELECT deco.* , decoinfo.* FROM Etre_decore AS deco 
            JOIN Personne AS pers ON deco.pers_matricule = pers.pers_matricule 
            JOIN Decoration AS decoinfo ON deco.deco_matricule = decoinfo.deco_matricule
            WHERE deco.pers_matricule = :matricule";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':matricule' => $matricule]);
    $resultats_deco = $stmt->fetch(PDO::FETCH_ASSOC);



    $sql = "SELECT sauve.* , sortmer.sort_mer_date_sauvetage FROM Etre_sauve AS sauve 
            JOIN Personne AS pers ON sauve.pers_matricule = pers.pers_matricule 
            JOIN Sortie_en_mer AS sortmer ON sauve.sort_mer_matricule = sortmer.sort_mer_matricule
            WHERE sauve.pers_matricule = :matricule";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':matricule' => $matricule]);
    $resultats_etre_sauve = $stmt->fetch(PDO::FETCH_ASSOC);



    $sql = "SELECT sauve.* , sortmer.sort_mer_date_sauvetage FROM Participe_sauvetage AS sauve 
            JOIN Personne AS pers ON sauve.pers_matricule = pers.pers_matricule 
            JOIN Sortie_en_mer AS sortmer ON sauve.sort_mer_matricule = sortmer.sort_mer_matricule
            WHERE sauve.pers_matricule = :matricule";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':matricule' => $matricule]);
    $resultats_participe_sauvetage = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $resultats = [
        'personne' => $resultats_pers,
        'deces' => $resultats_deces,
        'deco' => $resultats_deco,
        'etre_sauve' => $resultats_etre_sauve,
        'participe_sauvetage' => $resultats_participe_sauvetage
    ];

    if (!empty($resultats)) {
        return $resultats ;
    }
}