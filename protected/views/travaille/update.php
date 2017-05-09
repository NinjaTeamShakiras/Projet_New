<?php
/* @var $this TravailleController */
/* @var $model Travaille */

$this->breadcrumbs=array(
	'Travailles'=>array('index'),
	$model->id_travaille=>array('view','id'=>$model->id_travaille),
	'Update',
);

$this->menu=array(
	array('label'=>'List Travaille', 'url'=>array('index')),
	array('label'=>'Create Travaille', 'url'=>array('create')),
	array('label'=>'View Travaille', 'url'=>array('view', 'id'=>$model->id_travaille)),
	array('label'=>'Manage Travaille', 'url'=>array('admin')),
);
?>

<h1>Update Travaille <?php echo $model->id_travaille; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>