<?php
/* @var $this CompetencesCvController */
/* @var $model CompetencesCv */

$this->breadcrumbs=array(
	'Competences Cvs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CompetencesCv', 'url'=>array('index')),
	array('label'=>'Manage CompetencesCv', 'url'=>array('admin')),
);
?>

<h1>Create CompetencesCv</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>