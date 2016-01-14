<?php ob_start(); ?>
<script src="/JP/js/css_cond.js"></script>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h1 class="text-center">Comment voir la base de données brute ? (lire attentivement)</h1>
		</div>
		<p class="text-justify">Pour commencer, veuillez-vous connecter sur le site de l'hébergeur : <a href="https://www.1and1.fr/login?__lf=Static" title="1and1 Website">ici</a> - Demander les informations de connexion à Bruno</p>
		<p class="text-justify">Vous arriverez sur la page d'accueil de l'espace client une fois connecté. A partir de là, descendez un peu la page pour atteindre "Base de données MySQL" : <br><br><img src="/JP/view/kiosqueadmin/infos/imgs/1.png" class="img-responsive borderthin" alt="Image"></p>
		<p class="text-justify">Sur la page suivante, appuyez sur "phpMyAdmin" : <br><br><img src="/JP/view/kiosqueadmin/infos/imgs/2.png" class="img-responsive borderthin" alt="Image"></p>
		<p class="text-justify">Attendez que la page se charge (nouvel onglet), ensuite cliquez sur le "+" : <br><br><img src="/JP/view/kiosqueadmin/infos/imgs/3.png" class="img-responsive borderthin" alt="Image"></p>
		<p class="text-justify">Vous verrez désormais tous les tableaux de la base de données (ATTENTION : vous pourrez modifier ou supprimer des données sur cette interface) : <br><br><img src="/JP/view/kiosqueadmin/infos/imgs/4.png" class="img-responsive borderthin" alt="Image"></p>
		<p class="text-justify">Cliquez sur le nom de chaque tableau pour afficher son contenu : <br><br><img src="/JP/view/kiosqueadmin/infos/imgs/5.png" class="img-responsive borderthin" alt="Image"></p>

	</div>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<a href="/JP/kiosqueadmin/" class="btn btn-primary">Retour</a>
	</div>
</div>
<br>
<?php $contenu = ob_get_clean(); ?>