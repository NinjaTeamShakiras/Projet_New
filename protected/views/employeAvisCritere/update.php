<?php
/* @var $this EmployeAvisCritereController */
/* @var $model EmployeAvisCritere */

$this->breadcrumbs=array(
	'Employe Avis Criteres'=>array('index'),
	$model->id_employe_avis=>array('view','id'=>$model->id_employe_avis),
	'Update',
);

$this->menu=array(
	array('label'=>'List EmployeAvisCritere', 'url'=>array('index')),
	array('label'=>'Create EmployeAvisCritere', 'url'=>array('create')),
	array('label'=>'View EmployeAvisCritere', 'url'=>array('view', 'id'=>$model->id_employe_avis)),
	array('label'=>'Manage EmployeAvisCritere', 'url'=>array('admin')),
);
?>

<h1>Update EmployeAvisCritere <?php echo $model->id_employe_avis; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>