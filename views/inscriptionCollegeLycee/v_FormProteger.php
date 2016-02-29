<div class="row">
    <fieldset>
        <legend class="text-justify">Ce site est protégé par mot de passe,
            si vous n'avez pas de mot de passe, contacter le Kiosque par mail
            v.martin@kiosque-mayenne.org ou par tél 02 43 30 10 16</legend>
    </fieldset>
    <!-- Alerte valid -->
    <?php if(isset($_SESSION['valid'])) { ?>
        <div class="alert alert-success" role="alert">
            <?= $_SESSION['valid'] ?>
        </div>
    <?php } ?>
    <!-- Alerte error -->
    <?php if(isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger" role="alert">
            <?= $_SESSION['error'] ?>
        </div>
    <?php } ?>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-centered">
        <form action="?uc=connexionCL&action=login" method="POST" autocomplete="off">
            <div class="form-group">
                <label for="login">Nom d'utilisateur</label>
                <input class="form-control" required="" type="text" name="login" id="login" placeholder="Nom d'utilisateur">
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input class="form-control" required="" type="password" name="password" id="password" placeholder="Mot de passe">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="S'identifier">
                <input type="reset" class="btn btn-default">
            </div>
        </form>
    </div>
</div>
<script src="js/focus.js" type="text/javascript"></script>
<?php
if(isset($_SESSION['error']))
    unset($_SESSION['error']);
if(isset($_SESSION['valid']))
    unset($_SESSION['valid']);