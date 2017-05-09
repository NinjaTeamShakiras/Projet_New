
-- Insertion (Franck) : 28/03/2017 10h30

-- ORDRE D'IMPORTATION
-- ---------------------------------
-- 1) adresse 								*
-- 2) employe 								*
-- 3) entreprise 							*
-- 4) Utilisateur 							*
-- 5) travaille 							*
-- 6) Competences_CV
-- 7) CVa
-- 8) CV_Employe
-- 9) Criteres_Notation_Employe
-- 10) Criteres_notation_entreprise
-- 11) avis_employe
-- 12) avis_entreprise
-- 13) employé_avis_critere
-- 14) entreprise_avis_critere
-- 15) Infos_Complementaires_Profil
-- 16) Infos_Complementaires_Employe
-- 17) Infos_Complementaires_Entreprise
-- 18) Notification
-- 19) Offre_Emploi
-- 20) Postuler
-- ---------------------------------



--
-- 1) ADRESSE
--
INSERT INTO `prozzl_test`.`adresse`(`rue`, `ville`, `code_postal`)
	VALUES  (	'1 rue Jean Jaurès',			'Annecy', 		'74000'	),
			(	'5 rue Notre Dame', 			'Annecy', 		'74000'	),
			(	'1 place Centenaire', 			'Chambery',		'73000'	),
			(	'37 rue Jean Pierre Veyrat', 	'Chambery',		'73000'	),
			(	'68 rue Bobby Sands', 			'Chambery', 	'73000'	),
			(	'191 rue Michaud',				'Chambery',		'73000'	);


--
-- 2) EMPLOYE
--
INSERT INTO `prozzl_test`.`employe`(`nom_employe`, `prenom_employe`, `date_naissance_employe`, `employe_travaille`, 				`mail_employe`,		`telephone_employe`, 	`id_adresse`)
	SELECT 							'Pablo', 		'Juan', 			'1996-07-16',				1,				 'JuanPablo@prozzl_test.fr', 		'0605040302', 			id_adresse
		FROM adresse
	WHERE id_adresse = 1 ;

INSERT INTO `prozzl_test`.`employe`(`nom_employe`, `prenom_employe`, `date_naissance_employe`, `employe_travaille`,		 			`mail_employe`, 	`telephone_employe`, 	`id_adresse`)
	SELECT 							'Jean',			'Neige', 			'1960-01-01', 				0,	 			'JeanNeige@prozzl_test.fr', 		'0606060606', 			id_adresse
		FROM adresse
	WHERE id_adresse = 2 ;

INSERT INTO `prozzl_test`.`employe`(`nom_employe`, `prenom_employe`, `date_naissance_employe`, `employe_travaille`,		 			`mail_employe`, 	`telephone_employe`, 	`id_adresse`)
	SELECT 							'Martin',		'Dupont',				'1970-04-25',			0,				  'MartinDupont@prozzl_test.fr',	'0615649789',			id_adresse
		FROM adresse
	WHERE id_adresse = 3 ;

INSERT INTO `prozzl_test`.`employe`(`nom_employe`, `prenom_employe`, `date_naissance_employe`, `employe_travaille`,		 			`mail_employe`, 	`telephone_employe`, 	`id_adresse`)
	SELECT 							'Muraton',		'Franck',				'1748-02-18',			1,				'FranckyMuraton@prozzl_test.fr',	'0605040302',			id_adresse
		FROM adresse
	WHERE id_adresse = 4 ;

INSERT INTO `prozzl_test`.`employe`(`nom_employe`, `prenom_employe`, `date_naissance_employe`, `employe_travaille`,		 			`mail_employe`, 	`telephone_employe`, 	`id_adresse`)
	SELECT 							'Sacquet',		'Frodon',				'1002-05-08',			0,				'FrodonSacquet@prozzl_test.fr',		'0687976434',			id_adresse
		FROM adresse
	WHERE id_adresse = 5 ;	





--
-- 3) ENTREPRISE
--
INSERT INTO `prozzl_test`.`entreprise`(`nom_entreprise`, `recherche_employes`, 			`mail_entreprise`, 	`telephone_entreprise`, 	`id_adresse`)
	SELECT 									'Facebook',			0,				'Facebook@facebook.us',			'0646565646',			id_adresse
		FROM adresse
	WHERE id_adresse = 1;

INSERT INTO `prozzl_test`.`entreprise`(`nom_entreprise`, `recherche_employes`, 			`mail_entreprise`, 	`telephone_entreprise`, 	`id_adresse`)
	SELECT 									'Linkedin',			0,					'Linkedin@lkdn.us',			'0698871568',			id_adresse
		FROM adresse
	WHERE id_adresse = 2;

