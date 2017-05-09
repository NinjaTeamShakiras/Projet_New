<?php
/* @var $this AdresseController */
/* @var $model Adresse */

$this->breadcrumbs=array(
	'Adresses'=>array('index'),
	$model->id_adresse=>array('view','id'=>$model->id_adresse),
	'Update',
);

$this->menu=array(
	array('label'=>'List Adresse', 'url'=>array('index')),
	array('label'=>'Create Adresse', 'url'=>array('create')),
	array('label'=>'View Adresse', 'url'=>array('view', 'id'=>$model->id_adresse)),
	array('label'=>'Manage Adresse', 'url'=>array('admin')),
);
?>

<h1>Update Adresse <?php echo $model->id_adresse; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>