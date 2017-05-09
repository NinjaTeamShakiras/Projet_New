<?php
/* @var $this PostulerController */
/* @var $model Postuler */

$this->breadcrumbs=array(
	'Postulers'=>array('index'),
	$model->id_postuler,
);

$this->menu=array(
	array('label'=>'List Postuler', 'url'=>array('index')),
	array('label'=>'Create Postuler', 'url'=>array('create')),
	array('label'=>'Update Postuler', 'url'=>array('update', 'id'=>$model->id_postuler)),
	array('label'=>'Delete Postuler', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_postuler),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Postuler', 'url'=>array('admin')),
);
?>

<h1>View Postuler #<?php echo $model->id_postuler; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_postuler',
		'id_employe',
		'id_offre_emploi',
	),
)); ?>
