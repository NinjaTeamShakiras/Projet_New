<?php
/* @var $this AdresseController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Adresses',
);

$this->menu=array(
	array('label'=>'Create Adresse', 'url'=>array('create')),
	array('label'=>'Manage Adresse', 'url'=>array('admin')),
);
?>

<h1>Adresses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
