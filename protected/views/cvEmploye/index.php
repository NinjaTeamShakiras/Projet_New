<?php
/* @var $this CvEmployeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cv Employes',
);

$this->menu=array(
	array('label'=>'Create CvEmploye', 'url'=>array('create')),
	array('label'=>'Manage CvEmploye', 'url'=>array('admin')),
);
?>

<h1>Cv Employes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
