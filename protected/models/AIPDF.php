<?php

/* -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
	Ce qu'il manque :
		- Repérer les expériences professionnelles, les compétences et les informations diverses
		- Créer une fonction poursavoir quel needle utiliser
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
		- Cas où les informations sont suivis de deux points ex: date de naissance:07/06/1996 le explode ne fonctionnera pas 
-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- */


/* --- Variables générales --- */
define( 'NOT_FOUND_TERM', -888888 );
define( 'EMPTY_STR', "" );
define( 'ESPACE', " " );
define( 'POINT', '.' );
define( 'TIRET', '-' );
define( 'SLASH', '/' );
define( 'DEBUG', FALSE );
define( 'ALREADY_READ_ENTRY', '[[[READ]]]');
define( 'EMPTY_STRUCTURE', -888889 );
define( 'WORD', '[[[WORD]]]' );
define( 'YEAR', '[[[YEAR]]]' );
define( 'NUMBER', '[[[NUMBER]]]' );
define( 'DURATION', '[[[DURATION]]]');
define( 'BR', '<br />' );
define( 'BRSTRING', '<///>' );
define( 'EXP_LIMIT', 28.5 );
define( 'FORMATION_LIMIT', 4.9 );
define( 'MAX_SIZE_BLOC', 375 );


/**
 * Classe créée pour gérer l'inteligence artificielle du traitement de pdf
 */
class AIPDF extends CActiveRecord
{
	/* -- Tableau pour garder toutes les informations -- */
	public static $utilisateurInformation_arr = array();
	/* -- Tableau qui sauvegarde le contenu du CV de l'employé -- */
	public static $CVContents_arr = array();
	/* -- Tableau parallèle à celui qui contient la structure des informations -- */
	public static $CVstructures_arr = array();
	/* -- Tableau pour regrouper les blocs d'information -- */
	public static $CVBlocs_arr = array();
	/* -- Tableau pour ajouter les expériences professionneles -- */
	public static $expPros_arr = array();
	/* -- Tableau pour ajouter les expériences professionneles -- */
	public static $formations_arr = array();
	/* -- Tableau pour ajouter les expériences professionneles -- */
	public static $autres_arr = array();

	/* --- --- Mots clés --- --- */
	public static $blocsWordKeyExperiencesPro_arr = array(	'CDI', 'CDD', 'intérim', 'extra', 'temps partiel', 'temps complet', 'stage' );

	public static $blocsWordKeyFormation_arr = array(	'diplôme', 'université', 'BAC', 'BAC+1', 'BAC+2', 'BAC+3', 'BAC+4',
														'BAC+5', 'DUT', 'BTS', 'école', 'licence', 'master', 'mention'	);

	/* --- --- --- --- --- --- ---
		Mots clés pour la partie information personnel
	--- --- --- --- --- --- --- */
	public static $blocsWordKeyInformationsPerso_arr = array( 	'téléphone', 'tél', 'nom', 'prénom', 'date de naissance', 'date naissance', 'nationnalité', 'adresse', 'mail', 'email', 'e-mail', 'permis de conduire', 'site web', 'site-web', 'âge', 'profil' 	);
	/* --- --- --- --- --- ---
		Mots clés spécifiques de la partie information personnel 
	--- --- --- --- --- --- */
	public static $specificTelephoneWords_arr = array( 	'téléphone', 'tél' 	);
	public static $specificMailWords_arr = array( 	'mail', 'email', 'e-mail' 	);
	public static $specificWebsiteWords_arr = array( 	'site web', 'site-web', 'website' 	);
	public static $specificBirthDate_arr = array( 	'date de naissance', 'date naissance' 	);
	public static $domainNameList_arr = array( 	'.fr', '.com', '.org', '.etu', '.wordpress'		);
	/* --- --- --- --- ---
		Tableaux annexes 
	--- --- --- --- --- */
	/* -- Tableau avec les mots qui désignent une durée -- */
	public static $durationsNames_arr = array( 'année', 'années', 'jour', 'jours', 'semaine', 'semaines', 'heure', 'heures', 'mois', 'depuis' );


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'no_table';
	}


	


/******************************************************************************************************************************************************************
		Algorithme de traitement
******************************************************************************************************************************************************************/
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

		/***************
		TESTS
		***************/
		self::tests_();


		/* -- -- -- -- -- -- -- --
			Cette grande première partie utilise les key word et la détection par mot clés pour trouver les informations
			Les lignes qui sont traitées sont marquées commes lues et on ne le réutilise pas
		-- -- -- -- -- -- -- -- */
		/* -- Première partie de l'algorithme pour trouver les informations personnelles -- */
		self::get_personal_information( $informations_pdf->getText() );
		self::get_name_surname( $informations_pdf );

		/* -- Deuxième partie de l'algorithme pour segmenter le reste des lignes en blocs-- */
		self::start_segmentation();
		self::differentiate_blocs();

		/* -- Affichage des résultats -- */
		self::afficher_resultats();

	}
/******************************************************************************************************************************************************************
	TESTS
******************************************************************************************************************************************************************/
	public static function tests_()
	{
		self::add_cv_line( ' 21 juillet 1996' );
	}


