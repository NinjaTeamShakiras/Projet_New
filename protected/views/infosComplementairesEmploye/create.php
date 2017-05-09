<?php
/* @var $this InfosComplementairesEmployeController */
/* @var $model InfosComplementairesEmploye */

$this->breadcrumbs=array(
	'Infos Complementaires Employes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List InfosComplementairesEmploye', 'url'=>array('index')),
	array('label'=>'Manage InfosComplementairesEmploye', 'url'=>array('admin')),
);
?>

<h1>Create InfosComplementairesEmploye</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>