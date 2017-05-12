<h1>Analyse du CV</h1>
<?php

require './protected/vendor/autoload.php';

//var_dump( pdf2string('./upload/1/cv_1.pdf') );

/* -- On récupère le texte du CV de l'employe -- */


$parser = new \Smalot\PdfParser\Parser();
$pdf    = $parser->parseFile( './upload/1/cv_4.pdf' );
 
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






