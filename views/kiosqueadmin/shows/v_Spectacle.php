<?php ob_start(); ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h1 class="text-center">Gestion des spectacles</h1>
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
			<legend>Spectacles (<?= $actuel['nomSaison'] ?>)
				<a class="pull-right" title="Changer la saison courante" href="/JP/kiosqueadmin/shows/?seasonedit=1">
					<span class="glyphicon glyphicon-cog" aria-hidden="true">
					</span>
				</a>
				<a class="pull-right" title="Nouveau spectacle" href="/JP/kiosqueadmin/shows/?showsadd=1">
					<span class="glyphicon glyphicon-plus" aria-hidden="true">
					</span>
				</a>
			</legend>
			<thead>
				<tr>
					<th>Numéro Spectacle</th>
					<th>Nom</th>
					<th>Nombre de places</th>
					<th>Classes</th>
					<th>Options</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($listSpec as $key) { ?>
				<tr>
					<td><?= $key['idSpectacle'] ?></td>
					<td><?= $key['nomSpectacle'] ?></td>
					<td><?= $key['nbPlaceSpectacle'] ?></td>
					<td><?= $key['typeClasse'] ?></td>
					<td>
						<a title="Modifier <?= $key['nomSpectacle'] ?>" href="/JP/kiosqueadmin/shows/?shows=<?= $key['idSpectacle'] ?>&showsedit=1">
							<span class="glyphicon glyphicon-pencil" aria-hidden="true">
							</span>
						</a>
						<a title="Supprimer <?= $key['nomSpectacle'] ?>" href="/JP/kiosqueadmin/shows/?shows=<?= $key['idSpectacle'] ?>&showssuppr=1">
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
