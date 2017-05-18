
<div class="form form-upload-cv">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id' => 'employe-upload-cv-form',
	'action' => Yii::app()->createUrl( 'Employe/UploadTmpCV' ),
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
	'enableAjaxValidation' => false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div clas="row upload-input">
		<?php echo $form->fileField($model, 'cv_pdf'); ?>
		<?php echo $form->error($model, 'cv_pdf'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton("Ajouter CV", array( 'class' => 'btn-upload-cv' ) ); ?>
	</div>

	<div class="div-load-cv">
		<p>Votre CV est en cours de traitement</p>
		<div class="loader-upload-cv">Loading...</div>
	</div>
	

<?php $this->endWidget(); ?>

</div><!-- form -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
	$('#employe-upload-cv-form').on('submit', function(e){
		e.preventDefault();
		if( $('#Employe_cv_pdf').val() != "" )
		{
			$('.div-load-cv').show();
			this.submit();
		}

	});
</script>

