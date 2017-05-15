<?php
/* @var $this CompetenceController */
/* @var $model Competence */
?>

<h1>Mettre à jour la compétence <?php echo $model->intitule_competence; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>