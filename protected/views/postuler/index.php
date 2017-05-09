<?php
/* @var $this PostulerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Postulers',
);

$this->menu=array(
	array('label'=>'Create Postuler', 'url'=>array('create')),
	array('label'=>'Manage Postuler', 'url'=>array('admin')),
);
?>

<h1>Postulers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
