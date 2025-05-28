<?php
session_start();

function enregistrerNavigation() {
    if (!isset($_SESSION['navigation'])) {
        $_SESSION['navigation'] = [];
    }

    $current = $_SERVER['REQUEST_URI'];

    // Si le formulaire de retour est rempli alors je retire la dernière entrée et je redirige 
    if (!empty($_POST['retour'])) {
        array_pop($_SESSION['navigation']);
        header('Location: ' . $_POST['retour']);
        exit;
    }

    if (end($_SESSION['navigation']) !== $current) {
        $_SESSION['navigation'][] = $current;
    }

    // Je verifie aussi si > 1 pour ne pas supprimer l'index sinon impossible de retour
    if (count($_SESSION['navigation']) > 10 && count($_SESSION['navigation']) > 1) {
        array_splice($_SESSION['navigation'], 1, 1);
    }
}

function afficherBoutonRetour() {
    $nav = $_SESSION['navigation'] ?? [];
    $count = count($nav);

    if ($count >= 2) {
        $previous = $nav[$count - 2];

        // J'utilise un form pour ne pas passer mon retour dans l'URL
        echo '<form method="post" style="text-align:center; margin-top:2rem;">';
        echo '<input type="hidden" name="retour" value="' . htmlspecialchars($previous) . '">';
        echo '<button type="submit" class="bluebutton">Retour</button>';
        echo '</form>';
    }
}

function resetNav() {
    if (isset($_SESSION['navigation'])) {
        unset($_SESSION['navigation']);
    }
}