<?php
/* @var $this CvController */
/* @var $model Cv */

$this->breadcrumbs=array(
	'Cvs'=>array('index'),
	$model->id_CV=>array('view','id'=>$model->id_CV),
	'Update',
);

$this->menu=array(
	array('label'=>'List Cv', 'url'=>array('index')),
	array('label'=>'Create Cv', 'url'=>array('create')),
	array('label'=>'View Cv', 'url'=>array('view', 'id'=>$model->id_CV)),
	array('label'=>'Manage Cv', 'url'=>array('admin')),
);
?>

<h1>Update Cv <?php echo $model->id_CV; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>