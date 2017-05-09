<?php
/* @var $this InfosComplementairesProfilController */
/* @var $model InfosComplementairesProfil */

$this->breadcrumbs=array(
	'Infos Complementaires Profils'=>array('index'),
	$model->id_info,
);

$this->menu=array(
	array('label'=>'List InfosComplementairesProfil', 'url'=>array('index')),
	array('label'=>'Create InfosComplementairesProfil', 'url'=>array('create')),
	array('label'=>'Update InfosComplementairesProfil', 'url'=>array('update', 'id'=>$model->id_info)),
	array('label'=>'Delete InfosComplementairesProfil', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_info),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage InfosComplementairesProfil', 'url'=>array('admin')),
);
?>

<h1>View InfosComplementairesProfil #<?php echo $model->id_info; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_info',
		'nom_info',
		'personne_concernee',
	),
)); ?>
