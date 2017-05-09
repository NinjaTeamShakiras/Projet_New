<?php
/* @var $this EntrepriseAvisCritereController */
/* @var $model EntrepriseAvisCritere */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_entreprise_avis'); ?>
		<?php echo $form->textField($model,'id_entreprise_avis'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'note_entreprise_critere'); ?>
		<?php echo $form->textField($model,'note_entreprise_critere'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_critere_notation_entreprise'); ?>
		<?php echo $form->textField($model,'id_critere_notation_entreprise'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_avis_entreprise'); ?>
		<?php echo $form->textField($model,'id_avis_entreprise'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'commentaire_evaluation_critere'); ?>
		<?php echo $form->textField($model,'commentaire_evaluation_critere',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->