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


<?php

	//On récupère les infos de l'employé qu'on consulte
	$employe = Utilisateur::model()->FindByAttributes(array('id_employe'=>$model->id_employe));
	//On récupère l'utilisateur qui visite la page
	$user  = Utilisateur::model()->FindByAttributes(array('mail'=>Yii::app()->user->getID()));
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

<?php echo "<iv class='arriere-plan-employe'>" ?>

	<div>
		<?php $image = CHtml::image(Yii::app()->request->baseUrl.'/images/Prozzl_logo.png',
      'Image accueil');
 
      echo CHtml::link($image,array('employe/index','id'=> $user->id_employe)); ?>

	</div>

	<!-- MENU 	-->

	<div class="dropdown">
		<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenu1" aria-haspopup="true" aria-expanded="true">
		Menu 
		<span class="caret"></span>
		</button>
		<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
			<li>
				<a href="index.php?r=offreEmploi/mesOffres&id=<?php echo $user->id_employe;?>" title="Mon profil">
				Mes Candidatures
				</a>
			</li>
			<li>
				<a href="index.php?r=offreEmploi/recherche&id=<?php echo $user->id_employe;?>" title="Mon profil">
				Rechercher une offre
				</a>
			</li>
		</ul>
	</div>
<div id='contenu'> 
<div id='div-infos-perso'>


<!-- Affichage des infos persos -->	
<?php

//Si l'utilisateur consulte sa page on affiche les infos persos
//Sinon, si l'utilisateur consulte les infos de quelqu'un d'autre, on affiche pas les infos persos
if($user->id_employe == $_GET['id'])
{	
	echo "<h3 id='titre-infos-perso'>MES INFORMATIONS PERSONELLES</h3>";


 	echo "<div class='form-infos-perso form'>";	

		//Début du formulaire de vue des infos persos
		$form=$this->beginWidget('CActiveForm',
			array(
				'action'=>Yii::app()->createUrl('employe/update', array('id'=>$model->id_employe)),
			)
		);

	echo "<div class='row'>";
		echo Yii::app()->user->getFlash('success_maj_infos_persos');
		echo "<p>NOM : <label>".$model->nom_employe." ".$model->prenom_employe."</label></p>";
		echo "<p>DATE DE NAISSANCE : <label>".$this->changeDateNaissance($model->date_naissance_employe)."</label></p>";
		echo "<p>ADRESSE : <label>".$adresse."</label></p>";
		echo "<p>TELEPHONE : <label>".$user->telephone."</label></p>";
		echo "<p>AUTRE TELEPHONE : <label>".$user->telephone2."</label></p>";
		echo "<p>ADRESSE MAIL : <label>".$user->mail."</label></p>";
		echo "<p>SITE WEB : <label>".$user->site_web."</label></p>";
		echo "<p>RECHERCHE UN TRAVAIL : <label>".$model->employe_travaille."</label></p>";
	echo "</div>";

	echo"</div>";	
	echo"</div>";
	echo "<div class='row'>";
		echo Chtml::submitButton('Mettre à jour mes informations personelles',array('id'=>'btn-maj-infos'));
	$this->endWidget();	
	echo "</div>";
}
?>

<!-- Fin des infos persos -->


<div id='div-infos-comp'>



<!-- Début des infos complémentaires -->
<?php
//Le titre change en fonction de si on consulte sa propre page ou celle de quelqu'un d'autre
if($user->id_employe == $_GET['id'])
{
	echo "<h3 id='titre-infos-comp'>MES INFORMATIONS COMPLEMENTAIRES</h3>";
}
else
{
	echo "<h3 id='titre-infos-comp'>INFORMATIONS COMPLEMENTAIRES</h3>";
}
?>



<?php
	//Récupération des modèles d'informations complémentaires
	$competences = Competence::model()->FindAll("id_employe =".$model->id_employe);
	$formations = Formation::model()->FindAll("id_employe =".$model->id_employe);
	$exp_pros = ExperiencePro::model()->FindAll("id_employe =".$model->id_employe);
?>

