<h1>Competences</h1>

<div class="from">
<?php

	$competence= competence::model();

	$form=$this->beginWidget('CActiveForm',array(
	'id'=>'competence-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		),
	));
?>

	<div class="row">
		<?php echo $form->labelEx($competence,'intitule_competence'); ?>
		<?php echo $form->textfield($competence,'intitule_competence'); ?>
		<?php echo $form->error($competence,'intitule_competence'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($competence,'niveau_competence'); ?>
		<?php echo $form->textfield($competence,'niveau_competence'); ?>
		<?php echo $form->error($competence,'niveau_competence'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitbutton("Entrer les competences"); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
