<main id="login" class="mdl-layout__content">
	<div id="conteneurLogin" class="mdl-layout__tab-panel is-active">
		<?php
			// Si la variable session n'est pas remplie
			if(!isset($_SESSION["UserID"]))
			{
				// var_dump($_SESSION["UserID"]);
		?>
		<div id="formlogin" >
			<h2>Connexion</h2>
			<!-- Formulaire de connexion -->
			<form method="POST" action="index.php?login">
			Nom de l'utilisateur : <input type="text" name="user" value="a@a.aa"/><br><br>
			Mot de passe : <input type="password" name="pass" value="123456"/><br><br>
			<input type="submit" value="Login"/>
		</form>
		<a href="index.php?login&action=formulaire">Créer un compte</a><br>
				
		<?php
			}
			// Si l'usager est déjà connecté
			else
			{
				// // On affiche le message
				// echo "<p>Vous êtes déjà connecté sous le nom " . $_SESSION["UserID"] ."   ". "</p><br>";
				// echo "<a href='?uUsager&action=Logout'>Se déconnecter</a>";
			}
			// On affiche le message
			if($donnees["erreurs"] != "")
			{
				echo "<p class='message'><i class='fas fa-exclamation'></i>" . $donnees["erreurs"] . "</p>";
			}
		?>
		</div>

	</div>
</main>