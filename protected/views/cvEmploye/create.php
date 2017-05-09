<?php
/* @var $this CvEmployeController */
/* @var $model CvEmploye */

$this->breadcrumbs=array(
	'Cv Employes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CvEmploye', 'url'=>array('index')),
	array('label'=>'Manage CvEmploye', 'url'=>array('admin')),
);
?>

<h1>Create CvEmploye</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>