<?php

/**
 * This is the model class for table "utilisateur".
 *
 * The followings are the available columns in table 'utilisateur':
 * @property integer $id_utilisateur
 * @property string $login
 * @property string $mot_de_passe
 * @property string $role
 * @property integer $id_employe
 * @property integer $id_entreprise
 *
 * The followings are the available model relations:
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
			array('login, mot_de_passe', 'required'),
			array('id_employe, id_entreprise', 'numerical', 'integerOnly'=>true),
			array('login', 'length', 'max'=>50),
			array('mot_de_passe', 'length', 'max'=>100),
			array('role', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_utilisateur, login, mot_de_passe, role, mail, id_employe, id_entreprise', 'safe', 'on'=>'search'),
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
			'Employe' => array(self::BELONGS_TO, 'Employe', 'id_employe'),
			'Entreprise' => array(self::BELONGS_TO, 'Entreprise', 'id_entreprise'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_utilisateur' => 'Id Utilisateur',
			'login' => 'Pseudo',
			'mot_de_passe' => 'Mot De Passe',
			'mail' => 'Adresse Mail',
			'role' => 'Role',
			'id_employe' => 'Id Employe',
			'id_entreprise' => 'Id Entreprise',
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
		$criteria->compare('login',$this->login,true);
		$criteria->compare('mot_de_passe',$this->mot_de_passe,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('mail', $this->mail, true);
		$criteria->compare('id_employe',$this->id_employe);
		$criteria->compare('id_entreprise',$this->id_entreprise);

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

	/*	Fonction pour retourner l'identifiant à partir du nom de login
		de l'utilisateur
		Paramètres : Le login (String), [ Ex : GIT ]	
		Return : L'identifiant de l'utilisateur 	*/
	public static function get_id_utilisateur_connexion($login_str)
	{
		return Utilisateur::model()->findByAttributes(array( "login" => $login_str ))->id_utilisateur;
	}

	/*	Fonction pour récupérer l'utilisateur connecté à partir d'un login
		Paramètres : L'identifiant de l'entreprise 
		Return : Un objet Utilisateur (Objet) 		*/
	public static function get_utilisateur_connexion($login_str)
	{
		return Utilisateur::model()->findByAttributes(array( "login" => $login_str ));
	}

	
}
