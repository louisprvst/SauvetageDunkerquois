<?php
  $matricule = $_POST['bat_matricule'] ?? '';
  $nom = $_POST['bat_nom'] ?? '';
  $type = $_POST['bat_type'] ?? '';
  $pays = $_POST['bat_pays'] ?? '';
  $ville = $_POST['bat_ville'] ?? '';
  $gabarit = $_POST['bat_gabarit'] ?? '';

  require_once __DIR__ . '/../class/rechercheBateau.php';
  $resultats = rechercheGeneral($matricule, $nom, $type, $pays, $ville, $gabarit);
?>

<link rel="stylesheet" href="./../style/customstyle.css" media="all"/>
 
<div style="text-align: center; margin-top: 20px;">
  <button type="submit" form="bateau" class="bluebutton">Rechercher</button>

  <button type="button" onclick="window.location.href=window.location.pathname" class="bluebutton"> Réinitialiser </button>
</div>

<div class="bluecase">

  <h2 style="text-align: center;">Recherche de Bateaux</h2>

  <p class="tips">Cliquez sur matricule pour plus d'informations</p>

  <form method="post" id="bateau">
    <table style="width: 100%; margin-top: 1rem;">
      <thead>
        <tr>
          <th>Matricule</th>
          <th>Nom</th>
          <th>Type</th>
          <th>Pays</th>
          <th>Ville</th>
          <th>Gabarit</th>
        </tr>
        <tr>
          <td><input type="text" placeholder="Recherche par matricule" name="bat_matricule" value="<?= htmlspecialchars($matricule) ?>"></td>
          <td><input type="text" placeholder="Recherche par nom" name="bat_nom" value="<?= htmlspecialchars($nom) ?>"></td>
          <td><input type="text" placeholder="Recherche par type" name="bat_type" value="<?= htmlspecialchars($type) ?>"></td>
          <td><input type="text" placeholder="Recherche par pays" name="bat_pays" value="<?= htmlspecialchars($pays) ?>"></td>
          <td><input type="text" placeholder="Recherche par ville" name="bat_ville" value="<?= htmlspecialchars($ville) ?>"></td>
          <td><input type="text" placeholder="Recherche par gabarit" name="bat_gabarit" value="<?= htmlspecialchars($gabarit) ?>"></td>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($resultats)) : ?>
          <?php foreach ($resultats as $resultat): ?>
            <tr>
              <td><?= htmlspecialchars($resultat['bat_matricule']?? 'x') ?></td>
              <td><?= htmlspecialchars(empty($resultat['bat_nom']) || strtoupper($resultat['bat_nom']) === 'NULL'? 'x': $resultat['bat_nom']) ?></td>
              <td><?= htmlspecialchars(empty($resultat['bat_type']) || strtoupper($resultat['bat_type']) === 'NULL'? 'x': $resultat['bat_type']) ?></td>
              <td><?= htmlspecialchars(empty($resultat['bat_pays']) || strtoupper($resultat['bat_pays']) === 'NULL'? 'x': $resultat['bat_pays']) ?></td>
              <td><?= htmlspecialchars(empty($resultat['bat_ville']) || strtoupper($resultat['bat_ville']) === 'NULL'? 'x': $resultat['bat_ville']) ?></td>
              <td><?= htmlspecialchars(empty($resultat['bat_gabarit']) || strtoupper($resultat['bat_gabarit']) === 'NULL'? 'x': $resultat['bat_gabarit']) ?></td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </form>
</div>