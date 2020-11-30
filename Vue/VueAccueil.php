<?php
$this->titre = "Accueil";

if (isset($_SESSION['utilisateur'])) {
    echo "<h3><a href=index.php?action=trombi>Trombinoscope</a></h3>";
    echo "<h3><a href=index.php?action=annuaire>Annuaire</a></h3>";
    if ($_SESSION['utilisateur']->getFonctionBureau() == 'Secrétaire' |  $_SESSION['utilisateur']->getFonctionBureau() == 'Secrétaire adjoint') {
        echo "<h3><a href=index.php?action=nouveladherent>Nouvel adhérent</a></h3>";
    }
}
