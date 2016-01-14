<?php ob_start(); ?>
<div class="container">
	<div class="row">
		<div class="jumbotron">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h2>Bienvenue sur l'espace d'administration : <?= ucfirst($_SESSION['login']) ?></h2>
			</div>
			<p>
				<a href="/JP/kiosqueadmin/?admin=registration" class="btn btn-info">Gestion des inscriptions</a>
				<a href="/JP/kiosqueadmin/shows/" class="btn btn-info">Gestion des spectacles</a>
				<a href="/JP/kiosqueadmin/locations/" class="btn btn-info">Gestion des lieux</a>
				<a href="/JP/kiosqueadmin/schools/" class="btn btn-info">Gestion des écoles</a>
				<a href="/JP/kiosqueadmin/?export=1" class="btn btn-warning">Comment voir la base de données brute ?</a>
			</p>
		</div>
	</div>
</div>
<?php $contenu = ob_get_clean();
if(isset($_SESSION['error'])){ unset($_SESSION['error']); } ?>
