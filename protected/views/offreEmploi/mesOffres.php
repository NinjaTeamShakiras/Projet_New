<?php
/* @var $this OffreEmploiController */
/* @var $dataProvider CActiveDataProvider */

//$this->breadcrumbs=array(
//	'Offre Emplois',
//);


	$this->menu=array(
		array('label'=>'Liste des offres d\'emplois', 'url'=>array('/offreEmploi/index')), // Voir toutes les offres d'emplois
		array('label'=>'Rechercher des offres d\'emplois', 'url'=>array('/offreEmploi/recherche')), // Rechercher des offres d'emplois
	);

?>



<h1>Liste de mes candidatures</h1> <!-- Titre page -->



<?php

	$login = Yii::app()->user->getId();
	$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=>$login)); // Récupération de l'utilisateur
	$model = OffreEmploi::model()->FindAll(); // Récupération de toutes les offres


	$tablePostuler = Postuler::model()->FindAll(); // On récupère toutes les Candidatures
	$aPostuler = false;


	$tabOffre = OffreEmploi::model()->FindAll(); // Récupération de toutes les offres
	$nombreOffrePostuler = 0; // Nombre d'offre total


	foreach($tablePostuler as $postuler)
	{
		if($postuler->id_employe == $utilisateur->id_employe)
		{
			$nombreOffrePostuler++;
		}
	}
	
	print("<p> Vous avez postuler a ".$nombreOffrePostuler." offres.</p>");


	// On vérifie si un champs comprend l'id de l'employé et l'id de l'offre. Si c'est le cas, l'employé à déjà postuler
	foreach($tablePostuler as $postuler)
	{
		if($postuler->id_employe == $utilisateur->id_employe)
		{
			$offre = OffreEmploi::model()->FindByAttributes(array("id_offre_emploi"=>$postuler->id_offre_emploi)); // On récupère l'offre concernée
			$entreprise = entreprise::model()->FindByAttributes(array("id_entreprise"=>$offre->id_entreprise)); // On récupère l'entreprise qui propose l'offre

			// Pour récupéré l'adresse : 
			$userEntreprise = utilisateur::model()->FindByAttributes(array("id_entreprise"=>$entreprise->id_entreprise));
			$adresse = adresse::model()->FindByAttributes(array("id_adresse"=>$userEntreprise->id_adresse));

			//print("<p> ID entreprise : ".$offre->id_entreprise."</p>");
			//print("<p> ID offre : ".$offre->id_offre_emploi."</p>");
			print("<p> Proposé par : ".$entreprise->nom_entreprise."</p>");
			print("<p> Secteur d'activité : ".$entreprise->secteur_activite_entreprise." </p>");
			print("<p> Poste : ".$offre->poste_offre_emploi."</p>");
			print("<p> Type de contrat : ".$offre->type_offre_emploi."</p>");
			print("<p> Date prévisionnel d'embauche : ".$this->changeDateNaissance($offre->date_debut_offre_emploi)."</p>");
			print("<p> Salaire proposé : ".$offre->salaire_offre_emploi." €</p>");
			print("<p> Lieu : ".$adresse->ville." </p>");
			print("<p> Expérience nécéssaire : ".$offre->experience_offre_emploi."</p>");
			print("<p> Description de l'offre : ".$offre->description_offre_emploi."</p>");
			print("<p> Date de mise en ligne : ".$this->changeDateNaissance($offre->date_creation_offre_emploi)."</p>");
			print("<p> Vous avez postuler à cette offre le : ".$this->changeDateNaissance($postuler->date_postule)."</p>");
			echo CHtml::link('Voir cette offre' ,array('offreEmploi/view', 'id'=>$offre->id_offre_emploi));
			echo "<hr/>";
			$aPostuler = true;
		}
	}


	if(!$aPostuler)
	{
		echo "Vous n'avez jamais postuler !";
	}
	

?>
