<?php

	//si la variable nom du formulaire est défini(permet de refuser l'acces d'une personne ne venant pas de inscription.php)
	if(isset($_POST['nom']))
	{
		//Initialisation des variables récupérés depuis le formulaire
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$mail = $_POST['mail'];
		$login = $_POST['login'];
		$pwd = $_POST['pwd'];

		//identifiants de la bdd
		$bdd = "ndelcambre_pro";
		$host = "lakartxela.iutbayonne.univ-pau.fr";
		$user = "ndelcambre_pro";
		$pass= "ndelcambre_pro";

		//connexion à la bdd
		$link=mysqli_connect($host,$user,$pass,$bdd) or die("Impossible de se connecter à la base de données");

		//variable pour vérifier après si le login existe deja
		$verifLogin = mysqli_query($link, "SELECT login FROM users WHERE login = \"$login\"") or die ("Mort");

		//pareil pour le mail
		$verifMail = mysqli_query($link, "SELECT mail FROM users WHERE mail = \"$mail\"") or die ("Mort");

		//si le login existe deja
		if(mysqli_num_rows($verifLogin))
		{
			//alerte + redirection vers l'inscription
			echo '<body onLoad="alert(\'Ce nom d utilisateur existe déjà\')">';
			echo '<meta http-equiv="refresh" content="0;URL=inscription.php">';
		}
		//si le mail existe deja
		elseif(mysqli_num_rows($verifMail)) 
		{
			//alerte + redirection vers l'inscription
			echo '<body onLoad="alert(\'Cette adresse mail est deja associee a un compte\')">';
			echo '<meta http-equiv="refresh" content="0;URL=inscription.php">';
		}
		//sinon on insert les infos de la personne dans la bdd
		else
		{
			$link->query("INSERT INTO users VALUES ('$nom', '$prenom', '$mail', '$login','$pwd')");
			header('location: connexion.html');
		}

		//fermeture de la bdd
		mysqli_close($link);

	}
	//sinon on redirige vers l'accueil
	else
	{
		echo '<meta http-equiv="refresh" content="0;URL=accueil.php">';
	}

?>