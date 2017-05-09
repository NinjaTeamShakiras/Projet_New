<?php
/* @var $this AvisEntrepriseController */
/* @var $model AvisEntreprise */

/*$this->breadcrumbs=array(
	'Avis Entreprises'=>array('index'),
	$model->id_avis_entreprise=>array('view','id'=>$model->id_avis_entreprise),
	'Update',
);*/
?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'avis-entreprise-update-form',
	'action' => Yii::app()->createUrl('avisEntreprise/update'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>
	<?php 
		/* 			On affiche les criteres avec les valeurs			*/
		AvisEntreprise::afficher_criteres_notation_with_parameters( $criteresAvis_layout );
	?>

	<div class="row hide">
		<?php 
		/*		On assigne une valeur à l'input 		*/
		$model->id_entreprise = intval( $_GET['id'] );
		echo $form->textField( $model,'id_entreprise', [ 'readonly' => true ] ); ?>
		<?php echo $form->error( $model,'id_entreprise' ); ?>
	</div>

	<div class="row hide">
		<?php 
		/*		On assigne une valeur à l'input 		*/
		$model->id_avis_entreprise = intval( $avisEntreprise_layout->id_avis_entreprise );
		echo $form->textField( $model,'id_avis_entreprise', [ 'readonly' => true ] ); ?>
		<?php echo $form->error( $model,'id_avis_entreprise' ); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton( 'Modifier' ); ?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->