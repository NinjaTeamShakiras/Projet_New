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
			'postOnly + delete', // we only allow deletion via POST request
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
			$utilisateur->telephone = $_POST['Utilisateur']['telephone'];
			$utilisateur->telephone2 = $_POST['Utilisateur']['telephone2'];
			$utilisateur->mail = $_POST['Utilisateur']['mail'];

			var_dump($adresse);

			//On enregistre le modèle et on redirige
			if($model->save() && $utilisateur->save())
				$this->redirect(array('view','id'=>$model->id_employe));

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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
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

	/*Fonction qui affiche la page choixAjoutCV*/
	public function actionChoixAjoutCV()
	{
		//On créé une variable globale définissant si on est côté employé ou entreprise sur le site
		unset(Yii::app()->session['login']);
		Yii::app()->session['login'] = 'employe';

		$user = Utilisateur::model()->FindBYattributes(array("mail"=>Yii::app()->user->GetId()));
		
		if($user == null)
		{
			Yii::app()->user->loginRequired();
		}
		
		$this->render('choixAjoutCV');
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

		/*if(isset($_POST['btnajoutcompetence']))
		{
			$competence = new Competence;
			$user = Utilisateur::model()->FindBYattributes(array("mail"=>Yii::app()->user->GetId()));

			//On attributs les valeurs entrés par l'utilisateur dans le model competence
			$competence->attributes = $_POST['Competence'];
			$competence->id_employe = $user->id_employe;

			//On save le model competence 
			$competence->save();

			$this->redirect(array('employe/view', 'id'=>$user->id_employe));
		}*/



		/*$formation = new Formation;
		$experiencePro = new ExperiencePro;
		$competence = new Competence;
		$user = Utilisateur::model()->FindBYattributes(array("mail"=>Yii::app()->user->GetId()));

		if($user==null)
		{
			Yii::app()->user->loginRequired();
		}

		if(isset($_POST['Formation']) || isset($_POST['ExperiencePro']) || isset($_POST['Competence']))
		{
			if(isset($_POST['Formation']))
			{
				//On attributs les valeurs entrés par l'utilisateur dans le model Formation
				$formation->attributes = $_POST['Formation'];
				$formation->date_debut_formation = $this->changeDateBDD($_POST['Formation']['date_debut_formation']);
				$formation->date_fin_formation = $this->changeDateBDD($_POST['Formation']['date_fin_formation']);
				$formation->id_employe = $user->id_employe;

				//On save le model formation
				$formation->save();
			}
			
			if(isset($_POST['ExperiencePro']))
			{
				//On attributs les valeurs entrés par l'utilisateur dans le model experience
				$experiencePro->attributes = $_POST['ExperiencePro'];
				$experiencePro->date_debut_experience = $this->changeDateBDD($_POST['ExperiencePro']['date_debut_experience']);
				$experiencePro->date_fin_experience = $this->changeDateBDD($_POST['ExperiencePro']['date_fin_experience']);
				$experiencePro->id_employe = $user->id_employe;
				
				//On save le model experience
				$experiencePro->save();
			}

			if(isset($_POST['Competence']))
			{
				//On attributs les valeurs entrés par l'utilisateur dans le model competence
				$competence->attributes = $_POST['Competence'];
				$competence->id_employe = $user->id_employe;

				//On save le model competence 
				$competence->save();
			}

			
		}*/
			
		//Sinon on renvoie la page inscription car les champs ne sont pas valides
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


	/*Fonction qui permet, soit d'uploader son CV sur le site, soit d'être rédirigé vers 
	la page ajoutinfos.php suivant le bouton sur lequel on clique*/
	public function choixCV()
	{
		//Si il choisi l'upload, on upload le CV
		if(isset($_POST['upload']))
		{
			//METTRE ICI L'UPLOAD DU CV
			$this->redirect(array('employe/index'));
		}

		//Si il choisit de renseigner ses infos, on le redirige vers le dit formulaire
		if(isset($_POST['infos_persos']))
		{
			$this->render('ajoutinfos');
		}
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
}
