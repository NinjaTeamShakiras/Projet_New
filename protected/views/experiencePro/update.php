<?php
/* @var $this ExperienceProController */
/* @var $model ExperiencePro */

$this->breadcrumbs=array(
	'Experience Pros'=>array('index'),
	$model->id_experience=>array('view','id'=>$model->id_experience),
	'Update',
);

$this->menu=array(
	array('label'=>'List ExperiencePro', 'url'=>array('index')),
	array('label'=>'Create ExperiencePro', 'url'=>array('create')),
	array('label'=>'View ExperiencePro', 'url'=>array('view', 'id'=>$model->id_experience)),
	array('label'=>'Manage ExperiencePro', 'url'=>array('admin')),
);
?>

<h1>Update ExperiencePro <?php echo $model->id_experience; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>