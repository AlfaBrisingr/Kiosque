<?php ob_start(); session_start(); if(isset($_SESSION)) { unset($_SESSION); session_destroy(); } ?>
<script type="text/javascript" src="/JP/view/inscriptionEcole/block/js/main.js"></script>
<div class="container">
	<div class="content">
		<h1>Bienvenue, les inscriptions seront disponibles dans : </h1>
		<div class="bloc" id="days">
		</div>
		<div class="bloc" id="hours">
		</div>
		<div class="bloc" id="minutes">
		</div>
		<div class="bloc last" id="seconds">
		</div>
	</div>
</div>
<?php $contenu = ob_get_clean(); ?>