<!DOCTYPE html>

<html lang="fr-FR">

  <head>
    <title>Historique des naufrages - CMUA</title>
    <link rel="icon" href="https://archives-dunkerque.fr/fileadmin/CMUA/favicon.ico" type="image/vnd.microsoft.icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
    <meta name="robots" content="index,follow" />
    <meta name="twitter:card" content="summary" />
    <meta name="apple-mobile-web-app-capable" content="no" />
    <meta name="google" content="notranslate" />

    <link rel="stylesheet" href="./style/bootstrappackageicon.min.css" media="all" />
    <link rel="stylesheet" href="./style/theme-0d7f9be96d13db32849f66a9659792ed33b451f979e710ffae8742739207bfbd.css" media="all" />
    <link rel="stylesheet" href="./style/owl.carousel.min.css" media="all" />
    <link rel="stylesheet" href="./style/cmua-ea6dae8716f630adaee2fa06efcf31352aea48cd0f3fa32d400c2ae4181a788a.css" media="all"/>
  </head>

  <body>

    <?php include './inc/header.inc.php' ; ?>

    <div id="page-content" class="bp-page-content main-section" role="main">
        <div id="c36555" class="frame frame-size-default frame-default frame-type-header frame-layout-default frame-background-primary frame-no-backgroundimage frame-space-before-none frame-space-after-none">
          <div class="frame-group-container">
            <div class="frame-group-inner">
              <div class="frame-container frame-container-default">
                <div class="frame-inner">
                  <header class="frame-header">
                    <h1 class="element-header">
                      <span>Historique des naufrages</span>
                    </h1>
                  </header>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php
          $matricule = $_POST['bat_matricule'] ?? '';
          $nom = $_POST['bat_nom'] ?? '';
          $type = $_POST['bat_type'] ?? '';
          $pays = $_POST['bat_pays'] ?? '';
          $ville = $_POST['bat_ville'] ?? '';
          $gabarit = $_POST['bat_gabarit'] ?? '';

          require_once __DIR__ . '/class/rechercheBateau.php';
          $resultats = rechercheGeneral($matricule, $nom, $type, $pays, $ville, $gabarit);
        ?>

      <?php include './inc/searchbateau.php' ; ?>

    <?php include './inc/footer.inc.php' ; ?>

  </body>
  
</html>