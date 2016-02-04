<?php $mois = array('1' => 'janvier','2' => 'février','3' => 'mars', '4' => 'avril', '5' => 'mai', '6' => 'juin', '7' => 'juillet', '8' => 'août', '9' => 'septembre', '10' => 'octobre', '11' => 'novembre', '12' => 'décembre'); ?>
<?php $jour = array('1' => 'Lundi','2' => 'Mardi','3' => 'Mercredi', '4' => 'Jeudi', '5' => 'Vendredi', '6' => 'Samedi', '7' => 'Dimanche'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-12 col-xs-12 col-lg-12">
			<div class="progress">
				<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%;">
					60%
				</div>
			</div>
			<h3>Choix du spectacle</h3>
		</div>
	</div>
	<p class="text-justify">
		Le Kiosque traite les inscription par ordre d'arrivée.
		Si votre choix N°1 n'est plus possible (spectacle complet),
		votre classe sera automatiquement redirigée vers votre choix N°2, etc...
	</p>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<p class="text-justify"><span class="require">*</span> : champs obligatoires</p>
		</div>
	</div>
	<form action="?uc=cl&action=etape4" method="post" id="form3">
		<div class="form-group">
			<h3>Choix n°1</h3>
		</div>
		<?php foreach ($lesSpectacles->getCollection() as $spectacle): ?>
			<div class="radio">
				<label>
					<input type="radio" required name="choix1"
					<?php if(isset($_SESSION['choix1']) && $_SESSION['choix1'] == $spectacle->getNom())
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
			<label>Vos impossibilités - choix 1</label>
			<div class="form-group">
				<textarea class="form-control" rows="6" cols="90" style="resize:none" name="impo1" placeholder="Merci nous signaler ici la ou les séances auxquelles vous savez déjà que vous ne pourrez pas vous rendre."><?php if(isset($_SESSION['impo1']) && $_SESSION['impo1'] != ""){ echo $_SESSION['impo1']; } ?></textarea>
			</div>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Continuer</button>
		</div>
		<div class="col-md-12 row">
			<a href="?uc=cl&action=etape2" class="btn btn-link">Retour</a>
			<a href="?uc=cl&action=choisirTypeEcole" class="btn btn-link">Revenir au début du formulaire</a>
			<a href="?uc=index" class="btn btn-link">Revenir à l'accueil</a>
		</div>
	</form>
	<script src="js/validate.js"></script>
	<script type="text/javascript">$.noConflict();</script>
</div>
