<?php

session_start();

if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {
    if ($_SESSION['login'] == "admin" && $_SESSION['pwd'] == "admin")
    {

        ?>

        <html>
            <head>
                <title>Administration</title>
                <meta charset="utf-8">
                <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
                <link rel="stylesheet" href="styleAdmin.css">
                <script>
                </script>
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
                    <a href=accueil.php><h2>< Retour à l'accueil</h2></a>
                </div>

                <div class=tableau>
                    <table border="1">
                    <tr>
                        <th>id</th>
                        <th>Titre</th>
                        <th>Genre</th>
                        <th>Réalisateur</th>
                        <th>Durée</th>
                        <th>Prix</th>
                        <th>Affiche</th>
                        <th>Supprimer</th>
                    </tr>
                    <?php

                        $json = file_get_contents("filmsJSON.json");

                        $data = json_decode($json,true);

                        foreach($data as $film)
                        {
                            $lien = "traitementAjout.php?del=".$film['id'];
                            echo "
                            <tr>
                                <td>".$film['id']."</td>
                                <td>".$film['titre']."</td>
                                <td class='genre'>".$film['genre']."</td>
                                <td>".$film['realisateur']."</td>
                                <td>".$film['duree']."</td>
                                <td>".$film['prix']."€</td>
                                <td>".$film['affiche']."</td>
                                <td><a href=".$lien."><img src='autresImages/croix.png' alt='croix' /></a></td>
                            </tr>
                            ";
                        }
                    ?>
                    </table>

                </div>

                <div class=bout>
                    <a class='lienAjoutFilm' href='ajoutFilm.php'>Ajouter un Film</a>
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
    else
    {
        echo '<meta http-equiv="refresh" content="0;URL=accueil.php">';	
    }

}
else
{
    echo '<meta http-equiv="refresh" content="0;URL=accueil.php">';	
}


?>

