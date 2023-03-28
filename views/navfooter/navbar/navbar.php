<?php 
    define('APPLICATION_PATH', $_SERVER['DOCUMENT_ROOT'] . '/projetWeb');
    require APPLICATION_PATH . '/controllers/veriflogin.php';
?>

<html>
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <link rel="icon" type="image/svg" href="http://localhost:3000/projetWeb/img/logo/petit_logo.svg">
      <link rel="stylesheet" href="http://localhost:3000/projetWeb/views/navfooter/navbar/style.css">
      <link rel="stylesheet" href="http://localhost:3000/projetWeb/assets/vendors/fontawesome/css/all.min.css">
      <link rel="manifest" href="http://localhost:3000/projetWeb/manifest.json">
    

    </head>
    <body>
        <header>
            <div class="navbar">
                <div class="logo"><a href="http://localhost:3000/projetWeb/views/afficher_offre/afficher_offre.php"><img alt="notre petit logo" src="http://localhost:3000/projetWeb/img/logo/petit_logo.svg" ></a></div>
                    <div class="leftNav">
                        <a href="http://localhost:3000/projetWeb/views/afficher_offre/afficher_offre.php" class="button"><span class="offres">Offres</span></a>
                        <a href="http://localhost:3000/projetWeb/views/afficher_entreprise/afficher_entreprise.php" class="button"><span class="entreprises">Entreprises</span></a>
                        <a href="http://localhost:3000/projetWeb/views/afficher_humain/afficher_humain.php" class="button"><span class="utilisateurs">Utilisateurs</span></a>
                    </div>
                    <ul class="links">
                        <li><a href="http://localhost:3000/projetWeb/views/comparatif/page_comparatif.php"><i class="fas fa-balance-scale-left"></i></a></li>
                        <li><a href="http://localhost:3000/projetWeb/views/wishlist/wishlist.php"><i class="fas fa-hand-holding-heart"></i></a></li>
                        <?php 
                            $id_user = $_COOKIE['user_id'];
                            echo '<li><a href="http://localhost:3000/projetWeb/views/fiche_humain/fiche_humain.php?id='.$id_user.'php"><i class="fas fa-user"></i></a></li>';
                        ?>
                    </ul> 
                    <div class="toggle_btn">
                        <i class="fa-solid fa-bars"></i>
                    </div>
                    <div class="dropdown_menu">
                        <li><a href="http://localhost:3000/projetWeb/views/comparatif/page_comparatif.php"><i class="fas fa-balance-scale-left"></i></a></li>
                        <li><a href="http://localhost:3000/projetWeb/views/wishlist/wishlist.php"><i class="fas fa-hand-holding-heart"></i></a></li>
                        <?php 
                        $id_user = $_COOKIE['user_id'];
                        echo '<li><a href="http://localhost:3000/projetWeb/views/fiche_humain/fiche_humain.php?id='.$id_user.'php"><i class="fas fa-user"></i></a></li>';
                        ?>
                    </div>
                </div>
            </div>
        </header>
        <script>
            const toggleBtn = document.querySelector('.toggle_btn')
            const toggleBtnIcon = document.querySelector('.toggle_btn i')
            const dropDownMenu = document.querySelector('.dropdown_menu')
            
            toggleBtn.onclick = function(){
                dropDownMenu.classList.toggle('open')
                const isOpen = dropDownMenu.classList.contains('open');
                
                toggleBtnIcon.classList = isOpen
                ? 'fa-solid fa-xmark' 
                : 'fa-solid fa-bars';
            }
        </script>
          <script >
         if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('../../service-worker.js')
      .then((registration) => {
        console.log('Service Worker enregistré avec succès:', registration);
      })
      .catch((error) => {
        console.error('Échec de l\'enregistrement du Service Worker:', error);
      });
    }
    </script>
    </body>
</html>