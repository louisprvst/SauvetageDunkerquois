<?php
  session_start();
  require_once __DIR__ . '/../lib/retour.php';;
  enregistrerNavigation();

  require_once __DIR__ . '/../class/recherchePersonne.php';
  $matricule = $_GET['matricule'] ?? '';
  $personne = rechercheParMatricule($matricule);
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
                            <h1 class="element-header">
                              <span><?= htmlspecialchars($personne['personne']['pers_nom'])?> <?= htmlspecialchars($personne['personne']['pers_prenom1'])?></span>
                            </h1>
                        </header>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bluecase">

      <h2 style="text-align: center;"> <strong> Fiche Personne <?= htmlspecialchars($personne['personne']['pers_matricule'])?> </strong> </h2>

      <p class="tips">Cliquez sur l'identifiant pour plus d'informations</p>

      <?php
        if ($personne) {

          if (!empty($personne['personne'])) {
            echo '<p class="fiche_title"> <strong> Détails de la personne : </strong> </p>';
          }

            if (!empty($personne['personne']['pers_matricule'])) {
              echo '<div><p>Identifiant : ' . htmlspecialchars($personne['personne']['pers_matricule']) . '</p></div>';
            }

            if (!empty($personne['personne']['pers_nom'])) {
              echo '<div><p>Nom : ' . htmlspecialchars($personne['personne']['pers_nom']) . '</p></div>';
            }

            if (!empty($personne['personne']['pers_prenom1']) || !empty($personne['personne']['pers_prenom2']) || !empty($personne['personne']['pers_prenom3'])) {
              echo '<div><p>Prénom : ' . htmlspecialchars($personne['personne']['pers_prenom1']) . ' ' . htmlspecialchars($personne['personne']['pers_prenom2']) . ' ' . htmlspecialchars($personne['personne']['pers_prenom3']) . '</p></div>';
            }

            if (!empty($personne['personne']['pers_nationalite'])) {
              echo '<div><p>Nationalité : ' . htmlspecialchars($personne['personne']['pers_nationalite']) . '</p></div>';
            }

            if (!empty($personne['personne']['pers_ddn'])) {
              echo '<div><p>Date de naissance : ' . htmlspecialchars($personne['personne']['pers_ddn']) . '</p></div>';
            }

            if (!empty($personne['personne']['pers_lieu_naissance'])) {
              echo '<div><p>Lieu de naissance : ' . htmlspecialchars($personne['personne']['pers_lieu_naissance']) . '</p></div>';
            }

            if (!empty($personne['personne']['pers_marie_avec'])) {
              echo '<div><p>Conjoint(e) : ' . htmlspecialchars($personne['personne']['pers_marie_avec']) . '</p></div>';
            }

            if (!empty($personne['personne']['pers_station'])) {
              echo '<div><p>Station : ' . htmlspecialchars($personne['personne']['pers_station']) . '</p></div>';
            }

            if (!empty($personne['personne']['pers_fonction_sauvetage_matricule'])) {
              echo '<div><p>Fonction sauvetage : ' . htmlspecialchars($personne['personne']['fonction_sauvetage_description']) . '</p></div>';
            }

            if (!empty($personne['personne']['pers_metier'])) {
              echo '<div><p>Métier : ' . htmlspecialchars($personne['personne']['pers_metier']) . '</p></div>';
            }

            if (!empty($personne['personne']['pers_affectation_complement'])) {
              echo '<div><p>Affecté sur le bateau : <a href="detailsBateau.php?matricule=' . 
                urlencode($personne['personne']['pers_affectation_complement']) . '">' . 
                htmlspecialchars($personne['personne']['pers_affectation_complement']) . '</a> </p> </div>';
            }

            if (!empty($personne['personne']['pers_observation'])) {
              echo '<div><p>Observation : ' . htmlspecialchars($personne['personne']['pers_observation']) . '</p></div>';
            }

          if (!empty($personne['deces'])) {
            echo '<p class="fiche_title"> <strong> Détails du deces : </strong> </p>';
          }

            if (!empty($personne['deces']['deces_date'])) {
              echo '<div><p>Date du deces : ' . htmlspecialchars($personne['deces']['deces_date']) . '</p></div>';
            }

            if (!empty($personne['deces']['deces_lieu'])) {
              echo '<div><p>Lieu du deces : ' . htmlspecialchars($personne['deces']['deces_lieu']) . '</p></div>';
            }

            if (!empty($personne['deces']['sortie_en_mer_matricule'])) {
              echo '<div><p>Sortie en mer de la deco : <a href="detailsSortie.php?matricule=' . urlencode($personne['deces']['sortie_en_mer_matricule']) . '">' . 
                   htmlspecialchars($personne['deces']['sortie_en_mer_matricule']) . '</a> </p></div>';
            }

          if(!empty($personne['deco'])) {
            foreach($personne['deco'] as $deco) {
                
              echo '<p class="fiche_title"> <strong> Détails de la décoration : </strong> </p>';
              
              if (!empty($deco['annee'])) {
                echo '<div><p>Date de la décoration :' . htmlspecialchars($deco['annee']) . '</p></div>';
              }

              if (!empty($deco['deco_description'])) {
                echo '<div><p>Décoration : ' . htmlspecialchars($deco['deco_description']) . '</p></div>';
              }

              if (!empty($deco['sort_mer_matricule'])) {
                echo '<div><p>Sortie en mer de la decoration : <a href="detailsSortie.php?matricule=' . urlencode($deco['sort_mer_matricule']) . '">' . 
                    htmlspecialchars($deco['sort_mer_matricule']) . '</a> </p></div>';
              }
            }          
          }

          if (!empty($personne['etre_sauve'])) {
            echo '<p class="fiche_title"> <strong> Détails de son sauvetage : </strong> </p>';
          }

            if (!empty($personne['etre_sauve']['sort_mer_date_sauvetage'])) {
              echo '<div><p>Date du naufrage :' . htmlspecialchars($personne['etre_sauve']['sort_mer_date_sauvetage']) . '</p></div>';
            }

            if (!empty($personne['etre_sauve']['sort_mer_matricule'])) {
              echo '<div><p>Sortie en mer de la deco : <a href="detailsSortie.php?matricule=' . urlencode($personne['etre_sauve']['sort_mer_matricule']) . '">' . 
                    htmlspecialchars($personne['etre_sauve']['sort_mer_matricule']) . '</a> </p></div>';     
            }
        }
      ?>

      <?php if(!empty($personne['participe_sauvetage'])) : ?>

        <?php echo '<p class="fiche_title"> <strong> Détails de ses participations aux sauvetages : </strong> </p>'; ?>
        
        <table style="width: 100%; margin-top: 1rem;">
          <thead>
            <tr>
              <th style="padding-right: 1rem;">Date du sauvetage</th>
              <th>Identifiant de la sortie en mer</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($personne['participe_sauvetage'] as $resultat): ?>
              <tr>
                <td style="padding-right: 1rem;"><?= htmlspecialchars($resultat['sort_mer_date_sauvetage'] ?? 'x') ?></td>
                <td>
                  <a href="detailsSortie.php?matricule=<?= urlencode($resultat['sort_mer_matricule']) ?>">
                    <?= htmlspecialchars($resultat['sort_mer_matricule']) ?>
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