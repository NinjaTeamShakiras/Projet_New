<?php

/**
 * This is the model class for table "experience_pro".
 *
 * The followings are the available columns in table 'experience_pro':
 * @property integer $id_experience
 * @property string $date_debut_experience
 * @property string $date_fin_experience
 * @property string $intitule_experience
 * @property string $entreprise_experience
 * @property string $description_experience
 * @property integer $id_employe
 *
 * The followings are the available model relations:
 * @property Employe $idEmploye
 */
class ExperiencePro extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'experience_pro';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_employe, date_debut_experience, intitule_experience, entreprise_experience','required'),
			array('id_employe', 'numerical', 'integerOnly'=>true),
			array('intitule_experience, entreprise_experience', 'length', 'max'=>45),
			array('description_experience', 'length', 'max'=>255),
			array('date_debut_experience, date_fin_experience', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_experience, date_debut_experience, date_fin_experience, intitule_experience, entreprise_experience, description_experience, id_employe', 'safe', 'on'=>'search'),
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
			'idEmploye' => array(self::BELONGS_TO, 'Employe', 'id_employe'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_experience' => 'Id Experience',
			'date_debut_experience' => 'Date de début de l\'expérience',
			'date_fin_experience' => 'Date de fin de l\'éxperience',
			'intitule_experience' => 'Intitule de l\'éxperience',
			'entreprise_experience' => 'Entreprise dans laquelle vous avez travaillé',
			'description_experience' => 'Description de l\'éxperience',
			'id_employe' => 'Id Employe',
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

		$criteria->compare('id_experience',$this->id_experience);
		$criteria->compare('date_debut_experience',$this->date_debut_experience,true);
		$criteria->compare('date_fin_experience',$this->date_fin_experience,true);
		$criteria->compare('intitule_experience',$this->intitule_experience,true);
		$criteria->compare('entreprise_experience',$this->entreprise_experience,true);
		$criteria->compare('description_experience',$this->description_experience,true);
		$criteria->compare('id_employe',$this->id_employe);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ExperiencePro the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
