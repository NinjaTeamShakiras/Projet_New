<?php
/* @var $this AvisEmployeController */
/* @var $model AvisEmploye */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_avis_employe'); ?>
		<?php echo $form->textField($model,'id_avis_employe'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'note_generale_avis_employe'); ?>
		<?php echo $form->textField($model,'note_generale_avis_employe'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_creation'); ?>
		<?php echo $form->textField($model,'date_creation'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nb_signalements'); ?>
		<?php echo $form->textField($model,'nb_signalements'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_employe'); ?>
		<?php echo $form->textField($model,'id_employe'); ?>
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