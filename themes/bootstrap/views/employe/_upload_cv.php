<?php
/* @var $this EmployeController */
/* @var $model Employe */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id' => 'employe-upload-cv-form',
	'action' => Yii::app()->createUrl( 'Employe/UploadCV', array( 'id_int' => $model->id_employe ) ),
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
	'enableAjaxValidation' => false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div clas="row">
		<?php echo $form->labelEx($model, 'cv_pdf'); ?>
		<?php echo $form->fileField($model, 'cv_pdf'); ?>
		<?php echo $form->error($model, 'cv_pdf'); ?>
	</div>	

	



	<div class="row buttons">
		<?php echo CHtml::submitButton("Ajouter CV"); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->