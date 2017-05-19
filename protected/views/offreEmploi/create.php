<?php
	/* @var $this EmployeController */
	/* @var $model Employe */
	$image = CHtml::image(Yii::app()->request->baseUrl.'/images/prozzl_logo.png',
	      'Image accueil');
	 
	      echo CHtml::link($image,array('entreprise/index'));
?>

<div class='filtre-vert'>
	<h1 class=intitule>Créer une offre d'emploi</h1>

	<?php $this->renderPartial('_form', array('model'=>$model)); ?>