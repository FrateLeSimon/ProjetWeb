<?php require_once '../../controllers/loginController.php'; ?>
<html>
    <head>
        <title>StaJ Login</title>
        <meta charset="utf-8">
        <link rel="icon" type="image/svg" href="../../img/logo/petit_logo.svg">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="../../assets/vendors/fontawesome/css/all.min.css">
    </head>
    <body>
    <header>
            <div class="logo"><a href="../vitrine/page_vitrine.php"><img src="../../img/logo/gros_logo.svg" ></a></div>
        </header>
        <section id="page1" class = "container">
            <h1>Bonjour !</h1>
            <p>Connectez-vous pour accéder à votre compte</p>

            <?php if (isset($error_message) && !empty($error_message)): ?>
            <div class="error-message">
                <p><?php echo $error_message; ?></p>
            </div>
            <?php endif; ?>

            <form method="post">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" required />
                </div>
<label for="password">Mot de Passe</label>
<input type="password" name="password" required />
</div>    <input type="submit" value="Se connecter" />

<p class="message">Pilote et pas encore inscrit ? <a href="../signup/signup.php">Créer un compte</a></p>
</form>
</section>

<script src="script.js"></script>
</body>
</html>