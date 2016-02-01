function sure(){
	return confirm("Êtes-vous sûr ?");
}


function voirPlanningSeance(form)
{
	var seance = form.elements["seance"].value;
	document.location.href = "?uc=admin&action=TableauPDF&seance="+seance;
}