/******************************************************************************************************************************************************************
	Partie pour différencier les blocs
******************************************************************************************************************************************************************/
	/*
	 *	Fonction pour séparer les blocs en expériences pro, formation et autres
	 */
	public static function differentiate_blocs()
	{
		/* -- Récupération des blocs -- */
		$blocs_arr = self::get_blocs_cv();
		/* -- Vérifications avant de commencer -- */
		if( sizeof( $blocs_arr ) > 0 )
		{
			/* -- Parcours du tableau de blocs -- */
			foreach ( $blocs_arr as $key_int => $bloc_str )
			{
				if( strlen( $bloc_str ) < MAX_SIZE_BLOC )
				{
					$formationIndex_int = self::is_a_formation( $bloc_str );
					$expProIndex_int = self::is_a_experience_pro( $bloc_str );

					if( $formationIndex_int < $expProIndex_int && $expProIndex_int >= EXP_LIMIT )
					{
						if( DEBUG ) var_dump("Bloc : Expériences Pro");
						array_push( self::$expPros_arr, $bloc_str );
					}
					else if ($formationIndex_int > $expProIndex_int && $formationIndex_int >= FORMATION_LIMIT)
					{
						if( DEBUG ) var_dump("Bloc : Formations");
						array_push( self::$formations_arr, $bloc_str );
					}
					else
					{
						/*************************************
						**************************************
						**************************************
						On peut faire une deuxième verification avant de l'ajouter à autres
						**************************************
						*************************************/
						if( DEBUG ) var_dump("Bloc : Autres informations");
						array_push( self::$autres_arr, $bloc_str );
					}
				}
			}
		}
	}
	/*
	 *	Fonction pour tester si un bloc est une formations
	 *	Return : Un indice de ressemblance 
	 */
	/*********************************************
	*********************************************
	*********************************************
		On peut améliorer en utilisant une longueur de concaténation plus grande pour regarder les résultats
	*********************************************
	*********************************************
	*********************************************/
	public static function is_a_formation( $bloc_str )
	{
		/* -- Initliasitaion indice correspondance -- */
		$index_int = 0;
		/* -- Tableau pour garder les mots clés retrouvées -- */
		$foundWords_arr = array();
		/* -- On sépare le bloc en mots -- */
		$word_arr = explode( ESPACE, $bloc_str );

		/* -- Parcours du tableau des mots -- */
		foreach ( $word_arr as $key_int => $word_str )
		{
			/* -- On parcourt le tableau des mots clés -- */
			foreach (self::$blocsWordKeyFormation_arr as $key2_int => $wordKey_str )
			{
				$normalized_str = trim(self::str_replace_separator_symbols( self::full_normalize_string( $word_str ) ));
				/* -- S'il y a un mot dans clé dans le blocs -- */
				if( self::full_normalize_string( $wordKey_str ) == $normalized_str )
				{
					$line_str = EMPTY_STR;
					/* -- On concatene les mots qui lui précedent -- */
					if( array_key_exists( $key_int - 2, $word_arr ) )
						$line_str .= $word_arr[ $key_int - 2 ] . ESPACE;
					if( array_key_exists( $key_int - 1, $word_arr ) )
						$line_str .= $word_arr[ $key_int - 1 ] . ESPACE;
					/* -- On ajoute le mots en question -- */
					$line_str .= $word_arr[ $key_int ] . ESPACE;
					/* -- On concatene les mots qui le suivent -- */
					if( array_key_exists( $key_int + 1, $word_arr ) )
						$line_str .=  $word_arr[ $key_int + 1 ] . ESPACE;
					if( array_key_exists( $key_int + 2, $word_arr ) )
						$line_str .= $word_arr[ $key_int + 2 ] . ESPACE;
					/* -- On ajoute la ligne -- */
					array_push( $foundWords_arr, $line_str );
					/* -- On incrémente l'indice de ressemblance -- */
					$tmp_int = $index_int * 2.5 + 5;
					$index_int += $tmp_int;
				}
			}
		}
		/* -- Si des mots clés ont été retrouvées -- */
		if( sizeof( $foundWords_arr ) > 0 )
		{
			/* -- On regarde ensuite les informations trouvées -- */
			foreach ($foundWords_arr as $key_int => $value_str)
			{
				/* -- Si la phrase contient une année -- */
				$struct_str = self::caracterize_line( $value_str );
				$yearIndex_int = strpos( $struct_str, YEAR );
				if( $yearIndex_int !== FALSE )
					$index_int += 35.0;
			}
		}
		return $index_int;
	}
	/*
	 *	Fonction pour tester si un bloc est une expérience pro
	 *	Return : Un indice de ressemblance
	 */
	public static function is_a_experience_pro( $bloc_str )
	{
		/* -- Initliasitaion indice correspondance -- */
		$index_int = 0;
		/* -- Tableau pour garder les mots clés retrouvées -- */
		$foundWords_arr = array();
		/* -- On sépare le bloc en mots -- */
		$word_arr = explode( ESPACE, $bloc_str );

		/* -- On détermine la structure de la phrase -- */
		$struct_str = self::caracterize_line( $bloc_str );
		$structs_arr = explode( TIRET, $struct_str );

		/* -- On regarde par rapport aux mots clés -- */
		foreach ( self::$blocsWordKeyExperiencesPro_arr as $value_str )
		{
			if( strpos( self::full_normalize_string( $bloc_str ), self::full_normalize_string( $value_str ) ) )
				$index_int += 15;
		}
		
		/* -- On parcourt chaque tag du bloc -- */
		if( sizeof( $structs_arr ) > 0 )
		{
			foreach( $structs_arr as $key_int => $singleStruct_str )
			{
				if( $singleStruct_str == DURATION )
				{
					/* -- On incrémente le taux de ressemblance -- */
					$tmp_int = $index_int * 2.5 + 2.75;
					$index_int += $tmp_int;
					/* -- On regarde s'il y a d'autres tag significatifs -- */
					if( isset( $structs_arr[ $key_int + 1 ] ) && $structs_arr[ $key_int + 1 ] == YEAR || 
						isset( $structs_arr[ $key_int - 1 ] ) && $structs_arr[ $key_int - 1 ] == YEAR )
					{
						$tmp_int = $index_int * 2.4 + 3.5;
						$index_int += $tmp_int;
					}
				}
				if( $singleStruct_str == YEAR )
				{
					/* -- On incrémente le taux de ressemblance -- */
					$tmp_int = $index_int * 1.5 + 1.5;
					$index_int += $tmp_int;
				}
			}
		}
		/* -- S'il y a des mots de formations on enlève les points qui sont ajoutés par la durée -- */
		$index_int = $index_int - self::is_a_formation( $bloc_str );

		return $index_int;
	}




