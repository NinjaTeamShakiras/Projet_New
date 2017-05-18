<?php
	//Début du formulaire de vue des infos persos
	$form=$this->beginWidget('CActiveForm',
		array(
			'action'=>Yii::app()->createUrl('Entreprise/parametres'),
		)
	);

	echo CHtml::submitbutton('Déconnexion', array('name'=>'btndeco'));
	echo CHtml::submitbutton('Supprimer mon compte', array('name'=>'btnsupcompte'));
	echo CHtml::submitbutton('Retour', array('name'=>'btnretour'));

	$this->endWidget();	

?>	