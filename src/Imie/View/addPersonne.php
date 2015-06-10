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
        <form method="post" action="index.php?ctrl=personne&act=<?= isset($_GET['id'])?'update':'insert'?>">
            <fieldset>
                <legend><?= isset($_GET['id'])?'Modification':'Ajout'?> de personnes</legend>
                <input type="hidden" name="id" value="<?= isset($_GET['id'])?$personne->getId():''?>"/>
                <label for="nom">Nom:</label>
                <input type="text" name="nom" value="<?= isset($_GET['id'])?$personne->getNom():''?>"/>
                
                <label for="prenom">Prénom:</label>
                <input type="text" name="prenom" value="<?= isset($_GET['id'])?$personne->getPrenom():''?>"/>
                
                <label for="ville">Ville:</label>
                <input type="text" name="ville" value="<?= isset($_GET['id'])?$personne->getVille():''?>"/>
                
                <label for="dateNaissance">Date de naissance:</label>
                <input type="text" name="dateNaissance" value="<?= isset($_GET['id'])?$personne->getDateNaissanceFR():''?>"/>
                
                <input type="submit" value="Envoyer"/>
            </fieldset>
        </form>
    </body>
</html>
