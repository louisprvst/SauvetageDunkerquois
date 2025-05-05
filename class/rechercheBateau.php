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

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($resultats)) {
        return $resultats ;
    } 
}