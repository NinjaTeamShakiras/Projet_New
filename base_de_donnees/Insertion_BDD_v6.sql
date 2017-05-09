--
-- 1) ADRESSE
--
INSERT INTO `prozzl_test`.`adresse`(`rue`, `ville`, `code_postal`)
	VALUES  (	'1 rue Jean Jaurès',			'Annecy', 		'74000'	),
			(	'5 rue Notre Dame', 			'Annecy', 		'74000'	);


--
-- 2) EMPLOYE
--
INSERT INTO `prozzl_test`.`employe`(`nom_employe`, `prenom_employe`, `date_naissance_employe`, `employe_travaille`)
	SELECT 							'Pablo', 		'Juan', 			'1996-07-16',				1
		FROM adresse
	WHERE id_adresse = 1 ;


--
-- 3) ENTREPRISE
--
INSERT INTO `prozzl_test`.`entreprise`(`nom_entreprise`, `nombre_employes`, `recherche_employes`, `secteur_activite_entreprise`, `anne_creation_entreprise`,`age_moyen_entreprise`)
	SELECT 									'Facebook',			10,					0,					'réseaux sociaux',					'2000',					'17'
		FROM adresse
	WHERE id_adresse = 2;




--
-- 4) UTILISATEUR
--
			-- employe
INSERT INTO `prozzl_test`.`Utilisateur`(`mail`, 			`mot_de_passe`, 		`role`, `date_creation_utilisateur`, `date_derniere_connexion`, `telephone`, 	`telephone2`, `site_web`,			`id_employe`, 	`id_entreprise`, `id_adresse` )
	SELECT 								'employe', 				'mdp', 			'employe',				now(),						now(), 			'0610203040',	'0610203041', 'www.employe.fr',		id_employe, 		NULL,				1
		FROM employe
	WHERE nom_employe = "Pablo";

			-- entreprise
INSERT INTO `prozzl_test`.`Utilisateur`(`mail`, 			`mot_de_passe`, 		`role`, `date_creation_utilisateur`, `date_derniere_connexion`, `telephone`, 	`telephone2`, `site_web`,			`id_employe`, 	`id_entreprise`, `id_adresse` )
	SELECT 								'entreprise', 			'mdp', 		'entreprise',				now(),						now(), 			'0610203040',	'0610203041', 'www.entreprise.fr',		NULL, 		id_entreprise,			2
		FROM entreprise
	WHERE nom_entreprise = "Infomaniak";




--
-- 5) TRAVAILLE
--
INSERT INTO `prozzl_test`.`job`(`date_debut_contrat`, `date_fin_contrat`, `duree_contrat`, 	`id_employe`, `id_entreprise`	)
	SELECT 								'2017-04-01', 	'2017-04-03',			2,	 		id_employe,		id_entreprise
    	FROM employe,entreprise
    WHERE id_employe = 1 AND id_entreprise = 1;








--
-- 19) OFFRE EMPLOI 
--
INSERT INTO `prozzl_test`.`Offre_Emploi`(`date_creation_offre_emploi`, `poste_offre_emploi`, `type_offre_emploi`, `date_debut_offre_emploi`, `salaire_offre_emploi`, `experience_offre_emploi`,`description_offre_emploi`, `id_entreprise`)
	VALUES  (	now(),		'Commercial',			'CDI ', 			'2017-04-12'	,1200, 	'BAC STMG',		'Achat,vente en tout genre', 		1	),
			(	now(),		'Assistant',			'CDD ', 			'2017-04-13'	,1500, 	'BAC L',		'Gestion de plannig',		 		1	),
			(	now(),		'Developpeur',			'CDD ', 	 		'2017-04-14'	,3200, 	'BAC S',		'Maintenance de site web',	 		1	),
			(	now(),		'Ingénieur systeme',	'CDI ',				'2017-04-15'	,2200, 	'BAC S',		'Maintenance serveur',		 		1	),
			(	now(),		'Commercial',			'CDD ', 	 		'2017-04-16'	,1450, 	'BAC S',		'Vente dans l\'immobilier',	 		1	),
			(	now(),		'Commercial',			'Stage ', 	 		'2017-04-17'	,400, 	'BREVET',		'Sous-fifre qui apporte le café', 	1	),
			(	now(),		'Commercial',			'CDD ', 	 		'2017-04-18'	,1700, 	'BAC S',		'Achat de materiels ménagé', 		1	),
			(	now(),		'Commercial',			'CDI ', 	 		'2017-04-19'	,1800, 	'BAC STMG',		'Achat,vente ordinateur portable',	1	);
		--	  date_crea 		poste 				type 				date_debut		salaire 	experience 				description 		entreprise






--
-- 20) POSTULER 
--
INSERT INTO `prozzl_test`.`Postuler`(`id_employe`,`id_offre_emploi`,`date_postule`)
	VALUES  (	1,			1,			'2017-03-12'	),
			(	1,			2,			'2017-03-25'	),
			(	1,			3,			'2017-04-06'	);
		--	  employe 	offre_emploi 		date_postule