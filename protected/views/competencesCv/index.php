<?php
/* @var $this CompetencesCvController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Competences Cvs',
);

$this->menu=array(
	array('label'=>'Create CompetencesCv', 'url'=>array('create')),
	array('label'=>'Manage CompetencesCv', 'url'=>array('admin')),
);
?>

<h1>Competences Cvs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
