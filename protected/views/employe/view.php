<?php
/* @var $this EmployeController */
/* @var $model Employe */

$this->breadcrumbs=array(
	'Employes'=>array('index'),
	$model->id_employe,
);

$this->menu=array(
	array('label'=>'List Employe', 'url'=>array('index')),
	array('label'=>'Create Employe', 'url'=>array('create')),
	array('label'=>'Update Employe', 'url'=>array('update', 'id'=>$model->id_employe)),
	array('label'=>'Delete Employe', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_employe),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Employe', 'url'=>array('admin')),
);
?>

<h1>View Employe #<?php echo $model->id_employe; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_employe',
		'nom_employe',
		'prenom_employe',
		'date_naissance_employe',
		'employe_travaille',
	),
)); ?>
