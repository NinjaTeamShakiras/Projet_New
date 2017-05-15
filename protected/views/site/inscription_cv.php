<h1>Inscription à partir du CV</h1>

<?php
	/* --- Sert pour lire le PDF --- */
	require './protected/vendor/autoload.php';

	$this->renderPartial( './../employe/_upload_cv', array( 'model' => Employe::model() ) );

	/* -- Si leCV a été téléchargé par l'utilisateur -- */
	if( isset( $_GET[ 'token' ] ) )
	{
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
				echo '<div>Extraction réussie</div>';
				AIPDF::start_algorithm( $CV_pdf );
			}
			else 
			{
				echo '<div>Problème de récupération du texte</div>';
			}
		}
	}
?>