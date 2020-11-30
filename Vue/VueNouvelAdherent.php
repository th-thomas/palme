<?php
$this->titre = "Nouvel adhérent";
?>
<form method="post" action="index.php?action=validernouvadh">
    <p>
        Nom <input type="text" name="nom"/></br>
        Prénom <input type="text" name="prenom"/></br>
        Date de naissance <input type="date" name="datenaissance"/></br>
        Date de fin de validité du certificat médical <input type="date" name="datefincertifmed"/></br>
        <input type="submit" value="Valider"/>
    </p>
</form>

