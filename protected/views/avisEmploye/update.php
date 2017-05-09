<?php
/* @var $this AvisEmployeController */
/* @var $model AvisEmploye */

/*$this->breadcrumbs=array(
	'Avis Employes'=>array('index'),
	$model->id_avis_employe=>array('view','id'=>$model->id_avis_employe),
	'Update',
);

$this->menu=array(
	array('label'=>'List AvisEmploye', 'url'=>array('index')),
	array('label'=>'Create AvisEmploye', 'url'=>array('create')),
	array('label'=>'View AvisEmploye', 'url'=>array('view', 'id'=>$model->id_avis_employe)),
	array('label'=>'Manage AvisEmploye', 'url'=>array('admin')),
);*/
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'avis-employe-form',
	'action' => Yii::app()->createUrl('avisEmploye/updateAvisEmploye'),
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>
	<?php 
		/* 			On affiche les criteres avec les valeurs			*/
		AvisEmploye::afficher_criteres_notation_with_parameters( $criteresAvis_layout );
	?>

	<div class="row hide">
		<?php 
		/*		On assigne une valeur à l'input 		*/
		$model->id_employe = intval( $_GET['id'] );
		echo $form->textField( $model,'id_employe', [ 'readonly' => true ] ); ?>
		<?php echo $form->error( $model,'id_employe' ); ?>
	</div>

	<div class="row hide">
		<?php 
		/*		On assigne une valeur à l'input 		*/
		$model->id_avis_employe = intval( $avisEmploye_layout->id_avis_employe );
		echo $form->textField( $model,'id_avis_employe', [ 'readonly' => true ] ); ?>
		<?php echo $form->error( $model,'id_avis_employe' ); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton( 'Modifier' ); ?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->