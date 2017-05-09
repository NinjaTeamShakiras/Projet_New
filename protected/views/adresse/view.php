<?php
/* @var $this AdresseController */
/* @var $model Adresse */

$this->breadcrumbs=array(
	'Adresses'=>array('index'),
	$model->id_adresse,
);

$this->menu=array(
	array('label'=>'List Adresse', 'url'=>array('index')),
	array('label'=>'Create Adresse', 'url'=>array('create')),
	array('label'=>'Update Adresse', 'url'=>array('update', 'id'=>$model->id_adresse)),
	array('label'=>'Delete Adresse', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_adresse),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Adresse', 'url'=>array('admin')),
);
?>

<h1>View Adresse #<?php echo $model->id_adresse; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_adresse',
		'rue',
		'ville',
		'code_postal',
	),
)); ?>
