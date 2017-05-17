

<?php

$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=> Yii::app()->user->getId()));

/*		MENU 		*/
if($utilisateur != null)
{ // Si connecter
	if (Utilisateur::est_employe(Yii::app()->user->role) )
	{ // Si employe
		?>

		<div class="dropdown">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenu1" aria-haspopup="true" aria-expanded="true">
				Menu 
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
				<li>
					<a href="index.php?r=employe/view&id=<?php echo $utilisateur->id_employe;?>" title="Mon profil">
							Mon profil
					</a>
				</li>
				<li>
					<a href="index.php?r=OffreEmploi/index" title="Liste des offres d'emplois">
					Liste des offres d'emplois
					</a>
				</li>
				<li>
					<a href="index.php?r=OffreEmploi/mesOffres" title="Mes candidatures">
					Mes candidatures
					</a>
				</li>
				<li>
					<a href="index.php?r=employe/index" title="Rechercher une offre">
					Rechercher une offre
					</a>
				</li>
			</ul>
		</div>
		<?php
	}
}
else
{
	?>
	<div class="dropdown">
		<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenu1" aria-haspopup="true" aria-expanded="true">
			Menu 
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
			<li>
				<a href="index.php?r=OffreEmploi/index" title="Liste des offres d'emplois">
				Liste des offres d'emplois
				</a>
			</li>
			<li>
				<a href="index.php?r=employe/index" title="Rechercher une offre">
				Rechercher une offre
				</a>
			</li>
		</ul>
	</div>
	<?php
}

?>
<h1>Inscription à partir du CV</h1>

<?php
	/* --- Sert pour lire le PDF --- */
	require './protected/vendor/autoload.php';
	

	/* -- Si le CV a été téléchargé par l'utilisateur -- */
	if( isset( $_GET[ 'token' ] ) )
	{
		$informationsCV_arr = array();
		/* -- On récupère le texte du CV de l'employe -- */
		$parser = new \Smalot\PdfParser\Parser();
		/* -- URL pour récupérer le cv temporaire -- */
		$url_str = './upload/session/'. $_GET[ 'token' ] . '/cv_' . $_GET[ 'token' ] . '.pdf';
		
		/* -- Si c'est un fichier valide -- */
		if( file_exists( $url_str ) )
		{
			/* -- Parse du fichier PDF -- */
			$CV_pdf = $parser->parseFile( $url_str );
			/* -- Récupération du texte du PDF -- */
			$PDFText_str = $CV_pdf->getText();
			
			/* -- On teste que la récupération du texte à réussi -- */
			if (strlen( $PDFText_str ) > 100 )
			{
				echo '<div style="padding : 2% 0%; text-align: center; widht: 100%;"><b>Extraction des informations réussie</b></div>';
				$informationsCV_arr = AIPDF::start_algorithm( $CV_pdf );
				$this->renderPartial( './../site/inscriptionEmployeCV', array( 'informations_arr' => $informationsCV_arr ) );
			}
			else 
			{
				echo '<div>Problème de récupération du texte</div>';
			}
		}
		else
		{
			echo '<div>Téléchargez votre CV ici : </div>';
			$this->renderPartial( './../employe/_upload_cv', array( 'model' => Employe::model() ) );
		}
	}
	/* -- S'il ne l'a pas téléchargé -- */
	else
	{
		$this->renderPartial( './../employe/_upload_cv', array( 'model' => Employe::model() ) );
	}



	if($utilisateur == null )
	{
		?>
		<!-- Formulaire avec le bouton pour Inscription -->
		<div class="form">
			<?php
			//Début du form
			$form=$this->beginWidget('CActiveForm',
				array(
					'action'=>Yii::app()->createUrl('/employe/ajoutInfos'),
				)
			);
			?>

			<div class="row">
				<?php echo CHtml::submitButton('Renseigner mes informations personnelles et générer mon CV'); ?>
			</div>

			<?php $this->endWidget(); ?>
		
		</div>
		<?php 
	}
