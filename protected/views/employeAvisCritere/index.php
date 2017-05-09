<?php
/* @var $this EmployeAvisCritereController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Employe Avis Criteres',
);

$this->menu=array(
	array('label'=>'Create EmployeAvisCritere', 'url'=>array('create')),
	array('label'=>'Manage EmployeAvisCritere', 'url'=>array('admin')),
);
?>

<h1>Employe Avis Criteres</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
