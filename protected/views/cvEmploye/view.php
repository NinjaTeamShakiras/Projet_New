<?php
/* @var $this CvEmployeController */
/* @var $model CvEmploye */

$this->breadcrumbs=array(
	'Cv Employes'=>array('index'),
	$model->id_cv_employe,
);

$this->menu=array(
	array('label'=>'List CvEmploye', 'url'=>array('index')),
	array('label'=>'Create CvEmploye', 'url'=>array('create')),
	array('label'=>'Update CvEmploye', 'url'=>array('update', 'id'=>$model->id_cv_employe)),
	array('label'=>'Delete CvEmploye', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_cv_employe),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CvEmploye', 'url'=>array('admin')),
);
?>

<h1>View CvEmploye #<?php echo $model->id_cv_employe; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_cv_employe',
		'niveau_competence',
		'id_employe',
		'id_competence',
		'id_cv',
	),
)); ?>
