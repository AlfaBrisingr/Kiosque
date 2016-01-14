<?php ob_start(); ?>
<?php $jour = array('1' => 'Lundi','2' => 'Mardi','3' => 'Mercredi', '4' => 'Jeudi', '5' => 'Vendredi', '6' => 'Samedi', '7' => 'Dimanche'); ?>
<script src="/JP/js/css_cond.js"></script>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h1 class="text-center">Gestion des écoles</h1>
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
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="ecoles">
		<legend>Ecoles <a title="Ajouter une école" href="/JP/kiosqueadmin/schools/?schoolsadd=1"><span class="pull-right glyphicon glyphicon-plus" aria-hidden="true"></span></a></legend>
		<div class="table-responsive">
			<div class="overflow-scroll-table-lg">
				<table class="table table-hover table-condensed table-bordered table-striped">
					<thead>
						<tr>
							<th>N°</th>
							<th>Type</th>
							<th>Nom</th>
							<th>Adresse</th>
							<th>Code Postal</th>
							<th>Ville</th>
							<th>Mail</th>
							<th>Directeur</th>
							<th>Options</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($listEcole as $key) { ?>
						<tr>
							<td><?= $key['id'] ?></td>
							<td><?php if($key['typeEcole'] == '1') { echo 'Publique'; } else { echo 'Privée'; } ?></td>
							<td><?= $key['nomEcole'] ?></td>
							<td><?= $key['adresseEcole'] ?></td>
							<td><?= $key['cpEcole'] ?></td>
							<td><?= $key['villeEcole'] ?></td>
							<td><?= $key['mail_dir'] ?></td>
							<td><?= $key['nomEns'].' '.$key['prenomEns'] ?>
							</td>
							<td>
								<a href="/JP/kiosqueadmin/schools/?schools=<?= $key['id'] ?>&edit=1" title="Modifier l'école n° <?= $key['id'] ?>">
									<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
								</a>
								<a onclick="return sure()" href="/JP/kiosqueadmin/schools/?schools=<?= $key['id'] ?>&suppr=1" title="Supprimer l'école n° <?= $key['id'] ?>">
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
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<a href="/JP/kiosqueadmin/" class="btn btn-primary">Retour</a>
	</div>
</div>
<br>
<?php $contenu = ob_get_clean(); if(isset($_SESSION['error'])){ unset($_SESSION['error']); }
if(isset($_SESSION['valid'])){ unset($_SESSION['valid']); } ?>