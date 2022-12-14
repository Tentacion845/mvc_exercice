<!DOCTYPE html>
<html lang="fr">

<?php include "Views/Layout/metaHeader.php" ?>

<body>
    <br />

    <?php include "Views/Layout/header.php" ?>
    <section class="section-authentification">
        <h1>
            <?php echo $params['connected'] === true ? "Connecté" : "Pas connecté" ?>
        </h1>

        <span style="color:red"><?= $_FORMERROR["err"]["form"] ?? '' ?></span>

        <form action="index.php?action=login" method="POST" class="form">
            <div class="form__group">
                <input type="email" class="form__input" required placeholder="E-mail" id="email" name="email" />
                <span style="color:red"><?= $_FORMERROR["err"]["email"] ?? '' ?></span>

            </div>

            <div class="form__group u-margin-bottom-big">
                <input type="password" class="form__input" required placeholder="Mot de Passe" id="password" maxlength="16" minlength="6" name="password" />
            </div>

            <div class="form__group">
                <div class="u-center-text u-margin-bottom-big">
                    <button class="btn" type="submit">Se connecter</button>
                </div>
            </div>
        </form>
        <div class="u-center-text u-margin-bottom-big">
            <a href="inscription.php" class="btn">Créer un compte gratuitement</a>
        </div>

        <div class="u-center-text">
            <a href="resetpassword.php" class="btn">Mot de passe oublié</a>
        </div>
    </section>

    <?php include "Views/Layout/footer.php"; ?>

</body>

</html>