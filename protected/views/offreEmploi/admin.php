<?php
/* @var $this OffreEmploiController */
/* @var $model OffreEmploi */

$this->breadcrumbs=array(
	'Offre Emplois'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List OffreEmploi', 'url'=>array('index')),
	array('label'=>'Create OffreEmploi', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#offre-emploi-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Offre Emplois</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'offre-emploi-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_offre_emploi',
		'date_creation_offre_emploi',
		'type_offre_emploi',
		'salaire_offre_emploi',
		'experience_offre_emploi',
		'description_offre_emploi',
		/*
		'id_entreprise',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
