<?php
/* @var $this SiteController */

echo "<h1>Prozzl</h1>";
echo "<h1>Recruteur de l'industrie touristique</h1>";

echo Yii::app()->user->getFlash('suppr_compte');

echo "<h2>Vous recherchez ?<h2>";

$form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl('site/Accueil'),
));

// Message d'acces refusé
echo Yii::app()->user->getFlash('access_denied');

echo CHtml::submitButton('Un emploi/Un stage', array('name' => 'btnemploye')); 
echo CHtml::submitButton('Un salarié', array('name' => 'btnentreprise')); 
?>
<div class='connexion'>Déjà un compte? <?php echo CHtml::link('Connexion',array('site/login'));
?>
</div>
<?php
$this->endWidget(); 	
?>
