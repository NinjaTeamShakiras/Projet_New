<?php
/* @var $this InfosComplementairesEntrepriseController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Infos Complementaires Entreprises',
);

$this->menu=array(
	array('label'=>'Create InfosComplementairesEntreprise', 'url'=>array('create')),
	array('label'=>'Manage InfosComplementairesEntreprise', 'url'=>array('admin')),
);
?>

<h1>Infos Complementaires Entreprises</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
