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
			{
				$this->redirect(Yii::app()->user->getReturnUrl());
			}
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

	/*Fonction qui permet d'inscrire un employé dans la base de données*/
	public function actionInscriptionEmploye()
	{
		//On créé un utilisateur et un employé
		$model = new Employe;
		$user = new Utilisateur;

			//Si les textfields ne sont pas vides
			if(isset($_POST['Utilisateur']) && isset($_POST['Employe']))
			{
				if ($this->	verif_mdp($_POST['Utilisateur']['mot_de_passe']) == 1)
				{

					//On attributs les valeurs entrés par l'utilisateur dans le model employé 
					$model->attributes = $_POST['Employe'];
					$model->date_naissance_employe = $this->changeDateBDD($_POST['Employe']['date_naissance_employe']);
				
					//On save le model employé
					$model->save();

					//Définition du fuseau horaire GMT+1
					date_default_timezone_set('Europe/Paris');
					$date = (new \DateTime())->format('Y-m-d H:i:s');

					//On attribut les valeurs entrés par l'utilisateur dans le model utilisateur
					$user->date_creation_utilisateur = $date;
					$user->date_derniere_connexion = $date;
					$user->attributes = $_POST['Utilisateur'];
					$user->role = "employe";

					//On recupère l'id de l'employé et on le donne à l'utilisateur
					$employe = Employe::model()->findByAttributes(array("id_employe"=>$model->id_employe));;
					$user->id_employe = $employe->id_employe;
					
					
					if($user->save())
					{
						$this->redirect(array('site/login'));
					}
				}
			}
			
			//Sinon on renvoie la page inscription car les champs ne sont pas valides
			$this->render('inscriptionEmploye', array('model'=>$user));
	}


	/*Fonction qui permet d'inscrire une entreprise dans la base de données*/
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
				if($user ->save())
				{
					//On redirige vers la page 
					$this->redirect(array('site/login'));	
				}
			}

		}

		$this->render('inscriptionEntreprise', array('model'=>$user));
					
	}

	/*Fonction qui permet de vérifier si les 2 mot de passe entrés sont identiques */
	public function verif_mdp($mdp)
	{
		$res;
		//Si le champ n'est pas vide 
		if(isset($_POST['confirm_mdp']))
		{
			//Si il ne corresponde pas ...
			if($mdp != $_POST['confirm_mdp'])
			{
				//Cela ne marche pas et on redirige vers la page d'inscription
				echo "Les mots de passe ne correspondent pas !";
				$this->render('inscription', array('model'=>$user));
				//On renvoie 0 quand ils ne correspondent pas
				$res = 0;
			}
			else
			{
				//On renvoie 1 quand ils correspondent 
				$res = 1;
			}
		}

		return $res;
	}


	public function actionAccueil()
	{
		unset(Yii::app()->session['login']);
		$utilisateur = Utilisateur::model()->FindByAttributes(array("mail"=> Yii::app()->user->getId()));

		if (isset($_POST['btnemploye']))
		{ // Si employe pressé
			if($utilisateur != null)
			{
				if(Utilisateur::est_employe(Yii::app()->user->role) )
				{ // Si employe
					$this->redirect(array('employe/index'));
				}
				else if(!Utilisateur::est_employe(Yii::app()->user->role) )
				{ // Si entreprise
					Yii::app()->user->setFlash('access_denied', "<p style = color:blue;>Vous n'êtes pas autorisé à accéder à cette page !</p>");
					$this->redirect(array('site/index'));
				}
			}
			else
			{ // Si non connecté
				$this->redirect(array('employe/index'));
			}	
		} 

		if (isset($_POST['btnentreprise']))
		{ // Si entreprise pressé
			if($utilisateur != null)
			{
				if(Utilisateur::est_employe(Yii::app()->user->role) )
				{ // Si employe
					Yii::app()->user->setFlash('access_denied', "<p style = color:blue;>Vous n'êtes pas autorisé à accéder à cette page !</p>");
					$this->redirect(array('site/index'));
				}
				else if(!Utilisateur::est_employe(Yii::app()->user->role) )
				{ // Si entreprise
					$this->redirect(array('entreprise/index'));
					
				}
			}
			else
			{ // Si non connecté
				$this->redirect(array('entreprise/index'));
			}	
		}

	}


	public function actionRedirectInscriptionCV()
	{
		$this->render( 'inscription_cv' );
	}


	/*Fonction de modification du login et ou du mot de passe
	-->Fonctionne pour employe et pour entreprise */
	public function actionModifParamCo()
	{
		if(isset($_POST['btnmodifco']))
		{

			if ($this->	verif_mdp($_POST['Utilisateur']['mot_de_passe']) == 1)
			{
				//On récupère l'utilisateur en cours
				$utilisateur = Utilisateur::model()->FindByAttributes(array('mail'=>Yii::app()->user->getID()));

				//On attribue le nouveau login et le nouveau mot de passe
				$utilisateur->mail = $_POST['Utilisateur']['mail'];
				$utilisateur->mot_de_passe = $_POST['Utilisateur']['mot_de_passe'];

				//Si les données sont sauvegardées
				if($utilisateur->save())
				{
					//On log l'utilisateur avec ses nouveax login et mdp
					$identity=new UserIdentity($utilisateur->mail,$utilisateur->mot_de_passe);
					//Si les login et mdp sont fonctionnels, on le log
					if($identity->authenticate())
					{
						Yii::app()->user->login($identity);
						//On affiche un message de confirmation
						Yii::app()->user->setFlash('succes_modif_paramco', "<p style = color:red;>Vos paramètres de connexion ont bien été modifiés !</p>");

						//si l'utilisateur est un employé, on le redirige vers son index
						if($utilisateur->id_employe != null)
						{
							$this->redirect(array('employe/index', 'id'=>$utilisateur->id_employe));
						}
						//Sinon on le redirige vers la page entreprise
						else
						{
							$this->redirect(array('entreprise/index', 'id'=>$utilisateur->id_entreprise));
						}	
					}	 
				}
			}
		}

		if(isset($_POST['retour']))
		{
			//On récupère l'utilisateur en cours
			$utilisateur = Utilisateur::model()->FindByAttributes(array('mail'=>Yii::app()->user->getID()));

			//si l'utilisateur est un employé, on le redirige vers sa page parametres employe
			if($utilisateur->id_employe != null)
			{
				$this->redirect(array('employe/parametres'));
			}
			//Sinon on le redirige vers vers sa page parametres entreprise
			else
			{
				$this->redirect(array('entreprise/parametres'));
			}
		}

		$this->render('modifParamCo');
	}

}	