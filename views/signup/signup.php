<html>
    <head>
        <title>StaJ Signup</title>
        <meta charset="utf-8">
        <link rel="icon" type="image/svg" href="../../img/logo/petit_logo.svg">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="../../assets/vendors/fontawesome/css/all.min.css">
        <link rel="manifest" href="/manifest.json">
    </head>
    <body>
        <header>
            <div class="logo"><a href="../vitrine/page_vitrine.php"><img src="../../img/logo/gros_logo.svg" ></a></div>
        </header>
        <section id="page1" class="container">
            <h1>Créez votre compte pilote dès maintenant</h1>
            <p>Entrez les informations suivantes :</p>
            <form method="post">
            <div class="form-container">
            <div class="form-column">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" />
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" />
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirmez votre mot de passe</label>
                    <input type="password" name="confirm-password" />
                </div>
            </div>
            <div class="form-column">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" />
                </div>

                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" name="prenom" />
                </div>

                <div class="form-group">
                    <label for="centre">Centre</label>
                    <select name="ville">
                        <option value="default" disabled selected>Sélectionnez votre centre</option>
                        <option value="Dijon">Dijon</option>
                        <option value="Nancy">Nancy</option>
                        <option value="Reims">Reims</option>
                        <option value="Strasbourg">Strasbourg</option>
                        <option value="Châteauroux">Châteauroux</option>
                        <option value="Orléans">Orléans</option>
                        <option value="Paris(La Défense - Nanterre)">Paris(La Défense - Nanterre)</option>
                        <option value="Arras">Arras</option>
                        <option value="Caen">Caen</option>
                        <option value="Lille">Lille</option>
                        <option value="Rouen">Rouen</option>
                        <option value="Angoulême">Angoulême</option>
                        <option value="Brest">Brest</option>
                        <option value="La Rochelle">La Rochelle</option>
                        <option value="Le Mans">Le Mans</option>
                        <option value="Nantes">Nantes</option>
                        <option value="Saint-Nazaire">Saint-Nazaire</option>
                        <option value="Aix-en-Provence">Aix-en-Provence</option>
                        <option value="Grenoble">Grenoble</option>
                        <option value="Lyon">Lyon</option>
                        <option value="Nice">Nice</option>
                        <option value="Bordeaux">Bordeaux</option>
                        <option value="Montpellier">Montpellier</option>
                        <option value="Pau">Pau</option>
                        <option value="Toulouse">Toulouse</option>
                    </select>
                </div>
            </div>
            </div>
                <input type="submit" value="Suivant" />

                <p class="message">Déjà inscrit ? <a href="../login/login.php">Se connecter</a></p>
            </form>
        </section>

        <section id="page2" class="container">
            <a href="#" class="return"><i class="fas fa-angle-left"></i></a>
            <h1>Créez votre compte pilote dès maintenant</h1>
            <p>Sélectionnez vos promos :</p>
            <form method="post">
            <div class="form-container">
                <div class="form-column">
                <div class="form-group">
                    <input type="checkbox" id="a2" name="a2" value="a2">
                    <label for="a2">A2</label>
                </div>
                <div class="form-group">
                    <input type="checkbox" id="a3" name="a3" value="a3">
                    <label for="a3">A3</label>
                </div>
                <div class="form-group">
                    <input type="checkbox" id="a4" name="a4" value="a4">
                    <label for="a4">A4</label>
                </div>
                <div class="form-group">
                    <input type="checkbox" id="a5" name="a5" value="a5">
                    <label for="a5">A5</label>
                </div>
            </div>
                <div class="form-column">
                <div class="form-group">
                    <label for="specialite">Spécialité</label>
                    <select name="specialite">
                        <option value="default" disabled selected>Sélectionnez votre spécialité</option>
                        <option value="Info">Info</option>
                        <option value="BTP">BTP</option>
                        <option value="S3E">Nancy</option>
                        <option value="Géné">Reims</option>
                    </select>
                </div>
                </div>
            </div>
                <input type="submit" value="S'inscrire" />
            </form> 
        </section>
        <script src="../../assets/vendors/jquery/jquery-3.6.0.min.js"></script>
        <script src="script.js"></script>
    </body>
</html>