/******************************************************************************************************************************************************************
	Fonctions pour la segmentation en blocs du reste des informations
******************************************************************************************************************************************************************/
	/*
	 *	Fonction pour séparér en blocs les informations
	 */
	public static function start_segmentation()
	{
		/* -- Utilisée pour concaténer les blocs -- */
		$currentBloc_str = EMPTY_STR;
		/* -- Tableau avec les lignes du CV non lues -- */
		$CVInformations_arr = self::get_cv_non_read_content();
		/* -- Index pour parcourir le tableau sans repasser par les mêmes endroits -- */
		$index_int = 0;
		/* -- Initalisation du tableau -- */
		self::init_array_cv_structures();

		/* -- On parcourt toutes les lignes qui n'ont pas été lues -- */
		foreach ( $CVInformations_arr as $key_int => $value_str )
		{
			/* -- On les marque en fonction de leur structure -- */
			$tag_str = self::caracterize_line( $value_str, $key_int );
			/* -- Si des tags on été retrouvés on les ajoute dans le tableau de structures de la classe -- */
			if( !empty( $tag_str ) )
				self::$CVstructures_arr[ $key_int ] = $tag_str;
			/* -- Sinon on ajoute la constante EMPTY STRUCTURE -- */
			else
				self::$CVstructures_arr[ $key_int ] = EMPTY_STRUCTURE;	
		}
		/* -- Taille du tableau -- */
		$sizeOf_int = sizeof( self::$CVstructures_arr );
		$lastIndex_int = 0;
		/* -- On parcourt le tableau des tags pour trouver les blocs qui se ressemblent -- */
		for ( $i = 0; $i < $sizeOf_int; $i++ )
		{
			/* -- On ajoute la ligne à la même -- */
			$currentBloc_str .= $CVInformations_arr[ $i ];
			/* -- On parcourt à partir de i les autres lignes du tableau pour voir la ligne suivante
			qui peut lui ressembler si c'est le cas on arrête et i prend la valeur du dernier indice + 1 -- */
			for ( $j = $i + 1; $j < $sizeOf_int; $j++ )
			{
				/* -- Si on trouve une ressemblance on l'ajoute au tableau et on sort de la boucle -- */
				/* -- Il faut également vérifier qu'il y a un structure présente -- */
				if( self::is_same_structure( self::$CVstructures_arr[ $i ], self::$CVstructures_arr[ $j ] ) )
				{
					/* -- On ajoute le bloc au tableau -- */
					array_push( self::$CVBlocs_arr, $currentBloc_str );
					/* -- On efface tout avant -- */
					$currentBloc_str = EMPTY_STR;
					/* -- I prend la valeur de j pour ne pas reparcourir les mêmes lignes -- */
					$i = $j - 1;
					$lastIndex_int = $j;
					break;
				}
				/* -- Sinon on continue à concaténer les lignes ou à trouver des structures -- */
				else
				{
					/* -- On teste si avant il n'y a pas une ligne avec une structure particulière -- */
					if( self::is_similar_structure( self::$CVstructures_arr[ $i ], self::$CVstructures_arr[ $j ] ) )
					{
						/* -- On ajoute le bloc au tableau -- */
						array_push( self::$CVBlocs_arr, $currentBloc_str );
						/* -- On efface tout avant -- */
						$currentBloc_str = EMPTY_STR;
						/* -- I prend la valeur de j pour ne pas reparcourir les mêmes lignes -- */
						$i = $j - 1;
						$lastIndex_int = $j;
						break;
					}
					/* -- Sinon on continue la concaténation -- */
					else
					{
						$currentBloc_str .= $CVInformations_arr[ $j ];
					}
				}
			}
		}
		/* -- On ajoute le dernier bloc s'il n'est pas vide -- */
		$currentBloc_str = EMPTY_STR;
		/* -- On concatène les dernières lignes -- */
		for ($i=$lastIndex_int; $i < sizeof($CVInformations_arr); $i++)
			$currentBloc_str .= $CVInformations_arr[$i];
		/* -- On les ajoute au tableau segmenté -- */
		if( !empty( $currentBloc_str ) )
			array_push( self::$CVBlocs_arr, $currentBloc_str );

		/* -- On segmente tant que possible à partir des saut des lignes --*/
		$nbSegmentations_int = 999999;
		while ( $nbSegmentations_int > 0 )
			$nbSegmentations_int =  self::segment_bloc_array( self::$CVBlocs_arr, 2 );
	}
	
	/*
	 *	Fonction pour caractériser une ligne avec une structure
	 */
	public static function caracterize_line( $line_str )
	{
		/* -- Initialisations de la structure de la ligne -- */
		$structure_str = EMPTY_STR;
		/* -- On remplace les paranthèses les tirets etc. par des espaces -- */
		$line_str = trim(self::str_replace_separator_symbols( $line_str ));

		/* -- On sépare le mots en lignes -- */
		$words_arr = explode( ESPACE, $line_str  );
		/* -- On efface les entrées vide du tableau -- */
		self::delete_empty_entries( $words_arr );
		/* -- Vérification -- */
		if( sizeof( $words_arr ) > 0 )
		{
			/* -- On parcourt chaque mot -- */
			foreach ($words_arr as $key_int => $word_str )
			{
				/* -- S'il y a que des chiffres -- */
				if( is_numeric( $word_str ) )
				{
					/* -- On teste si c'est une annéee -- */
					if( self::str_is_a_valid_year( $word_str ) )
						$structure_str .= YEAR . TIRET;
					/* -- Sinon on le marque en tant que chiffre -- */
					else
						$structure_str .= NUMBER . TIRET;
				}
				/* -- S'il n'y a pas de chiffre, c'est donc un mot -- */
				else
				{
					/* -- On détecte les durées qui sont des mots -- */
					if( self::str_is_a_duration( $word_str ) )
						$structure_str .= DURATION . TIRET;
					/* -- Sinon on les marque en tant que mots simples -- */
					else
						$structure_str .= WORD . TIRET;
				}
			}
		}
		return $structure_str;
	}
	
	/*
	 *	Fonction qui permet de segmenter s'il y a plusieurs sauts de lignes vides, 
	 *	le nombre de lignes vides à couper est défini par la variable $x_int
	 *	Le tableau est modifié directement avec son adresse
	 *	Return : le nombre de sementations réalisé
	 */
	public static function segment_bloc_array( &$array_arr, $x_int )
	{
		/* -- Chaîne  -- */
		$needle_str = EMPTY_STR;
		$needle2_str = EMPTY_STR; 

		/* -- On initialise les chaînes de séparateurs -- */
		for ( $i=0; $i < $x_int; $i++ )
		{
			$needle_str .= BRSTRING;
			$needle2_str .= BRSTRING . ESPACE;
		}

		/* -- Compteur -- */
		$compter_int = 0;
		/* -- Nouveau tableau pour ajouter les blocs segmentés -- */
		$segmented_arr = $array_arr;
		/* -- On vide le tableau -- */
		$array_arr = array();
		/* -- On parcourt le tableau -- */
		foreach ( $segmented_arr as $key_int => $bloc_str )
		{
			/* -- On remplace les séparateurs pour les détecter avec strpos -- */
			$blocBR_str = str_replace( BR, BRSTRING, nl2br( $bloc_str ) );
			/* -- On supprime les sauts de ligne -- */
			$blocBR_str = (string) self::str_delete_line_end( $blocBR_str );
			/* -- On cherche les ocurrences dans la chaîne -- */
			$index_arr = self::strpos_r( $blocBR_str, $needle2_str );
			/* -- S'il y a des occurences on peut séparer -- */
			if( sizeof( $index_arr ) > 0 )
			{
				foreach ( $index_arr as $value_int )
				{
					/* -- On coupe en deux la chaîne -- */
					$beginString_str = substr( $blocBR_str, 0, $value_int );
					$endString_str = substr( $blocBR_str, $value_int + strlen( $needle2_str ), strlen( $blocBR_str ) );
					/* -- On remet les chaîne de caractères comme au début -- */
					$beginString_str = str_replace( BRSTRING, "\n", $beginString_str );
					$endString_str = str_replace( BRSTRING, "\n", $endString_str );
					/* -- On ajoute les chaînes séparées -- */
					array_push( $array_arr, $beginString_str );
					array_push( $array_arr, $endString_str );
					$compter_int ++;
				}
			}
			/* -- Si on peut pas on ajoute tout simplement le bloc -- */
			else
				array_push( $array_arr, $bloc_str );
		}
		return $compter_int;
	}





