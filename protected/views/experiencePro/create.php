<?php
/* @var $this ExperienceProController */
/* @var $model ExperiencePro */

$this->breadcrumbs=array(
	'Experience Pros'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ExperiencePro', 'url'=>array('index')),
	array('label'=>'Manage ExperiencePro', 'url'=>array('admin')),
);
?>

<h1>Create ExperiencePro</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>