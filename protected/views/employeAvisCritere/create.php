<?php
/* @var $this EmployeAvisCritereController */
/* @var $model EmployeAvisCritere */

$this->breadcrumbs=array(
	'Employe Avis Criteres'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EmployeAvisCritere', 'url'=>array('index')),
	array('label'=>'Manage EmployeAvisCritere', 'url'=>array('admin')),
);
?>

<h1>Create EmployeAvisCritere</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>