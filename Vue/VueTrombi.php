<?php 
$this->titre = 'Trombi';
foreach ($adherents as $adherent) {
    $id = $adherent->getIdentifiant(); 
    echo '<div><a href="?action=adherent&id='.$id.'">';
    $cheminImg = $adherent->cheminPhoto();
    $nomPrenom = $adherent->getPrenom().' '.$adherent->getNom();
    echo '<img style="max-width: 128px; height: auto; " src="'.$cheminImg.'" alt="Photo '.$nomPrenom.'"/></br>';
    echo '<strong>'.$nomPrenom.'</strong></a></br>';
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
}