INSERT INTO `prozzl_test`.`entreprise`(`nom_entreprise`, `recherche_employes`, 			`mail_entreprise`, 	`telephone_entreprise`, 	`id_adresse`)
	SELECT 									'Github',			0,					'github@github.fr',			'0456879795',			id_adresse
		FROM adresse
	WHERE id_adresse = 3;

INSERT INTO `prozzl_test`.`entreprise`(`nom_entreprise`, `recherche_employes`, 			`mail_entreprise`, 	`telephone_entreprise`, 	`id_adresse`)
	SELECT 									'Twitter',			0,					'Twitter@twitter.uk',		'0660068478',			id_adresse
		FROM adresse
	WHERE id_adresse = 4;




--
-- 4) UTILISATEUR
--
			-- employe
INSERT INTO `prozzl_test`.`Utilisateur`(`login`, 	`mot_de_passe`, 		`role`, 	`id_employe`, 	`id_entreprise`, `date_creation_utilisateur`, `date_derniere_connexion`)
	SELECT 								'MF', 			'password', 	'employe', 		id_employe, 		NULL,					now(),						now() 
		FROM employe
	WHERE nom_employe = "Muraton";

INSERT INTO `prozzl_test`.`Utilisateur`(`login`, 	`mot_de_passe`, 		`role`, 	`id_employe`, 	`id_entreprise`, `date_creation_utilisateur`, `date_derniere_connexion`)
	SELECT 								'MD', 			'password', 	'employe', 		id_employe,			 NULL,					now(), 						now() 
		FROM employe
	WHERE nom_employe = "Martin";

INSERT INTO `prozzl_test`.`Utilisateur`(`login`, 	`mot_de_passe`, 		`role`, 	`id_employe`, 	`id_entreprise`, `date_creation_utilisateur`, `date_derniere_connexion`)
	SELECT 								'JN', 			'password', 	'employe', 		id_employe, 		NULL,					now(), 						now() 
		FROM employe
	WHERE nom_employe = "Jean";

INSERT INTO `prozzl_test`.`Utilisateur`(`login`, 	`mot_de_passe`, 		`role`, 	`id_employe`, 	`id_entreprise`, `date_creation_utilisateur`, `date_derniere_connexion`)
	SELECT 								'PJ', 			'password', 	'employe', 		id_employe, 		NULL,					now(), 						now()  
		FROM employe
	WHERE nom_employe = "Pablo";

INSERT INTO `prozzl_test`.`Utilisateur`(`login`, 	`mot_de_passe`, 		`role`, 	`id_employe`, 	`id_entreprise`, `date_creation_utilisateur`, `date_derniere_connexion`)
	SELECT 								'SF', 			'password', 	'employe', 		id_employe,			NULL,					now(), 						now() 
		FROM employe
	WHERE nom_employe = "Sacquet";



			-- entreprise
INSERT INTO `prozzl_test`.`Utilisateur`(`login`, 	`mot_de_passe`, 		`role`, 	`id_employe`, 	`id_entreprise`,  `date_creation_utilisateur`, `date_derniere_connexion`)
	SELECT 								'FB', 			'password', 'entreprise', 			NULL,		 id_entreprise, 			now(), 						now() 
		FROM entreprise
	WHERE nom_entreprise = "Facebook";

INSERT INTO `prozzl_test`.`Utilisateur`(`login`, 	`mot_de_passe`, 		`role`, 	`id_employe`, 	`id_entreprise`,  `date_creation_utilisateur`, `date_derniere_connexion`)
	SELECT 								'TW', 			'password',	'entreprise',			 NULL, 		id_entreprise, 				now(), 						now()
		FROM entreprise
	WHERE nom_entreprise = "Twitter";

INSERT INTO `prozzl_test`.`Utilisateur`(`login`, 	`mot_de_passe`, 		`role`, 	`id_employe`, 	`id_entreprise`,  `date_creation_utilisateur`, `date_derniere_connexion`)
	SELECT 								'LKDN', 		'password', 'entreprise',			NULL, 		id_entreprise, 				now(), 						now()
		FROM entreprise
	WHERE nom_entreprise = "Linkedin";

INSERT INTO `prozzl_test`.`Utilisateur`(`login`, 	`mot_de_passe`, 		`role`, 	`id_employe`, 	`id_entreprise`,  `date_creation_utilisateur`, `date_derniere_connexion`)
	SELECT 								'GIT', 			'password', 'entreprise', 			NULL, 		id_entreprise, 				now(), 						now()
		FROM entreprise
	WHERE nom_entreprise = "Github";





