<?php
/* @var $this ExperienceProController */
/* @var $model ExperiencePro */
?>

<h1>Mettre à jour <?php echo $model->intitule_experience; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>