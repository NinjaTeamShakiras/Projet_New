<h1>Analyse du CV</h1>
<?php

require './protected/vendor/autoload.php';


/* -- On récupère le texte du CV de l'employe -- */


$parser = new \Smalot\PdfParser\Parser();
$pdf    = $parser->parseFile( './upload/test/cv_2.pdf' );
 
$PDFText_str = $pdf->getText();

/* -- On teste que la récupération du texte à réussi -- */

if (strlen( $PDFText_str ) > 100 )
{
	echo '<p>Extraction réussie</p>';
	AIPDF::start_algorithm( $pdf );
}
else 
{
	echo '<p>Problème de récupération du texte</p>';
}






