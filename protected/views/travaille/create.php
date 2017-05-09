<?php
/* @var $this TravailleController */
/* @var $model Travaille */

$this->breadcrumbs=array(
	'Travailles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Travaille', 'url'=>array('index')),
	array('label'=>'Manage Travaille', 'url'=>array('admin')),
);
?>

<h1>Create Travaille</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>