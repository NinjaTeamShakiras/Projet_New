<?php
/* @var $this FormationController */
/* @var $model Formation */

$this->breadcrumbs=array(
	'Formations'=>array('index'),
	$model->id_formation,
);

$this->menu=array(
	array('label'=>'List Formation', 'url'=>array('index')),
	array('label'=>'Create Formation', 'url'=>array('create')),
	array('label'=>'Update Formation', 'url'=>array('update', 'id'=>$model->id_formation)),
	array('label'=>'Delete Formation', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_formation),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Formation', 'url'=>array('admin')),
);
?>

<h1>View Formation #<?php echo $model->id_formation; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_formation',
		'date_debut_formation',
		'date_fin_formation',
		'intitule_formation',
		'etablissement_formation',
		'diplome_formation',
		'description_formation',
		'id_employe',
	),
)); ?>
