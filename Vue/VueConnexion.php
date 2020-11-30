<?php
$this->titre = "Connexion";

if (isset($utilisateurConnecte)) {
    $_SESSION['utilisateur'] = $utilisateurConnecte;
    echo '<p style="color:limegreen">Connexion réussie.</br>Bienvenue, <strong>'.$utilisateurConnecte->getPrenom().' '.$utilisateurConnecte->getNom().'</strong> !</p>';
    echo '<p><a href="index.php?action=accueil">Retour à l\'accueil</a></p>';
}
else {
    echo '<h3>'.'S\'identifier'.'</h3>';
    if (isset($msgErreurConnexion)) {
        if ($msgErreurConnexion == 'echecId') {
            echo '<p style="color:red">Login saisi non valide</p>';
        }
        else if ($msgErreurConnexion == 'echecMdp') {
            echo '<p style="color:red">Mot de passe saisi non valide</p>';
        }
    }
    ?>
<form method="post" action="index.php?action=validerConnexion">
    <p>
        Login <input type="text" name="login"/></br>
        Mot de passe <input type="password" name="motdepasse"/></br>
        <input type="submit" value="Connexion"/></p>
    </p>
</form>
<?php
}
?>
