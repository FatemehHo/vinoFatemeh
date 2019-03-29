<main class="mdl-layout__content">
	<div class="demo-card-wide mdl-card mdl-shadow--2dp">
		<?php 
			if(isset($donnees['bouteille'])){
				$bouteille = $donnees['bouteille'];
			}
			$nom          = isset($bouteille->nom) ? $bouteille->nom : '';
			$quantite     = isset($bouteille->quantite) ? $bouteille->quantite : '';
			$millesime    = isset($bouteille->millesime) ? $bouteille->millesime : '';
			$date_achat   = isset($bouteille->date_achat) ? $bouteille->date_achat : '';
			$boire_avant  = isset($bouteille->boire_avant) ? $bouteille->boire_avant : '';
			$prix         = isset($bouteille->prix) ? $bouteille->prix : '';
			$pays         = isset($bouteille->pays) ? $bouteille->pays : '';
			$format       = isset($bouteille->format) ? $bouteille->format : '';
			$note         = isset($bouteille->note) ? $bouteille->note : '';
			$code_saq     = isset($bouteille->code_saq) ? $bouteille->code_saq : '';
			$id_bouteille = isset($bouteille->id_bouteille) ? $bouteille->id_bouteille : '';
		?>
		<div class="mdl-card__title">	
			<h2 class="mdl-card__title-text"><?php echo $donnees['titre'] ?></h2>		
		</div>
		<div class="mdl-card__supporting-text">
			<div class="mdl-textfield mdl-js-textfield" id="recherche">
				Recherche : <input class="mdl-textfield__input" type="text" name="nom_bouteille">
				<ul class="listeAutoComplete">

				</ul>
			</div>
			<div class="case">
				<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="afficher">
					<input type="checkbox" class="mdl-checkbox__input" name="recherche" id="afficher">
					<span class="mdl-checkbox__label">Faire une recherche dans les bouteilles de la SAQ</span>
				</label>
			</div>
			<form method="POST">
				<div class="mdl-textfield mdl-js-textfield">
					Nom : 
						<input class="mdl-textfield__input" type="text" id="nom_bouteille" name="nom" value="<?php echo $nom ?>" required="required">
				</div>
				<div class="mdl-textfield mdl-js-textfield">
					Millesime :  
						<input class="mdl-textfield__input" type="number" min="1900" max="<?php echo date('Y') ?>" id="millesime" name="millesime" value="<?php echo $millesime ?>" required="required">
				</div>
				<div class="mdl-textfield mdl-js-textfield" id="quantite">
					Quantité : <input class="mdl-textfield__input" type="number" min="0" name="quantite" value="<?php echo $quantite ?>" required="required">
				</div>
				<div class="mdl-textfield mdl-js-textfield" id="date_achat">
					Date d'achat : <input class="mdl-textfield__input" type="date" required="required" name="date_achat" value="<?php echo $date_achat ?>">
				</div>
				<div class="mdl-textfield mdl-js-textfield" id="boire_avant">
					Boire avant : <input class="mdl-textfield__input" type="date" required="required" name="boire_avant" value="<?php echo $boire_avant ?>">
				</div>
				<div class="mdl-textfield mdl-js-textfield">
					Prix :
						<input class="mdl-textfield__input" type="text" id="prix" name="prix" value="<?php echo $prix ?>" required="required">
				</div>
				<div class="mdl-textfield mdl-js-textfield">
					Pays :
						<input class="mdl-textfield__input" type="text" id="pays" name="pays" value="<?php echo $pays ?>" required="required">
				</div>
				<div class="mdl-textfield mdl-js-textfield">
					Format : 
						<input class="mdl-textfield__input" type="text" id="format" name="format" value="<?php echo $format ?>" required="required">
				</div>
				<div class="mdl-textfield mdl-js-textfield">
					Type : <select name="type">
					<?php
						foreach ($donnees['types'] as $unType)
						{
							echo "<option value='" . $unType->id_type . "'>" . $unType->type . "</option>";
						}
					?>
					</select>
				</div>
				<div class="mdl-textfield mdl-js-textfield" id="note">
					Note : <input class="mdl-textfield__input" type="text" size="3" required="required" name="note" value="<?php echo $note ?>" required="required">
				</div>
				<div class="mdl-textfield mdl-js-textfield" id="cellier">
					Cellier : <select name="id_cellier">
					<?php
						foreach ($donnees['celliers'] as $unCellier)
						{
							echo "<option value='" . $unCellier->id_cellier . "'>" . $unCellier->nom . "</option>";
						}
					?>
					</select>
				</div>
				<div>	
					<?php
						if(isset($id_bouteille)) {
					?>
					<input type="hidden" name="id_bouteille" value="<?php echo $id_bouteille ?>">
					<?php
						}
					?>
					<?php
						if(isset($code_saq)) {
					?>
					<input type="hidden" name="code_saq" value="<?php echo $code_saq ?>">
					<?php
						} else {
					?>
					<input type="hidden" name="code_saq" value="">
					<?php
						}
					?>		
					<input type="hidden" name="action" value="<?php echo $donnees['actionBouton'] ?>">
					<input type="submit" value="<?php echo $donnees['titreBouton'] ?>" class="<?php echo $donnees['classeBouton'] ?>">
				</div>
			</form>
	</div>
</main>
