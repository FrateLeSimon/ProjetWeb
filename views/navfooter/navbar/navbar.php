<html>
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="http://localhost:3000/projetWeb//views/navfooter/navbar/style.css">
      <link rel="stylesheet" href="http://localhost:3000/projetWeb/assets/vendors/fontawesome/css/all.min.css">
    </head>
    <body>
        <nav class="navbar background">
        <div class="logo"><a href="#"><img src="http://localhost:3000/projetWeb/img/logo/petit_logo.svg" ></a></div>
        <div class="leftNav">
          <!-- the value that search bar will take is text -->
                <a href="http://localhost:3000/projetWeb/views/afficher_offre/afficher_offre.php" class="button"><span class="offres">Offres</span></a>
                <a href="http://localhost:3000/projetWeb/views/afficher_entreprise/afficher_entreprise.php" class="button"><span class="entreprises">Entreprises</span></a>
                <a href="http://localhost:3000/projetWeb/views/afficher_humain/afficher_humain.php" class="button"><span class="utilisateurs">Utilisateurs</span></a>
            </div>
            <!-- we have used list tag that is ul 
                 to list the items-->
            <ul class="nav-list">
                <li><a href="http://localhost:3000/projetWeb/comparatif/page_comparatif.php"><i class="fas fa-balance-scale-left"></i></a></li>
                <li><a href="http://localhost:3000/projetWeb/messagerie/page_messagerie.php"><i class="far fa-comment-alt"></i></a></li>
                <li><a href="http://localhost:3000/projetWeb/wishlist/page_wishlist.php"><i class="fas fa-hand-holding-heart"></i></a></li>
                <li><a href="http://localhost:3000/projetWeb/profil/page_profil.php"><i class="fas fa-user"></i></a></li>
            </ul>
            <!-- we have used rightnav in order to design
                 the seachbar properly by using CSS-->
        </nav>
    </body>
</html>