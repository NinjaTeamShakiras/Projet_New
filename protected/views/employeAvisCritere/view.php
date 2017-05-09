<?php
/* @var $this EmployeAvisCritereController */
/* @var $model EmployeAvisCritere */

$this->breadcrumbs=array(
	'Employe Avis Criteres'=>array('index'),
	$model->id_employe_avis,
);

$this->menu=array(
	array('label'=>'List EmployeAvisCritere', 'url'=>array('index')),
	array('label'=>'Create EmployeAvisCritere', 'url'=>array('create')),
	array('label'=>'Update EmployeAvisCritere', 'url'=>array('update', 'id'=>$model->id_employe_avis)),
	array('label'=>'Delete EmployeAvisCritere', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_employe_avis),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EmployeAvisCritere', 'url'=>array('admin')),
);
?>

<h1>View EmployeAvisCritere #<?php echo $model->id_employe_avis; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_employe_avis',
		'note_employe_avis',
		'id_entreprise',
		'id_critere_notation_employe',
		'id_avis_employe',
	),
)); ?>
