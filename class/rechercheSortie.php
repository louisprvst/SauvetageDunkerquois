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



    $sql = "SELECT commandant_bateau_secouru AS patron, 'Bateau secouru' AS role, bateau_secouru AS bat FROM details_sortie_en_mer WHERE sort_mer_matricule = :sort_mer_matricule AND bateau_secouru IS NOT NULL
            UNION ALL
            SELECT canot1_patron AS patron, 'Canot' AS role, canot1 AS bat FROM details_sortie_en_mer WHERE sort_mer_matricule = :sort_mer_matricule AND canot1 IS NOT NULL
            UNION ALL
            SELECT canot2_patron AS patron, 'Canot' AS role, canot2 AS bat FROM details_sortie_en_mer WHERE sort_mer_matricule = :sort_mer_matricule AND canot2 IS NOT NULL
            UNION ALL
            SELECT remorqueur1_patron AS patron, 'Remorqueur' AS role, remorqueur1 AS bat FROM details_sortie_en_mer WHERE sort_mer_matricule = :sort_mer_matricule AND remorqueur1 IS NOT NULL
            UNION ALL
            SELECT remorqueur2_patron AS patron, 'Remorqueur' AS role, remorqueur2 AS bat FROM details_sortie_en_mer WHERE sort_mer_matricule = :sort_mer_matricule AND remorqueur2 IS NOT NULL
            UNION ALL
            SELECT pilotage1_patron AS patron, 'Pilotage' AS role, pilotage1 AS bat FROM details_sortie_en_mer WHERE sort_mer_matricule = :sort_mer_matricule AND pilotage1 IS NOT NULL
            UNION ALL
            SELECT lamanage_patron AS patron, 'Lamanage' AS role, lamanage AS bat FROM details_sortie_en_mer WHERE sort_mer_matricule = :sort_mer_matricule AND lamanage IS NOT NULL ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':sort_mer_matricule' => $sort_mer_matricule]);
    $bateau = $stmt->fetchAll(PDO::FETCH_ASSOC);


    
    $resultats = [
        'sortie' => $sortie,
        'participe' => $participe,
        'sauve' => $etre_sauve,
        'deces' => $deces,
        'deco' => $deco,
        'bateau' => $bateau
    ];

    if (!empty($resultats)) {
        return $resultats ;
    } 
}