<?php

/**
 * This is the model class for table "offre_emploi".
 *
 * The followings are the available columns in table 'offre_emploi':
 * @property integer $id_offre_emploi
 * @property string $date_creation_offre_emploi
 * @property string $type_offre_emploi
 * @property integer $salaire_offre_emploi
 * @property string $experience_offre_emploi
 * @property string $description_offre_emploi
 * @property integer $id_entreprise
 *
 * The followings are the available model relations:
 * @property Entreprise $idEntreprise
 * @property Postuler[] $postulers
 */
class OffreEmploi extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'offre_emploi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()	
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_creation_offre_emploi, id_entreprise', 'required'),
			array('salaire_offre_emploi, id_entreprise', 'numerical', 'integerOnly'=>true),
			array('type_offre_emploi', 'length', 'max'=>30),
			array('experience_offre_emploi, description_offre_emploi', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_offre_emploi, date_creation_offre_emploi, type_offre_emploi, salaire_offre_emploi, experience_offre_emploi, description_offre_emploi, id_entreprise', 'safe', 'on'=>'search'),
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
			'idEntreprise' => array(self::BELONGS_TO, 'Entreprise', 'id_entreprise'),
			'postulers' => array(self::HAS_MANY, 'Postuler', 'id_offre_emploi'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_offre_emploi' => 'Id Offre Emploi',
			'date_creation_offre_emploi' => 'Date Creation Offre Emploi',
			'type_offre_emploi' => 'Type de l\'offre d\'emploi :',
			'salaire_offre_emploi' => 'Salaire de l\'offre d\'emploi :',
			'experience_offre_emploi' => 'Experience nécéssaire :',
			'description_offre_emploi' => 'Description de l\'offre d\'emploi :',
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

		$criteria->compare('id_offre_emploi',$this->id_offre_emploi);
		$criteria->compare('date_creation_offre_emploi',$this->date_creation_offre_emploi,true);
		$criteria->compare('type_offre_emploi',$this->type_offre_emploi,true);
		$criteria->compare('salaire_offre_emploi',$this->salaire_offre_emploi);
		$criteria->compare('experience_offre_emploi',$this->experience_offre_emploi,true);
		$criteria->compare('description_offre_emploi',$this->description_offre_emploi,true);
		$criteria->compare('id_entreprise',$this->id_entreprise);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OffreEmploi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
