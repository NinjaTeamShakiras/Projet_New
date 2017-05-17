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

<div class='arriere-plan-employe'>

<?php $image = CHtml::image(Yii::app()->request->baseUrl.'/images/prozzl_logo.png',
      'Image accueil');
 
      echo CHtml::link($image,array('employe/index','id'=> $utilisateur->id_employe)); ?>


<!--  MENU 	-->
<?php
//Si l'utilisateur est connecté
if($utilisateur != null)
{
	?>
	<div class="btn-group" style="float: right;">
		<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenu1" aria-haspopup="true" aria-expanded="true">
		Menu
		<span class="caret"></span>
		</button>
		<ul class="ddropdown-menu dropdown-menu-right">
			<li>
				<a href="index.php?r=employe/view&id=<?php echo $utilisateur->id_employe;?>" title="Mon profil">
				Mon Profil
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
				<a href="index.php?r=OffreEmploi/mesOffres" title="Mes candidatures">
				Mes candidatures
				</a>
			</li>
		</ul>
	</div>
	<?php
}
else
{
	?>
	<div class="btn-group" style="float: right;">
		<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenu1" aria-haspopup="true" aria-expanded="true">
			Menu
	   	<span class="caret"></span>
	   	</button>
		<ul class="dropdown-menu dropdown-menu-right">
			<li>
				<a href="index.php?r=employe/view&id=<?php echo $utilisateur->id_employe;?>" title="Mon profil">
				Mon Profil
				</a>
			</li>
			<li>
				<a href="index.php?r=OffreEmploi/index" title="Mon candidatures">
				Mes Candidatures
				</a>
			</li>
		</ul>
	</div>
	<?php
}
?>

<div class='filtre-vert'>
	
<!-- Formulaire de recherche d'une offre d'emploi -->
<div class='row'>
	<?php echo "<h3 id='phrase-nb-offres'>Trouver les offres qui vous correspondent parmis ".$nombreOffre." offres</h3>"; ?>
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

	<div id="div-champs-recherche">
			<!-- Recherche d'un poste (textfield + dropdownlist+ bouton submit) -->	
			<?php
				//Recherche par POSTE
				echo $form->textField(
					$model,'poste_offre_emploi', array(	
						'class' => 'champs-recherche autocomplete-find-offreEmploi',
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
					'class' => 'champs-recherche autocomplete-find-offreEmploi',
					'url_data_auto' => Yii::app()->createUrl('offreEmploi/GetAllLieuJSON'),
					'size' => 45,
					'maxlength' => 30,
					'placeholder' => 'Rechercher par lieu',
				)
			);
		?>
	</div>
	
	<div id="div-champs-selection">
		<?php
			//Recherche par TYPE DE CONTRAT (liste déroulante)
			//-->On ajoute l'option "Sélectionner pour la liste"
			$static_type = array('' => Yii::t('', 'Sélectionner le type de contrat'));
			$typeOffre = CHtml::listData($tabOffre,'type_offre_emploi', 'type_offre_emploi'); // On récupère tout les type d'offre existant
			echo $form->dropDownList($model,'type_offre_emploi',$static_type + $typeOffre, array('class'=>'menu_roulant-selection')); // On affiche une liste déroulante de toutes les offres
		?>
	
		<?php
			//Recherche par SECTEUR
			//-->On ajoute l'option "Sélectionner pour la liste"
			$static_secteur = array('' => Yii::t('', 'Sélectionner le secteur'));
			$secteurOffre = CHtml::listData($tabEntreprise,'secteur_activite_entreprise', 'secteur_activite_entreprise'); // On récupère tout les secteur d'offre existant
			echo $form->dropDownList($entreprise,'secteur_activite_entreprise',$static_secteur + $secteurOffre, array('class'=>'menu_roulant-selection')); // On affiche une liste déroulante de tout les secteur d'activité
		?>
	
	</div>
	<div id='div-btn-rechercher'>
		<?php
			// Button d'envoi
			echo CHtml::submitButton('Rechercher',array('class'=>'btn btn-success','id'=>'btn_rechercher'));

		$this->endWidget();
 		?>
 	</div>

</div>

<?php
/*
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

?>
</div>
*/
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

		echo "<div class='row' id='div_infos'>".CHtml::submitButton('Voir mes informations personnelles !',array('class'=>'btn_infos btn '))."</div>";

	$this->endWidget();
	echo "</div>";
}
?>
</div>

	