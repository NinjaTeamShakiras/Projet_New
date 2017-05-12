<?php
/* @var $this EntrepriseController */
/* @var $data action Search */

/*
$this->breadcrumbs=array(
	'Entreprises',
);
*/

?>



<h1>Candidatures : </h1>

<?php
	
	// Récupération de l'entreprise
	$login = Yii::app()->user->getId();
	$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=>$login)); 
	$entreprise = Entreprise::model()->FindByAttributes(array("id_entreprise"=>$utilisateur->id_entreprise));


	// Récupération de toutes les candidature
	$candidats = postuler::model()->findAll();

	// Récupération de toutes les offres
	$tabOffres = offreEmploi::model()->findAll();

	// Tableau de récupération des offres correspondant à l'entreprise
	$tabOffreEntreprise = array();

	// Tableau de résultat offre/candidat de l'entreprise
	$tabOffreRes = array();
	$tabCandidatRes = array();	

	// On match les offres à celle de l'entreprise
	foreach($tabOffres as $offre)
	{
		if($offre->id_entreprise == $entreprise->id_entreprise)
		{
			$tabOffreEntreprise[] =$offre;
		}
	}


	// on match les offres de l'entreprise aux candidature

	foreach($candidats as $candidat)
	{
		foreach($tabOffreEntreprise as $offre)
		{
			if($candidat->id_offre_emploi == $offre->id_offre_emploi)
			{
				$tabOffreRes[] = $offre;
				$tabCandidatRes[] = $candidat;	
				break;
			}
		}
	}

	// On affiche la liste des candidats restant

	foreach($tabCandidatRes as $candidat)
	{
		print("<p> Le candidat ".$candidat->id_employe." a postulé à votre offre</p>");

	}

?>




