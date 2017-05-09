<?php
/* @var $this InfosComplementairesEmployeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Infos Complementaires Employes',
);

$this->menu=array(
	array('label'=>'Create InfosComplementairesEmploye', 'url'=>array('create')),
	array('label'=>'Manage InfosComplementairesEmploye', 'url'=>array('admin')),
);
?>

<h1>Infos Complementaires Employes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
