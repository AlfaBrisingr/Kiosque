<div class="container">
	<div class="row">
		<div class="jumbotron">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h2>Bienvenue sur l'espace d'administration : <?= ucfirst($_SESSION['utilisateur']->getUsername()) ?></h2>
			</div>
			<p>
				<a href="?uc=admin&action=voirInscription" class="btn btn-info">Gestion des inscriptions Jeunes Publics</a>
				<a href="?uc=admin&action=voirInscriptionCL" class="btn btn-info">Gestion des inscriptions Collège Lycée</a>
				<a href="?uc=admin&action=voirInfos" class="btn btn-warning">Comment voir la base de données brute ?</a><br><br>
				<a href="?uc=admin&action=voirSpectacle" class="btn btn-info">Gestion des spectacles</a>
				<a href="?uc=admin&action=voirLieu" class="btn btn-info">Gestion des lieux</a>
				<a href="?uc=admin&action=voirEcole" class="btn btn-info">Gestion des écoles</a>
			</p>
		</div>
	</div>
</div>
<?php
if(isset($_SESSION['error'])){ unset($_SESSION['error']); } ?>
