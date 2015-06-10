<?php

namespace Model;

use \DateTime;

class PersonneDAO{

	private $connection;

	public function __construct($connection){
		$this->connection = $connection;
	}

	public function insert(PersonneDTO $p){
		$pdo = $this->connection;
		if($pdo !== null){
			try{
				$rqt = 'INSERT INTO personne(nom, prenom, ville, date_naissance)'
				 		. ' VALUES(?,?,?,?);';

				$stmt = $pdo->prepare($rqt);

				$stmt->bindValue(1, $p->getNom());
				$stmt->bindValue(2, $p->getPrenom());
				$stmt->bindValue(3, $p->getVille());
				$stmt->bindValue(4, $p->getDateNaissanceSQL());

				$stmt->execute();

				$p->setId($pdo->lastInsertId());
			}
			catch(PDOException $e){
				echo "Erreur dans la requête : " . $e->getMessage();
			}
		}
	}

	public function update(PersonneDTO $p){
		$pdo = $this->connection;
		if($pdo !== null){
			try{
				$rqt = "UPDATE personne SET nom = ?, prenom = ?, ville = ?, date_naissance = ? WHERE personne_id = ?;";

				$stmt = $pdo->prepare($rqt);

				$stmt->bindValue(1, $p->getNom());
				$stmt->bindValue(2, $p->getPrenom());
				$stmt->bindValue(3, $p->getVille());
				$stmt->bindValue(4, $p->getDateNaissanceSQL());
				$stmt->bindValue(5, $p->getId());

				$stmt->execute();

			}
			catch(PDOException $e){
				echo "Erreur dans la requête : " . $e->getMessage();die();
			}
		}
	}

	public function delete(PersonneDTO $p){
		$pdo = $this->connection;
		if($pdo !== null){
			try{
				$rqt = "DELETE FROM personne WHERE personne_id = ?;";

				$stmt = $pdo->prepare($rqt);

				$stmt->bindValue(1, $p->getId());

				$stmt->execute();

			}
			catch(PDOException $e){
				echo "Erreur dans la requête : " . $e->getMessage();die();
			}
		}
	}

	public function get($id){
		$p = null;

		$id = intval($id);
		$pdo = $this->connection;
		if($pdo !== null){
			try{
				$rqt = "SELECT nom, prenom, ville, date_naissance FROM personne WHERE personne_id = ?;";

				$stmt = $pdo->prepare($rqt);

				$stmt->bindValue(1, $id);

				$stmt->execute();

				// Il y a au maximum un résultat donc pas besoin d'un while.
				$row = $stmt->fetch();

				// Si on a un résultat, on instancie une instance de PersonneDTO et on l'hydrate
				// pour le renvoyer.
				// $row sera faux si il n'y a plus ou aucun résultat au fetch()
				if($row){
					$p = new PersonneDTO();
					$p->setNom($row['nom'])
						->setPrenom($row['prenom'])
						->setVille($row['ville'])
						->setDateNaissance($row['date_naissance'])
						->setId($id);
				}

				$stmt->closeCursor(); // Fermeture de la requête pour libérer de la mémoire

			}
			catch(PDOException $e){
				echo "Erreur dans la requête : " . $e->getMessage();die();
			}
		}

		return $p;
	}

	public function selectAll(){
		// Tableau de toutes les personnes (tableau de PersonneDTO)
		$all = [];

		$pdo = $this->connection;
		if($pdo !== null){
			try{
				$rqt = "SELECT personne_id, nom, prenom, ville, date_naissance FROM personne ORDER BY nom, prenom;";

				$stmt = $pdo->prepare($rqt);

				$stmt->execute();

				$rows = $stmt->fetchAll();

				foreach($rows as $row){
					$p = new PersonneDTO();
					$p->setNom($row['nom'])
						->setPrenom($row['prenom'])
						->setVille($row['ville'])
						->setDateNaissance($row['date_naissance'])
						->setId($row['personne_id']);
					$all[] = $p;
				}

				$stmt->closeCursor();

				// Exemple avec le fetch() tout cours
				// while($row = $stmt->fetch()){
					// $p = new PersonneDTO();
					// $p->setNom($row['nom'])
					// 	->setPrenom($row['prenom'])
					// 	->setVille($row['ville'])
					// 	->setDateNaissance($row['date_naissance'])
					// 	->setId($id);
					// $all[] = $p;
				// }

			}
			catch(PDOException $e){
				echo "Erreur dans la requête : " . $e->getMessage();die();
			}
		}

		return $all;
	}

	public function select(PersonneDTO $p){
		// Tableau des personnes ressemblant à celle passée en paramètre
		// Par ex: Si la personne passée en paramètre est de Nantes, je veux
		// récupérer toutes celles de Nantes.
		$like = [];
		$operator = "";

		$pdo = $this->connection;
		if($pdo !== null){
			try{
				$rqt = "SELECT personne_id, nom, prenom, ville, date_naissance FROM personne ";

				if($p->getId() !== null 
					|| $p->getNom()!== null
					|| $p->getPrenom() !== null
					|| $p->getDateNaissance() !== null){

					$rqt .= "WHERE ";

					$methods = ['getID' => 'personne_id',
							 'getNom' => 'nom',
							 'getPrenom' => 'prenom',
							  'getVille' => 'ville',
							   'getDateNaissanceFR' => 'date_naissance'];
					$today = new DateTime();
					$params = [];

					foreach($methods as $method => $champ){
						if($p->$method() !== null && $p->$method() !== -1 && $p->$method() !== $today->format('d-m-Y')){
							$rqt .= $operator . "$champ = ? ";
							$operator = " AND ";
							$params[] = $method;
						}
					}

					$stmt = $pdo->prepare($rqt);

					for($ii = 0; $ii < count($params); $ii++){
						$stmt->bindValue($ii+1, $p->$params[$ii]());
					}

					$stmt->execute();

					$rows = $stmt->fetchAll();

					foreach ($rows as $row) {
						$p = new PersonneDTO();
						$p->setNom($row['nom'])
							->setPrenom($row['prenom'])
							->setVille($row['ville'])
							->setDateNaissance($row['date_naissance'])
							->setId($row['personne_id']);
						$like[] = $p;
					}

				}
				

			}
			catch(PDOException $e){
				echo "Erreur dans la requête : " . $e->getMessage();die();
			}
		}


		return $like;
	}

	public function close(){
		$this->connection = null;
	}


}