<?php

/**
 * Classe créée pour gérer l'inteligence artificielle du traitement de pdf
 */
class PDF extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'no_table';
	}

	/*
 	 *	Fonction principale pour générer un CV
	 */
	public static function generate_cv_pdf( $path_str, $employe )
	{
		require('./protected/src/FPDF/fpdf.php');

		$pdf = new FPDF();
		$pdf->AddPage();
		
		PDF::header( $pdf, $employe->id_employe );
		PDF::body( $pdf, $employe );

		$pdf->Output( $path_str, 'F' );
	}

	public static function header( $pdf, $numeroCandidat_int )
	{
		// Logo
	    $pdf->Image( './images/logo-cv.png', 10, 6, 32 );
	    // Police Arial gras 15
	    $pdf->SetFont( 'Arial', 'B', 16 );
	    $pdf->Ln( 4 );
	    $pdf->Cell( 90 );
	    $pdf->Cell( 5, 10,'Numero de candidat : ' . $numeroCandidat_int, 0, 0, 'C' );
	    $pdf->Image( './images/line-cv.png', 5, 40, 200 );
	}

	public static function body( $pdf, $employe )
	{
		/* -- Expériences professionnelles -- */
		$pdf->SetFont( 'Arial', 'B', 15 );
		$pdf->Cell( -225 );
		$pdf->Cell( 0, 75, 'Experiences : ', 0, 0, 'C' );
		$pdf->Cell( -150 );
		$pdf->Ln( 45 );
		PDF::body_experiences( $pdf, $employe );
		
		/* -- Formations -- */
		$pdf->SetFont( 'Arial', 'B', 15 );
		$pdf->Cell( -130 );
		$pdf->Cell( 0, 15, 'Formation : ', 0, 0, 'C' );
		$pdf->Ln( 15 );
		PDF::body_formations( $pdf, $employe );
		
	}
	
	public static function body_experiences( $pdf, $employe )
	{
		$experiences_arr = ExperiencePro::model()->findAll( 'id_employe', $employe->id_employe );
		$pdf->SetFont( 'Arial', 'B', 10 );

		foreach ( $experiences_arr as $experience )
		{
			$pdf->Cell( 5 );
			/* -- Traitement de la durée -- */
			$mois_debut = substr( $experience->date_debut_experience, 5, 2 );
			$annee_debut = substr( $experience->date_debut_experience, 0, 4 );
			$mois_fin = substr( $experience->date_fin_experience, 5, 2 );
			$annee_fin = substr( $experience->date_fin_experience, 0, 4 );
			$lines_arr = PDF::explode_into_lines_max( $experience->description_experience, 60 );
			$pdf->Cell( 60, 7, 'Du ' . $mois_debut . '-' . $annee_debut . ' au ' . $mois_fin . '-' . $annee_fin );
			$pdf->Cell( 135, 7, utf8_decode( $experience->intitule_experience . ' - ' . $experience->entreprise_experience ) );
			$pdf->Ln();
			foreach ($lines_arr as $value_str)
			{
				$pdf->Cell( 65, 7, "" );
				$pdf->Cell( 40, 7, utf8_decode( trim($value_str) ) );
				$pdf->Ln();
			}
			$pdf->Ln();
		}
	}

	public static function body_formations( $pdf, $employe )
	{
		$formations_arr = Formation::model()->findAll( 'id_employe', $employe->id_employe );

		$pdf->SetFont( 'Arial', 'B', 10 );

		foreach ( $formations_arr as $formation )
		{
			$pdf->Cell( 5 );
			/* -- Traitement de la durée -- */
			$mois_debut = substr( $formation->date_debut_formation, 5, 2 );
			$annee_debut = substr( $formation->date_debut_formation, 0, 4 );
			$mois_fin = substr( $formation->date_fin_formation, 5, 2 );
			$annee_fin = substr( $formation->date_fin_formation, 0, 4 );
			$lines_arr = PDF::explode_into_lines_max( $formation->description_formation, 60 );
			$pdf->Cell( 60, 7, 'Du ' . $mois_debut . TIRET . $annee_debut . ' au ' . $mois_fin . '-' . $annee_fin );
			$pdf->Cell( 135, 7, utf8_decode( $formation->intitule_formation . TIRET . $formation->etablissement_formation ) );
			$pdf->Ln();
			foreach ($lines_arr as $value_str)
			{
				$pdf->Cell( 65, 7, "" );
				$pdf->Cell( 40, 7, utf8_decode( trim($value_str) ) );
				$pdf->Ln();
			}
			$pdf->Ln();
		}
	}

	public static function explode_into_lines_max( $string_str, $max_int = 62 )
	{
		$array_arr = AIPDF::explode_into_lines( $string_str );
		$return_arr = array();
		foreach ($array_arr as $key_int => $line_str )
		{
			if( strlen( $line_str ) >= $max_int )
			{
				$words_arr = explode( ESPACE, $line_str );
				$tmpLine_str = EMPTY_STR;
				foreach ($words_arr as $k_int => $word_str )
				{
					$tmpLine_str .= $word_str . ESPACE;
					if( strlen( $tmpLine_str ) >= $max_int )
					{
						$tmpLine_str = str_replace( $words_arr[ $k_int ], EMPTY_STR, $tmpLine_str );
						array_push( $return_arr, $tmpLine_str );
						$tmpLine_str = $words_arr[ $k_int ] . ESPACE;
					}
				}
				array_push( $return_arr, $tmpLine_str );
			}
			else
			{
				array_push( $return_arr, trim($line_str) );
			}
		}
		return $return_arr;
	}

}