<div class="form">

	<?php
	//Début du formulaire de vue des infos complémentaires
		$form=$this->beginWidget('CActiveForm',
			array(
				'action'=>Yii::app()->createUrl('employe/ajoutInfos'),
			)
		);
	?>	

	<?php
		//Le titre change en fonction de si on consulte sa propre page ou celle de quelqu'un d'autre
		if($user->id_employe == $_GET['id'])
		{
			echo "<h4>MES FORMATIONS/ PARCOURS SCOLAIRE </h4>";
		}
		else
		{
			echo "<h4>FORMATIONS/ PARCOURS SCOLAIRE</h4>";
		}
	?>

	<div class="row">
		<?php
			foreach($formations as $formation)
			{
				echo Yii::app()->user->getFlash('success_maj_formation');
				echo "<p>Date de début de la formation : <label>".$this->changeDateNaissance($formation->date_debut_formation)."</label></p>";
				echo "<p>Date de fin de la formation : <label>".$this->changeDateNaissance($formation->date_fin_formation)."</label></p>";
				echo "<p>Intitulé de la formation : <label>".$formation->intitule_formation."</label></p>";
				echo "<p>Etablissement de la formation : <label>".$formation->etablissement_formation."</label></p>";
				echo "<p>Diplome obtenu : <label>".$formation->diplome_formation."</label></p>";
				echo "<p>Description de la formation : <label>".$formation->description_formation."</label></p>";
				echo CHtml::link('Mettre à jour cette formation',array('Formation/update', 'id'=>$formation->id_formation));
				echo CHtml::link('Supprimer cette formation',array('Formation/delete', 'id'=>$formation->id_formation)); 
			}
		?>
	</div>

	<?php
	//Le titre change en fonction de si on consulte sa propre page ou celle de quelqu'un d'autre
	if($user->id_employe == $_GET['id'])
	{
		echo "<h4>MES EXPERIENCES PROFESSIONNELLES</h4>";
	}
	else
	{
		echo "<h4>EXPERIENCES PROFESSIONNELLES</h4>";
	}
	?>

	<div class="row">
		<?php
			foreach($exp_pros as $exp_pro)
			{

				echo Yii::app()->user->getFlash('success_maj_exp');
				echo "<p>Date de début de l'expérience pro : <label>".$this->changeDateNaissance($exp_pro->date_debut_experience)."</label></p>";
				echo "<p>Date de fin de l'expérience pro : <label>".$this->changeDateNaissance($exp_pro->date_fin_experience)."</label></p>";
				echo "<p>Intitulé de l'expérience pro : <label>".$exp_pro->intitule_experience."</label></p>";
				echo "<p>Entreprise dans laquelle vous êtiez salarié : <label>".$exp_pro->entreprise_experience."</label></p>";
				echo "<p>Description de l'expérience pro : <label>".$exp_pro->description_experience."</label>	</p>";
				echo CHtml::link('Mettre à jour cette expérience',array('ExperiencePro/update', 'id'=>$exp_pro->id_experience));
				echo CHtml::link('Supprimer cette expérience',array('ExperiencePro/delete', 'id'=>$exp_pro->id_experience)); 

			}
		?>	
	</div>

	<?php
	//Le titre change en fonction de si on consulte sa propre page ou celle de quelqu'un d'autre
	if($user->id_employe == $_GET['id'])
	{
		echo "<h4>MES COMPETENCES</h4>";
	}
	else
	{
		echo "<h4>COMPETENCE</h4>";
	}
	?>


	<div class="row">
		<ul>
		<?php
			foreach($competences as $competence)
			{
					echo Yii::app()->user->getFlash('success_maj_competence');
				echo "<li>".$competence->intitule_competence."<label> Niveau ".$competence->niveau_competence."/5</label></li>";
				echo CHtml::link('Mettre à jour cette compétence',array('Competence/update'),array('id'=>$competence->id_competence,'class'=>'modifier-supprimer-competence'));
				echo "   ";
				echo CHtml::link('Supprimer cette compétence',array('Competence/delete'),array('id'=>$competence->id_competence,'class'=>'Modifier-supprimer-competence')); 
			}
		?>
		</ul>
	</div>
	</div>	
</div>
	<div class="row">
		<?php echo CHtml::submitButton('Ajouter de nouvelles informations complémentaires', array('name'=>'btnajout','id'=>'btn-maj-infos')); ?>


	<?php $this->endWidget();?>	
</div>


<?php 

	/* --- Page pour traiter le pdf --- */
	$this->renderPartial( 'cv_edit', array( 'model' => $model ) );
?>
</div>
</div>
