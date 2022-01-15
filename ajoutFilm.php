<?php

    //démarage de la session : indispensable pour en utiliser les variables
    session_start();

    //si la personne est connecté
    if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) 
    {
        //et si les identifiant coorespondent à ceux de l'admin, affichage de la page
        if ($_SESSION['login'] == "admin" && $_SESSION['pwd'] == "admin")
        {
            ?>

            <html>
            <head>
                <title>Formulaire d'identification</title>
                <meta charset="utf-8">
                <title>Acheter films</title>
                <link rel="stylesheet" href="styleAjout.css">
            </head>

            <body>

                <header>
                    <div class="barre"></div>
                    <div class="overlay"></div>
                        <nav>
                            <a href=accueil.php class=accueil><h2>BOUTIQUE DE FILMS</h2></a>
                        </nav>
                </header>

                <div class="barre"></div>
                
                <div class="retour">
                    <a href=admin.php><h2>< Retour en arrière</h2></a>
                </div>

                <div class="sully">
                    <img src="autresImages/sully.png" alt="sully" />
                </div>
                <div class="formulaire">
                <form enctype="multipart/form-data" method="POST" action="traitementAjout.php" >
                    <h1>Ajouter un film à la liste :</h1>
                    <h2 class="q">Identifiant: </h2><input class="q" type="text" size="25" maxlength="30" name="id" pattern="[^ .]*" required><br />
                    <h2 class="q">Titre: </h2><input class="q" type="text" size="25" maxlength="30" name="titre" required><br />
                    <h2 class="q">Genre: </h2><input class="q" type="text" size="25" maxlength="30" name="genre" required><br />
                    <h2 class="q">Réalisateur: </h2><input class="q" type="text" size="25" maxlength="20" name="realisateur" required><br />
                    <h2 class="t">Durée (minutes): </h2><input class="t" type=number size="1" maxlength="3" name="duree" required><br />
                    <h2 class="t">Prix (€): </h2><input class="t" type=number size="10" maxlength="8" name="prix" required><br />

                    <h2 class="t">Affiche: </h2><input class="t" name="file" type="file" accept= "image/jpeg" required ><br />

                <button class="bouton" type="submit" name="submit"> <h2>Ajouter le film</h2></button><br />

                </form>

                </div>

            </body>

            <footer>
                <div class="barre"></div>
                <img src="autresImages/olaf.png" alt="Olaf" />
                <h2>Merci de passer sur le site !</h2>
                <a href="./nous.php">Notre équipe</a>
            </footer>

            </html>

            <?php  

        }
        //sinon on redirige vers l'accueil
        else
        {
            echo '<meta http-equiv="refresh" content="0;URL=accueil.php">';	
        }

    }
    //sinon on redirige vers l'accueil
    else
    {
        echo '<meta http-equiv="refresh" content="0;URL=accueil.php">';	
    }


?>
