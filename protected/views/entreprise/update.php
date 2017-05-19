<div>
	<?php
		$image = CHtml::image(Yii::app()->request->baseUrl.'/images/prozzl_logo.png',
	      'Image accueil');
	 
	      echo CHtml::link($image,array('entreprise/index'));
	?>

<div class='filtre-vert'>

		<h1 class=intitule>Modifier votre profil</h1>

		<?php $this->renderPartial('_form', array('model'=>$model)); ?>

</div>