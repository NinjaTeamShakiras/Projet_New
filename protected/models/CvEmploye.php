<?php

/**
 * This is the model class for table "cv_employe".
 *
 * The followings are the available columns in table 'cv_employe':
 * @property integer $id_cv_employe
 * @property integer $niveau_competence
 * @property integer $id_employe
 * @property integer $id_competence
 * @property integer $id_cv
 *
 * The followings are the available model relations:
 * @property Employe $idEmploye
 * @property CompetencesCv $idCompetence
 * @property Cv $idCv
 */
class CvEmploye extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cv_employe';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('niveau_competence, id_employe, id_competence, id_cv', 'required'),
			array('niveau_competence, id_employe, id_competence, id_cv', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_cv_employe, niveau_competence, id_employe, id_competence, id_cv', 'safe', 'on'=>'search'),
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
			'idCompetence' => array(self::BELONGS_TO, 'CompetencesCv', 'id_competence'),
			'idCv' => array(self::BELONGS_TO, 'Cv', 'id_cv'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_cv_employe' => 'Id Cv Employe',
			'niveau_competence' => 'Niveau Competence',
			'id_employe' => 'Id Employe',
			'id_competence' => 'Id Competence',
			'id_cv' => 'Id Cv',
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

		$criteria->compare('id_cv_employe',$this->id_cv_employe);
		$criteria->compare('niveau_competence',$this->niveau_competence);
		$criteria->compare('id_employe',$this->id_employe);
		$criteria->compare('id_competence',$this->id_competence);
		$criteria->compare('id_cv',$this->id_cv);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CvEmploye the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
