<?php ob_start();
?>
<div class="container">
	<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
		<?php if($passe == true){ ?>
		<h1>Demande d'inscription terminée.</h1>
		<p class="text-justify">
			Votre réponse a bien été enregistrée.
			Vous allez recevoir d'ici peu un récapitulatif de votre demande
			à l'adresse mail que vous nous avez indiquée. Si vous ne recevez
			rien d'ici quelques jours, merci de joindre Valérie Martin de préférence
			par mail à v.martin@kiosque-mayenne.org ou par tél au 02 43 30 10 16.
			<p class="text-justify">A bientôt.</p>
			<p class="text-justify">L'équipe du Kiosque.</p>
			<?php } else { ?>
			<?= $_SESSION['error'] ?>
			<?php } ?>
		</p>
		<a href="/JP/" class="btn btn-link">Revenir à l'accueil</a>
	</div>
</div>
<?php
$contenu = ob_get_clean(); if(isset($_SESSION['error'])){ unset($_SESSION['error']); }
?>
