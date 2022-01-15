<?php
    session_start();
    include 'fonctionsPanier.php';

    //on récupère l'id et la quantité(-1) de l'article et on modifie sa quantité en conséquence         
    $identifiant = $_SESSION['panier']['id'][$_POST['film']];
    $quantite = ($_SESSION['panier']['quantite'][$_POST['film']])-1;               
    modifierQuantiteFilm($identifiant,$quantite);

    header('location:panier.php');

?>