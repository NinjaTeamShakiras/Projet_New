<?php
/* @var $this ExperienceProController */
/* @var $model ExperiencePro */

$this->breadcrumbs=array(
	'Experience Pros'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ExperiencePro', 'url'=>array('index')),
	array('label'=>'Create ExperiencePro', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#experience-pro-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Experience Pros</h1>

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
	'id'=>'experience-pro-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_experience',
		'date_debut_experience',
		'date_fin_experience',
		'intitule_experience',
		'entreprise_experience',
		'description_experience',
		/*
		'id_employe',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
