<?php
/**
 * Class Controler
 * Gère les requêtes HTTP
 * 
 * @author Jonathan Martel
 * @author Alexandre Pachot
 * @version 1.0
 * @update 2019-03-10
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */

class Controler 
{
	/**
	 * Traite la requête
	 * @return void
	*/
	public function gerer()
	{
		switch ($_REQUEST['requete'])
		{
			case 'listeBouteille':
				$this->listeBouteille();
				break;
			case 'autocompleteBouteille':
				$this->autocompleteBouteille();
				break;
			case 'ajouterBouteilleSaq':
				$this->ajouterBouteilleSaq();
				break;
			case 'ajouterNouvelleBouteilleCellier':
				$this->ajouterNouvelleBouteilleCellier();
				break;
			case 'ajouterBouteilleCellier':
				$this->ajouterBouteilleCellier();
				break;
			case 'listesCelliers':
				$this->listesCelliers();
				break;
			case 'boireBouteilleCellier':
				$this->boireBouteilleCellier();
				break;
			case 'modifierBouteille':
				$this->modifierBouteille();
				break;
			case 'modifier':
				$this->modifierUneBouteille();
				break;
			default:
				$this->accueil();
				break;
		}
	}

	private function accueil()
	{
		$bouteille_cellier = new Bouteille();
		$donnees = $bouteille_cellier->obtenir_liste_bouteilles_cellier(1);
		include("vues/entete.php");
		include("vues/cellier.php");
		include("vues/pied.php");
	}

	private function listeBouteille()
	{
		$bte = new Bouteille();
		$cellier = $bte->getListeBouteilleCellier();
		echo json_encode($cellier);
	}
	
	private function autocompleteBouteille()
	{
		$bte = new Bouteille();
		$body = json_decode(file_get_contents('php://input'));
		$listeBouteille = $bte->autocomplete($body->nom);
		echo json_encode($listeBouteille);
	}

	private function ajouterNouvelleBouteilleCellier()
	{
		$body = json_decode(file_get_contents('php://input'));
		if(!empty($body)){
			$bte = new Bouteille();
			$resultat = $bte->ajouterBouteilleCellier($body);
			echo json_encode($resultat);
		}
		else{
			include("vues/entete.php");
			include("vues/ajouter.php");
			include("vues/pied.php");
		}
	}
	
	private function boireBouteilleCellier()
	{
		$body = json_decode(file_get_contents('php://input'));		
		$bte = new Bouteille();
		$resultat = $bte->modifierQuantiteBouteilleCellier($body->id, -1);
		$resultat = $bte->recupererQuantiteBouteilleCellier($body->id);
		echo json_encode($resultat);
	}

	private function ajouterBouteilleCellier()
	{
		$body = json_decode(file_get_contents('php://input'));		
		$bte = new Bouteille();
		$resultat = $bte->modifierQuantiteBouteilleCellier($body->id, 1);
		$resultat = $bte->recupererQuantiteBouteilleCellier($body->id);
		echo json_encode($resultat);
	}

	private function modifierBouteille()
	{
		$bte = new Bouteille();
		$data = $bte->getBouteilleParId($_GET["id"]);
		$type = $bte->listeType();
		include("vues/entete.php");
		include("vues/modifier.php");
		include("vues/pied.php");
	}

	private function modifierUneBouteille()
	{
		$bte = new Bouteille();
		$data = $bte->modifierBouteille();
		$this->accueil();
	}

	private function ajouterBouteilleSaq()
	{
		$bte = new SAQ();
		// Faire appelle à get produit pour les insérer dans la base de données
		$bte->getProduits();
		$data = $bte->obtenirBouteillesSaq();
		include("vues/entete.php");
		include("vues/bouteilleSaq.php");
		include("vues/pied.php");
	}

	private function listesCelliers()
	{
		$celliers = new Celliers();
		// Faire appelle à recupereToutCellier pour récupérer tous les celliers existants par l’usager qui est connecte 
		$data = $celliers->recupereCelliers(1);
		include("vues/entete.php");
		include("vues/listesCelliers.php");
		include("vues/pied.php");
	}
}