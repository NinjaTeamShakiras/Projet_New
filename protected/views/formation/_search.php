<?php
/* @var $this FormationController */
/* @var $model Formation */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_formation'); ?>
		<?php echo $form->textField($model,'id_formation'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_debut_formation'); ?>
		<?php echo $form->textField($model,'date_debut_formation'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_fin_formation'); ?>
		<?php echo $form->textField($model,'date_fin_formation'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'intitule_formation'); ?>
		<?php echo $form->textField($model,'intitule_formation',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'etablissement_formation'); ?>
		<?php echo $form->textField($model,'etablissement_formation',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'diplome_formation'); ?>
		<?php echo $form->textField($model,'diplome_formation',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description_formation'); ?>
		<?php echo $form->textField($model,'description_formation',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_employe'); ?>
		<?php echo $form->textField($model,'id_employe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->