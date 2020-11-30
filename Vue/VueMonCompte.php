<?php
$this->titre = 'Mon compte';
$adherent = $_SESSION['utilisateur'];
$id = $adherent->getIdentifiant();
echo '<div>';
$cheminImg = $adherent->cheminPhoto();
$nomPrenom = $adherent->getPrenom().' '.$adherent->getNom();
echo '<img style="max-width: 128px; height: auto; " src="'.$cheminImg.'" alt="Photo '.$nomPrenom.'"/></br>';
echo '<strong>'.$nomPrenom.'</strong></br>';

echo ($adherent->getFonctionBureau() == 'Aucune') ? '' : $adherent->getFonctionBureau().'</br>';
if ($adherent->getEstCoach()) {
    echo 'Coach</br>';
}
else {
    echo ($adherent->getEstEntraineur()) ? 'Entraîneur</br>' : '';
}
echo ($adherent->getEstRespMateriel()) ? 'Responsable du matériel</br>' : '';
echo ($adherent->getEstRespPlanning()) ? 'Responsable du planning</br>' : '';
echo '</br></div>';
if (isset($msg)) {
    if ($msg == '') {
        echo '<p style="color:limegreen">Mot de passe modifié avec succès !</p>';
    }
    else {
        echo '<p style="color:red">' . $msg . '</p>';
    }
}
echo '<p><strong>Changer mon mot de passe</strong></p>';?>
<form method="post" action="index.php?action=nouveauMdp">
    <p>
Mot de passe actuel <input type="password" name="mdpActuel"/></br>
Nouveau mot de passe <input type="password" name="nvMdp"/></br>
        <input type="submit" value="Valider"/>
    </p>
</form><?php

$id = $adherent->getIdentifiant();

