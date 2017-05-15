<?php
/* @var $this EmployeController */
/* @var $model Employe */


/* -- Override de jquery avec la version 3.0 -- */
$cs = Yii::app()->clientScript;
$cs->scriptMap = array(
'jquery.js' => Yii::app()->request->baseUrl.'/js/jquery.js',
);
$cs->registerCoreScript('jquery');
/* -- Utilisation du script -- */
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/employe_view.js');
?>

<?php $image = CHtml::image(Yii::app()->request->baseUrl.'/images/icone_prozzl.png',
      'Image accueil');
 
      echo CHtml::link($image,array('site/index','id'=> 'accueil')); ?>

<h3 id='titre'>Mes informations personelles</h3>

<?php

	//On récupère l'utilisateur correspondant à l'employé
	$user = Utilisateur::model()->FindByAttributes(array('id_employe'=>$model->id_employe));
	//On récupère l'adresse correspondant à l'employé
	$adresse = Adresse::model()->FindByAttributes(array('id_adresse'=>$user->id_adresse));

	//Si l'adresse est nulle on dit qu'elle n'est pas renseignée
	if($adresse == null){
		$adresse = "Non renseignée";
	}
	//Sinon, on définit une variable adresse récupérée depuis model Adresse
	else
	{
		$adresse = $adresse->rue.", ".$adresse->code_postal." ".$adresse->ville;
	}

	//On fait pareil pour le site Web
	if($user->site_web == null)
	{
		$user->site_web = "Non renseigné";
	}

	//On fait pareil pour les téléphones
	if($user->telephone == null)
	{
		$user->telephone = "Non renseigné";
	}

	if($user->telephone2 == null)
	{
		$user->telephone2 = "Non renseigné";
	}

	//On définit si l'employé cherche un travail ou non
	if($model->employe_travaille == null)
	{
		$model->employe_travaille = "Non renseigné";
	}
	else if($model->employe_travaille == 1)
	{
		$model->employe_travaille = "Non";
	}
	else if($model->employe_travaille == 0)
	{
		$model->employe_travaille = "Oui";
	}
?>

	
<!-- Affichage des infos persos -->	
<div class="form">	

	<?php
		//Début du formulaire de vue des infos persos
		$form=$this->beginWidget('CActiveForm',
			array(
				'action'=>Yii::app()->createUrl('employe/update', array('id'=>$model->id_employe)),
			)
		);

		echo "<div class='row' id='champ-infos-persos'>";
		echo "<p>Nom : <label>".$model->nom_employe." ".$model->prenom_employe."</label></p>";
		echo "<p>Date de naissance : <label>".$model->date_naissance_employe."</label</p>";
		echo "<p>Adressse : <label>".$adresse."</label></p>";
		echo "<p>Téléphone : <label>".$user->telephone."</label></p>";
		echo "<p>Autre téléphone : <label>".$user->telephone2."</label></p>";
		echo "<p>Adresse mail : <label>".$user->mail."</label></p>";
		echo "<p>Site WEB : <label>".$user->site_web."</label></p>";
		echo "<p>Recherche un travail : <label>".$model->employe_travaille."</label></p>";
		echo "</div>";
	?>

	<div class="row">
		<?php echo Chtml::submitButton('Mettre à jour mes informations personelles',array('id'=>'btn-maj-infos')); ?>
	</div>

	<?php $this->endWidget();?>	
</div>	
<!-- Fin des infos persos -->



<h3 id='titre'>Mes informations complémentaires</h3>

<?php
	//Récupération des modèles d'informations complémentaires
	$competences = Competence::model()->FindAll("id_employe =".$model->id_employe);
	$formations = Formation::model()->FindAll("id_employe =".$model->id_employe);
	$exp_pros = ExperiencePro::model()->FindAll("id_employe =".$model->id_employe);
?>

<div class="form">

	<?php
	//Début du formulaire de vue des infos complémentaires
		$form=$this->beginWidget('CActiveForm',
			array(
				'action'=>Yii::app()->createUrl('employe/ajoutInfos'),
			)
		);
	?>	
	<div id='info-comp'>

	<p>Mes formations / Parcours scolaire</p>

	<div class="row">
		<?php
			foreach($formations as $formation)
			{
				echo Yii::app()->user->getFlash('success_maj_formation');
				echo "<p>Date de début de la formation : <label>".$this->changeDateNaissance($formation->date_debut_formation)."</label></p>";
				echo "<p>Date de fin de la formation : <label>".$this->changeDateNaissance($formation->date_fin_formation)."</label></p>";
				echo "<p>Intitulé de la formation : <label>".$formation->intitule_formation."</label></p>";
				echo "<p>Etablissement de la formation : <label>".$formation->etablissement_formation."</label></p>";
				echo "<p>Diplome obtenu : <label>".$formation->diplome_formation."</label></p>";
				echo "<p>Description de la formation : <label>".$formation->description_formation."</label></p>";
				echo CHtml::link('Mettre à jour cette formation',array('Formation/update', 'id'=>$formation->id_formation));
				echo CHtml::link('Supprimer cette formation',array('Formation/delete', 'id'=>$formation->id_formation)); 
			}
		?>
	</div>

	<p>Mes expériences professionnelles</p>

	<div class="row">
		<?php
			foreach($exp_pros as $exp_pro)
			{

				echo Yii::app()->user->getFlash('success_maj_exp');
				echo "<p>Date de début de l'expérience pro : <label>".$this->changeDateNaissance($exp_pro->date_debut_experience)."</label></p>";
				echo "<p>Date de fin de l'expérience pro : <label>".$this->changeDateNaissance($exp_pro->date_fin_experience)."</label></p>";
				echo "<p>Intitulé de l'expérience pro : <label>".$exp_pro->intitule_experience."</label></p>";
				echo "<p>Entreprise dans laquelle vous êtiez salarié : <label>".$exp_pro->entreprise_experience."</label></p>";
				echo "<p>Description de l'expérience pro : <label>".$exp_pro->description_experience."</label>	</p>";
				echo CHtml::link('Mettre à jour cette expérience',array('ExperiencePro/update', 'id'=>$exp_pro->id_experience));
				echo CHtml::link('Supprimer cette expérience',array('ExperiencePro/delete', 'id'=>$exp_pro->id_experience)); 

			}
		?>	
	</div>

	<p>Mes compétences</p>

	<div class="row">
		<ul>
		<?php
			foreach($competences as $competence)
			{
					echo Yii::app()->user->getFlash('success_maj_competence');
				echo "<li>".$competence->intitule_competence."<label> Niveau ".$competence->niveau_competence."/5</label></li>";
				echo CHtml::link('Mettre à jour cette compétence',array('Competence/update', 'id'=>$competence->id_competence));
				echo " ";
				echo CHtml::link('Supprimer cette compétence',array('Competence/delete', 'id'=>$competence->id_competence)); 
			}
		?>
		</ul>
	</div>

	<div class="row">
		<?php echo CHtml::submitButton('Ajouter de nouvelles informations complémentaires', array('name'=>'btnajout','id'=>'btn-maj-infos')); ?>

	</div>	

	<?php $this->endWidget();?>	
</div>


<?php 

	/* --- Page pour traiter le pdf --- */
	$this->renderPartial( 'cv_edit', array( 'model' => $model ) );
?>
