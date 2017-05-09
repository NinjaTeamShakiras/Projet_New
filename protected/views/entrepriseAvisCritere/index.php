<?php
/* @var $this EntrepriseAvisCritereController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Entreprise Avis Criteres',
);

$this->menu=array(
	array('label'=>'Create EntrepriseAvisCritere', 'url'=>array('create')),
	array('label'=>'Manage EntrepriseAvisCritere', 'url'=>array('admin')),
);
?>

<h1>Entreprise Avis Criteres</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
