<?php
/* @var $this AvisEntrepriseController */
/* @var $model AvisEntreprise */
/* @var $form CActiveForm */
?>

<div class="form">


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'avis-entreprise-form',
	'action' => Yii::app()->createUrl('avisEntreprise/create'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation' => true,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php 
		AvisEntreprise::afficher_criteres_notation_entreprise();
	?>

	<div class="row hide">
		<?php echo $form->labelEx($model,'id_entreprise'); ?>
		<?php 
		/*		On assigne une valeur à l'input 		*/
		$model->id_entreprise = intval( $_GET['id'] );
		echo $form->textField( $model,'id_entreprise', [ 'readonly' => true ] ); ?>
		<?php echo $form->error( $model,'id_entreprise' ); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton( 'Envoyer mon avis' ); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->