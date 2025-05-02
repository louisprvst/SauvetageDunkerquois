<div style="background-color: #bbc0f0; border-radius: 16px; padding: 2rem; margin: 2rem auto; display: table; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">

          <h2 style="text-align: center;">Recherche de Bateaux</h2>

          <form method="post">
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
                  <td><input type="text" name="bat_matricule" value="<?= htmlspecialchars($matricule) ?>"></td>
                  <td><input type="text" name="bat_nom" value="<?= htmlspecialchars($nom) ?>"></td>
                  <td><input type="text" name="bat_type" value="<?= htmlspecialchars($type) ?>"></td>
                  <td><input type="text" name="bat_pays" value="<?= htmlspecialchars($pays) ?>"></td>
                  <td><input type="text" name="bat_ville" value="<?= htmlspecialchars($ville) ?>"></td>
                  <td><input type="text" name="bat_gabarit" value="<?= htmlspecialchars($gabarit) ?>"></td>
                  <td><button type="submit">Rechercher</button></td>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($resultats)) : ?>
                  <?php foreach ($resultats as $resultat): ?>
                    <tr>
                      <td><?= htmlspecialchars($resultat['bat_matricule']) ?></td>
                      <td><?= htmlspecialchars($resultat['bat_nom']) ?></td>
                      <td><?= htmlspecialchars($resultat['bat_type']) ?></td>
                      <td><?= htmlspecialchars($resultat['bat_pays']) ?></td>
                      <td><?= htmlspecialchars($resultat['bat_ville']) ?></td>
                      <td><?= htmlspecialchars($resultat['bat_gabarit']) ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </form>
        </div>