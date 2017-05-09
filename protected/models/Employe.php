<?php

/**
 * This is the model class for table "employe".
 *
 * The followings are the available columns in table 'employe':
 * @property integer $id_employe
 * @property string $nom_employe
 * @property string $prenom_employe
 * @property string $date_naissance_employe
 * @property integer $employe_travaille
 *
 * The followings are the available model relations:
 * @property AvisEmploye[] $avisEmployes
 * @property Competence[] $competences
 * @property ExperiencePro[] $experiencePros
 * @property Formation[] $formations
 * @property Job[] $jobs
 * @property Postuler[] $postulers
 * @property Utilisateur[] $utilisateurs
 */
class Employe extends CActiveRecord
{
	/* --- 
		Attribut pour enregistrer le CV 
	--- */
	public $cv_pdf;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'employe';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nom_employe, prenom_employe', 'required'),
			array('employe_travaille', 'numerical', 'integerOnly'=>true),
			array('nom_employe, prenom_employe', 'length', 'max'=>45),
			array('date_naissance_employe', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_employe, nom_employe, prenom_employe, date_naissance_employe, employe_travaille', 'safe', 'on'=>'search'),
			//array( 'cv_pdf', 'file', 'types'=>'pdf', 'safe' => false )
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
			'avisEmployes' => array(self::HAS_MANY, 'AvisEmploye', 'id_employe'),
			'competences' => array(self::HAS_MANY, 'Competence', 'id_employe'),
			'experiencePros' => array(self::HAS_MANY, 'ExperiencePro', 'id_employe'),
			'formations' => array(self::HAS_MANY, 'Formation', 'id_employe'),
			'jobs' => array(self::HAS_MANY, 'Job', 'id_employe'),
			'postulers' => array(self::HAS_MANY, 'Postuler', 'id_employe'),
			'utilisateurs' => array(self::HAS_MANY, 'Utilisateur', 'id_employe'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_employe' => 'Id Employe',
			'nom_employe' => 'Nom Employe',
			'prenom_employe' => 'Prenom Employe',
			'date_naissance_employe' => 'Date Naissance Employe',
			'employe_travaille' => 'Employe Travaille',
			'cv_pdf' => 'CV employé'
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

		$criteria->compare('id_employe',$this->id_employe);
		$criteria->compare('nom_employe',$this->nom_employe,true);
		$criteria->compare('prenom_employe',$this->prenom_employe,true);
		$criteria->compare('date_naissance_employe',$this->date_naissance_employe,true);
		$criteria->compare('employe_travaille',$this->employe_travaille);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Employe the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
