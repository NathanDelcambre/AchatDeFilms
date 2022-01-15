<?php

    //si le formulaire est bien rempli
    if(isset($_POST['submit'])&&isset($_POST['id'])&&isset($_POST['titre'])&&isset($_POST['genre'])&&isset($_POST['realisateur'])&&isset($_POST['duree'])&&isset($_POST['prix'])){

        //Récupération du fichier JSON contenant nos informations sur le film
        $json = file_get_contents("filmsJSON.json");

        //On décode les données du fichier JSON récupéré
        $json = json_decode($json,true);

        //on initialise une variable existe à false
        $existe=false;

        //pour chaque film
        for($i=0;$i<count($json);$i++)
        {
            //si l'id du film correspond à l'id du film renseigné dans le formulaire
            if ($json[$i]['id']==$_POST['id']) {
                //la variable existe devient true
                $existe=true;
            }    
        }

        //si la variable existe est true
        if ($existe) {
            //alerte + redirection vers l'ajout de film
            echo '<body onLoad="alert(\'L identifiant du film existe deja, veuillez en choisir un autre\')">';
            echo '<meta http-equiv="refresh" content="0;URL=ajoutFilm.php">';
        } 
        //sinon on ajoute le film
        else 
        {              
            //on crée un tableau
            $contenu=array();

            //on remplit le tableau grâce aux infos provenant du formulaire
            $contenu['id'] = $_POST['id'];
            $contenu['titre'] = $_POST['titre'];
            $contenu['genre'] = $_POST['genre'];
            $contenu['realisateur'] = $_POST['realisateur'];
            $contenu['duree'] = $_POST['duree'];
            $contenu['prix'] = $_POST['prix'];
            $contenu['affiche'] = "imageSource/".$_POST['id'].".jpg";

            //on télécharge le film dans le bon dossier 
            move_uploaded_file($_FILES['file']['tmp_name'],$contenu['affiche']);
        
            //on met contenu dans la variable json
            $json[]=$contenu;
            
            $json=json_encode($json);

            file_put_contents('filmsJSON.json',$json);

            //on renvoie vers admin.php
            header('location: admin.php');
        }

    }
    //sinon si la variable globale fait référence à une suppression
    elseif(isset($_GET['del']))
    {
        //on récupère le fichier json
        $contenus = file_get_contents('filmsJSON.json');
        $contenus = json_decode($contenus,true);

        //on crée un tableau
        $verifier=array();

        //pour chaque film
        for($i=0;$i<count($contenus);$i++)
        {
            //si l'id du film ne correspond pas à l'id récupéré dans la variable globale
            if($contenus[$i]['id']!=$_GET['del']){
                //on insère le film dans le nouveau tableau
                $verifier[]=$contenus[$i];
            }
            else
            {
                unlink($contenus[$i]['affiche']);
                unlink($contenus[$i]['id'].".php");
            }
        }

        //puis on l'applique au fichier json
        $verifier = json_encode($verifier);
        file_put_contents('filmsJSON.json',$verifier);

        //on redirige vers admin.php
        header('location: admin.php');
    }

?>