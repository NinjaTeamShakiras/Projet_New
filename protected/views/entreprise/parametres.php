<?php

	$image = CHtml::image(Yii::app()->request->baseUrl.'/images/prozzl_logo.png',
	      'Image accueil');
	 
	      echo CHtml::link($image,array('entreprise/index'));

	//Début du formulaire de vue des infos persos
	$form=$this->beginWidget('CActiveForm',
		array(
			'action'=>Yii::app()->createUrl('Entreprise/parametres'),
		)
	);

?>
<div class='filtre-vert'>

	<div>
	<?php echo CHtml::submitbutton('Modifier mes identifiants de connexion', array('name'=>'btnmodifco','class'=>'btnmodifier_id col-md-offset-3'));
	echo CHtml::submitbutton('Supprimer mon compte', array('name'=>'btnsupcompte','class'=>'btnmodifier_id col-md-offset-2'));?>
	</div>
	<div class=div-retour>
	<?php
	echo CHtml::submitbutton('Retour', array('name'=>'btnretour','class'=>'btnretour'));?>
	</div>

	<?php

	$this->endWidget();	

	?>
</div>	