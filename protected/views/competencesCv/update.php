<?php
/* @var $this CompetencesCvController */
/* @var $model CompetencesCv */

$this->breadcrumbs=array(
	'Competences Cvs'=>array('index'),
	$model->id_competence=>array('view','id'=>$model->id_competence),
	'Update',
);

$this->menu=array(
	array('label'=>'List CompetencesCv', 'url'=>array('index')),
	array('label'=>'Create CompetencesCv', 'url'=>array('create')),
	array('label'=>'View CompetencesCv', 'url'=>array('view', 'id'=>$model->id_competence)),
	array('label'=>'Manage CompetencesCv', 'url'=>array('admin')),
);
?>

<h1>Update CompetencesCv <?php echo $model->id_competence; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>