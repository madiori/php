<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <fieldset>
                <legend>Détails</legend>
                <label><?= $personne->getId()?></label>
                <label><?= $personne->getNom()?></label>
                <label><?= $personne->getPrenom()?></label>
                <label><?= $personne->getVille()?></label>
                <label><?= $personne->getDateNaissanceFR()?></label>
                
                <a href="index.php">retour à l'accueil</a>
            </fieldset>
    </body>
</html>
