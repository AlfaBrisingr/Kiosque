<?php $mois = array('1' => 'janvier','2' => 'février','3' => 'mars', '4' => 'avril', '5' => 'mai', '6' => 'juin', '7' => 'juillet', '8' => 'août', '9' => 'septembre', '10' => 'octobre', '11' => 'novembre', '12' => 'décembre'); ?>
<?php $jour = array('1' => 'Lundi','2' => 'Mardi','3' => 'Mercredi', '4' => 'Jeudi', '5' => 'Vendredi', '6' => 'Samedi', '7' => 'Dimanche'); ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="progress">
				<div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%;">
					80%
				</div>
			</div>
			<h3>Choix du spectacle</h3>
		</div>
	</div>
	<p class="text-justify">
		Le Kiosque traite les inscriptions.
		Si votre choix N°1 n'est plus possible (spectacle complet),
		votre classe sera automatiquement redirigée vers votre choix N°2, etc...
	</p>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<p class="text-justify"><span class="require">*</span> : champs obligatoires</p>
		</div>
	</div>
	<form action="?uc=cl&action=etape5" method="post" id="form4">
		<input type="hidden" name="Choix2" value="">
		<div class="form-group">
			<div class="form-group">
				<h4>Choix n°2</h4>
				<label>Choix 2 <span class="require">*</span></label>
			</div>
			<div class="radio">
				<label>
					<input type="radio" required name="choix2" <?php if(isset($_SESSION['choix2']) && $_SESSION['choix2'] == 'non'){ echo 'checked="checked"'; } ?> value="non">Pas de choix n°2
				</label>
			</div>
			<?php foreach ($lesSpectacles->getCollection() as $spectacle): ?>
				<div class="radio">
					<label>
						<input type="radio" required name="choix2"
						<?php if(isset($_SESSION['choix2']) && $_SESSION['choix2'] == $spectacle->getNom())
						{
							echo 'checked="checked"';
						} ?> value="<?= $spectacle->getNom() ?>">
						<?php echo $spectacle->getNom().' - '; ?>
						<?php echo $spectacle->getTypeClasse();
						$i = 0;
						foreach ($spectacle->getLesSeances()->getCollection() as $seance)
						{
							echo ' - ';
							echo $jour[$seance->getDate()->format('N')].
							$seance->getDate()->format(' d ').
							$mois[$seance->getDate()->format('n')];
							echo $seance->getDate()->format(' Y');
							echo ' à '.$seance->getDate()->format('H').'h'.$seance->getDate()->format('i ');
						}
						?>
					</label>
				</div>
			<?php endforeach; ?>
			<div class="form-group">
				<input type="hidden" name="form">
				<button type="submit" class="btn btn-primary">Continuer</button>
			</div>
			<div class="col-md-12 row">
				<a href="?uc=cl&action=etape3" class="btn btn-link">Retour</a>
				<a href="?uc=cl&action=choisirTypeEcole" class="btn btn-link">Revenir au début du formulaire</a>
				<a onclick="document.location.href = '?uc=connection&action=logout'" class="btn btn-link">Réinitialiser</a>
				<a href="?uc=index" class="btn btn-link">Revenir à l'accueil</a>
			</div>
		</form>
		<script src="/JP/js/validate.js"></script>
		<script type="text/javascript">$.noConflict();</script>
	</div>
