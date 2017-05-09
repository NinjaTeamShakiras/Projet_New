<?php
/* @var $this InfosComplementairesProfilController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Infos Complementaires Profils',
);

$this->menu=array(
	array('label'=>'Create InfosComplementairesProfil', 'url'=>array('create')),
	array('label'=>'Manage InfosComplementairesProfil', 'url'=>array('admin')),
);
?>

<h1>Infos Complementaires Profils</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
