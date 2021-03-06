<?php

/**
 * Création, suppression et affichage du cellier.
 *
 * @package  Vino
 * @author   Fatemeh Homatash
 * @version  1.0
 */
class Controleur_Cellier extends Controleur
{
	/**
	 * @var object $modele_bouteille Le modèle Modele_Bouteille.
	 */
	private $modele_bouteille;

	/**
	 * @var object $modele_cellier Le modèle Modele_Cellier.
	 */
	private $modele_cellier;
	
	public function __construct()
	{
		$this->modele_bouteille = $this->modele('Modele_bouteille');
		$this->modele_cellier = $this->modele('Modele_cellier');
		$this->modele_type = $this->modele('Modele_type');
	}

	public function traite(array $params)
	{
		// On vérifie que l’usagé est bien connecté
		if ( ! isset($_SESSION['id_usager']) )
		{
			header('Location: ' . base_url() );
		}
		switch($params['action'])
		{
			case 'index':
				$this->index();
				break;

			case 'voir':
				$this->voir();
				break;

			// Affichage du formulaire
			case 'ajouter-form':
				$this->ajouter_form();
				break;

			// Ajout d’un cellier
			case 'ajouter':
				$this->ajouter();
				break;

			// Suppression de cellier
			case 'supprimer':
				$this->supprimerCellier();
				break;

			// Recherche sur les bouteils existant dans le cellier
			case 'pageRecherche':
				$this->pageRecherche();
				break;

			// Recherche sur les bouteils existant dans le cellier
			case 'recherche':
				$this->recherche();
				break;

			default :
				trigger_error('Action invalide.');
		}
	}

	/**
	 * Fonction qui affiche la liste des celliers d'usager
	 * 
	 */
	public function index()
	{
		$donnees['celliers'] = $this->modele_cellier->obtenir_par_usager($_SESSION['id_usager']);
		$this->afficheVue('modeles/en-tete');
		$this->afficheVue('modeles/menu-usager');
		$this->afficheVue('cellier/liste', $donnees);
		$this->afficheVue('modeles/bas-de-page');
	}

	/**
	 * Fonction qui vérifie si l'usager est conécté et puis il récupére tous les bouteilles qui appartient a un cellier
	 * 
	 */
	public function voir()
	{
		$idCellier = $this->modele_cellier->verif_usager($_GET['id_cellier'],$_SESSION['id_usager']);
		if ($idCellier == null) {
			header('Location: ' . site_url('login&action=logout') );
		}
		$resultat = $this->modele_cellier->obtenir_par_id($_GET['id_cellier']);
		$donnees['bouteilles'] = $this->modele_bouteille->bouteilles_cellier($_GET['id_cellier']);

		// Si il n'y a aucune bouteille dans le cellier, il dirige directement vers le formulaire ajout bouteille
		if ($donnees['bouteilles']==null) {
			$donnees['id_cellier'] = $_GET['id_cellier'];
			$donnees['types'] = $this->modele_type->obtenir_tous();
			$donnees['celliers'] = $this->modele_cellier->obtenir_par_usager($_SESSION['id_usager']);
			// Titre à afficher dans le formulaire
			$donnees['titre'] = 'Ajouter Bouteille';
			// Action du bouton input du formulaire
			$donnees['actionBouton'] = 'ajouter';
			// Value du bouton input du formulaire
			$donnees['titreBouton'] = 'Ajouter la bouteille';
			// Classe du bouton input du formulaire
			$donnees['classeBouton'] = 'mdl-button mdl-js-button mdl-button--raised mdl-button--colored';
			$this->afficheVue('modeles/en-tete');
			$this->afficheVue('modeles/menu-usager');
			$this->afficheVue('bouteille/formulaire', $donnees);
			$this->afficheVue('modeles/bas-de-page');
		}
		// Si il existe déjà des bouteilles dans le cellier, il affiche la liste de tous les bouteilles existant
		else{
			$this->afficheVue('modeles/en-tete');
			$this->afficheVue('modeles/menu-usager');
			$this->afficheVue('cellier/cellier', $donnees);
			$this->afficheVue('modeles/bas-de-page');
		}
	}
	
	/**
	 * Fonction qui affiche le formulaire d'ajout de cellier
	 * 
	 */
	public function ajouter_form()
	{
		$this->afficheVue('modeles/en-tete');
		$this->afficheVue('modeles/menu-usager');
		$this->afficheVue('cellier/ajouter');
		$this->afficheVue('modeles/bas-de-page');
	}

	/**
	 * Fonction qui ajout un cellier pour l'usager
	 * 
	 */	
	public function ajouter()
	{
		$this->modele_cellier->ajouter($_SESSION['id_usager']);
		$donnees['celliers'] = $this->modele_cellier->obtenir_par_usager($_SESSION['id_usager']);
		$this->afficheVue('modeles/en-tete');
		$this->afficheVue('modeles/menu-usager');
		$this->afficheVue('cellier/liste', $donnees);
		$this->afficheVue('modeles/bas-de-page');
	}

	/**
	 * Fonction qui supprime un cellier de l'usager
	 * 
	 */	
	public function supprimerCellier()
	{
		$body = json_decode(file_get_contents('php://input'));
		$this->modele_bouteille->supprimerBouteille($body->id_cellier);
		$this->modele_cellier->supprimerCellier($body->id_cellier);
		echo json_encode(true);
	}	

	/**
	 * Fonction qui prent le id du cellier et affiche les vues relies
	 * 
	 */
	public function pageRecherche()
	{
		$donnees['id-cellier'] = $_GET['id_cellier'];
		$this->afficheVue('modeles/en-tete');
		$this->afficheVue('modeles/menu-usager');
		$this->afficheVue('cellier/recherche', $donnees);
		$this->afficheVue('modeles/bas-de-page');
	}

	public function recherche()
	{
		$body = json_decode(file_get_contents('php://input'));
		$listeBouteilles = $this->modele_bouteille->recherche($body->id_cellier, $body->recherchePar, $body->valeur, $body->operation);
		echo json_encode($listeBouteilles);
	}
}
