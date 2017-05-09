<?php
/* @var $this CompetenceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Competences',
);

$this->menu=array(
	array('label'=>'Create Competence', 'url'=>array('create')),
	array('label'=>'Manage Competence', 'url'=>array('admin')),
);
?>

<h1>Competences</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
