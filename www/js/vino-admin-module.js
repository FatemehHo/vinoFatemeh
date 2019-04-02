/**
 * @file Module VinoAdmin
 * @author Alexandre Pachot
 * @version 0.1
 */
var vinoAdmin = (function(){

	'use strict';


	/**
	 * Le module vinoAdmin gère les fonctions de la page d’administration.
	 * @exports vinoAdmin
	 */
	var obj = {};


	/**
	 * Démarre l’importation des bouteilles de vin de la SAQ.
	 */
	obj.importer = function() {
		window.location = 'index.php?importation&action=importer';
		// let requete = new Request('index.php?importation&action=importer');
		// fetch(requete)
		// .then(response => {
		// 	if (response.status === 200) {
		// 		return response.text();
		// 	} else {
		// 		throw new Error('Erreur');
		// 	}
		// })
		// .then(response => {
		// 	console.log(response);
		// }).catch(error => {
		// 	console.error(error);
		// });
	}

	return obj;

})();