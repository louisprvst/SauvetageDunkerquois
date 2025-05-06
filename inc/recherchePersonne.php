<?php
  $matricule = $_POST['pers_matricule'] ?? '';
  $nom = $_POST['pers_nom'] ?? '';
  $prenomun = $_POST['pers_prenomun'] ?? '';
  $nationalite = $_POST['pers_nationalite'] ?? '';
  $naissance = $_POST['pers_naissance'] ?? '';
  $lieu_nai = $_POST['pers_lieu_nai'] ?? '';
  $metier = $_POST['pers_metier'] ?? '';

  require_once __DIR__ . '/../class/recherchePersonne.php';
  $resultats = rechercheGeneral($matricule, $nom, $prenomun, $nationalite, $naissance, $lieu_nai, $metier);
?>

<link rel="stylesheet" href="./../style/customstyle.css" media="all"/>

<div style="text-align: center; margin-top: 20px;">
  <button type="submit" form="personne" class="bluebutton">Rechercher</button>

  <button type="button" onclick="window.location.href=window.location.pathname" class="bluebutton"margin: 5px;"> Réinitialiser </button>
</div>

<div class="bluecase">

  <h2 style="text-align: center;">Recherche de Personnes</h2>

  <form method="post" id="personne">
    <table style="width: 100%; margin-top: 1rem;">
      <thead>
        <tr>
          <th>Matricule</th>
          <th>Nom</th>
          <th>Prenom</th>
          <th>Nationalite</th>
          <th>Date de Naissance</th>
          <th>Lieu de Naissance</th>
          <th>Métier</th> 
        </tr>
        <tr>
          <td><input type="text" name="pers_matricule" value="<?= htmlspecialchars($matricule) ?>"></td>
          <td><input type="text" name="pers_nom" value="<?= htmlspecialchars($nom) ?>"></td>
          <td><input type="text" name="pers_prenomun" value="<?= htmlspecialchars($prenomun) ?>"></td>
          <td><input type="text" name="pers_nationalite" value="<?= htmlspecialchars($nationalite) ?>"></td>
          <td><input type="text" name="pers_naissance" value="<?= htmlspecialchars($naissance) ?>"></td>
          <td><input type="text" name="pers_lieu_nai" value="<?= htmlspecialchars($lieu_nai) ?>"></td>
          <td><input type="text" name="pers_metier" value="<?= htmlspecialchars($metier) ?>"></td> 
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($resultats)) : ?>
          <?php foreach ($resultats as $resultat): ?>
            <tr>
              <td>
                <a href="inc/detailsPersonne.php?matricule=<?= urlencode($resultat['pers_matricule']) ?>">
                  <?= htmlspecialchars($resultat['pers_matricule']) ?>
                </a>
              </td>
              <td><?= htmlspecialchars($resultat['pers_nom'] ?? 'x') ?></td>
              <td><?= htmlspecialchars($resultat['pers_prenom1'] ?? 'x') ?></td>
              <td><?= htmlspecialchars($resultat['pers_nationalite'] ?? 'x') ?></td>
              <td><?= htmlspecialchars($resultat['pers_ddn'] ?? 'x') ?></td>
              <td><?= htmlspecialchars($resultat['pers_lieu_naissance'] ?? 'x') ?></td>
              <td><?= htmlspecialchars($resultat['pers_metier'] ?? 'x') ?></td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </form>
</div>