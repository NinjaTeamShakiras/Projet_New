<?php
/* @var $this AdresseController */
/* @var $model Adresse */

$this->breadcrumbs=array(
	'Adresses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Adresse', 'url'=>array('index')),
	array('label'=>'Manage Adresse', 'url'=>array('admin')),
);
?>

<h1>Create Adresse</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>