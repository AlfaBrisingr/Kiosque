
<div class="container">
	<div class="row">
		<div class="jumbotron">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<fieldset>
					<legend>Planifier l'inscription n° <?= $idInscription ?></legend>
				</fieldset>
				<form method="POST" action="?uc=admin&action=validerInscription&?ins=<?=$idInscription ?>">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
							<div class="form-group">
								<label>Sur la séance</label>
								<select class="form-control" name="seance">
									<?php foreach ($listChoix as $key) { ?>
									<option value="<?= $key['idSeance'] ?>">N° <?= $key['idSeance'] ?> - <?php $seance->getDate()->format("d/m/Y H:i"); ?> - <?= getXXX() $key['nomSpectacle'] ?> - Choix <?= $key['prioriteChoix'] ?></option>
									<!-- value doit être getIdTruc() -->
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
		<a href="?uc=admin&action=voirInscription" title="Retour">Retour</a>
	</div>
</div>