<?php
/* @var $this FormationController */
/* @var $model Formation */
?>

<h1>Mise à jour de la formation <?php echo $model->intitule_formation; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>