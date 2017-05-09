<?php
/* @var $this EntrepriseAvisCritereController */
/* @var $model EntrepriseAvisCritere */

$this->breadcrumbs=array(
	'Entreprise Avis Criteres'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List EntrepriseAvisCritere', 'url'=>array('index')),
	array('label'=>'Create EntrepriseAvisCritere', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#entreprise-avis-critere-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Entreprise Avis Criteres</h1>

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
	'id'=>'entreprise-avis-critere-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_entreprise_avis',
		'note_entreprise_critere',
		'id_critere_notation_entreprise',
		'id_avis_entreprise',
		'commentaire_evaluation_critere',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