--
-- 5) TRAVAILLE
--
INSERT INTO `prozzl_test`.`travaille`(`date_debut_contrat`, `date_fin_contrat`, `duree_contrat`, 	`id_employe`, `id_entreprise`	)
	SELECT 								'2017-04-01', 			'2017-04-03',			2,	 		id_employe,		id_entreprise
    	FROM employe,entreprise
    WHERE id_employe = 1 AND id_entreprise = 1;

INSERT INTO `prozzl_test`.`travaille`(`date_debut_contrat`, `date_fin_contrat`, `duree_contrat`, 	`id_employe`, `id_entreprise`	)
	SELECT 								'2017-04-01', 			'2017-04-29',			29, 		id_employe, 	id_entreprise
    	FROM employe,entreprise
    WHERE id_employe = 2 AND id_entreprise = 2;

INSERT INTO `prozzl_test`.`travaille`(`date_debut_contrat`, `date_fin_contrat`, `duree_contrat`, 	`id_employe`, `id_entreprise`	)
	SELECT 								'2017-04-01', 			'2017-04-28',			28, 		id_employe, 	id_entreprise
    	FROM employe,entreprise
    WHERE id_employe = 3 AND id_entreprise = 3;

INSERT INTO `prozzl_test`.`travaille`(`date_debut_contrat`, `date_fin_contrat`, `duree_contrat`, 	`id_employe`, `id_entreprise`	)
	SELECT 								'2017-04-01', 			'2017-04-27',			27,			id_employe, 	id_entreprise
    	FROM employe,entreprise
    WHERE id_employe = 4 AND id_entreprise = 4;

INSERT INTO `prozzl_test`.`travaille`(`date_debut_contrat`, `date_fin_contrat`, `duree_contrat`, 	`id_employe`, `id_entreprise`	)
	SELECT 								'2017-04-01', 			'2017-05-01',			30, 		id_employe, 	id_entreprise
    	FROM employe,entreprise
    WHERE id_employe = 5 AND id_entreprise = 2;








--
-- 6) COMPETENCES_CV /!\ ne pas remplir !! /!\
--




--
-- 7) CV /!\ ne pas remplir !! /!\
--





--
-- 8) CV_EMPLOYE /!\ ne pas remplir !! /!\
--






--
-- 9) CRITERES_NOTATION_EMPLOYE
--
INSERT INTO `prozzl_test`.`criteres_notation_employe`(`nom_critere_employe`, `critere_note`, `description_critere`) 
VALUES  (	"Type de contrat",				 										0, 		"Type de contrat que vous aviez au sein de l'entreprise"														),
		(	"Relation avec les managers",											1, 		"Note de 1 à 10 correspondant à votre relation avec les managers"												),
		(	"Relation avec les collègues",											1, 		"Note de 1 à 10 correspondant à votre relation avec vos collègues"												),
		(	"Politique RH (culture d'entreprise, formations, événements)", 			1, 		"Note de 1 à 10 correspondant à la politique des relations humaines au sein de l'entreprise"					),
		(	"Equilibre entre la vie personelle et professionelle", 					1, 		"Note de 1 à 10 correspondant à l'équilibre entre vos professionelles et personelles"							),
		(	"Qualité des missions / diversité des tâches", 							1, 		"Note de 1 à 10 correspondant à la qualité des missions confiées et la diveristé des tâches effectuées"			),
		(	"Responsabilités / Confiance accordée par l'entreprise", 				1, 		"Note de 1 à 10 correspondant aux responsabilités et à la confiance accordée par l'entreprise"					),
		(	"Niveau de stress", 													1, 		"Note de 1 à 10 correspondant au stress personnel ressenti au sein de l'entreprise"								),
		(	"Opportunités d'évolution", 											1, 		"Note de 1 à 10 correspondant aux opportunités d'évolution proposées par l'entreprise"							),
		(	"Qualité des rétributions financières",									1, 		"Note de 1 à 10 correspondant à la qualité des rétributions financières offertes par l'entreprise"				),
		(	"Points forts à conserver", 											0, 		"Paragraphe de 300 caractères max. expliquant les points forts de l'entreprise que vous encouragez à conserver"	),
		(	"Axes d'amélioration",													0, 		"Paragraphe de 300 caractères max. indiquant les axes d'amélioration que vous suggérez à l'entreprise"			);
		--	  non critère                                                    	note 				description






