<?php
/* @var $this EmployeController */
/* @var $model Employe */
?>
<?php	$login = Yii::app()->user->getId();
	// Récupération de l'utilisateur
	$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=>$login));?>

<?php $image = CHtml::image(Yii::app()->request->baseUrl.'/images/icone_prozzl.png',
      'Image accueil');
 
      echo CHtml::link($image,array('employe/index','id'=> $utilisateur->id_employe)); ?>

<h1 id=titre>Comment souhaiter vous ajouter votre CV</h1>	

<?php

$form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl('employe/choixCV'),
)); 

echo "<p id=CV>".CHtml::submitButton('Télécharger mon CV sur le site', array('name' => 'upload','id'=>'bouton-CV'))."</p>"; 
echo "<p id=infos>".CHtml::submitButton('Renseigner mes informations personnelles et générer mon CV', array('name'=> 'infos_persos','id'=>'bouton-infos'))."</p>"; 
$this->endWidget(); 

?>