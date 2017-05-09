<?php
/* @var $this ExperienceProController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Experience Pros',
);

$this->menu=array(
	array('label'=>'Create ExperiencePro', 'url'=>array('create')),
	array('label'=>'Manage ExperiencePro', 'url'=>array('admin')),
);
?>

<h1>Experience Pros</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
