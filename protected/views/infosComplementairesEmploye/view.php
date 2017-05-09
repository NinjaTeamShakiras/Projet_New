<?php
/* @var $this InfosComplementairesEmployeController */
/* @var $model InfosComplementairesEmploye */

$this->breadcrumbs=array(
	'Infos Complementaires Employes'=>array('index'),
	$model->id_info_employe,
);

$this->menu=array(
	array('label'=>'List InfosComplementairesEmploye', 'url'=>array('index')),
	array('label'=>'Create InfosComplementairesEmploye', 'url'=>array('create')),
	array('label'=>'Update InfosComplementairesEmploye', 'url'=>array('update', 'id'=>$model->id_info_employe)),
	array('label'=>'Delete InfosComplementairesEmploye', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_info_employe),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage InfosComplementairesEmploye', 'url'=>array('admin')),
);
?>

<h1>View InfosComplementairesEmploye #<?php echo $model->id_info_employe; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_info_employe',
		'description_info',
		'id_info_profil',
		'id_employe',
	),
)); ?>
