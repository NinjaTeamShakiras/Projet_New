<?php
/* @var $this CompetenceController */
/* @var $model Competence */

$this->breadcrumbs=array(
	'Competences'=>array('index'),
	$model->id_competence,
);

$this->menu=array(
	array('label'=>'List Competence', 'url'=>array('index')),
	array('label'=>'Create Competence', 'url'=>array('create')),
	array('label'=>'Update Competence', 'url'=>array('update', 'id'=>$model->id_competence)),
	array('label'=>'Delete Competence', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_competence),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Competence', 'url'=>array('admin')),
);
?>

<h1>View Competence #<?php echo $model->id_competence; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_competence',
		'intitule_competance',
		'niveau_competence',
		'id_employe',
	),
)); ?>
