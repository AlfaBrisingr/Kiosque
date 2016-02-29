function sure(){
	return confirm("Êtes-vous sûr ?");
}


function voirPlanningSeance(form)
{
	var seance = form.elements["seance"].value;
	document.location.href = "?uc=admin&action=PlanningPDF&seance="+seance;
}

function voirSeanceSpectacle(form)
{
	var spectacle = form.elements["spectacle"].value;
	document.location.href = "?uc=admin&action=SeancePDF&spectacle="+spectacle;
}

function voirJaugeSpectacle(form)
{
	var spectacle = form.elements["spectacle"].value;
	document.location.href = "?uc=admin&action=JaugePDF&spectacle="+spectacle;
}