/******************************************************************************************************************************************************************
	Fonctions générales concernant les informations personnelles
******************************************************************************************************************************************************************/
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
			/* -- S'il manque encore des informations personnelles on repasse par les lignes qui ont été lues -- */
			if( !self::all_informations_found() )
				self::get_personal_information_adapt( TRUE );

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
					/* -- Si le full mode est activé on doit vérifier que l'information ne se répète pas -- */
					if( $fullMode_bool )
						$result_str = self::str_delete_duplicata_entry( $result_str, 'Téléphone' );
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
					/* -- Si le full mode est activé on doit vérifier que l'information ne se répète pas -- */
					if( $fullMode_bool )
						$result_str = self::str_delete_duplicata_entry( $result_str, 'Mail' );
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
					/* -- Si le full mode est activé on doit vérifier que l'information ne se répète pas -- */
					if( $fullMode_bool )
						$result_str = self::str_delete_duplicata_entry( $result_str, 'Site-web' );
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
					/* -- Si le full mode est activé on doit vérifier que l'information ne se répète pas -- */
					if( $fullMode_bool )
						$result_str = self::str_delete_duplicata_entry( $result_str, 'Adresse' );
					self::add_found_information( 'Adresse', $result_str );					
					self::delete_entry_information( $result_str );
				}
			}
		}
		/* -- -- -- -- --
			Partie date de naissance
		-- -- -- -- -- */
		if( $informations_arr['Date-de-naissance'] === NOT_FOUND_TERM )
		{
			$contentCV_arr = $fullMode_bool ? self::get_cv_content() : self::get_cv_non_read_content();
			if( sizeof( $contentCV_arr ) >= 1 )
			{
				/* -- On parcourt les lignes du CV -- */
				foreach ( $contentCV_arr as $key_int => $value_str )
				{
					$result_str = self::extract_date_naissance( $value_str );
					/* -- Si un résultat a été trouvé -- */
					if( $result_str !== NOT_FOUND_TERM )
					{
						/* -- Si le full mode est activé on doit vérifier que l'information ne se répète pas -- */
						if( $fullMode_bool )
							$result_str = self::str_delete_duplicata_entry( $result_str, 'Date-de-naissance' );
						self::add_found_information( 'Date-de-naissance', $result_str );
						self::delete_entry_information( $value_str );
						break;
					}
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
		/* -- -- -- -- --
			Partie adresse : Traité que dans la fonction "adapt" car on utilise des boucles, de plus, 
			souvent les informations sont sur différentes lignes donc ce n'est pas adapté pour cette fonction-ci
		-- -- -- -- -- */
		/* -- -- -- -- --
			Partie date de naissance
		-- -- -- -- -- */
		if( in_array( $wordKey_str, self::$specificBirthDate_arr ) )
		{
			/* -- Extraction du site web -- */
			//$result_str = self::extract_date_naissance( $line_str, $wordKey_str );
			$result_str = self::extract_date_naissance( $line_str );
			/* -- Si rien n'a été trouvé on fait extract à partir de l'array -- */

			/* -- Si la date de naissance a été trouvé on l'ajoute -- */
			if( $result_str != NOT_FOUND_TERM )
			{
				self::add_found_information( 'Date-de-naissance', $result_str );
				self::delete_entry_information( $line_str );
			}
		}
	}



	/*
	 *	Fonction générale pour trouver le prénom et le nom de la personne
	 */
	public static function get_name_surname( $file_pdf )
	{
		$authorMetaData_str = EMPTY_STR;
		/* -- On récupère les méta données du fichier -- */
		if( isset( $file_pdf->getDetails()['Author'] ) )
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
			if( self::get_information_value( 'Nom' ) == NOT_FOUND_TERM && self::get_information_value( 'Prénom' ) == NOT_FOUND_TERM )
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
			$motsAuthor_arr = explode( ESPACE, trim($authorMeta_str) );
			$motsLine_arr = explode( ESPACE, trim($line_str) );
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



/******************************************************************************************************************************************************************
	Fonctions d'extraction de données pour la partie des informations professionnelles 
******************************************************************************************************************************************************************/
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
	 * 	Return : Le site Web (String) ou la constante NOT_FOUND_TERM
	 */
	public static function extract_site_web( $line_str, $wordKey_str = null )
	{
		$wordsFromLine_arr = explode( ESPACE, trim($line_str) );
		/* -- On parcourt les mots -- */

		if( sizeof( $wordsFromLine_arr ) > 0 )
		{
			/* -- On parcourt chaque mot -- */
			foreach ( $wordsFromLine_arr as $key_int => $value_str ) 
			{
				/* -- Si c'est un URL on procede à l'extraire du mot -- */
				if( self::match_web_url( $value_str ) )
				{
					return $value_str;
				}
			}
		}
		
		return NOT_FOUND_TERM;
	}


	/*
	 * 	Fonction pour extraire une adresse dans les informations
	 * 	Le paramètre est un tableau car une adresse peut être sur plusieurs lignes différentes
	 * 	Return : L'adresse (String) si quelque chose a été trouvé ou la constante NOT_FOUND_TERM
	 */
	public static function extract_adresse_from_array( $informations_arr )
	{
		if( sizeof( $informations_arr ) > 0 )
		{
			/* -- On parcourt toutes les lignes du CV -- */
			foreach ( $informations_arr as $key_int => $value_str )
			{
				/* -- Si on trouve un code postal dans la ligne cela veut dire qu'il y a des fortes chances 
				que ce soit une adresse -- */
				if( self::match_code_postal( $value_str ) )
				{
					/* -- On teste le cas où c'est tout dans la même ligne -- */
					if( self::check_for_adresse_postal_structure( $value_str ) )
					{
						return $value_str;
					}
					/* -- On teste le cas où l'adresse n'est pas sur la même ligne -- */
					else
					{
						$testLine_str = $value_str;
						$start_int = $key_int - 1;
						$linesUp_int = 0;
						/* -- On fait une boucle pour remonter jusqu'au début de l'adresse -- */
						while ( !self::check_for_adresse_postal_structure( $testLine_str ) || !isset( $informations_arr[ $start_int ] ) )
						{
							if( isset( $informations_arr[ $start_int ] ) )
								$testLine_str = $informations_arr[ $start_int ] . ESPACE . $testLine_str;
							$start_int --;
							$linesUp_int ++;
							if( $linesUp_int > 4 )
								break;
						}
						if( self::check_for_adresse_postal_structure( $testLine_str ) )
							return $testLine_str;
					}

				}
			}
		}
		
		return NOT_FOUND_TERM;
	}
	
	/*
	 *	Fontion pour extraire une date de naissance à partir d'une ligne
	 *	Return : la date de naissance trouvée ou la constante NOT_FOUND_TERM
	 */
	public static function extract_date_naissance( $line_str, $wordKey_str = NULL )
	{
		/* -- On efface le mot clé -- */
		if( !is_null($wordKey_str) )
			$line_str = trim(self::delete_key_word_from_line( $line_str, $wordKey_str ));
		
		/* -- On regarde s'il y a un séparateur dans la date de naissance -- */
		$separator_char = "";
		$separatorIndexSlash_int = strpos( $line_str, SLASH );
		$separatorIndexTiret_int = strpos( $line_str, TIRET );

		/* -- S'il y a un '/' et pas un tiret -- */
		if( $separatorIndexSlash_int !== FALSE && $separatorIndexTiret_int === FALSE )
			$separator_char = SLASH;
		/* -- S'il y un tirer et pas de '/' -- */
		if( $separatorIndexSlash_int === FALSE && $separatorIndexTiret_int !== FALSE )
			$separator_char = TIRET;
				

		/* -- S'il y a des '/' ou des '-' c'est probablement une date de naissance -- */
		if( !empty( $separator_char ) )
		{
			/* -- On calcule les autres indices -- */
			$index1_int = strpos( $line_str, $separator_char, 0 );
			$index2_int = strpos( $line_str, $separator_char, $index1_int + 1 );
			/* -- S'il y a au moins deux '-' ( ou '/' ) dans la chaîne -- */
			if( $index1_int !== FALSE && $index2_int !== FALSE )
			{
				/* -- On coupe par mots -- */
				$motsLine_arr = explode( ESPACE, $line_str );
				/* -- On parcourt chaque mot -- */
				foreach ( $motsLine_arr as $key_int => $value_str )
				{
					//$newIndex1_int = strpos( $value_str, $separator_char );
					//$newIndex2_int = strpos( $value_str, $separator_char, $newIndex1_int + 1 );
					/* -- On teste si c'est bien une date de naissance -- */
					$date_str = self::str_is_date_naissance( $line_str, $separator_char );
					if( $date_str !== FALSE )
						return $date_str;
				}
			}
		}
		/* -- S'il n'y a pas de '/' ou des '-', par exemple une date du style 4 juin 1986  -- */
		else 
		{
			/* -- On teste directement si c'est une date de naissance -- */
			$date_str = self::str_is_date_naissance( $line_str );
			if( $date_str !== FALSE )
				return $date_str;
		}

		return NOT_FOUND_TERM;
	}




/******************************************************************************************************************************************************************
	Fonctions annexes
******************************************************************************************************************************************************************/
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
		return str_replace( ESPACE, EMPTY_STR, trim($line_str) );
	}

	/*
	 *	Fonction pour transformer le texte en lignes
	 * 	Return : Un tableau avec les lignes contenant les informations
	 */
	public static function explode_into_lines( $informations_str )
	{

		/* -- S'il y a déjà des sauts de ligne -- */
		if( strpos($informations_str, BR) !== FALSE )
		{
			return explode( BR, $informations_str );
		}
		else 
		{
			return explode( BR, nl2br( $informations_str ) );
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
		$motsLines_arr = explode( ESPACE, trim($line_str) );
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
			if( is_numeric( $wordsLine_arr[0] ) && strlen( $wordsLine_arr[0] ) < 5 )
			{
				/* -- On vérifie ensuite où se termine la fin de l'adresse -- */
				for ( $i = 1; $i < sizeof($wordsLine_arr); $i++ )
				{ 
					/* -- Si le reste des informations qui contient un code postal -- */
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

	/*
	 *	Fonction pour enlever le tag read
	 *	Return : Le string sans le tag [[[READ]]]
	 */
	public static function str_delete_read_tag( $string_str )
	{
		return str_replace( ALREADY_READ_ENTRY, ESPACE, $string_str );
	}

	/*
	 *	Fonction pour tester qu'une nouvelle entrée ne possède pas d'autres entrées déjà présentes
	 *	Ex: Adres - Mail [[[READ]]], c'est pour vérifier que si la ligne a déjà été marqué on doit
	 *	faire attention car il y deux informations sur la même ligne
	 *	Return : l'information sans l'information répété si elle existe
	 */
	public static function str_delete_duplicata_entry( $string_str, $informationName_str )
	{
		/* -- On parcourt les informations du tableau pour vérifier la partie qui 
		pourrait être dupliquée-- */
		foreach (self::get_information_array() as $key_str => $value_str)
		{
			if( trim($key_str) != trim($informationName_str) && $value_str !== NOT_FOUND_TERM )
			{
				$string_str = str_replace( $value_str, ESPACE, $string_str );
			}
		}
		return $string_str;
	}

	/*
	 *	Fonction pour déterminer une année de naissance avec une ligne passée en paramètre
	 *	Return : la date de naissance si la ligne est bien une date de naissance sinon FALSE
	 */
	public static function str_is_date_naissance( $string_str, $separator_char = NULL )
	{
		$separatedArray_arr = array();
		/* -- S'il y a un séparateur du style '/' ou '-', on sépare en fonction du $separateur -- */
		if( !is_null( $separator_char ) )
			$separatedArray_arr = explode( $separator_char, $string_str );
		/* -- Si non on sépare par mots -- */
		else
			$separatedArray_arr = explode( ESPACE, $string_str );

		/* -- On vérifie qu'il y trois cases dans le tableau -- */
		if( sizeof( $separatedArray_arr ) >= 3 )
		{
			foreach ($separatedArray_arr as $key_int => $value_str )
			{
				/* -- On cherche une structure de date de naissance dans le tableau de mots -- */
				if( self::is_month_day( $separatedArray_arr[ $key_int ] ) )
				{
					if( isset( $separatedArray_arr[ $key_int + 1 ] ) && self::is_a_month( $separatedArray_arr[ $key_int + 1 ] ) )
					{
						if( isset( $separatedArray_arr[ $key_int + 2 ] ) && self::is_a_birth_year( $separatedArray_arr[ $key_int + 2 ] ) )
							return $separatedArray_arr[ $key_int ] . ESPACE . $separatedArray_arr[ $key_int + 1 ] . ESPACE . $separatedArray_arr[ $key_int + 2 ];
					}
				}
				/* -- S'il y d'autres choses dans la ligne-- */
				else
				{
					$espaceExplode_arr = explode( ESPACE, $value_str);
					if( self::is_month_day( end( $espaceExplode_arr ) ) )
					{
						if( isset( $separatedArray_arr[ $key_int + 1 ] ) && self::is_a_month( $separatedArray_arr[ $key_int + 1 ] ) )
						{
							if( isset( $separatedArray_arr[ $key_int + 2 ] ) && self::is_a_birth_year( $separatedArray_arr[ $key_int + 2 ] ) )
								return end( $espaceExplode_arr ) . ESPACE . $separatedArray_arr[ $key_int + 1 ] . ESPACE . $separatedArray_arr[ $key_int + 2 ];
						}
					}
				}
				
			}
			
		}
	
		return FALSE;		

	}

	/*
	 *	Fonction pour déterminer si le chiffre est un jour du mois
	 *	Return : vrai si c'est un jour du mois, FALSE si ce n'est pas le cas
	 */
	public static function is_month_day( $line_int )
	{
		if( is_numeric( $line_int ) && $line_int <= 31 && $line_int > 0 )
			return TRUE;
		else
			return FALSE;
	} 
	/*
	 *	Fonction pour déterminer si c'est un mois de l'année
	 *	Return : vrai si c'est un mois, FALSE si ce n'est pas le cas
	 */
	public static function is_a_month( $line_str )
	{
		/* -- Tableau avec les mois -- */
		$months_arr = array( 'janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre' );

		/* -- Si le mois de l'année est exprimé en chiffres -- */
		if( is_numeric( $line_str ) )
		{
			/* -- Il doit être inférieur à 12 forcément -- */
			if( $line_str > 0 && $line_str <= 12 )
				return TRUE;
		}
		/* -- Si c'est le mois avec des lettres -- */
		else
		{
			/* -- On teste pour chaque mois s'il correspond à la ligne -- */
			foreach ( $months_arr as $value_str )
			{
				if( self::full_normalize_string( $line_str ) == self::full_normalize_string( $value_str ) )
					return TRUE;
			}
		}

		return FALSE;
	} 

	/*
	 *	Fonction pour déterminer si le chiffre est un jour du mois
	 *	Return : vrai si c'est un jour du mois, FALSE si ce n'est pas le cas
	 */
	public static function is_a_birth_year( $line_int )
	{
		/* -- Si c'est une ligne numérique -- */
		if( is_numeric( $line_int ) && strlen( $line_int ) <= 4 )
		{
			/* -- Si c'est une date avec deux chiffres -- */
			if( strlen( $line_int ) == 2 )
			{
				if( $line_int < substr( date('Y'), -2 ) )
					$line_int = '20' . $line_int;
				else
					$line_int = '19' . $line_int;
			}
			/* -- On considère que les personnes on au moins 16 ans pour pouvoir travailler et pas plus de 100 ans ..  -- */ 
			if( intval( date('Y') ) - 16 >= $line_int && $line_int >= intval( date('Y') ) - 100 )
				return TRUE;
		}
		return FALSE;
	} 

	/*
 	 *	Fonction pour enlèver les possibles symboles séparateurs qui pueut y avoir dans une ligne,
 	 *	Return : Le string sans les symboles et des espaces à la place
	 */
	public static function str_replace_separator_symbols( $line_str )
	{
		/* -- On enlève les tirets -- */
		$line_str = str_replace( TIRET, ESPACE, $line_str );
		/* -- On enlève les '/' -- */
		$line_str = str_replace( SLASH, ESPACE, $line_str );
		/* -- On enlève les paranthèses -- */
		$line_str = str_replace( '(', ESPACE, $line_str );
		$line_str = str_replace( ')', ESPACE, $line_str );
		/* -- On enlève les guillemets -- */
		$line_str = str_replace( '"', ESPACE, $line_str );
		$line_str = str_replace( '«', ESPACE, $line_str );
		$line_str = str_replace( '»', ESPACE, $line_str ); 
		return $line_str;
	}

	/*
	 *	Fonction pour savoir s'il y au moins une chiffre dans une ligne
	 *	Return : TRUE s'il y a une ligne, FALSE s'il n'y a aucune
	 */
	public static function has_a_number( $line_str )
	{
		for ( $i=0; $i < strlen( $line_str ); $i++ )
		{ 
			if( is_numeric( $line_str[ $i ] ) )
				return TRUE;
		}
		return FALSE;
	}

	/* 
	 * 	Fonction pour supprimer les entrées vides sur le tableau passé en paramètre
	 */
	public static function delete_empty_entries( &$array_arr )
	{
		/* -- Vérification -- */
		if( sizeof( $array_arr ) > 0 )
		{
			/* -- Parcourt du tableau en paramètre-- */
			foreach ($array_arr as $key_int => $value_str )
			{
				if( empty( $value_str ) )
					unset($array_arr[ $key_int ] );
			}
		}		
	}

	/*
	 *	Fonction pour savoir si la ligne passée en paramètre est une année
	 *	Return : TRUE si c'est une année ou FALSE sinon
	 */
	public static function str_is_a_valid_year( $line_str )
	{
		if( strlen( $line_str ) == 4  )
		{
			/* -- Si on a retrouvé l'information de date de naissance -- */
			if( self::get_information_array()['Date-de-naissance'] !== NOT_FOUND_TERM )
			{
				$dateInformations_arr = explode( ESPACE, self::get_information_array()['Date-de-naissance'] );
				if( intval( end( $dateInformations_arr ) ) < $line_str  )
					return TRUE; 
			}
			/* -- Sinon on impose une tranche aribitraire --*/
			else
			{
				$endYear = date('Y') + 10;
				$beginYear = date('Y') - 70;
				if( $endYear >= intval( $line_str ) && $beginYear <= intval( $line_str )  )
					return TRUE;
 			}
		}
		return FALSE;
	}

	/*
	 *	Fonction pour déterminer si la ligne est une durée
	 *	Return : TRUE si c'est une durée ou contient une durée, FALSE sinon
	 */
	public static function str_is_a_duration( $line_str )
	{
		/* -- On parcourt les durées pour voir s'il y a une correspondance -- */
		foreach ( self::$durationsNames_arr as  $value_str )
		{			
			if( strpos( $line_str, $value_str ) !== FALSE )
				return TRUE;
		}
		return FALSE;
	}

	/*
 	 *	Fonction pour tester si deux structures sont ressemblables
 	 *	Renvoie TRUE si les structures sont ressemblables, FALSE sinon
	 */
	public static function is_same_structure( $structure1_str, $structure2_str)
	{
		/* -- On ne traite pas les structures vides -- */
		if( $structure1_str !== EMPTY_STRUCTURE && $structure2_str !== EMPTY_STRUCTURE )
		{
			/* -- Si les deux structures sont égales -- */
			if( $structure1_str === $structure2_str )
			{
				/* -- On teste que ce n'est pas des structures seulement avec des mots -- */
				if( !self::structure_contains_only_words( $structure1_str ) )
				{
					return TRUE;
				}
				
			}
		}
		return FALSE;
	}

	/*
	 *	Fonction pour tester que la structure passée en paramètre ne contient pas que des mots
	 * 	Return : TRUE si elle contient que des mots, FALSE si elle ne contient pas que des mots
	 */
	public static function structure_contains_only_words( $structure_str )
	{
		/* -- On découpe chaque structure pour savoir ce qu'il y dans la ligne et on efface les possibles blancs -- */
		$structures_arr = explode( TIRET, $structure_str );
		self::delete_empty_entries( $structures_arr );
		/* -- Parcourt du tableau --*/
		foreach ( $structures_arr as $value_str )
		{
			/* -- Si la structure contient autre chose que des mots --*/
			if( $value_str !== WORD )
				return FALSE;
		}
		return TRUE;
	}

		/*
 	 *	Fonction pour tester si deux structures sont ressemblables
 	 *	Renvoie TRUE si les structures sont ressemblables, FALSE sinon
	 */
	public static function is_similar_structure( $structure1_str, $structure2_str)
	{
		/* -- On découpe en structures simples -- */
		$tagsStructure1_arr = explode( TIRET, $structure1_str );
		$tagsStructure2_arr = explode( TIRET, $structure2_str );
		self::delete_empty_entries( $tagsStructure1_arr );
		self::delete_empty_entries( $tagsStructure2_arr );
		/* -- On ne traite pas les structures vides -- */
		if( $structure1_str !== EMPTY_STRUCTURE && $structure2_str !== EMPTY_STRUCTURE )
		{
			/* -- Si les deux structures commencent par une durée ou une année -- */
			if( $tagsStructure1_arr[ 0 ] === DURATION && $tagsStructure2_arr[ 0 ] === DURATION ||  
				$tagsStructure1_arr[ 0 ] === YEAR && $tagsStructure2_arr[ 0 ] === YEAR )
				return TRUE;
			/* -- Si la structure contient deux années -- */
		}
		return FALSE;
	}

	/*
	 *	Fonction pour retrouver toutes les occurences du $needle_str dans la chaîne
	 *	Return : Un tableau avec les indices de toutes les occurences
	 */
	public static function strpos_r( $haystack_str, $needle_str )
	{
	    if(strlen($needle_str) > strlen($haystack_str))
	        trigger_error(sprintf("%s: length of argument 2 must be <= argument 1", __FUNCTION__), E_USER_WARNING);

	    $seeks = array();
	    while($seek = strrpos($haystack_str, $needle_str))
	    {
	        array_push($seeks, $seek);
	        $haystack_str = substr($haystack_str, 0, $seek);
	    }
	    return array_reverse( $seeks );
	}

	/*
	 * 	Fonction pour enlèver les espaces dans un string
	 *	Return : Le string tout attaché
	 */
	public static function attach_string( $line_str )
	{
		$line_str = str_replace( ESPACE, EMPTY_STR, $line_str );
		$line_str = preg_replace( "#\n|\t|\r#", EMPTY_STR, $line_str );
		return $line_str;
	}


	/*
	 *	Fonction pour enlèver les saut de ligne et les tabulations dans une chaîne
	 *	Return : La chaîne modifiée
	 */
	public static function str_delete_line_end( $string_str )
	{
		$string_str = str_replace("\n","",$string_str); 
		$string_str = str_replace("\r","",$string_str); 
		$string_str = str_replace("\t","",$string_str); 
		return $string_str;
	}




/******************************************************************************************************************************************************************
	Fonctions pour gérer les tableaux contenant les informations et les informations retrouvées
******************************************************************************************************************************************************************/
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
	 *	Fonction pour tester s'il reste des informations à récupérer
	 * 	Return : TRUE si toutes les informations on été trouvées, FALSE sinon
	 */
	public static function all_informations_found()
	{
		foreach ( self::get_information_array() as $value_str ) 
		{
			if( $value_str === NOT_FOUND_TERM )
				return FALSE;
		}

		return TRUE;
	}

	/*
	 *	Fonction pour afficher les résultats de l'algorithme
	 */
	public static function afficher_resultats()
	{
		echo '<p>L\'analyse du CV a trouvé :</p>';
		echo '<ul><b>Informations personnelles</b>';
		foreach ( self::$utilisateurInformation_arr as $key_str => $value_str )
		{
			if( $value_str != NOT_FOUND_TERM )
				echo '<li>' . $key_str . ' : ' . $value_str.'</li>';
		}
		echo '</ul>';
		echo '<ul><b>Expériences professionnelles</b>';
		foreach ( self::$expPros_arr as $key_int => $value_str )
		{
			echo '<li>' . 'Expérience #' . $key_int . ' : ' . $value_str . '</li>';
		}
		echo '</ul>';
		echo '<ul><b>Formations</b>';
		foreach ( self::$formations_arr as $key_int => $value_str )
		{
			echo '<li>' . 'Formation #' . $key_int . ' : ' . $value_str . '</li>';
		}
		echo '</ul>';

	}

	/*
	 * 	Fonction pour ajouter une valeur qui a été trouvée
	 */
	public static function add_found_information( $information_str, $value_str )
	{
		if( strpos($value_str, ALREADY_READ_ENTRY) !== FALSE )
			$value_str = self::str_delete_read_tag( $value_str );
		self::$utilisateurInformation_arr[$information_str] = trim($value_str);
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
	 *	Initalisation du tableau contenant les structures
	 */
	public static function init_array_cv_structures()
	{
		$array_arr = array();
		/* -- Initailisation de chaque entrée que le tableau contiendra -- */
		foreach ( self::get_cv_non_read_content() as $key_int => $value_str )
		{
			$array_arr[ $key_int ] = EMPTY_STRUCTURE;
		}
		self::$CVstructures_arr = $array_arr;
	}
	
	/*
	 *	Fonction GET pour récupérer toutes le tableau de structures
	 */
	public static function get_cv_structures()
	{
		return self::$CVstructures_arr;
	}

	/*
	 *	Fonction GET pour récupérer toutes les informations qui n'ont pas été lues
	 */
	public static function get_cv_non_read_content()
	{
		$tmp_arr = array();

		foreach ( self::get_cv_content() as $key_int => $value_str )
		{
			if( strpos( $value_str, ALREADY_READ_ENTRY ) === FALSE )
				array_push( $tmp_arr, $value_str );
		}

		return $tmp_arr;
	}
	
	/*
	 *	Fonction GET pour les blocs de CV
	 */
	public static function get_blocs_cv()
	{
		return self::$CVBlocs_arr;
	}
	
	/*
	 *	Function pour ajouter des lignes aux informations du CV
	 *	Utilisé pour tester différents cas possibles
	 */
	public static function add_cv_line( $line_str )
	{
		array_push( self::$CVContents_arr, $line_str );
	}





/******************************************************************************************************************************************************************
	Fonctions pour normaliser les strings
******************************************************************************************************************************************************************/
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
