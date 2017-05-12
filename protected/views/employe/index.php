<?php
/* @var $this EmployeController */
/* @var $dataProvider CActiveDataProvider */

?>

<?php
	$login = Yii::app()->user->getId();
	// Récupération de l'utilisateur
	$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=>$login));
	$model = OffreEmploi::model();
	// Récupération de toutes les offres
	$tabOffre = OffreEmploi::model()->FindAll();
	// Récupération de toutes les entreprises
	$tabEntreprise = entreprise::model()->FindAll();

	$entreprise = entreprise::model();
	$adresse = adresse::model();

	$nombreOffre = sizeof($tabOffre); // Nombre d'offre total

?>


<!-- Formulaire de recherche d'une offre d'emploi -->
<div>
	<?php echo "<h3>Trouver les offres qui vous correspondent parmis ".$nombreOffre." offres</h3>"; ?>
</div>	

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
		<!-- Recherche d'un poste (textfield + dropdownlist+ bouton submit) -->	
		<?php
			//Recherche par POSTE
			echo $form->textField(
				$model,'poste_offre_emploi', array(	
					'class' => 'autocomplete-find-offreEmploi',
					'url_data_auto' => Yii::app()->createUrl('offreEmploi/GetAllPosteJSON'),
					'size' => 45,
					'maxlength' => 30,
					'placeholder' => 'Rechercher par poste',
				)
			);
		?>
	
		<?php
			//Recherche par TYPE DE CONTRAT (liste déroulante)
			//-->On ajoute l'option "Sélectionner pour la liste"
			$static_type = array('' => Yii::t('', 'Sélectionner le type de contrat'));
			$typeOffre = CHtml::listData($tabOffre,'type_offre_emploi', 'type_offre_emploi'); // On récupère tout les type d'offre existant
			echo $form->dropDownList($model,'type_offre_emploi',$static_type + $typeOffre); // On affiche une liste déroulante de toutes les offres
		?>
	</div>
	
	<div class="row">
		<?php
			//Recherche par LIEU
			echo $form->textField(
				$adresse,'ville', array(	
					'class' => 'autocomplete-find-offreEmploi',
					'url_data_auto' => Yii::app()->createUrl('offreEmploi/GetAllLieuJSON'),
					'size' => 37,
					'maxlength' => 30,
					'placeholder' => 'Rechercher par lieu',
				)
			);
		?>
	
		<?php
			//Recherche par SECTEUR
			//-->On ajoute l'option "Sélectionner pour la liste"
			$static_secteur = array('' => Yii::t('', 'Sélectionner le secteur'));
			$secteurOffre = CHtml::listData($tabEntreprise,'secteur_activite_entreprise', 'secteur_activite_entreprise'); // On récupère tout les secteur d'offre existant
			echo $form->dropDownList($entreprise,'secteur_activite_entreprise',$static_secteur + $secteurOffre); // On affiche une liste déroulante de tout les secteur d'activité
		?>
	
		<?php
			// Button d'envoi
			echo CHtml::submitButton('Rechercher');
		?>
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

	<div class="row">
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

	<div class="row">
		<!-- Bouton pour postuler -->
		<?php echo CHtml::submitButton('Postuler à une annonce en un seul click !'); ?>
	</div>

	<?php $this->endWidget(); ?>
</div>	

<?php

//Si l'utilisateur est connecté, on lui affiche un bouton pour voir ses infos persos
if($utilisateur != null)
{
	//Formulaire pour voir ses infos persos
	echo "<div class='wide form'>";
		//Début du form
		$form=$this->beginWidget('CActiveForm',
			array(
				'action'=>Yii::app()->createUrl('employe/view', array('id'=>$utilisateur->id_employe)),
			)
		);

		echo "<div class='row'>".CHtml::submitButton('Voir mes informations personnelles !')."</div>";

	$this->endWidget();
	echo "</div>";
}
?>

	