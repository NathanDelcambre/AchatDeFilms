<?php
    session_start();
    include 'fonctionsPanier.php';

    //Récupération du fichier JSON contenant nos informations sur le film
    $json = file_get_contents("filmsJSON.json");

    //On décode les données du fichier JSON récupéré
    $data = json_decode($json,true);

    if (isset($_GET['var']))
    {
        foreach($data as $film)
        {
            //si l'id du film correspond à l'id du film récupéré
            if($film['id']==$_GET['var'])
            {
                //on ajoute l'article au panier
                ajouterFilm($film['id'],$film['titre'],1,$film['prix'],$film['genre'],$film['realisateur'],$film['duree']);
            }
        }
        header("location:pages/".$_GET['var'].".php");
    } 
    else 
    {
        foreach($data as $film)
        {
        //si l'id du film correspond à l'id du film récupéré
        if($film['id']==$_POST['film'])
        {
            //on ajoute l'article au panier
            ajouterFilm($film['id'],$film['titre'],1,$film['prix'],$film['genre'],$film['realisateur'],$film['duree']);
        }
    }
        header('location:panier.php');
    }
    

    
?>
    