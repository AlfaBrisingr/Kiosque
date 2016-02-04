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
<h1 class="text-justify">
    Bienvenue sur le site d'inscription du Kiosque.
</h1>
<a href="?uc=connexion" class="btn btn-link">Accéder au formulaire d'inscription Jeune Public</a>
<a href="?uc=connexionCL" class="btn btn-link">Accéder au formulaire d'inscription Collège Lycée</a>



<?php
if(isset($_SESSION['error']))
    unset($_SESSION['error']);
if(isset($_SESSION['valid']))
    unset($_SESSION['valid']);
if(Main::connexionExistantePublic())
{
    session_destroy();
}