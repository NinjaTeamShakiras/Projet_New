<h1>Experience professionelle</h1>

<div class="from">
<?php

	$experiencePro= experiencePro::model();

	$form=$this->beginWidget('CActiveForm',array(
	'id'=>'experience-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		),
	));
?>

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

	<div class="row buttons">
		<?php echo CHtml::submitbutton("Entrer l'experience"); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