--
-- 10) CRITERES_NOTATION_ENTREPRISE
--
INSERT INTO `prozzl_test`.`criteres_notation_entreprise`(`nom_critere_entreprise`, `critere_note`, `description_critere`)
VALUES  (	"Type de contrat",								0, 	"Type de contrat de l'employé au sin de l'entreprise"																),
		(	"Qualité globale du travail",					1, 	"Note de 1 à 10 correspondantà la qualité du travail de l'employé au sein de l'entreprise"							),
		(	"Relation avec les autres collaborateurs",		1, 	"Note de 1 à 10 correspondant aux relations du salarié avec les autres collaborateurs"								),
		(	"Relation avec les clients",					1, 	"Note de 1 à 10 correspondant aux relations du salarié avec les clients de l'entreprise"							),
		(	"Prises d'initiatives",							1, 	"Note de 1 à 10 correspondant aux prises d'initiatives du salarié au sein de l'entreprise"							),
		(	"Motivation",									1, 	"Note de 1 à 10 correspondant à la motivation du salarié au sein de l'entreprise"									),
		(	"Compétences pour le poste",					1, 	"Note de 1 à 10 correpondant aux compétences du salarié par rapport à son poste au sein de l'entreprise"			),
		(	"Capacité d'évolution / compréhension",			1, 	"Note de 1 à 10 correspondant à la capacité d'évolution et à la capacité de compréhension des tâches du salarié"	),
		(	"Capacite d'adaptation",						1, 	"Note de 1 à 10 correspondant à la capacité d'adaptation de l'employé"												),
		(	"Points forts à conserver",						0, 	"Paragraphe de 300 caractères max. expliquant les points forts du salarié que vous encouragez à conserver"			),
		(	"Axes d'amélioration",							0, 	"Paragraphe de 300 caractères max. indiquant les axes d'amélioration que vous suggérez à l'employé"					);
		--	  non critère                                 note 				description





--
-- 11) AVIS_EMPLOYE
--
INSERT INTO `prozzl_test`.`avis_employe`(`note_generale_avis`, `date_creation`, `nb_signalements`, `id_employe`, `id_utilisateur`)
	VALUES  (	0,		'2017-01-01',		12,		1,		6	),
			(	1,		'2017-02-01',		16,		2,		7	),
			(	2,		'2017-03-01',		15,		3,		8	),
			(	3,		'2017-04-01',		12,		4,		9	),
			(	4,		'2017-05-01',		22,		5,		6	),
			(	5,		'2017-06-01',		5,		1,		7	),
			(	5,		'2017-07-01',		7,		2,		8	),
			(	6,		'2017-08-01',		84,		3,		9	),
			(	7,		'2017-09-01',		45,		4,		6	),
			(	8,		'2017-10-01',		32,		5,		7	),
			(	9,		'2017-11-01',		65,		1,		8	),
			(	10,		'2017-12-01',		32,		2,		9	);
		--	  note 			date      	  signale   idEnt   idUtil






--
-- 12) AVIS_ENTREPRISE
--
INSERT INTO `prozzl_test`.`avis_entreprise`(`note_generale_avis`, `date_creation`, `nb_signalements`, `id_entreprise`, `id_utilisateur`)
	VALUES  (	0,		'2016-01-01',		12,		1,		1	),
			(	1,		'2016-02-01',		16,		2,		2	),
			(	2,		'2016-03-01',		15,		3,		3	),
			(	3,		'2016-04-01',		12,		4,		4	),
			(	4,		'2016-05-01',		22,		1,		5	),
			(	5,		'2016-06-01',		5,		2,		1	),
			(	5,		'2016-07-01',		7,		3,		2	),
			(	6,		'2016-08-01',		84,		4,		3	),
			(	7,		'2016-09-01',		45,		1,		4	),
			(	8,		'2016-10-01',		32,		2,		5	),
			(	9,		'2016-11-01',		65,		3,		1	),
			(	10,		'2016-12-01',		32,		4,		2	);
		--	  note 			date      	  signale   idEnt   idUtil



--
-- 13) EMPLOYE_AVIS_CRITERE
--






--
-- 14) ENTREPRISE_AVIS_CRITERE 
--






--
-- 15) INFOS_COMPLEMENTAIRES_PROFIL
--





--
--  16) INFOS_COMPLEMENTAIRES_EMPLOYE
--




--
-- 17) INFOS_COMPLEMENTAIRES_ENTREPRISE
--





--
-- 18) NOTIFICATIONS 
--













--
-- 19) OFFRE EMPLOI 
--







--
-- 20) POSTULER 
--
