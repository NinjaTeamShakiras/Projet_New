<?php
/* @var $this SiteController */
unset(Yii::app()->session['login']);
?>

<div class=arriere-plan>
	<div class=filtre-vert>'
		<div class="logo"><img src="images/Prozzl.png" alt="Prozzl"/></div>

		<?php
		echo Yii::app()->user->getFlash('suppr_compte');

		echo "<div class='Recherche'>Vous recherchez ? </div>";

		$form=$this->beginWidget('CActiveForm', array(
			'action'=>Yii::app()->createUrl('site/Accueil'),
		));

		// Message d'acces refusé
		echo Yii::app()->user->getFlash('access_denied'); 
		?>

		<div class="twobuttons row ">
			<?php
			echo CHtml::submitButton('Un emploi/Un stage', array('name' => 'btnemploi','class' => 'btn-emploi')); 
			echo CHtml::submitButton('Un salarié', array('name' => 'btnemploye','class' => 'btn-employe')); 
			?>
		</div>

		<div class='connexion'>Déjà un compte? <?php echo CHtml::link('Connexion',array('site/login'),array('class'=>'btnredirect'));?></div>	

		<?php $this->endWidget(); ?>

	</div>
</div>
