<?php

    ////////////////////////////////////////
    ///////// CREATION DES VIGNETTES ///////
    ////////////////////////////////////////

    session_start();
    include 'fonctionsPanier.php';

    $contenu='<?php

    $nbPanier=compterArticles();

    ?>';

    // On précise que le type d'éléments qui vont etre traités seront des images
    header ("Content-type: image/jpeg");

    //Fontion permettant la redimension d'images
    function redimage($img_src,$img_dest,$dst_w,$dst_h){

        //Lecture des dimensions de l'image
        $size=getImageSize("$img_src");
        $src_w=$size[0];
        $src_h=$size[1];

        //Teste les dimensions tenant dans la zone
        $test_h=round(($dst_w/$src_w)*$src_h);
        $test_w=round(($dst_h/$src_h)*$src_w);

        //Crée une image vierge aux bonne dimensions
        $dst_im=ImageCreateTrueColor($dst_w,$dst_h);

        //Copie dans l'image initiale redimensionné
        $src_im=ImageCreateFromJpeg("$img_src");
        ImageCopyResampled($dst_im,$src_im,0,0,0,0,$dst_w,$dst_h,$src_w,$src_h);

        //Sauvegarde de la nouvelle image
        ImageJpeg($dst_im,$img_dest);

        //Detruis les tampons
        ImageDestroy($dst_im);
        ImageDestroy($src_im);
    }

    //Récupération du fichier JSON contenant nos informations sur le film
    $json = file_get_contents("filmsJSON.json");

    //On décode les données du fichier JSON récupéré
    $data = json_decode($json,true);

    //Pour chaque film on...
    $i=1;
    foreach($data as $film)
    {
        //...redimensionne l'image en agrandie 
        redimage($film['affiche'],$film['affiche'],480,600);

        //...crée le lien de l'image prochainement redimensionné en vignettes
        $fichier='./vignettes/image'.$i.'.jpeg';

        //...redimensionne l'image
        redimage($film['affiche'],$fichier,230,300);

        //.. ouvre (ici on crée) la page php du film
        $monFichier=fopen("pages/".$film['id'].".php","w");

        //...crée le lien vers le panier avec l'id du film en variable globale
        $lien = "../panier.php?add=".$film['id'];

        //...implémente dans la page php les informations suivantes
        fputs($monFichier,
        "<?php 
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
                    <img src=../".$film['affiche'].">
                </div>
                <div class=contenuBox>
                    <h2>".$film['titre']."</h2>
                    <p>Genre : ".$film['genre']."</p>
                    <p>Réalisateur : ".$film['realisateur']."</p>
                    <p>Durée : ".$film['duree']." minutes</p>
                    <p>Prix : ".$film['prix']."€</p>
                    <a class=ajouterPanier href=\"../traitementAjoutPanier.php?var=".$film['id']."\">Ajouter au panier</a>
                </div>
            </div>
        </body>

        <footer>
        <div class='barre'></div>
        <img src='../autresImages/olaf.png' alt='Olaf' />
        <h2>Merci de passer sur le site !</h2>
        <a href='./nous.php'>Notre équipe</a>
        </footer>
        </HTML>"
    );

        //on incrémente
        $i+=1;
    }


    //on remet le type de contenu en html !!!important!!!
    header ("Content-type: text/html");
    ?>

    <HTML>
    <head>
        <meta charset="utf-8">
        <title>Acheter films</title>
        <link rel="stylesheet" href="styleAffichage.css">
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
                            if (isset($_SESSION['login']) && isset($_SESSION['pwd']))
                            {					
                            echo '<a href="./deconnexion.php">Déconnexion</a>';
                            }
                            //sinon le bouton connexion qui lui permettra de se connecter
                            else
                            {
                            echo '<a href="./connexion.html">Connexion</a>';
                            }
                            
                        ?>
                    </div>
                </nav>
        </header>

        <div class="scrat">
            <img src="autresImages/scrat.png" alt="scrat" />
        </div>

        <div class="barre"></div>
                                
        <div class="liere">
            <img src="autresImages/liere.png" alt="liere" />
        </div>

        <div class="ajoutFilm">				
            <?php
                //Si la personne est connecté
                if (isset($_SESSION['login']) && isset($_SESSION['pwd']))
                {
                    //et si les identifiant coorespondent à ceux de l'admin
                    if ($_SESSION['login'] == "admin" && $_SESSION['pwd'] == "admin")
                    {
                        //on fait apparaitre un bouton permettant l'accès back office du site
                        echo '<form action="admin.php" method="post">';
                        echo '<input type="submit" value="Modifier la liste des films">';
                        echo '</form>';
                    }
                }
            ?>
        </div>

    <?php


    //Récupération du fichier JSON contenant nos informations sur le film
    $json = file_get_contents("filmsJSON.json");

    //On décode les données du fichier JSON récupéré
    $data = json_decode($json,true);

    //initialisation de i
    $i=1;

    echo "
    <div class='groupeFilms'>";
    //Pour chaque film
    foreach($data as $film)
    {
        //Initialisation des variables dynamiques
        $lien='pages/'.$film['id'].'.php';
        $fichier='./vignettes/image'.$i.'.jpeg';

        //Affichage des films    
        echo "
        <div class='film'>
            <img src=".$fichier."><BR>
            <a href=".$lien."><h2>".$film['titre']."</h2></a>
            <h3>".$film['prix']."€</h3>
        </div>";
        //on incrémente
        $i+=1;
    }

    echo "</div>";
?>

<div class="sid">
    <img src="autresImages/sid.png" alt="sid" />
</div>

<div class="manfred">
    <img src="autresImages/manfred.png" alt="manfred" />
</div>

</body>
<footer>
	<div class="barre"></div>
	<img src="autresImages/olaf.png" alt="Olaf" />
	<h2>Merci de passer sur le site !</h2>
	<a href="./nous.php">Notre équipe</a>
</footer>
</HTML>