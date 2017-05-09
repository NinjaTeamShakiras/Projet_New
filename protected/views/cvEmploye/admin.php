<?php
/* @var $this CvEmployeController */
/* @var $model CvEmploye */

$this->breadcrumbs=array(
	'Cv Employes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CvEmploye', 'url'=>array('index')),
	array('label'=>'Create CvEmploye', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cv-employe-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Cv Employes</h1>

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
	'id'=>'cv-employe-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_cv_employe',
		'niveau_competence',
		'id_employe',
		'id_competence',
		'id_cv',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
