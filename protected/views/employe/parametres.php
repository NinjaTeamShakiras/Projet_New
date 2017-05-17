<?php
	//Début du formulaire de vue des infos persos
	$form=$this->beginWidget('CActiveForm',
		array(
			'action'=>Yii::app()->createUrl('employe/parametres'),
		)
	);

	echo CHtml::submitbutton('Déconnexion', array('name'=>'btndeco'));
	echo CHtml::submitbutton('Supprimer mon compte', array('name'=>'btnsupcompte'));
	echo Chtml::submitbutton('Modifier mes paramètres de connexion', array('name'=>'btnmodifco'));

	$this->endWidget();	

?>	