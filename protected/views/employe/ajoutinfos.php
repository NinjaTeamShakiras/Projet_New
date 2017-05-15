<?php
//Override de jquery avec la version 3.0 
$cs = Yii::app()->clientScript;
$cs->scriptMap = array(
'jquery.js' => Yii::app()->request->baseUrl.'/js/jquery.js',
);
$cs->registerCoreScript('jquery');
//Appel du fichier js correspondant à la page
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/infoscomplementaires.js');
?>

<h1>Formations</h1>

<div class="from">
	<?php

	$formation= formation::model();
	$competence= competence::model();
	$experiencePro= experiencePro::model();

	$form=$this->beginWidget('CActiveForm',array(
		'id'=>'infos-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
			),
		));
		?>

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

		</div>
		<div class="row">
			<?php echo CHtml::submitbutton("Ajouter une competence",array('id' => 'btnajoutcompetence')); ?>
		</div>

		<div class="row buttons">
			<?php echo CHtml::submitbutton("Valider",array('name' => 'valider')); ?>
		</div>

		<?php $this->endWidget(); ?>
	</div>
