<div class='arriere-plan-employe'>
	<?php
		/* @var $this EmployeController */
		/* @var $model Employe */
		$login = Yii::app()->user->getId();
		// Récupération de l'utilisateur
		$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=>$login));
		$image = CHtml::image(Yii::app()->request->baseUrl.'/images/Prozzl_logo.png','Image accueil');
		echo CHtml::link($image,array('employe/index','id'=> $utilisateur->id_employe));
	?>

<div class='filtre-blanc'>
	
	<h1 class=intitule>Mettre à jour mes informations personelles</h1>

	<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>