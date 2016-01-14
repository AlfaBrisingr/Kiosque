<?php ob_start(); ?>
<?php $jour = array('1' => 'Lundi','2' => 'Mardi','3' => 'Mercredi', '4' => 'Jeudi', '5' => 'Vendredi', '6' => 'Samedi', '7' => 'Dimanche'); ?>
<script src="/JP/js/css_cond.js"></script>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h1 class="text-center">Gestion des inscriptions</h1>
			<?php if(isset($_SESSION['error'])) { ?>
			<div class="alert alert-danger" role="alert">
				<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				<span class="sr-only">Error:</span>
				<?= $_SESSION['error'] ?>
			</div>
			<?php } ?>
			<?php if(isset($_SESSION['valid'])) { ?>
			<div class="alert alert-success" role="alert">
				<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
				<?= $_SESSION['valid'] ?>
			</div>
			<?php } ?>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-9" id="inscription">
		<div class="table-responsive">
			<legend>Inscriptions</legend>
			<div class="overflow-scroll-table">
				<table class="table table-hover table-condensed table-bordered">
					<thead>
						<tr>
							<th>N°</th>
							<th>Etat</th>
							<th>Ets</th>
							<th>Par</th>
							<th>Divers</th>
							<th>Impossibilités</th>
							<th>Nbr Enfants</th>
							<th>Nbr Adultes</th>
							<th>Date d'inscription</th>
							<th>Options</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($listIns as $key) { ?>
						<tr>
							<td><?= $key['idInscription'] ?></td>
							<td id="etat"><?php if($key['validationInscription'] == '1') { echo 'Validée'; } else { echo 'Non validée'; } ?></td>
							<td><?= $key['nomEcole'] ?></td>
							<td><?= $key['nomEns'].' '.$key['prenomEns'] ?></td>
							<td><?php if(empty($key['diversInscription'])){ echo '<strong><em>Vide</em></strong>'; } else { echo $key['diversInscription']; } ?></td>
							<td><?php if(empty($key['impoInscription']) || $key['impoInscription'] == ' - - ' || $key['impoInscription'] == '- -' || $key['impoInscription'] == ' -  - ') { echo '<strong><em>Vide</em></strong>'; } else { echo $key['impoInscription']; } ?></td>
							<td><?= $key['nbEnfantsInscription'] ?></td>
							<td><?= $key['nbAdultesInscription'] ?></td>
							<td><?php $d = new DateTime($key['dateInscription']);
								echo date_format($d, 'd/m/Y H:i'); ?>
							</td>
							<td>
								<a href="/JP/kiosqueadmin/?ins=<?= $key['idInscription'] ?>&valid=1" title="Planifier l'inscription n° <?= $key['idInscription'] ?>">
									<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
								</a>
								<a href="/JP/kiosqueadmin/?ins=<?= $key['idInscription'] ?>&edit=1" title="Modifier l'inscription n° <?= $key['idInscription'] ?>">
									<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
								</a>
								<a onclick="return sure()" href="/JP/kiosqueadmin/?ins=<?= $key['idInscription'] ?>&suppr=1" title="Supprimer l'inscription n° <?= $key['idInscription'] ?>">
									<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
								</a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
		<legend>Inscriptions (choix)</legend>
		<div class="overflow-scroll-table">
			<table class="table table-striped table-hover table-condensed table-bordered">
				<thead>
					<tr>
						<th>Inscription n°</th>
						<th>Spectacle choisi</th>
						<th>Choix n°</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($listChoix as $key) { ?>
					<tr>
						<td><?= $key['idInscription'] ?></td>
						<td><?= $key['nomSpectacle'] ?></td>
						<td><?= $key['prioriteChoix'] ?></td>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
				<legend>Planning</legend>
				<div class="overflow-scroll-table">
					<table class="table table-striped table-hover table-bordered table-condensed">
						<thead>
							<tr>
								<th>Séance</th>
								<th>Spectacle</th>
								<th>Séance</th>
								<th>Inscription</th>
								<th>Inscrits</th>
								<th>Options</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($listPlan as $key) { ?>
							<tr>
								<td><?= $key['idSeance'] ?></td>
								<td><?= $key['nomSpectacle'] ?></td>
								<td>
									<?php $d = new DateTime($key['date_heure']);
									echo $jour[$d->format('N')].' '; 
									echo date_format($d, 'd/m/Y - H:i'); ?>
								</td>
								<td><?= $key['nomEcole'] ?> <?= '- '.$key['nomEns'].' '.$key['prenomEns'] ?></td>
								<td><?= $key['jaugeUtilise']; ?></td>
								<td>
									<a onclick="return sure()" href="/JP/kiosqueadmin/?s=<?= $key['idSeance'] ?>&i=<?= $key['idInscription'] ?>" title="Supprimer du planning">
										<span class="glyphicon glyphicon-remove"></span>
									</a>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6" id="jauge">
				<table class="table table-striped table-hover table-bordered table-condensed">
					<legend>Jauges</legend>
					<thead>
						<tr>
							<th>Séance</th>
							<th>Spectacle</th>
							<th>Séance</th>
							<th>Jauge utilisée</th>
							<th>Jauge restante</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($listJauge as $key) { ?>
						<tr>
							<td><?= $key['idSeance'] ?></td>
							<td><?= $key['nomSpectacle'] ?></td>
							<td>
								<?php $d = new DateTime($key['date_heure']);
								echo $jour[$d->format('N')].' '; 
								echo date_format($d, 'd/m/Y - H:i'); ?>
							</td>
							<td><?= $key['jaugeUtilise']; ?></td>
							<td><?= $key['jaugeRestante']; ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
				<table class="table table-bordered table-hover table-striped table-condensed">
					<legend>Spectacle</legend>
					<thead>
						<tr>
							<th>N°</th>
							<th>Nom</th>
							<th>Nombre de places</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($listSpec as $key) { ?>
						<tr>
							<td><?= $key['idSpectacle'] ?></td>
							<td><?= $key['nomSpectacle'] ?></td>
							<td><?= $key['nbPlaceSpectacle'] ?></td>
						</tr>
						<?php
					} ?>
				</tbody>
			</table>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
			<legend>Séance <a title="Ajouter une séance" href="/JP/kiosqueadmin/?seanceadd=1"><span class="pull-right glyphicon glyphicon-plus" aria-hidden="true"></span></a></legend>
			<div class="overflow-scroll-table">
				<table class="clear table table-striped table-hover table-condensed table-bordered">
					<thead>
						<tr>
							<th>N°</th>
							<th>Spectacle</th>
							<th>Date/Heure</th>
							<th>Lieu</th>
							<th>Options</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($listSean as $key) { ?>
						<tr>
							<td><?= $key['idSeance'] ?></td>
							<td><?= $key['nomSpectacle'] ?></td>
							<td>
								<?php $d = new DateTime($key['date_heure']);
								echo $jour[$d->format('N')].' '; 
								echo date_format($d, 'd/m/Y - H:i'); ?>
							</td>
							<td><?= $key['nomLieu'] ?></td>
							<td>
								<a onclick="return sure()" href="/JP/kiosqueadmin/?seance=<?= $key['idSeance'] ?>">
									<span class="glyphicon glyphicon-remove"></span>
								</a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<a href="/JP/kiosqueadmin/" class="btn btn-primary">Retour</a>
		</div>
	</div>
</div>
<br>
<?php $contenu = ob_get_clean(); if(isset($_SESSION['error'])){ unset($_SESSION['error']); }
if(isset($_SESSION['valid'])){ unset($_SESSION['valid']); } ?>