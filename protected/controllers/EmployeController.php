<?php

class EmployeController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}


	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		$user = Yii::app()->user;

		//Si c'est un employe :
			//Il a accès à la supression, a l'index, à la vue et la maj
			//Il n'a pas accès à la partie admin
		if($user->getState('type') == 'employe')
		{
			return array(
				array('allow',
					  'actions'=>['index','view', 'update', 'delete','ajoutinfos'],
					),
				array('deny',
					  'actions'=>['admin'],
					),
			);
		}

		//Si c'est une entreprise :
			//Il a accès à la vue et à l'index
			//Il n'a pas accès à la maj, à la supression et à la partie admin
		if($user->getState('type') == 'entreprise')
		{

			return array(
					array('allow',
						  'actions'=>['view', 'index'],
						),
					array('deny',
						  'actions'=>['update','admin', 'delete'],
						),
			);
		}	

		//Si c'est un utilisateur non connecté
			//Il a juste accès à l'index et à la vues
		if($user->getState('type') == NULL)
		{
			return array(
					array('allow',
						  'actions'=>['index', 'view'],
						  ),
					);
		}
	}



	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Employe;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Employe']))
		{
			$model->attributes=$_POST['Employe'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_employe));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		if(isset($_POST['btnretour']))
		{
			$this->redirect(array('employe/view', 'id'=>$id));
		}

		$model=$this->loadModel($id);
		
		$utilisateur = Utilisateur::model()->findByAttributes(array('id_employe'=>$model->id_employe));		
		$adresse = Adresse::model()->findByAttributes(array('id_adresse'=>$utilisateur->id_adresse));

		if($adresse == null)
		{
			$adresse = new Adresse;
		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Employe']) && isset($_POST['Adresse']) && isset($_POST['Utilisateur']))
		{

			//Transormation de la date puisque en Anglais dans la base en français dans le site
			//On enregistre les nouvelles données dans les modèles
			$model->attributes = $_POST['Employe'];
			$model->date_naissance_employe = $this->changeDateBDD($_POST['Employe']['date_naissance_employe']);
			
			$adresse->attributes = $_POST['Adresse'];
			$adresse->save();

			$utilisateur->id_adresse = $adresse->id_adresse;
			$utilisateur->site_web = $_POST['Utilisateur']['site_web'];
			$utilisateur->telephone = $_POST['Utilisateur']['telephone'];
			$utilisateur->telephone2 = $_POST['Utilisateur']['telephone2'];
			$utilisateur->mail = $_POST['Utilisateur']['mail'];

			var_dump($adresse);

			//On enregistre le modèle et on redirige
			if($model->save() && $utilisateur->save())
			{
				Yii::app()->user->setFlash('success_maj_infos_persos', "<p style = color:blue;>Votre profil à bien été mise à jour !</p>");
				$this->redirect(array('view','id'=>$model->id_employe));
			}

		}

		$this->render('update',array(
			'model'=>$model, 'adresse'=>$adresse, 'utilisateur'=>$utilisateur,
		));
	}




	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		//On récupère l'utilisateur dans la base de données
		$utilisateur = Utilisateur::model()->FindByAttributes(array('id_employe'=>$id));

		/*Pour toutes les classes suivantes, on supprime soit l'occurence en entier, soit le champ
		id_utilisateur est mis a null dans l'occurence */

		//Dans la class Travaille
		$jobs = Job::model()->FindAll();

		foreach ($jobs as $job)
		{
			if($job->id_employe == $utilisateur->id_employe)
				$job->delete();
		}


		//Dans la class Postuler
		$postule = Postuler::model()->FindAll();

		foreach ($postule as $post)
		{
			if($post->id_employe == $utilisateur->id_employe)
				$post->delete();
		}


		//Dans la class Competence
		$competences = Competence::model()->FindAll();

		foreach($competences as $competence)
		{
			if($competence->id_employe == $utilisateur->id_employe)
				$competence->delete();
		}


		//Dans la class Expériences pro
		$exp_pros = ExperiencePro::model()->FindAll();

		foreach($exp_pros as $exp)
		{
			if($exp->id_employe == $utilisateur->id_employe)
				$exp->delete();
		}

		
		//Dans la class Formation
		$formations = Formation::model()->FindAll();

		foreach($formations as $formation)
		{
			if($formation->id_employe == $utilisateur->id_employe)
				$formation->delete();
		}

		//On supprime l'utilisateur
		Yii::app()->user->logout(false);
		$utilisateur->delete();
					

		//On supprime l'employé
		$model=$this->loadModel($id)->delete();
		$model->delete();

		//On créé un message flash pour l'utilisateur
		if(!isset($_GET['ajax']))
			Yii::app()->user->setFlash('suppr_compte', "<p style = color:blue;>Votre profil à bien été supprimé !</p>");
		
		//On reidrige ensuite vers la page d'accueil
		$this->redirect('index.php');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		unset(Yii::app()->session['login']);
		Yii::app()->session['login'] = 'employe';

		$dataProvider=new CActiveDataProvider('Employe');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Employe('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Employe']))
			$model->attributes=$_GET['Employe'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	
	/* Fonction qui change la date au format Américain pour la BDD */
	public function changeDateBDD($date)
	{
			$result = NULL;
			$day = 0;
			$month = 0;
			$year = 0;

			//On récupère chaque valeur grâce a substr
			$year = substr($date, 6, 4);
			$month = substr($date, 3, 2);
			$day = substr($date, 0, 2);

			$result = $year."-".$month."-".$day;

			return $result;
	}

	/*	Fonction qui change la date au format français
	@param $date est une date récupérée depuis la BDD
	*/
	protected function changeDateNaissance($date)
	{
		$result = NULL;
		$day = 0;
		$month = 0;
		$year = 0;

		//On récupère chaque valeur grâce a substr
		$year = substr($date, 0, 4);
		$month = substr($date, 5, 2);
		$day = substr($date, 8, 2);

		$result = $day."/".$month."/".$year;

		return $result;
	}


	/* Fonction d'insertions des infos personnelles dans la base de données
	--> L'utilisateur renseigne ses infos persos et elles sont enregistrées en BDD*/
	public function actionAjoutInfos()
	{
		//On créé une variable globale définissant si on est côté employé ou entreprise sur le site
		unset(Yii::app()->session['login']);
		Yii::app()->session['login'] = 'employe';

		//On récupère l'utilisateur
		$user = Utilisateur::model()->FindBYattributes(array("mail"=>Yii::app()->user->GetId()));

		//Si l'utilisateur n'est pas connecté, on force la connexion
		if($user == null)
		{
			Yii::app()->user->loginRequired();
		}


		if(isset($_POST['retour'])){
			$this->redirect(array('employe/view', 'id'=>$user->id_employe));
		}

		$this->render('ajoutinfos');

	}

	public function actionajoutCompetences()
	{
		//On récupère l'utilisateur
		$user = Utilisateur::model()->FindBYattributes(array("mail"=>Yii::app()->user->GetId()));

		//Si il clique sur "ajouter une compétence", on la créé
		if(isset($_POST['Competence']))
		{
			$competence = new Competence;

			//On attributs les valeurs entrés par l'utilisateur dans le model competence
			$competence->attributes = $_POST['Competence'];
			$competence->id_employe = $user->id_employe;

			//On save le model competence 
			if($competence->save())
			{
				//Si c'est OK, on affiche un message de confirmation
				Yii::app()->user->setFlash('success_ajout_competence', "<p style = color:blue;>La competence ".$competence->intitule_competence." à bien été ajoutée !</p>");
			}
		}

		$this->render('ajoutinfos');
	}

	public function actionajoutFormation()
	{
		//On récupère l'utilisateur
		$user = Utilisateur::model()->FindBYattributes(array("mail"=>Yii::app()->user->GetId()));

		//Si il clique sur ajouter une formation, on la créé
		if(isset($_POST['Formation']))
		{
			$formation = new Formation;

			//On attributs les valeurs entrés par l'utilisateur dans le model Formation
			$formation->attributes = $_POST['Formation'];
			$formation->date_debut_formation = $this->changeDateBDD($_POST['Formation']['date_debut_formation']);
			$formation->date_fin_formation = $this->changeDateBDD($_POST['Formation']['date_fin_formation']);
			$formation->id_employe = $user->id_employe;

			//On save le model formation
			if($formation->save())
			{
				//Si c'est OK, on affiche un message de confirmation
				Yii::app()->user->setFlash('success_ajout_formation', "<p style = color:blue;>La formation ".$formation->intitule_formation." à bien été ajoutée !</p>");
			}
		}

		$this->render('ajoutinfos');
	}

	public function actionajoutExpPro()
	{
		//On récupère l'utilisateur
		$user = Utilisateur::model()->FindBYattributes(array("mail"=>Yii::app()->user->GetId()));

		//Si il clique sur ajouter une expérience pro, on la créé
		if(isset($_POST['btnajoutexppro']) && isset($_POST['ExperiencePro']))
		{
			$experiencePro = new ExperiencePro;

			//On attributs les valeurs entrés par l'utilisateur dans le model experience
			$experiencePro->attributes = $_POST['ExperiencePro'];
			$experiencePro->date_debut_experience = $this->changeDateBDD($_POST['ExperiencePro']['date_debut_experience']);
			$experiencePro->date_fin_experience = $this->changeDateBDD($_POST['ExperiencePro']['date_fin_experience']);
			$experiencePro->id_employe = $user->id_employe;
				
			//On save le model experience
			if($experiencePro->save())
			{
				//Si c'est OK, on affiche un message de confirmation
				Yii::app()->user->setFlash('success_ajout_exp', "<p style = color:blue;>L'expérience pro ".$experiencePro->intitule_experience." à bien été ajoutée !</p>");
			}	
		}

		$this->render('ajoutinfos');
	}

	public function choixAjoutMAJInfos()
	{
		if(isset($_POST['btnmaj']))
		{

		}
		else if(isset($_POST['btnajout']))
		{
			$this->render('ajoutInfos');
		}	
	}


	/**
	 * Fonction pour télécharger le CV de l'employé
	 */
	public function actionUploadCV( $id_int )
	{
		/* -- On charge les propriétés de l'employé pour ajouter le cv en pdf -- */ 
		$employe = $this->loadModel( $id_int );
		
		if( !is_null( $employe->cv_pdf ) )
			$employe->cv_pdf = null;

		$employe->cv_pdf = CUploadedFile::getInstance( $employe, 'cv_pdf');
        if ( $employe->save() )
        {
        	/* -- Création d'un dossier pour sauvegarder le pdf s'il n'existe pas déjà -- */
        	if( !file_exists( './upload/' . $id_int ) )
        		mkdir( './upload/' . $id_int );
        	/* -- Sauvegarde du CV -- */
		    $employe->cv_pdf->saveAs( './upload/' . $id_int . '/cv_' . $id_int . '.pdf' );
			

			//$myurl = 'filename.pdf['.$pagenumber.']';
			/*$imagick = new Imagick('file.pdf[0]');
			$imagick->setImageFormat('png');
			file_put_contents( './upload/' . $id_int . '/cv_' . $id_int . '.png', $imagick );*/
		    
		    

		    /* -- Redirection vers le profil -- */
		    $url =  $this->createUrl( 'employe/view', array( 'id' => $id_int ) );
			$this->redirect( $url );
		}
	}

	/*
	 *	Fonction pour uploader un CV sans que l'utilisateur soit connecté
	 */
	public function actionUploadTmpCV()
	{
		/* -- On fait attendre avec sleep() faut penser à faire un chargement en javascript -- */
		$employe = new Employe();
		/* -- Récupération du CV -- */
		$employe->cv_pdf = CUploadedFile::getInstance( $employe, 'cv_pdf');

		if( !is_null( $employe->cv_pdf ) )
		{
			$id_int = session_id();
			$path_str = './upload/session/';

			/* -- Création d'un dossier pour sauvegarder le pdf s'il n'existe pas déjà -- */
	        if( !file_exists( $path_str . $id_int ) )
	        	mkdir( $path_str . $id_int );
	        /* -- Sauvegarde du CV -- */
			$employe->cv_pdf->saveAs( $path_str . $id_int . '/cv_' . $id_int . '.pdf' );
			/* -- Redirection vers le profil -- */
	    	$url =  $this->createUrl( 'site/redirectInscriptionCV', array( 'token' => $id_int ) );
			$this->redirect( $url );
		}
		$url_str =  $this->createUrl( 'site/redirectInscriptionCV' );
		$this->redirect( $url_str );
	}


	/*Fonction apellée dans ls paramètres du compte
	--> Soit on se déconnecte, soit on supprime le compte*/
	public function actionParametres()
	{
		//S'il cliques sur déconnexion, on apelle la fonction logout de SiteController
		if(isset($_POST['btndeco']))
		{
			Yii::app()->user->logout(false);
			Yii::app()->user->setFlash('logout_ok', "<p style = color:blue;>Vous avez bien été déconnecté(e) !</p>");
			$this->redirect(array('employe/index'));
		}

		//S'il cliques sur supression du compte, on apelle actionDelete de ce controller
		if(isset($_POST['btnsupcompte']))
		{
			$utilisateur = Utilisateur::model()->FindByAttributes(array('mail'=>Yii::app()->user->getID()));
			$this->redirect(array('employe/delete', 'id'=>$utilisateur->id_employe));
		}

		if(isset($_POST['btnmodifco']))
		{
			$this->redirect(array('site/modifParamCo'));
		}

		$this->render('parametres');
	}

	/*Fonction qui change le numéro de téléphone pour un affichage avec des points tous les deux chiffres
	@params $telephone est le numéro de téléphone*/
	public function afficheTelephone($telephone)
	{
		$res = "";

		for($i = 0; $i<10; $i++)
		{
			//Tous les deux chiffres on ajoute un point
			if($i%2 == 0)
			{
				$num = substr($telephone, $i, 2);
				$res .= $num.".";
			}

			//On enlève le point en trop
			$res = substr($res, 0, 14);
		}

		return $res;
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Employe the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Employe::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Employe $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='employe-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	
}// END CONTROLLER	
