<?php
	session_start();
	include 'fonctionsPanier.php';
	header ("Content-type: text/html");
?>

<HTML>
	<head>
		<meta charset="utf-8">
		<title>Acheter films</title>
		<link rel="stylesheet" href="stylePaiement.css">
	</head>

	<body>
		<header>
			<div class="barre"></div>
			<div class="overlay"></div>
				<nav>
					<a href=accueil.php class=accueil><h2>BOUTIQUE DE FILMS</h2></a>
					<ul>
						<li class="panier">
							<a href="panier.php">
							<img src="autresImages/panier.png" alt="panier"/> <span><?php echo compterFilms() ?></span>
							</a>
						</li>
					</ul>
					<div class="bconnex">
					<?php
						//Si la personne est connecté on affiche le bouton déconnexion qui le déconnectera
						if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {
							echo '<a href="./deconnexion.php">Déconnexion</a>';
						}
						//sinon le bouton connexion qui lui permettra de se connecter
						else{
							echo '<a href="./connexion.html">Connexion</a>';
						}
					?>
					</div>
				</nav>
		</header>

		<div class="barre"></div>
		
		<div class="retour">
			<a href=accueil.php><h2>< Retour à l'accueil</h2></a>
		</div>

		<div class="montant">
			<h2>Montant à régler : <?php echo montantTotal();?> €</h2>
			<img src="autresImages/bulle.png" alt="bulle" />
		</div>

		<div class="faucon">
			<img src="autresImages/faucon.png" alt="faucon" />
		</div>
		
		<div class="storm">
			<img src="autresImages/storm.png" alt="storm" />
		</div>
		<div class='formulaire'>
			<form action="verifDate.php" method="post">
				<img src="autresImages/logoBanque.png" alt="logopaiement" />
				<h1>Veuillez saisir vos informations bancaires :</h1>
				<h3 class=texte>Nom du propriétaire :</h3><input type="text" name="proprio" size=30 required>
				<h3 class=texte>N° de carte bancaire :</h3><input type="text" name="numcarte" size=30 pattern="^0[0-9]{14}0$|^1[0-9]{14}1$|^2[0-9]{14}2$|^3[0-9]{14}3$|^4[0-9]{14}4$|^5[0-9]{14}5$|^6[0-9]{14}6$|^7[0-9]{14}7$|^8[0-9]{14}8$|^9[0-9]{14}9$" required>
				<h3 >Date d'expiration :</h3><input class="dateTexte" type=date name="dateexp" size=15>
				<h3 class="cvv">CVV :</h3><input type="text" name="cvv" size=1 maxlength="3" class="cvv" pattern="[0-9]{3}" required>
				<input class="valid" type="submit" value="Valider" class='boutValider'>
			</form>
		</div>



	</body>
	<footer>
		<div class="barre"></div>
		<img src="autresImages/olaf.png" alt="Olaf" />
		<h2>Merci de passer sur le site !</h2>
		<a href="./nous.php">Notre équipe</a>
	</footer>
</HTML>