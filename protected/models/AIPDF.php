<?php

/* -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
	Ce qu'il manque :
		- Repérer les expériences professionnelles, les compétences et les informations diverses
		- La date de naissance de la personne ( avec mot clés? )
		- Adresse qui ne sont pas dans une seule ligne ( 2, 3 .. )
-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- */


/* -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
	Amélioriations de l'algorithme : 
	 	- Téléphones séparés par des points ou des tirets
		- Mots clés dans la base de données
		- Essayer de reconnaître le nom et le prénom avec l'aide du mail
		- Ajouter plus de nom de domaine
		- Ajouter début de URL https:// (Pas reconnu pour le moment)
		- Cas à traiter avec des PDF avec plusieurs pages
		- Pour le code postal gérer les code postal du type 76 000, 74 300 etc. (avec un espace)
-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- */


/* --- Variables générales --- */
define( 'NOT_FOUND_TERM', -888888 );
define( 'EMPTY_STR', "" );
define( 'ESPACE', " " );
define( 'POINT', '.' );
define( 'TIRET', '-' );
define( 'DEBUG', FALSE );
define( 'ALREADY_READ_ENTRY', '[[[READ]]]');


/**
 * Classe créée pour gérer l'inteligence artificielle du traitement de pdf
 */
class AIPDF extends CActiveRecord
{
	/* -- Tableau pour garder toutes les informations -- */
	public static $utilisateurInformation_arr;
	/* -- Tableau qui sauvegarde le contenu du CV de l'employé -- */
	public static $CVContents_arr;

	/* --- --- Mots clés --- --- */
	/*public static $blocsWordKeyExperiencesPro_arr = array(		'expériences professionnelles',
																'expérience professionnelle',
																'expériences pro',
																'expérience pro',
																'expériences',
																'expérience',
																'vie professionnelle',
																'parcours pro',
																'parcours professionnel' 	);

	public static $blocsWordKeyFormation_arr = array( 		'formation',
															'formations',
															'parcours scolaire',
															'diplôme',
															'diplômes',
															'mes diplômes',
															'éducation',
															'éducations',
															'étude',
															'études' 	);

	public static $blocsWordKeyCompetences_arr = array( 	'compétence',	
															'compétences',
															'langues',
															'langue',
															'informatique',
															'aptitude technique',
															'aptitudes technique',
															'qualités',
															'qualité',
															'ce que je sais faire',
															'je sais faire',
															'je peux faire' 	);
	public static $blocWordKeyInterets_arr = array( 	'centres intérêt',
														'centres d\'intérêt',
														'loisirs',
														'loisir',
														'divers' 	);*/

	/* --- --- --- --- --- --- ---
		Mots clés pour la partie information personnel
	--- --- --- --- --- --- --- */
	public static $blocsWordKeyInformationsPerso_arr = array( 	'téléphone',
																'tél',
																'nom',
																'prénom',
																'date de naissance',
																'nationnalité',
																'adresse',
																'mail',
																'email',
																'e-mail',
																'permis de conduire',
																'site web',
																'site-web',
																'âge',
																'profil' 	);

	public static $specificTelephoneWords_arr = array( 	'téléphone',
														'tél' 	);
	public static $specificMailWords_arr = array( 	'mail',
													'email',
													'e-mail' 	);
	public static $specificWebsiteWords_arr = array( 	'site web',
														'site-web',
														'website' 	);

