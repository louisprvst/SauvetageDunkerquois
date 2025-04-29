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



        <h1>Recherche de Bateaux</h1>


        <form method="post">
          <label>
            <input type="radio" name="choix" value="Par matricule"> Choix A
          </label>
          <label>
            <input type="radio" name="choix" value="Par nom"> Choix B
          </label>
          <label>
            <input type="radio" name="choix" value="Par type"> Choix C
          </label>
          <label>
            <input type="radio" name="choix" value="Par pays"> Choix C
          </label>
          <label>
            <input type="radio" name="choix" value="Par ville"> Choix C
          </label>
          <br><br>
          <input type="text" name="search" placeholder="Nom du bateau" required>
            <button type="submit">Rechercher</button>
        </form>

          <?php

            require_once __DIR__ . '/class/rechercheBateau.php';

            if (isset($_POST['search'])) {
              $resultats = rechercheGeneral($_POST['search']);

          ?>

            <table>
              <thead>
                <tr>
                  <th>Matricule</th>
                  <th>Nom</th>
                  <th>Type</th>
                  <th>Pays</th>
                  <th>Ville</th>
                  <th>Gabarit</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach ($resultats as $resultat) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($resultat['bat_matricule']) . "</td>";
                    echo "<td>" . htmlspecialchars($resultat['bat_nom']) . "</td>";
                    echo "<td>" . htmlspecialchars($resultat['bat_type']) . "</td>";
                    echo "<td>" . htmlspecialchars($resultat['bat_pays']) . "</td>";
                    echo "<td>" . htmlspecialchars($resultat['bat_ville']) . "</td>";
                    echo "<td>" . htmlspecialchars($resultat['bat_gabarit']) . "</td>";
                    echo "</tr>";
                  }
                }
                ?>
              </tbody>
            </table>




    <?php include './inc/footer.inc.php' ; ?>

  </body>
  
</html>