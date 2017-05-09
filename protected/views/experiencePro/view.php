<?php
/* @var $this ExperienceProController */
/* @var $model ExperiencePro */

$this->breadcrumbs=array(
	'Experience Pros'=>array('index'),
	$model->id_experience,
);

$this->menu=array(
	array('label'=>'List ExperiencePro', 'url'=>array('index')),
	array('label'=>'Create ExperiencePro', 'url'=>array('create')),
	array('label'=>'Update ExperiencePro', 'url'=>array('update', 'id'=>$model->id_experience)),
	array('label'=>'Delete ExperiencePro', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_experience),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ExperiencePro', 'url'=>array('admin')),
);
?>

<h1>View ExperiencePro #<?php echo $model->id_experience; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_experience',
		'date_debut_experience',
		'date_fin_experience',
		'intitule_experience',
		'entreprise_experience',
		'description_experience',
		'id_employe',
	),
)); ?>
