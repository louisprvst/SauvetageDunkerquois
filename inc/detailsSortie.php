<?php
    require_once __DIR__ . '/../class/rechercheSortie.php';

    $matricule = $_GET['matricule'] ?? '';
    $pers_matricule = $_GET['persmatricule'] ?? '';

    $sortie = rechercheGeneral($matricule);
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
                            <h1 class="element-header"> Sortie du 
                                <?= htmlspecialchars($sortie['sortie']['sort_mer_date_sauvetage'])?>
                            </h1>
                        </header>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bluecase">

      <h2 style="text-align: center;"> <strong> Fiche Sortie en mer <?= htmlspecialchars($sortie['sortie']['sort_mer_matricule'])?> </strong> </h2>

      <?php
        if ($sortie['sortie']) {

            if (!empty($sortie['sortie']['sort_mer_sauvetage_equipage'])) {
                echo '<div><p>Tout l\'équipage a été sauvé.</p></div>';
            }

            if (!empty($sortie['sortie']['sort_mer_sauvetage_nb_homme'])) {
                echo '<div><p>Personnes sauvées : ' . htmlspecialchars($sortie['sortie']['sort_mer_sauvetage_nb_homme']) . '</p></div>';
            }
            
            echo '<div><p>Personnes disparus : ' . htmlspecialchars($sortie['sortie']['sort_mer_nb_perte']) . '</p></div>';

            if (!empty($sortie['sortie']['sort_mer_duree'])) {
                echo '<div><p>Duree de la sortie (minutes) : ' . htmlspecialchars($sortie['sortie']['sort_mer_duree']) . '</p></div>';
            }

            if (!empty($sortie['sortie']['sort_mer_observation']) && $sortie['sortie']['sort_mer_observation'] != 'NULL') {
                echo '<div><p>Observation : ' . htmlspecialchars($sortie['sortie']['sort_mer_observation']) . '</p></div>';
            }
        }
      ?>

    <?php if(!empty($sortie['participe'])) : ?>
        <p> <strong> Personnes ayant participé au sauvetage : </strong> </p>
        <ul>
            <?php foreach ($sortie['participe'] as $resultat): ?>
                <li>
                    <a href="detailsPersonne.php?matricule=<?= urlencode($resultat['pers_matricule']) ?>">
                        <?= htmlspecialchars($resultat['pers_matricule']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
      
      <div style="text-align:center; margin-top:2rem;">
        <a href="detailsPersonne.php?matricule=<?= urlencode($pers_matricule)?>" class="bluebutton">Retour à la personne</a>
      </div>

    </div>

  <?php include 'footer.inc.php' ; ?>

</body>

</html>