<?php
  session_start();
  require_once __DIR__ . '/../lib/retour.php';
  enregistrerNavigation();

  require_once __DIR__ . '/../class/rechercheBateau.php';
  $matricule = $_GET['matricule'] ?? '';
  $bateau = rechercheMatricule($matricule);
?>

<!DOCTYPE html>

<html lang="fr-FR">

<head>
    <title>Historique des naufrages - CMUA</title> 

    <link rel="icon" href="https://archives-dunkerque.fr/fileadmin/CMUA/favicon.ico" type="image/vnd.microsoft.icon" />

    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
    <meta name="twitter:card" content="summary" />
    <meta name="apple-mobile-web-app-capable" content="no" />
    <meta name="google" content="notranslate" />

    <link rel="stylesheet" href="./../style/bootstrappackageicon.min.css" media="all" />
    <link rel="stylesheet" href="./../style/theme-0d7f9be96d13db32849f66a9659792ed33b451f979e710ffae8742739207bfbd.css" media="all" />
    <link rel="stylesheet" href="./../style/owl.carousel.min.css" media="all" />
    <link rel="stylesheet" href="./../style/cmua-ea6dae8716f630adaee2fa06efcf31352aea48cd0f3fa32d400c2ae4181a788a.css" media="all" />

    <link rel="stylesheet" href="./../style/customstyle.css" media="all" />
</head>

<body>

  <?php include 'header.inc.php' ; ?>

  <div id="page-content" class="bp-page-content main-section" role="main">
    <div id="c36555" class="frame frame-size-default frame-default frame-type-header frame-layout-default frame-background-primary frame-no-backgroundimage frame-space-before-none frame-space-after-none">
        <div class="frame-group-container">
            <div class="frame-group-inner">
                <div class="frame-container frame-container-default">
                    <div class="frame-inner">
                        <header class="frame-header">
                            <h1 class="element-header"> <?= htmlspecialchars($bateau['bateau']['bat_nom'])?> </h1>
                        </header>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bluecase">

      <h2 style="text-align: center;"> <strong> Fiche Bateau <?= htmlspecialchars($bateau['bateau']['bat_matricule'])?> </strong> </h2>

      <p class="tips">Cliquez sur l'identifiant pour plus d'informations</p>

      <?php

        if ($bateau) {

            echo '<p class="fiche_title"><strong>Détails sur le bateau :</strong></p>';

            if (!empty($bateau['bateau']['bat_nom'])) {
                echo '<div><p>Nom du bateau : ' . htmlspecialchars($bateau['bateau']['bat_nom']) . '</p></div>';
            }

            if (!empty($bateau['bateau']['bat_type']) && strtoupper($bateau['bateau']['bat_type']) !== 'NULL') {
                echo '<div><p>Type de bateau : ' . htmlspecialchars($bateau['bateau']['bat_type']) . '</p></div>';
            }

            if (!empty($bateau['bateau']['bat_pays']) && strtoupper($bateau['bateau']['bat_pays']) !== 'NULL') {
                echo '<div><p>Pays d\'origine : ' . htmlspecialchars($bateau['bateau']['bat_pays']) . '</p></div>';
            }

            if (!empty($bateau['bateau']['bat_ville']) && strtoupper($bateau['bateau']['bat_ville']) !== 'NULL') {
                echo '<div><p>Ville d\'origine : ' . htmlspecialchars($bateau['bateau']['bat_ville']) . '</p></div>';
            }

            if (!empty($bateau['bateau']['bat_gabarit'])) {
                echo '<div><p>Gabarit : ' . htmlspecialchars($bateau['bateau']['bat_gabarit']) . '</p></div>';
            }
        }
      ?>


      <?php if(!empty($bateau['affectation'])) : ?>
        <p class="fiche_title"> <strong> Personne affecté sur ce bateau : </strong> </p>
        <ul>
            <?php foreach ($bateau['affectation'] as $resultat): ?>
                <li>
                    <a href="detailsPersonne.php?matricule=<?= urlencode($resultat['pers_matricule']) ?>">
                        <?= htmlspecialchars($resultat['pers_matricule']) .
                        " ( " .  htmlspecialchars($resultat['pers_nom']) . " " .
                        htmlspecialchars($resultat['pers_prenom1']) . " ) " ?> 
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
      <?php endif; ?>


      <?php if(!empty($bateau['detail'])) : ?>

        <?php echo '<p class="fiche_title"> <strong> Détails de ses sortie(s) en mer : </strong> </p>'; ?>

        <table style="width: 100%; margin-top: 1rem;">
          <thead>
            <tr>
              <th style="text-align: left; padding-right: 1rem;">Sortie en mer</th>
              <th style="text-align: left; padding-right: 1rem;">Rôle</th>
              <th style="text-align: left;">Patron</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($bateau['detail'] as $resultat): ?>
              <tr>
                <td style="padding-right: 1rem;">
                    <a href="detailsSortie.php?matricule=<?= urlencode($resultat['sort_mer_matricule']) ?>">
                        <?= htmlspecialchars($resultat['sort_mer_matricule'])?> 
                    </a>
                </td>
                <td style="padding-right: 1rem;">
                    <?= htmlspecialchars($resultat['role'])?>
                </td>
                <td>
                    <a href="detailsPersonne.php?matricule=<?= urlencode($resultat['patron']) ?>">
                        <?=htmlspecialchars($resultat['patron'])?> 
                    </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>

    <div style="text-align: center; margin-top: 20px;">
      <div style="display: inline-block;">
          <?php afficherBoutonRetour(); ?>
      </div>
      <div style="display: inline-block;">
          <a href="../index.php" class="bluebutton">Accueil</a>
      </div>
    </div>

    </div>

  <?php include 'footer.inc.php' ; ?>

</body>

</html>