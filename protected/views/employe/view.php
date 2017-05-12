<?php
/* @var $this EmployeController */
/* @var $model Employe */


/* -- Override de jquery avec la version 3.0 -- */
$cs = Yii::app()->clientScript;
$cs->scriptMap = array(
'jquery.js' => Yii::app()->request->baseUrl.'/js/jquery.js',
);
$cs->registerCoreScript('jquery');
/* -- Utilisation du script -- */
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/employe_view.js');
?>

<h3>Mes informations personelles</h3>

<?php

	//On récupère l'utilisateur correspondant à l'employé
	$user = Utilisateur::model()->FindByAttributes(array('id_employe'=>$model->id_employe));
	//On récupère l'adresse correspondant à l'employé
	$adresse = Adresse::model()->FindByAttributes(array('id_adresse'=>$user->id_adresse));

	//Si l'adresse est nulle on dit qu'elle n'est pas renseignée
	if($adresse == null){
		$adresse = "Non renseignée";
	}
	//Sinon, on définit une variable adresse récupérée depuis model Adresse
	else
	{
		$adresse = $adresse->rue.", ".$adresse->code_postal." ".$adresse->ville;
	}

	//On fait pareil pour le site Web
	if($user->site_web == null)
	{
		$user->site_web = "Non renseigné";
	}

	//On fait pareil pour les téléphones
	if($user->telephone == null)
	{
		$user->telephone = "Non renseigné";
	}

	if($user->telephone2 == null)
	{
		$user->telephone2 = "Non renseigné";
	}

	//On définit si l'employé cherche un travail ou non
	if($model->employe_travaille == null)
	{
		$model->employe_travaille = "Non renseigné";
	}
	else if($model->employe_travaille == 1)
	{
		$model->employe_travaille = "Non";
	}
	else if($model->employe_travaille == 0)
	{
		$model->employe_travaille = "Oui";
	}
?>

	
	
<div class="wide form">	

	<?php
		//Début du formulaire de vue des infos persos
		$form=$this->beginWidget('CActiveForm',
			array(
				'action'=>Yii::app()->createUrl('employe/update', array('id'=>$model->id_employe)),
			)
		);

		echo "<div class='row'>";
		echo "<p>Nom : ".$model->nom_employe." ".$model->prenom_employe."</p>";
		echo "<p>Date de naissance : ".$model->date_naissance_employe."</p>";
		echo "<p>Adressse : ".$adresse."</p>";
		echo "<p>Téléphone : ".$user->telephone."</p>";
		echo "<p>Autre téléphone : ".$user->telephone2."</p>";
		echo "<p>Adresse mail : ".$user->mail."</p>";
		echo "<p>Site WEB : ".$user->site_web."</p>";
		echo "<p>Recherche un travail : ".$model->employe_travaille."</p>";
		echo "</div>";
	?>

	<div class="row buttons">
		<?php echo Chtml::submitButton('Mettre à jour mes informations personelles'); ?>
	</div>

	<?php $this->endWidget();?>	

</div>	


<?php 
	/* --- Ajout du formulaire pour uploader le CV --- */
	$this->renderPartial( '_upload_cv', array( 'model' => $model ) );

	/* --- Page pour traiter le pdf --- */
	$this->renderPartial( 'cv_edit', array( 'model' => $model ) );
?>
