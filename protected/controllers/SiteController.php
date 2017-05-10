<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
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


	public function actionInscriptionEmploye()
	{
		$model = new Employe;
		$user = new Utilisateur;


			if(isset($_POST['Utilisateur']) && isset($_POST['Employe']))
			{
				if ($this->	verif_mdp($_POST['Utilisateur']['mot_de_passe']) == 1)
				{
					$model->attributes = $_POST['Employe'];
					$model->date_naissance_employe = $this->changeDateBDD($_POST['Employe']['date_naissance_employe']);
				
					$model->save();

					//Définition du fuseau horaire GMT+1
					date_default_timezone_set('Europe/Paris');
					$date = (new \DateTime())->format('Y-m-d H:i:s');
					$user->date_creation_utilisateur = $date;
					$user->date_derniere_connexion = $date;

					$user->attributes = $_POST['Utilisateur'];
					$user->role = "employe";

					$employe = Employe::model()->findByAttributes(array("id_employe"=>$model->id_employe));;
					$user->id_employe = $employe->id_employe;
					
					
					$user->save();
					$this->redirect(array('employe/index'));
				}
			}
	
			$this->render('inscriptionEmploye', array('model'=>$user));
	}



	public function actionInscriptionEntreprise()
	{                        
		//On créé un utilisateur et une entreprise vide
		$model = new Entreprise;
		$user = new Utilisateur;

		//Si les textfields ne sont pas vides
		if(isset($_POST['Utilisateur']) && isset($_POST['Entreprise']))
		{
 			if ($this->	verif_mdp($_POST['Utilisateur']['mot_de_passe']) == 1)
			{
				//On attribues les valeurs entrés par l'utilisateur dans le model entreprise
				$model->attributes = $_POST['Entreprise'];
				$model->recherche_employes = NULL;

				//On save le model
				$model->save();

				//On fait pareil avec l'utilisateur
				//-->Définition du fuseau horaire GMT+1
				date_default_timezone_set('Europe/Paris');
				$date = (new \DateTime())->format('Y-m-d H:i:s');
				$user->date_creation_utilisateur = $date;
				$user->date_derniere_connexion = $date;
				$user->attributes = $_POST['Utilisateur'];
				$user->role = "entreprise";


				//On récupère l'id de l'entreprise et on la donne à l'utilisateur
				$model = Entreprise::model()->findByAttributes(array("id_entreprise"=>$model->id_entreprise));
				$user->id_entreprise = $model->id_entreprise;

				//On save l'utilisateur
				$user ->save();

				$this->redirect(array('entreprise/index'));
			}

		}

		$this->render('inscriptionEntreprise', array('model'=>$user));
					
	}

	public function verif_mdp($mdp)
	{
		$res;

		if(isset($_POST['confirm_mdp']))
		{
			if($mdp != $_POST['confirm_mdp'])
			{
				echo "Les mots de passe ne correspondent pas !";
				$this->render('inscription', array('model'=>$user));
				$res = 0;
			}
			else
			{
				$res = 1;
			}
		}

		return $res;
	}


	public function actionAccueil()
	{
		if (isset($_POST['btnemploi']))
		{
			$this->redirect(array('site/inscriptionEmploye'));	
		} 

		if (isset($_POST['btnemploye']))
		{
			$this->redirect(array('site/inscriptionEntreprise'));
		}
	}

}	