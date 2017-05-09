<?php
/* @var $this InfosComplementairesEntrepriseController */
/* @var $model InfosComplementairesEntreprise */

$this->breadcrumbs=array(
	'Infos Complementaires Entreprises'=>array('index'),
	$model->id_info_entreprise,
);

$this->menu=array(
	array('label'=>'List InfosComplementairesEntreprise', 'url'=>array('index')),
	array('label'=>'Create InfosComplementairesEntreprise', 'url'=>array('create')),
	array('label'=>'Update InfosComplementairesEntreprise', 'url'=>array('update', 'id'=>$model->id_info_entreprise)),
	array('label'=>'Delete InfosComplementairesEntreprise', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_info_entreprise),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage InfosComplementairesEntreprise', 'url'=>array('admin')),
);
?>

<h1>View InfosComplementairesEntreprise #<?php echo $model->id_info_entreprise; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_info_entreprise',
		'description_info',
		'id_info_profil',
		'id_entreprise',
	),
)); ?>
