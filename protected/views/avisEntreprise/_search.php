<?php
/* @var $this AvisEntrepriseController */
/* @var $model AvisEntreprise */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_avis_entreprise'); ?>
		<?php echo $form->textField($model,'id_avis_entreprise'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'note_generale_avis_entreprise'); ?>
		<?php echo $form->textField($model,'note_generale_avis_entreprise'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'commentaire_avis_entreprise'); ?>
		<?php echo $form->textField($model,'commentaire_avis_entreprise',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_entreprise'); ?>
		<?php echo $form->textField($model,'id_entreprise'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_utilisateur'); ?>
		<?php echo $form->textField($model,'id_utilisateur'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->