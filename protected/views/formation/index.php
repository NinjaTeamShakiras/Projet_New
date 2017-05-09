<?php
/* @var $this FormationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Formations',
);

$this->menu=array(
	array('label'=>'Create Formation', 'url'=>array('create')),
	array('label'=>'Manage Formation', 'url'=>array('admin')),
);
?>

<h1>Formations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
