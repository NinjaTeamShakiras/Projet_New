<?php
/* @var $this EmployeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Employes',
);

$this->menu=array(
	array('label'=>'Create Employe', 'url'=>array('create')),
	array('label'=>'Manage Employe', 'url'=>array('admin')),
);
?>

<h1>Employes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
