<?php
	//on inclue le fichier
	include("fonctionsPanier.php");
	//on lance la session
	session_start();
	header ("Content-type: text/html");
?>

<HTML>
	<head>
		<meta charset="utf-8">
		<title>Acheter films</title>
		<link rel="stylesheet" href="styleNous.css">
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
								<img src="autresImages/panier.png" alt="panier"/> <span><?php /*appel de la fonction compterArticles*/ echo compterFilms() ?></span>
							</a>
						</li>
					</ul>
					<div class="bconnex">
					<?php
						//Si la personne est connecté on affiche le bouton déconnexion qui le déconnectera
						if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) 
						{
							echo '<a href="./deconnexion.php">Déconnexion</a>';
						}
						else
						//sinon le bouton connexion qui lui permettra de se connecter
						{
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
		
		<div class="presentation">
			<div class="nathan">
				<img src="autresImages/bob.png" alt="bob" />
				<h2>Nathan Delcambre</h2>
			</div>
			
			<div class="gregory">
				<img src="autresImages/stuart.png" alt="stuart" />
				<h2>Grégory Errecart</h2>
			</div>
			<div class="contacts">
				<h2>Nous contacter :</h2>
				<h3>Adresses mails :</h3>
				<p>ndelcambre@iutbayonne.univ-pau.fr</p>
				<p>gerrecart@iutbayonne.univ-pau.fr</p>
			</div>
		</div>
	</body>

	<footer>
		<div class="barre"></div>
		<img src="autresImages/olaf.png" alt="Olaf" />
		<h2>Merci de passer sur le site !</h2>
		<a href="./nous.php">Notre équipe</a>
	</footer>
</HTML>