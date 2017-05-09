<?php
/* @var $this CompetencesCvController */
/* @var $model CompetencesCv */

$this->breadcrumbs=array(
	'Competences Cvs'=>array('index'),
	$model->id_competence,
);

$this->menu=array(
	array('label'=>'List CompetencesCv', 'url'=>array('index')),
	array('label'=>'Create CompetencesCv', 'url'=>array('create')),
	array('label'=>'Update CompetencesCv', 'url'=>array('update', 'id'=>$model->id_competence)),
	array('label'=>'Delete CompetencesCv', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_competence),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CompetencesCv', 'url'=>array('admin')),
);
?>

<h1>View CompetencesCv #<?php echo $model->id_competence; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_competence',
		'nom_competence',
	),
)); ?>
