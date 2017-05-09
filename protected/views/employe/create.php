<?php
/* @var $this EmployeController */
/* @var $model Employe */

//$this->breadcrumbs=array(
//	'Employes'=>array('index'),
//	'Create',
//);

$this->menu=array(
	array('label'=>'List Employe', 'url'=>array('index')),
	array('label'=>'Manage Employe', 'url'=>array('admin')),
);
?>

<h1>Create Employe</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>