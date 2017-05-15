<?php
/* @var $this EmployeController */
/* @var $dataProvider CActiveDataProvider */

?>
<?php $image = CHtml::image(Yii::app()->request->baseUrl.'/images/icone_prozzl.png',
      'Image accueil');
 
      echo CHtml::link($image,array('site/index','id'=> 'accueil')); ?>


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
<div class='row'>
	<?php echo "<h3 id='titre'>Trouver les offres qui vous correspondent parmis <mark>".$nombreOffre."</mark> offres</h3>"; ?>
</div>	

<div class="form">

	<?php
		//Début du form
		$form=$this->beginWidget('CActiveForm',
			array(
				'action'=>Yii::app()->createUrl('offreEmploi/Search'),
			)
		);
	?>

	<div id="row_field">
		<!-- Recherche d'un poste (textfield + dropdownlist+ bouton submit) -->	
		<?php
			//Recherche par POSTE
			echo $form->textField(
				$model,'poste_offre_emploi', array(	
					'class' => 'field autocomplete-find-offreEmploi',
					'url_data_auto' => Yii::app()->createUrl('offreEmploi/GetAllPosteJSON'),
					'size' => 45,
					'maxlength' => 30,
					'placeholder' => 'Rechercher par poste',
				)
			);
		?>
	
		<?php
			//Recherche par LIEU
			echo $form->textField(
				$adresse,'ville', array(	
					'class' => 'field autocomplete-find-offreEmploi',
					'url_data_auto' => Yii::app()->createUrl('offreEmploi/GetAllLieuJSON'),
					'size' => 37,
					'maxlength' => 30,
					'placeholder' => 'Rechercher par lieu',
				)
			);
		?>
	</div>
	
	<div id="row_field2">
		<?php
			//Recherche par TYPE DE CONTRAT (liste déroulante)
			//-->On ajoute l'option "Sélectionner pour la liste"
			$static_type = array('' => Yii::t('', 'Sélectionner le type de contrat'));
			$typeOffre = CHtml::listData($tabOffre,'type_offre_emploi', 'type_offre_emploi'); // On récupère tout les type d'offre existant
			echo $form->dropDownList($model,'type_offre_emploi',$static_type + $typeOffre, array('class'=>'menu_roulant')); // On affiche une liste déroulante de toutes les offres
		?>
	
		<?php
			//Recherche par SECTEUR
			//-->On ajoute l'option "Sélectionner pour la liste"
			$static_secteur = array('' => Yii::t('', 'Sélectionner le secteur'));
			$secteurOffre = CHtml::listData($tabEntreprise,'secteur_activite_entreprise', 'secteur_activite_entreprise'); // On récupère tout les secteur d'offre existant
			echo $form->dropDownList($entreprise,'secteur_activite_entreprise',$static_secteur + $secteurOffre, array('class'=>'menu_roulant')); // On affiche une liste déroulante de tout les secteur d'activité
		?>
	
	</div>
	<div id='div_rechercher'>
		<?php
			// Button d'envoi
			echo CHtml::submitButton('Rechercher',array('class'=>'btn btn-success','id'=>'btn_rechercher'));

		$this->endWidget();
 		?>
 	</div>

</div>


<!-- Fomulaire avec le bouton de l'ajout du CV -->
<div class="row">
	<?php
		//Début du form
		$form=$this->beginWidget('CActiveForm',
			array(
				'action'=>Yii::app()->createUrl('employe/choixAjoutCV'),
			)
		);
		//Début du form
		$form=$this->beginWidget('CActiveForm',
			array(
				'action'=>Yii::app()->createUrl('offreEmploi/recherche') ,
			)
		);
	?>

		<!-- Bouton d'ajout du CV -->
		<?php echo CHtml::submitButton('Ajouter mon CV',array('class'=>'btn btn-success ','id'=>'btn_cv'));
		?>
		<!-- Bouton pour postuler -->
		<?php echo CHtml::submitButton('Postuler à une annonce en un seul click !',array('class'=>'btn btn-success','id'=>'btn_postuler')); ?>

	<?php 
	$this->endWidget(); 
	$this->endWidget(); ?>
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

		echo "<div class='row' id='row_infos'>".CHtml::submitButton('Voir mes informations personnelles !',array('class'=>'btn_page btn btn-success','id'=>'btn_infos'))."</div>";

	$this->endWidget();
	echo "</div>";
}
?>

	