<h1>Formations</h1>

<div class="from">
<?php

	$formation= formation::model();

	$form=$this->beginWidget('CActiveForm',array(
	'id'=>'formation-form',
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

	<div class="row buttons">
		<?php echo CHtml::submitbutton('Entrer la formation'); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
