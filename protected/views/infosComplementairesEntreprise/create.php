<?php
/* @var $this InfosComplementairesEntrepriseController */
/* @var $model InfosComplementairesEntreprise */

$this->breadcrumbs=array(
	'Infos Complementaires Entreprises'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List InfosComplementairesEntreprise', 'url'=>array('index')),
	array('label'=>'Manage InfosComplementairesEntreprise', 'url'=>array('admin')),
);
?>

<h1>Create InfosComplementairesEntreprise</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>