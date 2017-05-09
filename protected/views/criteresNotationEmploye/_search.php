<?php
/* @var $this CriteresNotationEmployeController */
/* @var $model CriteresNotationEmploye */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_critere_notation_employe'); ?>
		<?php echo $form->textField($model,'id_critere_notation_employe'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nom_critere_employe'); ?>
		<?php echo $form->textField($model,'nom_critere_employe',array('size'=>60,'maxlength'=>350)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'critere_note_employe'); ?>
		<?php echo $form->textField($model,'critere_note_employe'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description_critere_employe'); ?>
		<?php echo $form->textField($model,'description_critere_employe',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->