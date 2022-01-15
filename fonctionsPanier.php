<?php

   //fonction permettant de récupérer le montant total du panier
   function montantTotal()
   {
      //on intialise le montant
      $total=0;
      //pour chaque film du panier
      for($i = 0; $i < count($_SESSION['panier']['id']); $i++)
      {
         //on ajoute au total la quantité de chaque film * son prix
         $total += $_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['prix'][$i];
      }
      //on retourne le montant total
      return $total;
   }

   //fonction permettant de rajouter un film au panier grace à ses parametres
   function ajouterFilm($idFilm,$titreFilm,$quantite,$prixFilm,$genreFilm,$realFilm,$dureeFilm)
   {

      //on cherhce la position de l'article dans le panier
      $positionFilm = array_search($idFilm, $_SESSION['panier']['id']);

      //Si le produit existe déjà 
      if ($positionFilm !== false)
      {
         //on incrémente la quantité
         $_SESSION['panier']['quantite'][$positionFilm] += $quantite ;
      }
      //Sinon on ajoute le produit
      else
      {         
         array_push( $_SESSION['panier']['titre'],$titreFilm);
         array_push( $_SESSION['panier']['quantite'],$quantite);
         array_push( $_SESSION['panier']['prix'],$prixFilm);
         array_push( $_SESSION['panier']['realisateur'],$realFilm);
         array_push( $_SESSION['panier']['genre'],$genreFilm);
         array_push( $_SESSION['panier']['id'],$idFilm);
         array_push( $_SESSION['panier']['duree'],$dureeFilm);
      }
   }

   //fonction permettant de modifier la quantite du film
   function modifierQuantiteFilm($idFilm,$quantite)
   {      
      //Si la quantité est positive
      if ($quantite > 0)
      {
         //Recherche de la position du produit dans le panier
         $positionFilm = array_search($idFilm,  $_SESSION['panier']['id']);
         //on applique la quantité renseigné en parametre
         $_SESSION['panier']['quantite'][$positionFilm] = $quantite;
      }
      //sinon on supprime l'article
      else
      {
         supprimerFilm($idFilm);
      }
   }

   //fonction permettant de compter le nombre d'article dans le panier
   function compterFilms()
   {
      //si le panier existe
      if (isset($_SESSION['panier']))
      {
         //on initialise le nombre d'article
         $nombre=0;
         //pour chaque article du panier
         for($i=0;$i<count($_SESSION['panier']['quantite']);$i++)
         {
            //on ajoute au total la quantité de chaque article 
            $nombre+=$_SESSION['panier']['quantite'][$i];
         }
         return $nombre;
      }
      //sinon on retourne 0
      else
      {
         return 0;
      }
   }

   //fonction permettant la suppression du produit
   function supprimerFilm($idFilm)
   {

      //utilisation d'un panier éphémaire
      $tempo=array();
      $tempo['titre'] = array();
      $tempo['realisateur'] = array();
      $tempo['id'] = array();
      $tempo['duree'] = array();
      $tempo['quantite'] = array();
      $tempo['prix'] = array();
      $tempo['genre'] = array();

      //pour chaque article dans le panier
      for($i = 0; $i < count($_SESSION['panier']['id']); $i++)
      {
         //si l'id de l'article est different de l'id du produit renseigné
         if ($_SESSION['panier']['id'][$i] !== $idFilm)
         {
            //on le met dans le panier éphémaire
            array_push( $tempo['titre'],$_SESSION['panier']['titre'][$i]);
            array_push( $tempo['realisateur'],$_SESSION['panier']['realisateur'][$i]);
            array_push( $tempo['id'],$_SESSION['panier']['id'][$i]);
            array_push( $tempo['genre'],$_SESSION['panier']['genre'][$i]);
            array_push( $tempo['duree'],$_SESSION['panier']['duree'][$i]);
            array_push( $tempo['quantite'],$_SESSION['panier']['quantite'][$i]);
            array_push( $tempo['prix'],$_SESSION['panier']['prix'][$i]);
         }
      }
      //On remplace le panier en session par notre panier temporaire à jour
      $_SESSION['panier'] =  $tempo;
      //On efface notre panier temporaire
      unset($tempo);
   }
?>