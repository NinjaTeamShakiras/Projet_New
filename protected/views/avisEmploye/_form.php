<?php
/* @var $this AvisEmployeController */
/* @var $model AvisEmploye */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'avis-employe-form',
	'action' => Yii::app()->createUrl('avisEmploye/CreerAvisEmploye'),
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
	<?php 
		AvisEmploye::afficher_criteres_notation_employe();
	?>

	<div class="row hide">
		<?php echo $form->labelEx($model,'id_employe'); ?>
		<?php 
		/*		On assigne une valeur à l'input 		*/
		$model->id_employe = intval( $_GET['id'] );
		echo $form->textField( $model,'id_employe', [ 'readonly' => true ] ); ?>
		<?php echo $form->error( $model,'id_employe' ); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton( 'Envoyer mon avis' ); ?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->