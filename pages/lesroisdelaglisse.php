<?php 
        session_start();
        include '../fonctionsPanier.php';
        ?>
        <HTML>
        <head>
        <meta charset='utf-8'>
        <title>Acheter films</title>
        <link rel='stylesheet' href='../stylesPageFilm.css'>
        </head>

        <body>
            <header>
                <div class='barre'></div>
                <div class='overlay'></div>

                    <nav>
                        <a href=../accueil.php class=accueil><h2>BOUTIQUE DE FILMS</h2></a>
                        <ul>
                            <li class='panier'>
                                <a href='../panier.php'>
                                    <img src='../autresImages/panier.png' alt='panier' /><span><?php echo compterFilms();?></span>
                                </a>
                            </li>
                        </ul>

                    </nav>
            </header>
            <div class='retour'>
            <a href=accueil.php><h2>< Retour à l'accueil</h2></a>
            </div>
            <div class=box>
                <div class=imageBox>
                    <img src=../imageSource/roisdelaglisse.jpg>
                </div>
                <div class=contenuBox>
                    <h2>Les Rois de la glisse</h2>
                    <p>Genre : Animation</p>
                    <p>Réalisateur : Ash Brannon, Chris Buck</p>
                    <p>Durée : 85 minutes</p>
                    <p>Prix : 2€</p>
                    <a class=ajouterPanier href="../traitementAjoutPanier.php?var=lesroisdelaglisse">Ajouter au panier</a>
                </div>
            </div>
        </body>

        <footer>
        <div class='barre'></div>
        <img src='../autresImages/olaf.png' alt='Olaf' />
        <h2>Merci de passer sur le site !</h2>
        <a href='./nous.php'>Notre équipe</a>
        </footer>
        </HTML>