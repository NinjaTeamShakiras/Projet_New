<?php
/* @var $this FormationController */
/* @var $model Formation */

$this->breadcrumbs=array(
	'Formations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Formation', 'url'=>array('index')),
	array('label'=>'Manage Formation', 'url'=>array('admin')),
);
?>

<h1>Create Formation</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>