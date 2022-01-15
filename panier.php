<?php
   session_start();
   include 'fonctionsPanier.php';
?>

<html>
   <head>
      <title>Formulaire d'identification</title>
      <meta charset="utf-8">
      <title>Acheter films</title>
      <link rel="stylesheet" href="stylePanier.css">
      <script>
      </script>
   </head>

   <body>

      <header>
         <div class="barre"></div>
         <div class="overlay"></div>
         <nav>
            <a href=accueil.php class=accueil><h2>BOUTIQUE DE FILMS</h2></a>                
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
      <div class="barre"></div>
      <div class="retour">
         <a href=accueil.php><h2>< Retour à l'accueil</h2></a>
      </div>

      <div class=titre>
         <h1>PANIER</h1>
      </div>
      
      <?php

         if (isset($_SESSION['login']) && isset($_SESSION['pwd']))
         {
                                     
            //On affiche le tableau
            echo "         
            <div class=tableau>
               <table border='1'>
                  <tr>
                     <th>Titre</th>
                     <th>Genre</th>
                     <th>Réalisateur</th>
                     <th>Durée (mn)</th>
                     <th>Prix</th>
                     <th>Quantité</th>
                     <th>Ajouter</th>
                     <th>Enlever</th>
                  </tr>";      

                  //pour chaque article dans le panier                                 
                  for($i=0;$i<count($_SESSION['panier']['id']);$i++)
                  {
                     //on affiche la suite du panier grâce aux informations contenues dans le panier
                     echo "
                        <tr>
                           <td>".$_SESSION['panier']['titre'][$i]."</td>
                           <td >".$_SESSION['panier']['genre'][$i]."</td>
                           <td>".$_SESSION['panier']['realisateur'][$i]."</td>
                           <td>".$_SESSION['panier']['duree'][$i]."</td>
                           <td>".$_SESSION['panier']['prix'][$i]."€</td>
                           <td>".$_SESSION['panier']['quantite'][$i]."</td>
                           <td>
                              <form action='traitementAjoutPanier.php' method='post'>
                              <input type='hidden' name='film' value=".$_SESSION['panier']['id'][$i].">
                              <input type='submit' value='X' class='boutConnex'>
                              </form>
                           </td>
                           <td>
                              <form action='traitementSuppPanier.php' method='post'>
                              <input type='hidden' name='film' value=".$i.">
                              <input type='submit' value='X' class='boutConnex'>
                              </form>
                           </td>
                        </tr>
                        ";
                     }

                  echo "</table>                        

               </div>
               <h3 class=nb>";
               if (compterFilms()==0) {
                  echo "Panier vide";
               }               
               elseif($_SESSION['login']=="admin" && ($_SESSION['pwd'])=="admin")
               {
                  echo "<h1 class=titre>Paiement innaccessible pour les administrateurs</h1>
                  <div class=espace></div>";
               }       
               else 
               {
                  echo "Nombre Articles : ".compterFilms()."</h3><h3 class=nb>Total : ".montantTotal()."€</h3><a class=fin href='paiement.php'>Paiement</a>";
               }
         }  
         //sinon on affiche une demande de connexion avec un bouton nous permettant d'y accéder
         else
         {
            echo "<h1 class=titre>Veuillez vous connecter :</h1>
            <div class=espace></div>
            <a class=fin href='connexion.html'>Se connecter</a>";
         }
      ?>



   </body>
   <footer>
      <div class="barre"></div>
      <img src="autresImages/olaf.png" alt="Olaf" />
      <h2>Merci de passer sur le site !</h2>
      <a href="./nous.php">Notre équipe</a>
   </footer>
</html>