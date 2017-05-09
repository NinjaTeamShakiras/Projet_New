<?php
/* @var $this EmployeController */
/* @var $model Employe */


/* -- Override de jquery avec la version 3.0 -- */
$cs = Yii::app()->clientScript;
$cs->scriptMap = array(
'jquery.js' => Yii::app()->request->baseUrl.'/js/jquery.js',
);
$cs->registerCoreScript('jquery');
/* -- Utilisation du script -- */
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/employe_view.js');


$this->breadcrumbs=array(
	'Employes'=>array('index'),
	$model->id_employe,
);

$this->menu=array(
	array('label'=>'List Employe', 'url'=>array('index')),
	array('label'=>'Create Employe', 'url'=>array('create')),
	array('label'=>'Update Employe', 'url'=>array('update', 'id'=>$model->id_employe)),
	array('label'=>'Delete Employe', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_employe),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Employe', 'url'=>array('admin')),
);
?>

<h1>View Employe #<?php echo $model->id_employe; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_employe',
		'nom_employe',
		'prenom_employe',
		'date_naissance_employe',
		'employe_travaille',
	),
)); ?>


<?php 
	
	$this->renderPartial( '_upload_cv', array( 	'model' => $model ) );

?>

<?php 	
	$url_pdf = './upload/' . $model->id_employe . "/cv_" . $model->id_employe . '.png';

	if( file_exists( $url_pdf ) ) : 	
?>
		<div>
			<canvas id="canvas" cv_url="<?php echo $url_pdf ?>"></canvas>
			<!-- 
			<iframe src="<?php //echo $url_pdf ?>#toolbar=0&navpanes=0&scrollbar=0" style="overflow: hidden; height: 50vh; width: 100%;" ></iframe>
			-->
		</div>

		

<?php  	
	/* --- END IF le CV existe --- */
	endif; 		
?>


<script type="text/javascript">
	
</script>
