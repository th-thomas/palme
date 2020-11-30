<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title><?= $titre ?></title>
</head>
<body>
<div id="global">
    <header>
        <a href="index.php"><h1 id="titreSite">Lyon Palme</h1></a>
        <?php
        if (isset($_SESSION['utilisateur'])) {
            echo  '<p style="color:limegreen">Connecté en tant que ' . $_SESSION['utilisateur']->getPrenom() . ' ' . $_SESSION['utilisateur']->getNom() . '. <a href=index.php?action=monCompte>Voir mon compte</a>. <a href=index.php?action=deconnexion>Déconnexion</a></p>';
        }
        else {
            echo '<p style="color:grey">Vous n\'êtes pas connecté. <a href=index.php?action=connexion>Connexion</a></p>';
        }
        ?>
    </header>
    <div id="contenu">
        <?= '<h2>'.$titre.'</h2>'. $contenu ?>
    </div> <!-- #contenu -->
    <footer id="piedSite">
        &copy; <?= date("Y"); ?> Lyon Palme
    </footer>
</div> <!-- #global -->
</body>
</html>