<?php
/* @var $this PostulerController */
/* @var $model Postuler */

$this->breadcrumbs=array(
	'Postulers'=>array('index'),
	$model->id_postuler=>array('view','id'=>$model->id_postuler),
	'Update',
);

$this->menu=array(
	array('label'=>'List Postuler', 'url'=>array('index')),
	array('label'=>'Create Postuler', 'url'=>array('create')),
	array('label'=>'View Postuler', 'url'=>array('view', 'id'=>$model->id_postuler)),
	array('label'=>'Manage Postuler', 'url'=>array('admin')),
);
?>

<h1>Update Postuler <?php echo $model->id_postuler; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>