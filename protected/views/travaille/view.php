<?php
/* @var $this TravailleController */
/* @var $model Travaille */

$this->breadcrumbs=array(
	'Travailles'=>array('index'),
	$model->id_travaille,
);

$this->menu=array(
	array('label'=>'List Travaille', 'url'=>array('index')),
	array('label'=>'Create Travaille', 'url'=>array('create')),
	array('label'=>'Update Travaille', 'url'=>array('update', 'id'=>$model->id_travaille)),
	array('label'=>'Delete Travaille', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_travaille),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Travaille', 'url'=>array('admin')),
);
?>

<h1>View Travaille #<?php echo $model->id_travaille; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_travaille',
		'date_debut_contrat',
		'date_fin_contrat',
		'duree_contrat',
		'id_employe',
		'id_entreprise',
	),
)); ?>
