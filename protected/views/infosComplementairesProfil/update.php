<?php
/* @var $this InfosComplementairesProfilController */
/* @var $model InfosComplementairesProfil */

$this->breadcrumbs=array(
	'Infos Complementaires Profils'=>array('index'),
	$model->id_info=>array('view','id'=>$model->id_info),
	'Update',
);

$this->menu=array(
	array('label'=>'List InfosComplementairesProfil', 'url'=>array('index')),
	array('label'=>'Create InfosComplementairesProfil', 'url'=>array('create')),
	array('label'=>'View InfosComplementairesProfil', 'url'=>array('view', 'id'=>$model->id_info)),
	array('label'=>'Manage InfosComplementairesProfil', 'url'=>array('admin')),
);
?>

<h1>Update InfosComplementairesProfil <?php echo $model->id_info; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>