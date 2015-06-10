<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Liste de personnes</title>
</head>
<body>
    <a href="index.php?ctrl=personne&act=add"><h1>Ajouter une personne</h1></a>
    <fieldset>
        <legend>Liste de personnes</legend>
        
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Supprimer</th>
                    <th>Editer</th>
                    <th>Détail</th>
                </tr>
            </thead>
            <tbody>
                
	<?php foreach ($personnes as $personne): ?>
                <tr>
                <td><?= $personne->getPrenom() . '</td><td>' . $personne->getNom() . '' ?></td>
                <td><a href="index.php?ctrl=personne&act=delete&id=<?= $personne->getId() ?>">DELETE</a> </td>
                <td><a href="index.php?ctrl=personne&act=edit&id=<?= $personne->getId() ?>">EDIT</a> </td>
                <td><a href="index.php?ctrl=personne&act=about&id=<?= $personne->getId() ?>">ABOUT</a> </td>
                </tr>
	<?php endforeach; ?>
                
            </tbody>
        </table>
        
    </fieldset>
</body>
</html>