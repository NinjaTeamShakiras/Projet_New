<?php
/* @var $this InfosComplementairesProfilController */
/* @var $model InfosComplementairesProfil */

$this->breadcrumbs=array(
	'Infos Complementaires Profils'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List InfosComplementairesProfil', 'url'=>array('index')),
	array('label'=>'Manage InfosComplementairesProfil', 'url'=>array('admin')),
);
?>

<h1>Create InfosComplementairesProfil</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>