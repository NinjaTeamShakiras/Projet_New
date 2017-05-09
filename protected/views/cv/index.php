<?php
/* @var $this CvController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cvs',
);

$this->menu=array(
	array('label'=>'Create Cv', 'url'=>array('create')),
	array('label'=>'Manage Cv', 'url'=>array('admin')),
);
?>

<h1>Cvs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
