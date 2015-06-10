<?php

namespace Model;

use \DateTime;

class PersonneDTO{
	private $id;
	private $nom;
	private $prenom;
	private $ville;
	private $dateNaissance;

	public function __construct($nom = null, $prenom = null, $ville = null, $dateNaissance = null){
		$this->id = -1;
		$this->setNom($nom);
		$this->setPrenom($prenom);
		$this->setVille($ville);
		$this->setDateNaissance($dateNaissance);
	}

	public function getId(){
		return $this->id;
	}

	public function getNom(){
		return $this->nom;
	}

	public function getPrenom(){
		return $this->prenom;
	}

	public function getVille(){
		return $this->ville;
	}

	public function getDateNaissance(){
		return $this->dateNaissance;
	}

	public function getDateNaissanceSQL(){
		return $this->dateNaissance->format('Y-m-d');
	}
	public function getDateNaissanceFR(){
		return $this->dateNaissance->format('d-m-Y');
	}

	public function setId($id){
		$this->id = $id;

		return $this;
	}

	public function setNom($nom){
		$this->nom = $nom;

		return $this;
	}

	public function setPrenom($prenom){
		$this->prenom = $prenom;

		return $this;
	}

	public function setVille($ville){
		$this->ville = $ville;

		return $this;
	}

	public function setDateNaissance($dateNaissance){
		try{
			$this->dateNaissance = new DateTime($dateNaissance);
		}
		catch(Exception $e){
			$this->dateNaissance = new DateTime();
		}

		return $this;
	}

	public function hydrate($donnees){
		foreach ($donnees as $key => $value){
			// On récupère le nom du setter correspondant à l'attribut.
			$method = 'set'.ucfirst($key);

			// Si le setter correspondant existe.
			if (method_exists($this, $method)) {
				// On appelle le setter.
				$this->$method(htmlentities($value));
			}
		}
	}

	public function getFullName(){
		return $this->getPrenom() . ' ' . $this->getNom();
	}


	public function __toString(){
		return '[nom]: ' . $this->nom 
			. ' - [prenom]: ' . $this->prenom
			. ' - [ville]: ' . $this->ville
			. ' - [date de naissance]: ' . $this->dateNaissance->format('d-m-Y');
	}

}