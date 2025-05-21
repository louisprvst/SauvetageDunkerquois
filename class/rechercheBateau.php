<?php

function rechercheGeneral(string $bat_matricule, string $bat_nom, string $bat_type, string $bat_pays, string $bat_ville, string $bat_gabarit) {

    $pdo = require_once __DIR__ . '/../lib/mypdo.php';

    $sql = "SELECT * FROM Bateau WHERE 1 = 1" ;

    $params = [];

    if (!empty($bat_matricule)) {
        $sql .= " AND bat_matricule LIKE :matricule";
        $params[':matricule'] = "%$bat_matricule%";
    }

    if (!empty($bat_nom)) {
        $sql .= " AND bat_nom LIKE :nom";
        $params[':nom'] = "%$bat_nom%";
    }

    if (!empty($bat_type)) {
        $sql .= " AND bat_type LIKE :type";
        $params[':type'] = "%$bat_type%";
    }

    if (!empty($bat_pays)) {
        $sql .= " AND bat_pays LIKE :pays";
        $params[':pays'] = "%$bat_pays%";
    }

    if (!empty($bat_ville)) {
        $sql .= " AND bat_ville LIKE :ville";
        $params[':ville'] = "%$bat_ville%";
    }

    if (!empty($bat_gabarit)) {
        $sql .= " AND bat_gabarit LIKE :gabarit";
        $params[':gabarit'] = "%$bat_gabarit%";
    }

    $sql .= " ORDER BY bat_nom ASC;";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($resultats)) {
        return $resultats ;
    } 
}


function rechercheMatricule(string $bat_matricule) {

    $pdo = require_once __DIR__ . '/../lib/mypdo.php';

    $sql = "SELECT * FROM Bateau WHERE bat_matricule = :matricule";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':matricule' => $bat_matricule]);
    $bateau = $stmt->fetch(PDO::FETCH_ASSOC);



    $sql = "SELECT pers.pers_matricule , pers.pers_nom , pers.pers_prenom1 FROM Personne AS pers 
    JOIN Bateau AS bat ON pers.pers_affectation_complement = bat.bat_matricule
    WHERE pers.pers_affectation_complement = :matricule";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':matricule' => $bat_matricule]);
    $affectation = $stmt->fetchAll(PDO::FETCH_ASSOC);



    $sql = "SELECT sort_mer_matricule, commandant_bateau_secouru AS patron, 'Bateau secouru' AS role FROM details_sortie_en_mer WHERE bateau_secouru = :matricule
            UNION ALL
            SELECT sort_mer_matricule, canot1_patron AS patron, 'Canot' AS role FROM details_sortie_en_mer WHERE canot1 = :matricule
            UNION ALL
            SELECT sort_mer_matricule, canot2_patron AS patron, 'Canot' AS role FROM details_sortie_en_mer WHERE canot2 = :matricule
            UNION ALL
            SELECT sort_mer_matricule, remorqueur1_patron AS patron, 'Remorqueur' AS role FROM details_sortie_en_mer WHERE remorqueur1 = :matricule
            UNION ALL
            SELECT sort_mer_matricule, remorqueur2_patron AS patron, 'Remorqueur' AS role FROM details_sortie_en_mer WHERE remorqueur2 = :matricule
            UNION ALL
            SELECT sort_mer_matricule, pilotage1_patron AS patron, 'Bateau de pilotage' AS role FROM details_sortie_en_mer WHERE pilotage1 = :matricule
            UNION ALL
            SELECT sort_mer_matricule, lamanage_patron AS patron, 'Bateau de lamanage' AS role FROM details_sortie_en_mer WHERE lamanage = :matricule ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':matricule' => $bat_matricule]);
    $detail = $stmt->fetchAll(PDO::FETCH_ASSOC);



    $resultats = [
        'bateau' => $bateau,
        'affectation' => $affectation ,
        'detail' => $detail
    ];

    if (!empty($resultats)) {
        return $resultats ;
    } 
}