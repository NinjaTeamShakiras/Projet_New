<?php
/* @var $this CompetenceController */
/* @var $model Competence */

$this->breadcrumbs=array(
	'Competences'=>array('index'),
	$model->id_competence=>array('view','id'=>$model->id_competence),
	'Update',
);

$this->menu=array(
	array('label'=>'List Competence', 'url'=>array('index')),
	array('label'=>'Create Competence', 'url'=>array('create')),
	array('label'=>'View Competence', 'url'=>array('view', 'id'=>$model->id_competence)),
	array('label'=>'Manage Competence', 'url'=>array('admin')),
);
?>

<h1>Update Competence <?php echo $model->id_competence; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>