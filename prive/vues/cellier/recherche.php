	<main class="mdl-layout__content">
		<div class="mdl-layout__tab-panel is-active" id="overview">
			<section class="section--center mdl-grid mdl-grid--no-spacing">				
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
					<button id="recherche" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
					  Rechercher
					</button>
					<div class="mdl-textfield mdl-js-textfield">
						Recherche par  
						<select id="recherchePar">
							<option value='' disabled selected style='display:none;'>-- selectionner --</option>
							<option value='millesime'>millesime</option>
							<option value='nom'>nom</option>
							<option value='pays'>pays</option>
							<option value='prix'>prix</option>	
							<option value='quantite'>quantite</option>							
							<option value='type'>type</option>
						</select>
						<select id="rechercheSpecifique" style='visibility: hidden;'>
							<option value='' disabled selected style='display:none;'>-- selectionner --</option>
							<option value=">=">plus grand ou égale</option>
							<option value="<=">plus petit ou égale</option>
						</select>
					</div>										
					<input class="mdl-textfield__input" type="search" id="btnRecherche" name="valeurRechercher" style="visibility: hidden;"/>	
					<ul class="affichageResultat"></ul>
				</div>
			</section>	
			<section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp"  id="affichageDetails" style='display: none;'>
				<header class="section__play-btn mdl-cell mdl-cell--3-col-desktop mdl-cell--2-col-tablet mdl-cell--4-col-phone mdl-color--teal-100 mdl-color-text--white">
					<div class='img'>
						<?php
							if(isset($bouteille->code_saq)) {
						?>
							<img src='https://s7d9.scene7.com/is/image/SAQ/<?php echo $bouteille->code_saq; ?>_is?$saq-rech-prod-gril$'>
						<?php
							}
							else {
						?>
							<img src='../divers/images/bouteille.jpg'>
						<?php
							}
						?>
					</div>
				</header>
				<div class="mdl-card mdl-cell mdl-cell--9-col-desktop mdl-cell--6-col-tablet mdl-cell--4-col-phone">
					<div class="mdl-card__supporting-text">
						<p id='nom_bouteille'></p>
						<p id='millesime'></p>
						<p id='type'></p>
						<p id='pays'></p>
						<p id='format'></p>
						<p id='quantite'></p>
						<p id='date_achat'></p>
						<p id='boire_avant'></p>
						<p id='prix'></p>
					</div>
				</div>
			</section>		
		</div>
	</main>
