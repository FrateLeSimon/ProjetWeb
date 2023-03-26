<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!--<link rel="stylesheet" href="style.css">-->
      <link rel="stylesheet" href="../../assets/vendors/fontawesome/css/all.min.css">
      <title>navbar</title>
    </head>
    <body>
        <!-- here in nav tag used two classes 
             that is navbar and background-->
        <!-- each class declared in nav tag will be 
             used to design the form using CSS-->
        <nav class="navbar background">
        <div class="logo"><a href="../../vitrine/page_vitrine.php"><img src="../../../img/logo/petit_logo.svg" ></a></div>
        <div class="leftNav">
          <!-- the value that search bar will take is text -->
                <input type="text" name="search" id="search" />
                <button class="btn btn-sm">Search</button>
            </div>
            <!-- we have used list tag that is ul 
                 to list the items-->
            <ul class="nav-list">
                <li><a href="../../comparatif/page_comparatif.php"><img src="../../../img/navbar/scale-unbalanced-solid.svg" ></a></li>
                <li><a href="../../messagerie/page_messagerie.php"><img src="../../../img/navbar/message-regular.svg" ></a></li>
                <li><a href="../../wishlist/page_wishlist.php"><img src="../../../img/navbar/hand-holding-heart-solid.svg" ></a></li>
                <li><a href="../../profil/page_profil.php"><img src="../../../img/navbar/user-solid.svg" ></a></li>
            </ul>
            <!-- we have used rightnav in order to design
                 the seachbar properly by using CSS-->
        </nav>


        <style>
/* définition des couleurs */
:root {
--primary-color: #D48042;
--secondary-color: #ffffff;
--background-color: #f5f5f5;
}

/* reset des marges et des paddings */

{
margin: 0;
padding: 0;
box-sizing: border-box;
}
/* définition du style pour la nav */
nav.navbar {
display: flex;
align-items: center;
justify-content: space-between;
height: 60px;
padding: 0 20px;
background-color: var(--primary-color);
}

/* définition du style pour le logo */
nav.navbar .logo img {
height: 40px;
}

/* définition du style pour la zone de gauche de la nav */
nav.navbar .leftNav {
display: flex;
align-items: center;
justify-content: center;
margin-right: auto;
}

/* définition du style pour le champ de recherche */
nav.navbar input[type="text"] {
width: 100%;
height: 30px;
border-radius: 15px;
border: none;
padding: 5px 10px;
font-size: 14px;
margin-left: 10px;
margin-right: 10px;
}

/* définition du style pour le bouton de recherche */
nav.navbar .btn {
margin-left: 10px;
background-color: var(--secondary-color);
color: var(--primary-color);
border: none;
border-radius: 15px;
padding: 5px 10px;
cursor: pointer;
font-size: 14px;
}

/* définition du style pour la liste de droite de la nav */
nav.navbar .nav-list {
display: flex;
align-items: center;
justify-content: center;
margin-left: auto;
}

/* définition du style pour chaque élément de la liste */
nav.navbar .nav-list li {
list-style: none;
margin-left: 20px;
}

/* définition du style pour chaque icône de la liste */
nav.navbar .nav-list li img {
height: 25px;
color: var(--secondary-color);
}

/* media queries pour rendre la navbar responsive */
@media screen and (max-width: 600px) {
nav.navbar {
flex-wrap: wrap;
justify-content: center;
}

nav.navbar .logo img {
margin-right: auto;
}

nav.navbar .nav-list {
margin-left: 0;
margin-top: 10px;
}

nav.navbar .leftNav {
margin: 0;
width: 100%;
}

nav.navbar input[type="text"] {
width: 70%;
}

nav.navbar .btn {
margin-left: 0;
}
}

      </style>



    </body>
</html>




