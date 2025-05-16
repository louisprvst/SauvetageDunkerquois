<?php

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['pers_search']['pers_matricule'] = $_POST['pers_matricule'] ?? '';
    $_SESSION['pers_search']['pers_nom'] = $_POST['pers_nom'] ?? '';
    $_SESSION['pers_search']['pers_prenomun'] = $_POST['pers_prenomun'] ?? '';
    $_SESSION['pers_search']['pers_nationalite'] = $_POST['pers_nationalite'] ?? '';
    $_SESSION['pers_search']['pers_naissance'] = $_POST['pers_naissance'] ?? '';
    $_SESSION['pers_search']['pers_lieu_nai'] = $_POST['pers_lieu_nai'] ?? '';
    $_SESSION['pers_search']['pers_metier'] = $_POST['pers_metier'] ?? '';
    $_SESSION['pers_search']['sauveteurs'] = $_POST['sauveteurs'] ?? false ;
  }

  $matricule = $_SESSION['pers_search']['pers_matricule'] ?? '';
  $nom = $_SESSION['pers_search']['pers_nom'] ?? '';
  $prenomun = $_SESSION['pers_search']['pers_prenomun'] ?? '';
  $nationalite = $_SESSION['pers_search']['pers_nationalite'] ?? '';
  $naissance = $_SESSION['pers_search']['pers_naissance'] ?? '';
  $lieu_nai = $_SESSION['pers_search']['pers_lieu_nai'] ?? '';
  $metier = $_SESSION['pers_search']['pers_metier'] ?? '';
  $is_sauveteurs = $_SESSION['pers_search']['sauveteurs'] ?? false;

  if (isset($_GET['reset']) && $_GET['reset'] == 1) {
    unset($_SESSION['pers_search']);
  }

  require_once __DIR__ . '/../class/recherchePersonne.php';
  $resultats = rechercheGeneral($matricule, $nom, $prenomun, $nationalite, $naissance, $lieu_nai, $metier, $is_sauveteurs);
?>

<link rel="stylesheet" href="./../style/customstyle.css" media="all"/>

<div style="text-align: center; margin-top: 20px;">
  <button type="submit" form="personne" class="bluebutton">Rechercher</button>

  <button type="button" onclick="window.location.href=window.location.pathname + '?reset=1'" class="bluebutton"> Réinitialiser </button>
</div>

<div class="bluecase">

  <h2 style="text-align: center;">Recherche de Personnes</h2>

  <p class="tips">Cliquez sur le matricule pour plus d'informations</p>

  <form method="post" id="personne">
    <table style="width: 100%; margin-top: 1rem;">
      <thead>
        <tr>
          <th></th>
          <th>Matricule</th>
          <th>Nom</th>
          <th>Prenom</th>
          <th>Nationalite</th>
          <th>Date de Naissance</th>
          <th>Lieu de Naissance</th>
          <th>Métier</th> 
        </tr>
        <tr>
          <td><input type="checkbox" name="sauveteurs" value="1" <?= $is_sauveteurs ? 'checked' : '' ?>></td>
          <td><input type="text" placeholder="Recherche par matricule" name="pers_matricule" value="<?= htmlspecialchars($matricule) ?>"></td>
          <td><input type="text" placeholder="Recherche par nom" name="pers_nom" value="<?= htmlspecialchars($nom) ?>"></td>
          <td><input type="text" placeholder="Recherche par prenom" name="pers_prenomun" value="<?= htmlspecialchars($prenomun) ?>"></td>
          <td><input type="text" placeholder="Recherche par nationalite" name="pers_nationalite" value="<?= htmlspecialchars($nationalite) ?>"></td>
          <td><input type="text" placeholder="Recherche par date de naissance" name="pers_naissance" value="<?= htmlspecialchars($naissance) ?>"></td>
          <td><input type="text" placeholder="Recherche par lieu de naissance" name="pers_lieu_nai" value="<?= htmlspecialchars($lieu_nai) ?>"></td>
          <td><input type="text" placeholder="Recherche par metier" name="pers_metier" value="<?= htmlspecialchars($metier) ?>"></td> 
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($resultats)) : ?>
          <?php foreach ($resultats as $resultat): ?>
            <tr>
              <td> <?php if (!empty($resultat['pers_fonction_sauvetage_matricule'])) : 
                echo '<img src="/../img/logo_snsm.png" alt="logo des sauveteurs" style="height: 20px; width: auto;"'; 
                endif ;?> 
              </td>
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