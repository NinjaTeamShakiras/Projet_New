<?php
/* @var $this TravailleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Travailles',
);

$this->menu=array(
	array('label'=>'Create Travaille', 'url'=>array('create')),
	array('label'=>'Manage Travaille', 'url'=>array('admin')),
);
?>

<h1>Travailles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
