<?php

namespace Controller;

use Model\PersonneDAO;
use Model\PersonneDTO;
use Model\Config;

class PersonneController extends Controller{

	// Cette action utilise un DAO pour aller chercher toutes les personnes
	// dans le modèle, j'appelle ensuite la vue adaptée.
	public function indexAction(){
		$dao = new PersonneDAO(Config::getPDO());
		$all = $dao->selectAll();

		//include "View/personnes.php";
                
                $this->render('personnes', array(
                    'personnes' => $all
                ));
	}
        
        public function deleteAction(){
            $dao = new PersonneDAO(Config::getPDO());
            $dao->delete($dao->get($_GET['id']));
            header("Location:index.php");
        }
        
        public function addAction() {
            $this->render('addPersonne');
        }
        
        public function insertAction(){
            $personne = new PersonneDTO();
            $personne->hydrate($_POST);
            
            $dao = new PersonneDAO(Config::getPDO());
            $dao->insert($personne);
            
            header('Location:index.php');
        }
        
        public function editAction(){
            $dao = new PersonneDAO(Config::getPDO());
            $perso = $dao->get($_GET['id']);
            
            $this->render('addPersonne', array(
                'personne'=>$perso
            ));
        }
        
        public function updateAction(){
            $id = $_POST['id'];
            
            $personne = new PersonneDTO();
            $personne->hydrate($_POST);
            
            $dao = new PersonneDAO(Config::getPDO());
            $dao->update($personne);
            
            header('Location: index.php');
        }
        
        public function aboutAction(){
            $id = $_GET['id'];
            
            $dao = new PersonneDAO(Config::getPDO());
            $personne = $dao->get($id);
            
            $this->render('aboutPersonne', array(
                'personne'=>$personne
            ));
        }
}