	public static $domainNameList_arr = array( 	'.fr', '.com', '.org', '.etu', '.wordpress' 	);

	


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'no_table';
	}


	


	/*************************************************************************************************************************************
		Algorithme de traitement
	*************************************************************************************************************************************/
	/*
	 * Début de l'algorithme de traitement
	 * Paramètre : Un objet pdf avec toutes les informations du CV
	 */
	public static function start_algorithm( $informations_pdf )
	{
		/* -- Nouveau utilisateur et employé pour sauvegarder les informations -- */
		$utilisateur = new Utilisateur();
		$employe = new Employe();
		/* -- Initialisation du tableau pour enrefistrer et sauvegarder les informations lors du parcours du CV -- */
		self::init_array_found_informations( self::$utilisateurInformation_arr );
		/* -- Initalisation du tableau -- */
		self::$CVContents_arr = self::explode_into_lines( $informations_pdf->getText() );

		
		/* -- -- -- -- -- -- --
			Testing pour ajouter d'autres lignes dans le CV
		-- -- -- -- -- -- -- --*/
		//self::add_cv_line( 'www.juanpi.fr' );
		//self::add_cv_line( '4 avenue de Merande 73000 Chambéry' );
		//var_dump( self::get_cv_content() );




		/* -- -- -- -- -- -- -- --
			Cette grande première partie utilise les key word et la détection par mot clés pour trouver les informations
			Les lignes qui sont traitées sont marquées commes lues et on ne le réutilise pas
		-- -- -- -- -- -- -- -- */
		/* -- Première partie de l'algorithme pour trouver les informations personnelles -- */
		self::get_personal_information( $informations_pdf->getText() );
		self::get_name_surname( $informations_pdf );


		/* -- Affichage des résultats -- */
		self::afficher_resultats();





		/* -- -- -- -- -- -- --
			Testing des functions d'extraction
		-- -- -- -- -- -- -- --*/
		/* -- Extraction Téléphone -- */
		/*
			var_dump( self::extract_phone_number( ': 01 22 22 22 99' ) );
			var_dump( self::extract_phone_number( '01 22 22 22 99' ) );
			var_dump( self::extract_phone_number( ': +33 7 22 22 22 99' ) );
			var_dump( self::extract_phone_number( ': +33 99' ) );
			var_dump( self::extract_phone_number( 'Tél : +33 7 22 22 22 99' ) );
		*/
		/* -- Extraction Email -- */
		/*
			self::extract_mail( 'fdsqjl cadavidj@hotmalil.com' );
			self::extract_mail( 'fdsqjl seecadavidj@hotmail.cfr' );
			self::extract_mail( 'cadada@dqfs' );
		*/
		/* -- Extraction Nom et prénom -- */
		/*
			var_dump( self::test_name_verifications( 'Juan', 'CV Juan Cadavid  - Double nationnalité' ) );
		*/
		/* -- Extraction site web -- */
		/*
			var_dump( self::extract_site_web( 'juanpi.compagnie' ) );
			var_dump( self::extract_site_web( 'http://www.juanpi.fr' ) );
			var_dump( self::extract_site_web( 'http://juanpi.fr' ) );
			var_dump( self::extract_site_web( 'www.juanpi.fr' ) );
			var_dump( self::extract_site_web( 'juanpi.fr' ) );
		*/
	

	}

	/*
	 * Fonction pour récupèrer les informations personnelles
	 */
	public static function get_personal_information()
	{
		/* -- -- -- -- -- --
			Première partie on regarde avec les mots clés ce qu'on peut retrouver
		-- -- -- -- -- -- */
		/* -- Tableau pour enregistrer les informations trouvées -- */
		$personalInformationInstances_arr = array();

		/* -- On sépare le texte en lignes -- */
		$informationInLines_arr = self::get_cv_non_read_content();
		
		/* -- Si on peut séparer en lignes -- */
		if( sizeof( $informationInLines_arr ) > 1 )
		{
			/* -- On parcourt les lignes pour trouver les ressemblances -- */
			foreach( $informationInLines_arr as $key_int => $value_str )
			{
				/* -- On parcourt sur la bibliothèque de mots clés -- */
				foreach (self::$blocsWordKeyInformationsPerso_arr as $key_bloc_int => $valueWordKey_str )
				{
					$indexFindWord_int = strpos( self::full_normalize_string( $value_str ), self::full_normalize_string( $valueWordKey_str ) );

					if( $indexFindWord_int !== FALSE )
					{
						if( DEBUG ) echo '<p>Débug #1 (Fonction <b>get_personal_information( ... )</b>) : ressemblence trouvée pour ' . $valueWordKey_str .'</p>';
						$tmp_arr = array( $valueWordKey_str => $value_str );
						array_push( $personalInformationInstances_arr, $tmp_arr );
					}	
				}
			}

			/* -- S'il y a des mots clés qui ont été repérées on appelle leurs fonctions -- */
			foreach ( $personalInformationInstances_arr as $key_int => $value_arr)
			{
				foreach ($value_arr as $key2_int => $value_str) {
					self::find_personal_information_extract_function( $value_str, $key2_int );
				}
			}

			/* -- On détermine le reste des informations personnelles sans l'utilisation des mots clés, sans répasser par les mêmes lignes -- */
			self::get_personal_information_adapt();
		}
		else 
		{
			if( DEBUG ) echo '<p>Débug #2 (Fonction <b>get_personal_information( ... )</b>) : Il n\'y a pas de saut de ligne</p>';
		}
		
	}


	/*
	 *	Fonction pour retrouver des informations personnelles qui n'ont pas été retrouvés par les mots clés
	 * 	Elle est utilisée après la recherche par mots clés en complémentaire des autres
	 *	Le full mode détermine si on répasse par les lignes qui ont déjà été lues ou pas
	 */
	public static function get_personal_information_adapt( $fullMode_bool = FALSE )
	{
		/* -- Récupération des informations du CV ligne par ligne -- */
		$informations_arr = self::get_information_array();
		$contentCV_arr = array();
		/* -- -- -- -- --
			Partie téléphone
		-- -- -- -- -- */
		if( $informations_arr['Téléphone'] === NOT_FOUND_TERM )
		{
			/* -- On parcourt les lignes non lues -- */
			$contentCV_arr = $fullMode_bool ? self::get_cv_content() : self::get_cv_non_read_content();
			foreach ( $contentCV_arr as $key_int => $value_str )
			{
				$result_str = self::extract_phone_number( $value_str );

				if( $result_str !== NOT_FOUND_TERM )
				{
					self::add_found_information( 'Téléphone', $result_str );
					self::delete_entry_information( $value_str );
					break;
				}
			}
		}
		/* -- -- -- -- --
			Partie mail
		-- -- -- -- -- */
		if( $informations_arr['Mail'] === NOT_FOUND_TERM )
		{
			$contentCV_arr = $fullMode_bool ? self::get_cv_content() : self::get_cv_non_read_content();
			/* -- On parcourt les lignes du CV -- */
			foreach ( $contentCV_arr as $key_int => $value_str )
			{
				$result_str = self::extract_mail( $value_str );

				if( $result_str !== NOT_FOUND_TERM )
				{
					self::add_found_information( 'Mail', $result_str );
					self::delete_entry_information( $value_str );
					break;
				}
			}
		}
		/* -- -- -- -- --
			Partie site web
		-- -- -- -- -- */
		if( $informations_arr['Site-web'] === NOT_FOUND_TERM )
		{
			$contentCV_arr = $fullMode_bool ? self::get_cv_content() : self::get_cv_non_read_content();
			/* -- On parcourt les lignes du CV -- */
			foreach ( $contentCV_arr as $key_int => $value_str )
			{
				$result_str = self::extract_site_web( $value_str );
				/* -- Si un résultat a été trouvé -- */
				if( $result_str !== NOT_FOUND_TERM )
				{
					self::add_found_information( 'Site-web', $result_str );
					self::delete_entry_information( $value_str );
					break;
				}
			}
		}
		/* -- -- -- -- --
			Partie Adresse
		-- -- -- -- -- */
		if( $informations_arr['Adresse'] === NOT_FOUND_TERM )
		{
			$contentCV_arr = $fullMode_bool ? self::get_cv_content() : self::get_cv_non_read_content();
			/* -- On appelle la fonction extract -- */
			if( sizeof( $contentCV_arr ) > 1 )
			{
				/* -- La fonction prend un tableau et non une ligne en paramètre -- */
				$result_str = self::extract_adresse_from_array( $contentCV_arr );
				/* -- Si un résultat a été trouvé -- */
				if( $result_str !== NOT_FOUND_TERM )
				{
					self::add_found_information( 'Adresse', $result_str );					
					self::delete_entry_information( $result_str );
				}
			}
		}
	}




	/*
	 * 	Fonction pour trouver la fonction qu'il faut appeler en fonction des mots clés qui sont passées en paramètres
	 */
	public static function find_personal_information_extract_function( $line_str, $wordKey_str = null )
	{
		/* -- -- -- -- --
			Partie téléphone
		-- -- -- -- -- */
		/* -- Si le key word téléphone a été trouvé -- */
		if( in_array( $wordKey_str, self::$specificTelephoneWords_arr ) )
		{
			if( DEBUG ) echo '<p>Débug #1 (Fonction <b>find_personal_information_extract_function( ... )</b>) : On extrait le téléphone </p>';
			
			/* -- Extraction du numéro de téléphone -- */
			$result_str = self::extract_phone_number( $line_str, $wordKey_str );

			/* -- Si le téléphone a été trouvé on l'ajoute -- */
			if( $result_str != NOT_FOUND_TERM )
			{
				self::add_found_information( 'Téléphone', $result_str );
				self::delete_entry_information( $line_str );
			}
			/* -- Affichage pour debug -- */
			if( DEBUG ) echo '<p>Débug #2 (Fonction <b>find_personal_information_extract_function( ... )</b>) : Résultat de l\'extraction </p>';
		}
		/* -- -- -- -- --
			Partie mail
		-- -- -- -- -- */
		if( in_array( $wordKey_str, self::$specificMailWords_arr ) )
		{
			if( DEBUG ) echo '<p>Débug #3 (Fonction <b>find_personal_information_extract_function( ... )</b>) : Début extraction téléphone </p>';
			/* -- Extraction du mail dans la ligne -- */
			$result_str = self::extract_mail( $line_str, $wordKey_str );

			/* -- Si le mail a été trouvé on l'ajoute -- */
			if( $result_str != NOT_FOUND_TERM )
			{
				self::add_found_information( 'Mail', $result_str );
				self::delete_entry_information( $line_str );
			}
			if( DEBUG ) echo '<p>Débug #4 (Fonction <b>find_personal_information_extract_function( ... )</b>) : Résultat extraction téléphone </p>';
			if( DEBUG ) var_dump( $result_str );
		}
		/* -- -- -- -- --
			Partie site web
		-- -- -- -- -- */
		if( in_array( $wordKey_str, self::$specificWebsiteWords_arr ) )
		{
			/* -- Extraction du site web -- */
			$result_str = self::extract_site_web( $line_str, $wordKey_str );
			/* -- Si le site web a été trouvé on l'ajoute -- */
			if( $result_str != NOT_FOUND_TERM )
			{
				self::add_found_information( 'Site-web', $result_str );
				self::delete_entry_information( $line_str );
			}
			
		}
		
	}



	/*
	 *	Fonction générale pour trouver le prénom et le nom de la personne
	 */
	public static function get_name_surname( $file_pdf )
	{
		/* -- On récupère les méta données du fichier -- */
		$authorMetaData_str = $file_pdf->getDetails()['Author'];
		/* -- S'il y a un auteur -- */
		if( strlen($authorMetaData_str) > 1 )
		{
			/* -- On parcourt les lignes qui n'ont pas été lues-- */
			foreach ( self::get_cv_non_read_content() as $key_int => $line_str )
			{
				/* -- On teste pour chaque ligne si on peut trouver le nom et le prénom-- */
				$result_arr = self::test_name_verifications( $authorMetaData_str, $line_str );
				if( $result_arr !== NOT_FOUND_TERM )
				{
					if( isset( $result_arr['Nom'] ) ) self::add_found_information( 'Nom', $result_arr['Nom'] );
					if( isset( $result_arr['Prénom'] ) ) self::add_found_information( 'Prénom', $result_arr['Prénom'] );
					self::delete_entry_information( $line_str );
				}	

			}
			/* -- Si rien n'a été récupéré -- */
			if( self::get_information_value( 'Nom' ) == NOT_FOUND_TERM && self::get_information_value( 'Prénom') == NOT_FOUND_TERM )
			{
				/* -- On parcourt les lignes qui on été déjà lues si cela ne fonctionne pas -- */
				foreach ( self::get_cv_content() as $key_int => $line_str )
				{
					/* -- On teste pour chaque ligne si on peut trouver le nom et le prénom-- */
					$result_arr = self::test_name_verifications( $authorMetaData_str, $line_str );
					if( $result_arr !== NOT_FOUND_TERM )
					{
						if( isset( $result_arr['Nom'] ) ) self::add_found_information( 'Nom', $result_arr['Nom'] );
						if( isset( $result_arr['Prénom'] ) ) self::add_found_information( 'Prénom', $result_arr['Prénom'] );
						self::delete_entry_information( $line_str );
					}	

				}
			}
		}
		/* -- S'il n'y a pas d'auteur on peut se servir du mail pour essayer de retrouver les informations -- */
		else
		{
			// *******************************************************************
			// *******************************************************************
			// 		A faire après
			// *******************************************************************
			// *******************************************************************
		}		
		
	}

	/*
  	 * 	Fonction pour récupèrer le nom et le prénom de la personne à partir de la méta donnée
	 *	Retourne le possible prénom et nom de la personne
	 */
	public static function test_name_verifications( $authorMeta_str, $line_str )
	{
		/* -- Array retour -- */
		$success_arr = array();
		/* -- Variables normalisées -- */
		$sanitizedLine_str = self::full_normalize_string( $line_str );
		$sanitizedAuthorName_str = self::full_normalize_string( $authorMeta_str );
		/* -- On teste si on trouve le nom dans la ligne des informations -- */
		if( strstr( $sanitizedLine_str, $sanitizedAuthorName_str ) !== FALSE )
		{
			$motsAuthor_arr = explode( ESPACE, trim( $authorMeta_str ) );
			$motsLine_arr = explode( ESPACE, trim( $line_str ) );
			/* -- Si l'auteur PDF a un seul prénom -- */
			if( sizeof( $motsAuthor_arr ) == 1 )
			{
				/* -- Si dans la ligne il y a un seul mot -- */
				if( sizeof( $motsLine_arr ) == 1 )
				{
					$success_arr['Prénom'] = $line_str;
				}
				/* -- Si dans la ligne il y a exactement deux mots (fortes chances qui ce soit son nom de famille )-- */
				else if( sizeof( $motsLine_arr ) == 2 )
				{
					/* -- On parcours les deux mots de la ligne -- */
					foreach ( $motsLine_arr as $value_str ) 
					{
						/* -- Si c'est le prénom on l'ajoute aux informations retrouvées -- */
						if( $sanitizedAuthorName_str == self::full_normalize_string( $value_str ) )
							$success_arr['Prénom'] = $authorMeta_str;
						else
							$success_arr['Nom'] = $value_str;

					}
				}
				/* -- S'il y a plus de deux mots dans la ligne -- */
				else 
				{
					/* -- On parcourt pour trouver le mot suivant car c'est fortement probable qu'il soitle nom de famille -- */
					foreach ( $motsLine_arr as $key_int => $value_str )
					{
						if( self::full_normalize_string( $value_str ) == $sanitizedAuthorName_str )
						{
							$success_arr['Prénom'] = $value_str;
							$success_arr['Nom'] = $motsLine_arr[ $key_int + 1 ];
						}
					}
				}
			}
			/* -- Si l'auteur du PDF à deux prénoms -- */
			else
			{
				/* -- -- */
				/* -- -- */
				/* -- -- */
				// Non traité pour l'instant
				/* -- -- */
				/* -- -- */
				/* -- -- */
			}
			
		}
		return !empty( $success_arr ) ? $success_arr : NOT_FOUND_TERM;
	}







	/*************************************************************************************************************************************
		Fonctions d'extraction de données
	*************************************************************************************************************************************/
	/*
	 * 	Fonction pour extraire les informations du téléphone dans une ligne précise
	 */
	public static function extract_phone_number( $line_str, $wordKey_str = null )
	{
		/* -- Variables utiles -- */
		$francePrefix_str = '+33';
		$prefixes_arr = array( 	$francePrefix_str, '07', '06', '03', '04', '05', '02', '01' );

		/* -- On enleve le key word de la phrase -- */
		if( !is_null( $wordKey_str) )
			$line_str = self::delete_key_word_from_line( $line_str, $wordKey_str );


		/* -- On regarde d'abord si la phrase contient les parties basiques -- */
		foreach ( $prefixes_arr as $key_int => $value_str )
		{
			$prefixeIndex_int = strpos( $line_str, $value_str );
			/* -- On regarde s'il y a des points qui séparent le téléphone -- */
			$line_str = self::str_replace_dots_other( $line_str );
			/* -- On efface les espaces ensuite -- */
			$deletedEspacesLine_str = self::delete_espace_string( $line_str );
						
			/* -- Si un prefixe correspond -- */
			if( $prefixeIndex_int !== FALSE )
			{
				/* -- Cette variable possède l'index où se trouve le prefixe trouvé -- */
				$indexPosition_int = strpos( $deletedEspacesLine_str, $value_str );
				/* -- Si le prefixe est du type +33 -- */
				if( strpos( $line_str, $francePrefix_str ) !== FALSE )
				{
					/* -- Si toutes les chiffres qui suivent sont du type numérique -- */
					if( @self::verify_X_characters_from_I( $deletedEspacesLine_str, $indexPosition_int + 1, $indexPosition_int + 9 ) )
					{
						$line_str = self::delete_espace_string( $line_str );
						return substr( $line_str, strpos( $line_str, $francePrefix_str ), 13 );
					}
				}
				else
				{
					/* -- Si toutes les chiffres qui suivent sont du type numérique -- */
					if( @self::verify_X_characters_from_I( $deletedEspacesLine_str, $indexPosition_int, $indexPosition_int + 9 ) )
					{
						$line_str = self::delete_espace_string( $line_str );
						return substr( $line_str, strpos( $line_str, $value_str ) , 10 );
					}	
				}
			}
		}
		return NOT_FOUND_TERM;
	}

	/*
	 *	Fonction pour extraire le mail dans une ligne d'information
	 * 	Return : Le email (String) ou la constante NOT_FOUND_TERM
	 */
	public static function extract_mail( $line_str, $wordKey_str = null )
	{
		/* -- On parcourt pour valider le mail et le garder si tout est bon -- */
		foreach( preg_split('/\s/', $line_str ) as $token_str )
		{
	        $email_str = filter_var( filter_var( $token_str, FILTER_SANITIZE_EMAIL ), FILTER_VALIDATE_EMAIL );

	        if ( $email_str !== false )
	        	break;
	    }
	    
	    if( $email_str )
	    	return $email_str;
	    else
	    	return NOT_FOUND_TERM;
	}


	/*
	 * 	Fonction pour extraire le site web dans une ligne d'information
	 * 	Return : Le site Web (String) ou la constante NOT_FOUND_ITEM
	 */
	public static function extract_site_web( $line_str, $wordKey_str = null )
	{
		$wordsFromLine_arr = explode( ESPACE, trim( $line_str ) );
		/* -- On parcourt les mots -- */
		foreach ( $wordsFromLine_arr as $key_int => $value_str ) 
		{
			/* -- Si c'est un URL on procede à l'extraire du mot -- */
			if( self::match_web_url( $value_str ) )
			{
				return $value_str;
			}
		}
		return NOT_FOUND_TERM;
	}


	/*
	 * 	Fonction pour extraire une adresse dans les informations
	 * 	Le paramètre est un tableau car une adresse peut être sur plusieurs lignes différentes
	 * 	Return : L'adresse (String) si quelque chose a été trouvé ou la constante NOT_FOUND_ITEM
	 */
	public static function extract_adresse_from_array( $informations_arr )
	{
		/* -- On parcourt toutes les lignes du CV -- */
		foreach ( $informations_arr as $key_int => $value_str )
		{
			/* -- Si on trouve un code postal dans la ligne cela veut dire qu'il y a des fortes chances 
			que ce soit une adresse -- */
			if( self::match_code_postal( $value_str ) )
			{
				/* -- On teste le cas où c'est tout dans la même ligne -- */
				//var_dump(self::check_for_adresse_postal_structure( $value_str ));
				if( self::check_for_adresse_postal_structure( $value_str ) )
					return $value_str;

			}
		}
		return NOT_FOUND_TERM;
	}
	







	/*************************************************************************************************************************************
		Fonctions annexes
	*************************************************************************************************************************************/
	/*
	 * 	Fonction pour retirer une Word Key dans une phrase
	 * 	Return : (String) la chaine sans le Key Word
	 */
	public static function delete_key_word_from_line( $line_str, $wordKey_str )
	{
		$original_str = $line_str;
		$position_int = strpos( self::full_normalize_string( $line_str ), self::full_normalize_string( $wordKey_str ) );
		return $position_int !== FALSE ? substr_replace( $line_str, EMPTY_STR, $position_int, strlen( $wordKey_str ) ) : $original_str;
	}

	/*
	 * 	Fonction pour effacer des espaces dans un string
	 * 	Return : Le mot sans espaces
	 */
	public static function delete_espace_string( $line_str )
	{
		return str_replace( ESPACE, EMPTY_STR, trim( $line_str ) );
	}

	/*
	 *	Fonction pour transformer le texte en lignes
	 * 	Return : Un tableau avec les lignes contenant les informations
	 */
	public static function explode_into_lines( $informations_str )
	{
		/* -- Variables use -- */
		$tabulation_char = "<br />"; 

		/* -- S'il y a déjà des sauts de ligne -- */
		if( strpos($informations_str, $tabulation_char) !== FALSE )
		{
			return explode( $tabulation_char, $informations_str );
		}
		else 
		{
			return explode( $tabulation_char, nl2br( $informations_str ) );
		}
	}

	/*
	 *	Fonction pour tester que de X à I les chiffres d'un string sont numériques
	 *	Return TRRUE si c'est le cas ou FALSE si ce n'est pas le cas
	 */
	public static function verify_X_characters_from_I( $string_str, $X_int, $I_int )
	{
		for ( $i = $X_int; $i <= $I_int; $i++ )
		{ 
			if( !is_numeric( $string_str[$i] ) )
				return FALSE;
		}

		return TRUE;
	}

	/*
	 *	Fonction pour matcher un URL
	 * 	Return : TRUE si c'est un URL FALSE si ce n'est pas un URL
	 */
	public static function match_web_url( $string_str )
	{
		/* -- Taux de ressemblance si supérieur à 80% c'est probablement un url -- */
		$taux_int = 0;
		$acceptingLimit = 90;
		/* -- Critères de recherche -- */
		$HTTPPosition_int = strpos( $string_str, 'http://' );
		$WWWPosition_int = strpos( $string_str, 'www.' );
		$pointPosition_int = strpos( $string_str, POINT );
		$secondPointPosition_int = @strpos( $string_str, POINT, $pointPosition_int + 1);

		/* -- Augmentation du taux en fonction de la présence des critères -- */
		if( $HTTPPosition_int !== FALSE )
			$taux_int += 30;

		if ( $WWWPosition_int !== FALSE )
			$taux_int += 45;

		if ( $pointPosition_int !== FALSE )
			$taux_int += 15;

		if ( $secondPointPosition_int !== FALSE )
			$taux_int += 35;

		/* -- Si le taux de validité n'a pas été atteint -- */
		if( $taux_int < $acceptingLimit )
		{
			/* -- On teste les URL du type juanpi.fr, hello.com car ce sont des URL aussi -- */
			foreach ( self::$domainNameList_arr as  $value_str )
			{
				$domainName_str  = substr( $string_str, strpos( $string_str, POINT ) );
				if( $domainName_str == $value_str )
					$taux_int += 80;
			}
		}
		/* -- Si le taux est accepté donc cela veut dire que c'est fortement une URL -- */
		return $taux_int >  $acceptingLimit ? TRUE : FALSE;

	}


	/*
	 *	Fonction pour trouver un code postal dans une ligne d'entrée
	 *	Return : TRUE si la ligne contient un code postal ou FALSE si ce n'est pas le cas
	 */
	public static function match_code_postal( $line_str )
	{

		$original_str = $line_str;
		/* -- On enlève les possibles tirets et points qu'on puisse trouver -- */
		$line_str = self::str_replace_dots_other( $line_str );
		/* -- On sépare par mots -- */
		$motsLines_arr = explode( ESPACE, trim( $line_str ) );
		/* -- Vérification avant de parcourir -- */
		if( sizeof( $motsLines_arr ) > 0 )
		{
			/* -- On parcourt chaque mot -- */
			foreach ($motsLines_arr as $key_int => $value_str)
			{

				/* -- On cherche les chiffres d'abord -- */
				if( is_numeric( $value_str ) )
				{
					/* -- On traite le premier cas,quand le code postal est du type 76000 -- */
					if( strlen( $value_str ) == 5 )
						return TRUE;
					else
					{
						/* -- -- */
						/* -- -- */
						/* -- -- */
						/* -- Il faut traiter le cas où le code postal est du type 76 000 -- */
						/* -- -- */
						/* -- -- */
						/* -- -- */
					}
				}
			}
		}
		return FALSE;
	}


	/*
 	 *	Fonction pour tester si la ligne passé en paramètre corresponds à une
 	 *	structure d'une adresse postal
 	 *	Return : TRUE si c'est le cas, FALSE sinon
	 */
	public static function check_for_adresse_postal_structure( $line_str )
	{
		/* -- On enlève les tirets et les points -- */
		$line_str = self::str_replace_dots_other( $line_str );
		/* -- On découpe par mots -- */
		$wordsLine_arr = explode( ESPACE, $line_str );
		/* -- S'il y au moins 4 mots dans la ligne -- */
		if( sizeof( $wordsLine_arr ) >= 4 )
		{
			/* -- Premier cas le numéro de rue est au début de la phrase-- */
			if( is_numeric( $wordsLine_arr[0] ) )
			{
				/* -- On vérifie ensuite où se termine la fin de l'adresse -- */
				for ( $i = 1; $i < sizeof($wordsLine_arr); $i++ )
				{ 
					/* -- Si le reste des informations contient un code postal -- */
					if( self::match_code_postal( $wordsLine_arr[ $i ] ) )
					{
						/* -- On teste si les mots d'après sont des possibles villes -- */
						if( @strlen( $wordsLine_arr[ $i + 1 ] ) > 2 || @strlen( $wordsLine_arr[ $i - 1 ] ) > 2 )
							return TRUE;
					}
				}
			}
			/* -- Si l'adresse ne commence pas par le numéro de rue -- */
			else
			{
				/* -- Pour l'instant on peut faire s'il y a pas numéro mais qu'il y a un code postal suvi d'une ville-- */
				/* -- On peut tester en utilsant une liste exhaustive de mots avenue, rue etc. -- */
				/* -- En plus de la présence d'un adresse postal -- */
			}
		}
		
		return FALSE;
	}


	/*
	 * 	Fonction pour enlèver les tirets et les points dans une ligne
	 *	Sert à mieux répérer certaines informations et pour pouvoir couper les chaînes toujours par des espaces
	 */
	public static function str_replace_dots_other( $line_str )
	{
		/* -- On remplace les points par des espaces -- */
		if( strpos( $line_str, POINT ) !== FALSE )
			$line_str = str_replace( POINT, ESPACE, $line_str );
		/* -- On remplace les tirets par des espaces-- */
		if( strpos($line_str, TIRET ) !== FALSE )
			$line_str = str_replace( TIRET, ESPACE, $line_str );

		return $line_str;
	}










	/*************************************************************************************************************************************
		Fonctions pour gérer les tableaux contenant les informations et les informations retrouvées
	*************************************************************************************************************************************/
	/*
	 *	Fonction pour initialiser le tableau d'informations
	 */
	public static function init_array_found_informations( &$array_arr )
	{
		$array_arr['Téléphone'] = NOT_FOUND_TERM;
		$array_arr['Nom'] = NOT_FOUND_TERM;
		$array_arr['Prénom'] = NOT_FOUND_TERM;
		$array_arr['Mail'] = NOT_FOUND_TERM;
		$array_arr['Adresse'] = NOT_FOUND_TERM;
		$array_arr['Site-web'] = NOT_FOUND_TERM;
		$array_arr['Date-de-naissance'] = NOT_FOUND_TERM;
	}

	/*
	 *	Function GET pour les information de l'utilisateur
	 */
	public static function get_information_array()
	{
		return self::$utilisateurInformation_arr;
	}

	/*
	 * 	Fonction pour récupérer directemment la valeur d'une information de l'utilisateur 
	 */
	public static function get_information_value( $value_str )
	{
		return isset( self::get_information_array()[ $value_str ] ) ? self::get_information_array()[ $value_str ] : NOT_FOUND_TERM;
	}


	/*
	 *	Fonction pour afficher les résultats de l'algorithme
	 */
	public static function afficher_resultats()
	{
		echo '<p>Informations trouvées par l\'algorithme :</p>';
		foreach ( self::$utilisateurInformation_arr as $key_str => $value_str )
		{
			if( $value_str != NOT_FOUND_TERM )
				echo '- ' . $key_str . ' : ' . $value_str.'</br>';
		}
		
	}

	/*
	 * 	Fonction pour ajouter une valeur qui a été trouvée
	 */
	public static function add_found_information( $information_str, $value_str )
	{
		self::$utilisateurInformation_arr[$information_str] = $value_str;
	}

	/*
	 *	Fonction pour supprimer une entrée dans le tableau de CV
	 */
	public static function delete_entry_information( $line_str )
	{
		if( ( $key_int = array_search($line_str, self::$CVContents_arr ) ) !== false)
		{
		    self::$CVContents_arr[ $key_int ] = $line_str . ALREADY_READ_ENTRY;
		}		 	
	}

	/*
	 *	Fonction GET pour récupérer toutes les informations de la variable self::$CVContents_arr
	 */
	public static function get_cv_content()
	{
		return self::$CVContents_arr;
	}


	/*
	 *	Fonction GET pour récupérer toutes les informations qui n'ont pas été lues
	 */
	public static function get_cv_non_read_content()
	{
		$tmp_arr = array();

		foreach ( self::get_cv_content() as $key_int => $value_str )
		{
			if( strpos( $value_str, ALREADY_READ_ENTRY ) === FALSE)
				array_push( $tmp_arr, $value_str );
		}

		return $tmp_arr;
	}

	/*
	 *	Function pour ajouter des lignes aux informations du CV
	 *	Utilisé pour tester différents cas possibles
	 */
	public static function add_cv_line( $line_str )
	{
		array_push( self::$CVContents_arr, $line_str );
	}


















	/*************************************************************************************************************************************
		Fonctions pour normaliser les strings
	*************************************************************************************************************************************/
	/*
	 *	Fonctions pour normaliser une chaîne de caractères UTF-8
	 */
	public static function normalize_utf8_string( $s )
	{
	    // Normalizer-class missing!
	    $original_string  = $s;
	    if (! class_exists("Normalizer", $autoload = false))
	        return $original_string;
	    
	    
	    // maps German (umlauts) and other European characters onto two characters before just removing diacritics
	    $s    = preg_replace( '@\x{00c4}@u'    , "AE",    $s );    // umlaut Ä => AE
	    $s    = preg_replace( '@\x{00d6}@u'    , "OE",    $s );    // umlaut Ö => OE
	    $s    = preg_replace( '@\x{00dc}@u'    , "UE",    $s );    // umlaut Ü => UE
	    $s    = preg_replace( '@\x{00e4}@u'    , "ae",    $s );    // umlaut ä => ae
	    $s    = preg_replace( '@\x{00f6}@u'    , "oe",    $s );    // umlaut ö => oe
	    $s    = preg_replace( '@\x{00fc}@u'    , "ue",    $s );    // umlaut ü => ue
	    $s    = preg_replace( '@\x{00f1}@u'    , "ny",    $s );    // ñ => ny
	    $s    = preg_replace( '@\x{00ff}@u'    , "yu",    $s );    // ÿ => yu
	    
	    
	    // maps special characters (characters with diacritics) on their base-character followed by the diacritical mark
	        // exmaple:  Ú => U´,  á => a`
	    $s    = Normalizer::normalize( $s, Normalizer::FORM_D );
	    
	    
	    $s    = preg_replace( '@\pM@u'        , "",    $s );    // removes diacritics
	    
	    
	    $s    = preg_replace( '@\x{00df}@u'    , "ss",    $s );    // maps German ß onto ss
	    $s    = preg_replace( '@\x{00c6}@u'    , "AE",    $s );    // Æ => AE
	    $s    = preg_replace( '@\x{00e6}@u'    , "ae",    $s );    // æ => ae
	    $s    = preg_replace( '@\x{0132}@u'    , "IJ",    $s );    // ? => IJ
	    $s    = preg_replace( '@\x{0133}@u'    , "ij",    $s );    // ? => ij
	    $s    = preg_replace( '@\x{0152}@u'    , "OE",    $s );    // Œ => OE
	    $s    = preg_replace( '@\x{0153}@u'    , "oe",    $s );    // œ => oe
	    
	    $s    = preg_replace( '@\x{00d0}@u'    , "D",    $s );    // Ð => D
	    $s    = preg_replace( '@\x{0110}@u'    , "D",    $s );    // Ð => D
	    $s    = preg_replace( '@\x{00f0}@u'    , "d",    $s );    // ð => d
	    $s    = preg_replace( '@\x{0111}@u'    , "d",    $s );    // d => d
	    $s    = preg_replace( '@\x{0126}@u'    , "H",    $s );    // H => H
	    $s    = preg_replace( '@\x{0127}@u'    , "h",    $s );    // h => h
	    $s    = preg_replace( '@\x{0131}@u'    , "i",    $s );    // i => i
	    $s    = preg_replace( '@\x{0138}@u'    , "k",    $s );    // ? => k
	    $s    = preg_replace( '@\x{013f}@u'    , "L",    $s );    // ? => L
	    $s    = preg_replace( '@\x{0141}@u'    , "L",    $s );    // L => L
	    $s    = preg_replace( '@\x{0140}@u'    , "l",    $s );    // ? => l
	    $s    = preg_replace( '@\x{0142}@u'    , "l",    $s );    // l => l
	    $s    = preg_replace( '@\x{014a}@u'    , "N",    $s );    // ? => N
	    $s    = preg_replace( '@\x{0149}@u'    , "n",    $s );    // ? => n
	    $s    = preg_replace( '@\x{014b}@u'    , "n",    $s );    // ? => n
	    $s    = preg_replace( '@\x{00d8}@u'    , "O",    $s );    // Ø => O
	    $s    = preg_replace( '@\x{00f8}@u'    , "o",    $s );    // ø => o
	    $s    = preg_replace( '@\x{017f}@u'    , "s",    $s );    // ? => s
	    $s    = preg_replace( '@\x{00de}@u'    , "T",    $s );    // Þ => T
	    $s    = preg_replace( '@\x{0166}@u'    , "T",    $s );    // T => T
	    $s    = preg_replace( '@\x{00fe}@u'    , "t",    $s );    // þ => t
	    $s    = preg_replace( '@\x{0167}@u'    , "t",    $s );    // t => t
	    
	    // remove all non-ASCii characters
	    $s    = preg_replace( '@[^\0-\x80]@u'    , "",    $s ); 
	    
	    
	    // possible errors in UTF8-regular-expressions
	    if (empty($s))
	        return $original_string;
	    else
	        return $s; 
	}

	/*
	 * Fonction pour normaliser un string : Lettres en minuscule + espace convertis en _ ...
	 */
	public static function full_normalize_string( $string_str )
	{
		/* -- Variables utiles -- */
		$espace_char = " ";
		$espaceReplace_char = "_";

		/* -- On remplace les caractères é en é, à en a ... -- */
		$string_str = AIPDF::normalize_utf8_string( $string_str );

		/* -- On enlève les espaces et on les remplace par _ -- */
		$string_str = str_replace( $espace_char, $espaceReplace_char, $string_str );
		
		/* -- On met tout en minuscule -- */
		$string_str = strtolower( $string_str );

		return $string_str;
	}
}
