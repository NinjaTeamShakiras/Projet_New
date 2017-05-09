<?php
/* @var $this CriteresNotationEmployeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Criteres Notation Employes',
);

$this->menu=array(
	array('label'=>'Create CriteresNotationEmploye', 'url'=>array('create')),
	array('label'=>'Manage CriteresNotationEmploye', 'url'=>array('admin')),
);
?>

<h1>Criteres Notation Employes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
