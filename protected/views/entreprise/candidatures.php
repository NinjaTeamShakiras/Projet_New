<?php
/* @var $this EntrepriseController */
/* @var $data action Search */

/*
$this->breadcrumbs=array(
	'Entreprises',
);
*/

$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=> Yii::app()->user->getId()));

?>

<!--	MENU 	-->
<div class="dropdown">
	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenu1" aria-haspopup="true" aria-expanded="true">
		Menu 
		<span class="caret"></span>
	</button>
	<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
		<li>
			<a href="index.php?r=offreEmploi/create" title="Déposer une annonce">
			Déposer une annonce
			</a>
		</li>
		<li>
			<a href="index.php?r=entreprise/view&id=<?php echo $utilisateur->id_entreprise;?>" title="Mon profil">
			Mon profil
			</a>
		</li>
		<li>
			<a href="index.php?r=OffreEmploi/index" title="Liste des offres d'emplois">
			Mes annonces
			</a>
		</li>
		<li>
			<a href="index.php?r=entreprise/index" title="Rechercher un CV">
			Rechercher un CV
			</a>
		</li>
	</ul>
</div>






<h1>Mes candidats : </h1>


<div class="wide form">

	<?php
		//Début du form
		$form=$this->beginWidget('CActiveForm',
			array(
				'action'=>Yii::app()->createUrl('entreprise/Candidatures'),
			)
		);
	?>

	<div class="row">	
		<?php
			$modelOffre = OffreEmploi::model();
			$Offres = OffreEmploi::model()->FindAll("id_entreprise =".$utilisateur->id_entreprise);
			$tabOffres = array();

			foreach ($Offres as $key=>$offre) {
				$num = $key + 1;
				$entreprise = Entreprise::model()->FindByAttributes(array('id_entreprise'=>$offre->id_entreprise));
				$tabOffresPersonnalise[] = "Annonce ".$num." - ".$offre->type_offre_emploi." - ".$offre->poste_offre_emploi;
			}

			//Afficher candidats par anonce
			//-->On ajoute l'option "Sélectionner pour la liste"
			$static = array('' => Yii::t('', 'Sélectionner une annonce ...'));
			$posteOffre = CHtml::listData($tabOffresPersonnalise,'id_offre_emploi','poste_offre_emploi'); // On récupère tout les type d'offre existant
			echo $form->dropDownList($modelOffre,'id_offre_emploi',$static + $tabOffresPersonnalise); // On affiche une liste déroulante de toutes les offres

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
	}
	else
	{
		// Candidats chercher et rendu
		if($data == null)
		{
			print("<p> Vous n'avez aucun candidat à cette offre </p>");
		}
		else
		{
			if(sizeof($data) == 1)
			{
				print("<p> Vous avez ".(sizeof($data))." candidat qui a postulé à cette annonce</p>");
			}
			else
			{
				print("<p> Vous avez ".(sizeof($data))." candidats qui ont postulé à cette annonce</p>");
			}
			
			foreach($data as $employe)
			{
				print("<p> Le candidat ".$employe->id_employe." a postulé à votre offre</p>");
			}
		}
	
	}

?>




