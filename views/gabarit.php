<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<meta charset="utf-8">
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
	<script src="/JP/js/main.js"></script>
	<title><?php  if(isset($titre)){ echo $titre; } elseif(isset($this->titre)){ echo $this->titre; } ?></title>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button id="dropdown" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<ul class="nav navbar-nav">
					<li <?php if(!(isset($_GET['etapeJP'])) && !(isset($_GET['choix_ecole'])) && !(isset($_GET['etapeCL'])) && !(isset($_POST['prestart'])) && !(isset($_SESSION['login'])) && !(isset($_GET['connexion']))){ ?> class="active" <?php } ?>>
						<a class="navbar-brand" href="/JP/">Kiosque</a>
					</li>
				</ul>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li <?php if(isset($_GET['etapeJP']) || isset($_GET['choix_ecole']) || isset($_POST['prestart']) || isset($_GET['connexion'])){ ?> class="active" <?php } ?>><?php if(isset($_COOKIE['login'])) { ?><a href="/JP/?choix_ecole=1">Jeune Public <span class="sr-only">(current)</span></a><?php } else { ?><a href="/JP/?connexion=0">Jeune Public <span class="sr-only">(current)</span></a><?php } ?></li>
					<?php if(isset($_SESSION['login'])){ ?> <li><a href="/JP/kiosqueadmin/">Administration</a></li><?php } ?>
				</ul>
				<?php if(isset($_SESSION['login'])) { ?>
				<ul class="nav navbar-nav pull-right">
					<li><button type="button" onclick="document.location.href = '/JP/?logout=true'" class="btn btn-default navbar-btn">Déconnexion</button></li>
				</ul>
				<?php } ?>
			</div>
			<!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	<div class="taille"><?= $contenu ?></div>
	<footer>
		<!-- Version 1.1 &copy Le Kiosque by TURMEL Kévin -->
	</footer>
</body>
</html>
