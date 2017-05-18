<?php
/* @var $this OffreEmploiController */
/* @var $dataProvider CActiveDataProvider */

//$this->breadcrumbs=array(
//	'Offre Emplois',
//);

?>





<?php

	$login = Yii::app()->user->getId();
	$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=>$login)); // Récupération de l'utilisateur
	$model = OffreEmploi::model()->FindAll(); // Récupération de toutes les offres
	$modelOffre = OffreEmploi::model();


	//$tablePostuler = Postuler::model()->FindAll(); // On récupère toutes les Candidatures
	$aPostuler = false;


	//$tabOffre = $model; // Récupération de toutes les offres
	$nombreOffrePostuler = 0; // Nombre d'offre total



/* 		MENU 	*/
if($utilisateur != null)
{ // Si connecter
	if (Utilisateur::est_employe(Yii::app()->user->role) )
	{ // Si employe
		?>
		<div class="dropdown">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenu1" aria-haspopup="true" aria-expanded="true">
			Menu 
			<span class="caret"></span>
			</button>
			<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
				<li>
					<a href="index.php?r=employe/view&id=<?php echo $utilisateur->id_employe;?>" title="Mon profil">
					Mon profil
					</a>
				</li>
				<li>
					<a href="index.php?r=site/redirectInscriptionCV" title="Ajouter mon CV">
					Ajouter mon CV
					</a>
				</li>
				<li>
					<a href="index.php?r=OffreEmploi/index" title="Liste des offres d'emplois">
					Liste des offres d'emplois
					</a>
				</li>
				<li>
					<a href="index.php?r=employe/index" title="Rechercher une offre">
					Rechercher une offre
					</a>
				</li>
				<li role="separator" class="divider"></li>
				<li>
					<a href="index.php?r=employe/Deconnexion" title="Déconnexion">
					Déconnexion
					</a>
				</li>
			</ul>
		</div>
		<?php
	}
}

?>

	
<h1>Mes candidatures</h1> <!-- Titre page -->


	<?php
	$tablePostuler = postuler::model()->FindAll("id_employe = '$utilisateur->id_employe'");
	foreach($tablePostuler as $postuler)
	{
		$nombreOffrePostuler++;
	}
	
	print("<p> Vous avez postuler à ".$nombreOffrePostuler." offres.</p>");

?>

 <!-- ---------------------------------------------------------------- -->
 
<div class="wide form">

	<?php
		//Début du form
		$form=$this->beginWidget('CActiveForm',
			array(
				'action'=>Yii::app()->createUrl('offreEmploi/actualiseMesOffres'),
			)
		);
	?>

	<div class="row">
		<?php
			$modelOffre = OffreEmploi::model();

			$tabOffreEmploye = array();

			// On récupère toutes les offres postulées par l'employé
			foreach($tablePostuler as $postuler)
			{
				// On récupère toutes les offres postulées par l'employé
				$offre = OffreEmploi::model()->FindByAttributes(array("id_offre_emploi"=>$postuler->id_offre_emploi));

				// On met de coté l'offre qui nous intérèsse
				$tabOffreEmploye[] = $offre;
			}


			$static_type = array('' => Yii::t('', 'Sélectionner un poste ...'));
			// On récupère tout les type d'offre existant dans tabOffreEmploye
			$posteOffre = CHtml::listData($tabOffreEmploye,'poste_offre_emploi', 'poste_offre_emploi'); 
			echo $form->dropDownList($modelOffre,'poste_offre_emploi',$static_type + $posteOffre); // On affiche une liste déroulante de toutes les offres

		?>
	</div>

	<div class="row buttons">	
		<?php
			// Button d'envoi
			echo CHtml::submitButton('Actualiser');
		?>
	</div>

	<?php $this->endWidget(); ?>

</div>




<?php


	if($data == -2)
	{
		// Uniquement lorsqu'on viens d'une autre page
	}
	else if($data == -1)
	{
		// Pas de paramètre selectionné
		print("<p> Vous n'avez pas séléctionné de poste</p>");
	}
	else
	{
		// Offre chercher et rendu
		if($data == null)
		{ // Si il n'y à pas d'offre ($data)
			print("<p> Vous n'avez postuler à aucune offre </p>");
		}
		else
		{ // Si il y a des offres
			$annonceN = 0; // Affichage du numéro d'annonce
			foreach($data as $offre)
			{ // On parcours les offres
				$annonceN++;
				$entreprise = entreprise::model()->FindByAttributes(array("id_entreprise"=>$offre->id_entreprise));
				$nomLien = "Annonce ".$annonceN." - ".$offre->type_offre_emploi." - ".$offre->poste_offre_emploi." - chez ".$entreprise->nom_entreprise;
				echo CHtml::link($nomLien ,array('offreEmploi/view', 'id'=>$offre->id_offre_emploi));
				echo "<hr/>";
			}
		}

	}




/*

	// Ancienne version d'affichage
	$annonceN = 0;

	// On vérifie si un champs comprend l'id de l'employé et l'id de l'offre. Si c'est le cas, l'employé à déjà postuler
	foreach($tablePostuler as $postuler)
	{
		if($postuler->id_employe == $utilisateur->id_employe)
		{

			$annonceN++;
			$offre = OffreEmploi::model()->FindByAttributes(array("id_offre_emploi"=>$postuler->id_offre_emploi)); // On récupère l'offre concernée
			$entreprise = entreprise::model()->FindByAttributes(array("id_entreprise"=>$offre->id_entreprise)); // On récupère l'entreprise qui propose l'offre

			// Pour récupéré l'adresse :
			$userEntreprise = utilisateur::model()->FindByAttributes(array("id_entreprise"=>$entreprise->id_entreprise));
			$adresse = adresse::model()->FindByAttributes(array("id_adresse"=>$userEntreprise->id_adresse));

			//print("<p> ID entreprise : ".$offre->id_entreprise."</p>");
			//print("<p> ID offre : ".$offre->id_offre_emploi."</p>");
			// - print("<p> Proposé par : ".$entreprise->nom_entreprise."</p>");
			// - print("<p> Secteur d'activité : ".$entreprise->secteur_activite_entreprise." </p>");
			// - print("<p> Poste : ".$offre->poste_offre_emploi."</p>");
			// - print("<p> Type de contrat : ".$offre->type_offre_emploi."</p>");
			// - print("<p> Date prévisionnel d'embauche : ".$this->changeDateNaissance($offre->date_debut_offre_emploi)."</p>");
			// - print("<p> Salaire proposé : ".$offre->salaire_offre_emploi." €</p>");
			// - print("<p> Lieu : ".$adresse->ville." </p>");
			// - print("<p> Expérience nécéssaire : ".$offre->experience_offre_emploi."</p>");
			// - print("<p> Description de l'offre : ".$offre->description_offre_emploi."</p>");
			// - print("<p> Date de mise en ligne : ".$this->changeDateNaissance($offre->date_creation_offre_emploi)."</p>");
			// - print("<p> Vous avez postuler à cette offre le : ".$this->changeDateNaissance($postuler->date_postule)."</p>");

			$nomLien = "Annonce ".$annonceN." - ".$offre->type_offre_emploi." - ".$offre->poste_offre_emploi." - créée le ".$this->changeDateNaissance($offre->date_creation_offre_emploi);

			echo CHtml::link($nomLien ,array('offreEmploi/view', 'id'=>$offre->id_offre_emploi));
			echo "<hr/>";
			$aPostuler = true;
		}
	}
*/	

?>
