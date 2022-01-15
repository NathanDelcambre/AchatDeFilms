<?php

	//on ouvre la bdd
	$bdd = "ndelcambre_pro";
	$host = "lakartxela.iutbayonne.univ-pau.fr";
	$user = "ndelcambre_pro";
	$pass= "ndelcambre_pro";

	$link=mysqli_connect($host,$user,$pass,$bdd) or die("Impossible de se connecter à la base de données");

	//on récupère le login
	$log = $_POST['login'];	

	//on récupère les information de la personne via son login
	$select = mysqli_query($link, "SELECT * FROM users WHERE login = \"$log\"") or die ("Mort");

	// on teste si nos variables sont définies
	if (isset($_POST['login']) && isset($_POST['pwd']))
	{	
		//pour chaque tuple
		foreach($select as $tuple)
		{	
			//si les informations correspondent
			if (($tuple['login'] == chop($_POST['login']," ")) && ($tuple['pwd'] == chop($_POST['pwd'], " "))) 
			{
				//on démarre la session
				session_start ();
				// on enregistre les paramètres de notre visiteur comme variables de session
				$_SESSION['login'] = $_POST['login'];
				$_SESSION['pwd'] = $_POST['pwd'];
				$_SESSION['mail'] = $tuple['mail'];
				$_SESSION['prenom'] = $tuple['prenom'];
				//si le panier n'existe pas
				if (!isset($_SESSION['panier']))
				{
					//on crée la panier et toutes ses caractéristiques
					$_SESSION['panier']=array();
					$_SESSION['panier']['titre'] = array();
					$_SESSION['panier']['realisateur'] = array();
					$_SESSION['panier']['id'] = array();
					$_SESSION['panier']['duree'] = array();
					$_SESSION['panier']['quantite'] = array();
					$_SESSION['panier']['prix'] = array();
					$_SESSION['panier']['genre'] = array();
				}
				// on redirige notre visiteur vers une page de notre section membre
				header('location: accueil.php');
			}
			
		}
		// alerte + redirection (arrive si infos pas treouvé dans le foreach)
		echo '<body onLoad="alert(\'Une erreur est survenue, le login ou le mot de passe est incorrect\')">';		
		echo '<meta http-equiv="refresh" content="0;URL=connexion.html">';	

	}
	//sinon alerte + redirection vers la page d'accueil
	else
	{
		echo '<body onLoad="alert(\'Pas par ici :) \')">';
		echo '<meta http-equiv="refresh" content="0;URL=accueil.html">';
	}
?>

