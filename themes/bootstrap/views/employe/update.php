<?php
/* @var $this EmployeController */
/* @var $model Employe */

$this->breadcrumbs=array(
	'Employes'=>array('index'),
	$model->id_employe=>array('view','id'=>$model->id_employe),
	'Update',
);

$this->menu=array(
	array('label'=>'List Employe', 'url'=>array('index')),
	array('label'=>'Create Employe', 'url'=>array('create')),
	array('label'=>'View Employe', 'url'=>array('view', 'id'=>$model->id_employe)),
	array('label'=>'Manage Employe', 'url'=>array('admin')),
);
?>

<h1>Update Employe <?php echo $model->id_employe; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>