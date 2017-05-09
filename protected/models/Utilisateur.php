<?php

/**
 * This is the model class for table "utilisateur".
 *
 * The followings are the available columns in table 'utilisateur':
 * @property integer $id_utilisateur
 * @property string $mail
 * @property string $mot_de_passe
 * @property string $role
 * @property string $date_creation_utilisateur
 * @property string $date_derniere_connexion
 * @property string $telephone
 * @property string $telephone2
 * @property integer $id_employe
 * @property integer $id_entreprise
 * @property string $site_web
 * @property integer $id_adresse
 *
 * The followings are the available model relations:
 * @property AvisEmploye[] $avisEmployes
 * @property AvisEntreprise[] $avisEntreprises
 * @property Notifications[] $notifications
 * @property Adresse $idAdresse
 * @property Employe $idEmploye
 * @property Entreprise $idEntreprise
 */
class Utilisateur extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'utilisateur';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mail, mot_de_passe, role, date_creation_utilisateur, date_derniere_connexion', 'required'),
			array('id_employe, id_entreprise, id_adresse', 'numerical', 'integerOnly'=>true),
			array('mail, role', 'length', 'max'=>45),
			array('mot_de_passe', 'length', 'max'=>100),
			array('telephone, telephone2', 'length', 'max'=>10),
			array('site_web', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_utilisateur, mail, mot_de_passe, role, date_creation_utilisateur, date_derniere_connexion, telephone, telephone2, id_employe, id_entreprise, site_web, id_adresse', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'avisEmployes' => array(self::HAS_MANY, 'AvisEmploye', 'id_utilisateur'),
			'avisEntreprises' => array(self::HAS_MANY, 'AvisEntreprise', 'id_utilisateur'),
			'notifications' => array(self::HAS_MANY, 'Notifications', 'id_utilisateur'),
			'idAdresse' => array(self::BELONGS_TO, 'Adresse', 'id_adresse'),
			'idEmploye' => array(self::BELONGS_TO, 'Employe', 'id_employe'),
			'idEntreprise' => array(self::BELONGS_TO, 'Entreprise', 'id_entreprise'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_utilisateur' => 'Id Utilisateur',
			'mail' => 'Mail',
			'mot_de_passe' => 'Mot De Passe',
			'role' => 'Role',
			'date_creation_utilisateur' => 'Date Creation Utilisateur',
			'date_derniere_connexion' => 'Date Derniere Connexion',
			'telephone' => 'Telephone',
			'telephone2' => 'Telephone2',
			'id_employe' => 'Id Employe',
			'id_entreprise' => 'Id Entreprise',
			'site_web' => 'Site Web',
			'id_adresse' => 'Id Adresse',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_utilisateur',$this->id_utilisateur);
		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('mot_de_passe',$this->mot_de_passe,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('date_creation_utilisateur',$this->date_creation_utilisateur,true);
		$criteria->compare('date_derniere_connexion',$this->date_derniere_connexion,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('telephone2',$this->telephone2,true);
		$criteria->compare('id_employe',$this->id_employe);
		$criteria->compare('id_entreprise',$this->id_entreprise);
		$criteria->compare('site_web',$this->site_web,true);
		$criteria->compare('id_adresse',$this->id_adresse);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Utilisateur the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

		/*	Fonction pour savoir si l'utilisateur qui est connecté est un employé	
		Paramètres : Rôle de l'utilisateur connecté
		Return : Booléen 		*/
	public static function est_employe($role_str)
	{
		return $role_str == "employe" ? true : false ;
	}

	/*	Fonction pour retourner l'identifiant à partir du mail
		de l'utilisateur
		Paramètres : Le mail (String), [ Ex : GIT ]	
		Return : L'identifiant de l'utilisateur 	*/
	public static function get_id_utilisateur_connexion($mail_str)
	{
		return Utilisateur::model()->findByAttributes(array( "mail" => $mail_str ))->id_utilisateur;
	}

	/*	Fonction pour récupérer l'utilisateur connecté à partir d'un mail
		Paramètres : L'identifiant de l'entreprise 
		Return : Un objet Utilisateur (Objet) 		*/
	public static function get_utilisateur_connexion($mail_str)
	{
		return Utilisateur::model()->findByAttributes(array( "mail" => $mail_str ));
	}



}
