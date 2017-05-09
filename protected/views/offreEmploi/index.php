<?php
/* @var $this OffreEmploiController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Offre Emplois',
);

$this->menu=array(
	array('label'=>'Create OffreEmploi', 'url'=>array('create')),
	array('label'=>'Manage OffreEmploi', 'url'=>array('admin')),
);
?>

<h1>Offre Emplois</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
