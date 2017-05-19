<?php
	//Début du formulaire de vue des infos persos
	$form=$this->beginWidget('CActiveForm',
		array(
			'action'=>Yii::app()->createUrl('employe/parametres'),
		)
	);

	echo CHtml::submitbutton('Modifier mes identifiants de connexion', array('name'=>'btnmodifco'));
	echo CHtml::submitbutton('Supprimer mon compte', array('name'=>'btnsupcompte'));
	echo CHtml::submitbutton('Retour', array('name'=>'btnretour'));

	$this->endWidget();	

?>	