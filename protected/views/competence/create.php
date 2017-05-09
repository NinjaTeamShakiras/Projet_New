<?php
/* @var $this CompetenceController */
/* @var $model Competence */

$this->breadcrumbs=array(
	'Competences'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Competence', 'url'=>array('index')),
	array('label'=>'Manage Competence', 'url'=>array('admin')),
);
?>

<h1>Create Competence</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>