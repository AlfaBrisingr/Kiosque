<?php ob_start(); ?>
<div class="container">
	<div class="row">
		<div class="jumbotron">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<fieldset>
					<legend>Planifier l'inscription n° <?= $idInscription ?></legend>
				</fieldset>
				<form method="POST" action="/JP/kiosqueadmin/?ins=<?=$idInscription ?>&validfinish=1">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
							<div class="form-group">
								<label>Sur la séance</label>
								<select class="form-control" name="seance">
									<?php foreach ($listChoix as $key) { ?>
									<option value="<?= $key['idSeance'] ?>">N° <?= $key['idSeance'] ?> - <?php $d = new DateTime($key['date_heure']); echo $d->format('d/m/Y H:i'); ?> - <?= $key['nomSpectacle'] ?> - Choix <?= $key['prioriteChoix'] ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<input type="submit" value="Envoyer" class="btn btn-primary">
						<input type="reset" value="Par défaut" class="btn btn-default">
					</div>
				</form>
			</div>
		</div>
		<a href="/JP/kiosqueadmin/?admin=registration" title="Retour">Retour</a>
	</div>
</div>
<?php $contenu = ob_get_clean(); ?>
