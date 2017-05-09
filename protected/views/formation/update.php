<?php
/* @var $this FormationController */
/* @var $model Formation */

$this->breadcrumbs=array(
	'Formations'=>array('index'),
	$model->id_formation=>array('view','id'=>$model->id_formation),
	'Update',
);

$this->menu=array(
	array('label'=>'List Formation', 'url'=>array('index')),
	array('label'=>'Create Formation', 'url'=>array('create')),
	array('label'=>'View Formation', 'url'=>array('view', 'id'=>$model->id_formation)),
	array('label'=>'Manage Formation', 'url'=>array('admin')),
);
?>

<h1>Update Formation <?php echo $model->id_formation; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>