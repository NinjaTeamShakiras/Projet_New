<?php
/* @var $this AvisEmployeController */
/* @var $model AvisEmploye */

$this->breadcrumbs=array(
	'Avis Employes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AvisEmploye', 'url'=>array('index')),
	array('label'=>'Manage AvisEmploye', 'url'=>array('admin')),
);
?>

<h1>Create AvisEmploye</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>