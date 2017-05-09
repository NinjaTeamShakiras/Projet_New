<?php
/* @var $this CvController */
/* @var $model Cv */

$this->breadcrumbs=array(
	'Cvs'=>array('index'),
	$model->id_CV,
);

$this->menu=array(
	array('label'=>'List Cv', 'url'=>array('index')),
	array('label'=>'Create Cv', 'url'=>array('create')),
	array('label'=>'Update Cv', 'url'=>array('update', 'id'=>$model->id_CV)),
	array('label'=>'Delete Cv', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_CV),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Cv', 'url'=>array('admin')),
);
?>

<h1>View Cv #<?php echo $model->id_CV; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_CV',
	),
)); ?>
