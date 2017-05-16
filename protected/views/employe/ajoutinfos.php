<?php $image = CHtml::image(Yii::app()->request->baseUrl.'/images/icone_prozzl.png','Image accueil');
 
      echo CHtml::link($image,array('site/index','id'=> 'accueil')); ?>

<!-- On affiche les messages de confirmation d'ajout d'infos -->
<?php echo Yii::app()->user->getFlash('success_ajout_formation'); ?>
<?php echo Yii::app()->user->getFlash('success_ajout_competence'); ?>
<?php echo Yii::app()->user->getFlash('success_ajout_exp'); ?>	


<div class="wide form">
	<?php
		$user = Utilisateur::model()->FindByAttributes(array("mail"=>Yii::app()->user->getID()));
		$formation= formation::model();

		$form=$this->beginWidget('CActiveForm',array(
			'id'=>'infos-form',
			'action'=>Yii::app()->createUrl('employe/ajoutFormation'),
			'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
		));
	?>

	<h1>Formations</h1>

	<div class="row">
		<?php echo $form->labelEx($formation,'intitule_formation'); ?>
		<?php echo $form->textfield($formation,'intitule_formation'); ?>
		<?php echo $form->error($formation,'intitule_formation'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($formation,'etablissement_formation'); ?>
		<?php echo $form->textfield($formation,'etablissement_formation'); ?>
		<?php echo $form->error($formation,'etablissement_formation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($formation,'diplome_formation'); ?>
		<?php echo $form->textfield($formation,'diplome_formation'); ?>
		<?php echo $form->error($formation,'diplome_formation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($formation,'date_debut_formation'); ?>
		<?php echo $form->textfield($formation,'date_debut_formation'); ?>
		<?php echo $form->error($formation,'date_debut_formation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($formation,'date_fin_formation'); ?>
		<?php echo $form->textfield($formation,'date_fin_formation'); ?>
		<?php echo $form->error($formation,'date_fin_formation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($formation,'description_formation'); ?>
		<?php echo $form->textarea($formation,'description_formation'); ?>
		<?php echo $form->error($formation,'description_formation'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::submitbutton("Ajouter une école / formation",array('name' => 'btnajoutformation')); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>		


<div class="wide form">
	<?php
		$experiencePro= ExperiencePro::model();

		$form=$this->beginWidget('CActiveForm',array(
			'id'=>'infos-form',
			'action'=>Yii::app()->createUrl('employe/ajoutExpPro'),
			'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
		));
	?>

	<h1>Experiences Pros</h1>

	<div class="row">
		<?php echo $form->labelEx($experiencePro,'intitule_experience'); ?>
		<?php echo $form->textfield($experiencePro,'intitule_experience'); ?>
		<?php echo $form->error($experiencePro,'intitule_experience'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($experiencePro,'entreprise_experience'); ?>
		<?php echo $form->textfield($experiencePro,'entreprise_experience'); ?>
		<?php echo $form->error($experiencePro,'entreprise_experience'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($experiencePro,'date_debut_experience'); ?>
		<?php echo $form->textfield($experiencePro,'date_debut_experience'); ?>
		<?php echo $form->error($experiencePro,'date_debut_experience'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($experiencePro,'date_fin_experience'); ?>
		<?php echo $form->textfield($experiencePro,'date_fin_experience'); ?>
		<?php echo $form->error($experiencePro,'date_fin_experience'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($experiencePro,'description_experience'); ?>
		<?php echo $form->textarea($experiencePro,'description_experience'); ?>
		<?php echo $form->error($experiencePro,'description_experience'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::submitbutton("Ajouter une expérience professionnelle",array('name' => 'btnajoutexppro')); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>	


<div class = "wide form">
	<?php

		$competence= competence::model();

		$form=$this->beginWidget('CActiveForm',array(
			'id'=>'infos-form',
			'action'=>Yii::app()->createUrl('employe/ajoutCompetences'),
			'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
		));
	?>		

	<h1>Competences</h1>
		
	<div class="row">
		<?php echo $form->labelEx($competence,'intitule_competence'); ?>
		<?php echo $form->textfield($competence,'intitule_competence'); ?>
		<?php echo $form->error($competence,'intitule_competence'); ?>
	</div>


	<div class="row">
		<?php echo $form->radioButtonList($competence,'niveau_competence',array('1','2','3','4','5'),array('separator' => ' ')); ?>
		<?php echo $form->error($competence,'niveau_competence'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::submitbutton("Ajouter une competence",array('name' => 'btnajoutcompetence')); ?>
	</div>

	<?php $this->endWidget(); ?>
</div>	

	<div class="row">
		<?php echo CHtml::button("Retour à la page précédente",array('name' => 'retour', 'submit'=>array('employe/view', 'id'=>$user->id_employe))); ?>
	</div>

