<?php
$this->titre = 'Adhérent ';
$id = $adherent->getIdentifiant();
echo '<div>';
$cheminImg = $adherent->cheminPhoto();
$nomPrenom = $adherent->getPrenom().' '.$adherent->getNom();
echo '<img style="max-width: 128px; height: auto; " src="'.$cheminImg.'" alt="Photo '.$nomPrenom.'"/></br>';
echo '<strong>'.$nomPrenom.'</strong></br>';
if (!$adherent->getEstActif()) {
    echo '<div style="color:orange">Ancien adhérent</div>';
}

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

$id = $adherent->getIdentifiant();
if ($_SESSION['utilisateur']->getFonctionBureau() == 'Secrétaire' |  $_SESSION['utilisateur']->getFonctionBureau() == 'Secrétaire adjoint') {
    echo ($adherent->getEstActif()) ? '<a href="?action=archiver&id='.$id.'">Archiver ?</a></br>' : '<a href="?action=desarchiver&id='.$id.'">Désarchiver ?</a></br>';
}
