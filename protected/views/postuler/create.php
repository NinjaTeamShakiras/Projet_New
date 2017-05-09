<?php
/* @var $this PostulerController */
/* @var $model Postuler */

$this->breadcrumbs=array(
	'Postulers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Postuler', 'url'=>array('index')),
	array('label'=>'Manage Postuler', 'url'=>array('admin')),
);
?>

<h1>Create Postuler</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>