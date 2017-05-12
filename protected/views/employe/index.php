<?php
/* @var $this EmployeController */
/* @var $dataProvider CActiveDataProvider */

?>

<h1>Rechercher une offre : </h1> <!-- Titre page -->



<?php
	$login = Yii::app()->user->getId();
	$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=>$login)); // Récupération de l'utilisateur
	$model = OffreEmploi::model();
	$tabOffre = OffreEmploi::model()->FindAll(); // Récupération de toutes les offres

	$entreprise = entreprise::model();
	$adresse = adresse::model();


	$nombreOffre = sizeof($tabOffre); // Nombre d'offre total

	print("<p> Trouver les offres qui vous correspondes parmis ".$nombreOffre." offres.</p>");
?>


<!-- Formulaire de recherche d'une offre d'emploi -->
<div class="wide form">

	<?php
		//Début du form
		$form=$this->beginWidget('CActiveForm',
			array(
				'action'=>Yii::app()->createUrl('offreEmploi/Search'),
			)
		);
	?>

	<div class="row">
		<!-- Recherche d'un poste (textfield + bouton submit) -->	
		<?php

			// Recherche par POSTE
			echo $form->textField(
				$model,'poste_offre_emploi', array(	
					'class' => 'autocomplete-find-offreEmploi',
					'url_data_auto' => Yii::app()->createUrl('offreEmploi/GetAllPosteJSON'),
					'size' => 45,
					'maxlength' => 30,
					'placeholder' => 'Rechercher par poste',
				)
			);

			?><br/><?php

			// Recherche par TYPE (liste déroulante )
			echo $form->dropDownList(
				$model, 'type_offre_emploi', array(
					''=>'',
					'CDD'=>'CDD',
					'CDI'=>'CDI', 
					'STAGE'=>'STAGE',
					'ALTERNANCE'=>'ALTERNANCE',
					'EXTRA'=>'EXTRA',
				)
			);

			?><br/><?php

			// Recherche par Lieu
			

			echo $form->textField(
				$adresse,'ville', array(	
					'class' => 'autocomplete-find-offreEmploi',
					'url_data_auto' => Yii::app()->createUrl('offreEmploi/GetAllLieuJSON'),
					'size' => 45,
					'maxlength' => 30,
					'placeholder' => 'Rechercher par lieu',
				)
			);

			?><br/><?php

			// Recherche par Secteur

			echo $form->textField(
				$entreprise,'secteur_activite_entreprise', array(	
					'class' => 'autocomplete-find-offreEmploi',
					'url_data_auto' => Yii::app()->createUrl('offreEmploi/GetAllSecteurJSON'),
					'size' => 45,
					'maxlength' => 30,
					'placeholder' => 'Rechercher par secteur d\'activité',
				)
			);

			?><br/><?php
			// Button d'envoi
			echo CHtml::submitButton('Rechercher');
		?>

	</div>

	<div class="row buttons">
	</div>

	<?php $this->endWidget(); ?>

</div>


<!-- Fomulaire avec le bouton de l'ajout du CV -->
<div class="wide form">
	<?php
		//Début du form
		$form=$this->beginWidget('CActiveForm',
			array(
				'action'=>Yii::app()->createUrl('employe/choixAjoutCV'),
			)
		);
	?>

	<div class="row buttons">
		<!-- Bouton d'ajout du CV -->
		<?php echo CHtml::submitButton('Ajouter mon CV'); ?>
	</div>

	<?php $this->endWidget(); ?>
		
</div>

<!-- Formulaire avec le bouton pour postuler en click -->
<div class="wide form">
	<?php
		//Début du form
		$form=$this->beginWidget('CActiveForm',
			array(
				'action'=>Yii::app()->createUrl('offreEmploi/recherche') ,
			)
		);
	?>

	<div class="row buttons">
		<!-- Bouton pour postuler -->
		<?php echo CHtml::submitButton('Postuler à une annonce en un seul click !'); ?>
	</div>

	<?php $this->endWidget(); ?>
		
</div>