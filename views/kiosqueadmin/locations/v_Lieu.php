<?php ob_start(); ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h1 class="text-center">Gestion des lieux</h1>
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
		<table class="table table-striped table-hover table-bordered table-condensed">
			<legend>Lieux
				<a class="pull-right" title="Nouveau lieu" href="/JP/kiosqueadmin/locations/?locationsadd=1">
					<span class="glyphicon glyphicon-plus" aria-hidden="true">
					</span>
				</a>
			</legend>
			<thead>
				<tr>
					<th>Numéro Lieu</th>
					<th>Nom</th>
					<th>Adresse</th>
					<th>Code Postal</th>
					<th>Ville</th>
					<th>Options</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($listLieu as $key) { ?>
				<tr>
					<td><?= $key['idLieu'] ?></td>
					<td><?= $key['nomLieu'] ?></td>
					<td><?= $key['adrLieu'] ?></td>
					<td><?= $key['cpLieu'] ?></td>
					<td><?= $key['villeLieu'] ?></td>
					<td>
						<a title="Modifier <?= $key['nomLieu'] ?>" href="/JP/kiosqueadmin/locations/?locations=<?= $key['idLieu'] ?>&locationsedit=1">
							<span class="glyphicon glyphicon-pencil" aria-hidden="true">
							</span>
						</a>
						<a title="Supprimer <?= $key['nomLieu'] ?>" href="/JP/kiosqueadmin/locations/?locations=<?= $key['idLieu'] ?>&locationssuppr=1">
							<span class="glyphicon glyphicon-remove" aria-hidden="true">
							</span>
						</a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<a href="/JP/kiosqueadmin/" class="btn btn-primary">Retour</a>
		</div>
	</div>
</div>
<?php $contenu = ob_get_clean(); if(isset($_SESSION['error'])){ unset($_SESSION['error']); }
if(isset($_SESSION['valid'])){ unset($_SESSION['valid']); } ?>
