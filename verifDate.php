<?php
	//on lance la session
	session_start();
	//on inclut fonctionsPanier.php
	include 'fonctionsPanier.php';

	//on récupère la date saisie dans le formulaire
	$dateSaisie=$_POST['dateexp'];

	//si la date est supérieur à 3mois
	if ($dateSaisie >= date('Y-m-d', strtotime('+3 month')))
	{
		//on valide la commande en envoyant un mail et on redirige vers l'accueil
		mail($_SESSION['mail'], 'Validation de paiement', "Bonjour ".$_SESSION['prenom'].", votre commande de ".montantGlobal()."euros a bien ete prise en compte. Cordialement");
		echo '<body onLoad="alert(\'Commande effectuée, vérifiez vos mails!\')">';
		echo '<meta http-equiv="refresh" content="0;URL=accueil.php">';
	}
	//sinon
	else
	{
		//alerte + redirection vers la page paiement.php
		echo '<body onLoad="alert(\'La date d expiration doit etre superieure de 3 mois a la date d aujourdhui\')">';
		echo '<meta http-equiv="refresh" content="0;URL=paiement.php">';
	}
?>

