<?php

/**
 * This is the model class for table "competence".
 *
 * The followings are the available columns in table 'competence':
 * @property integer $id_competence
 * @property string $intitule_competence
 * @property string $niveau_competence
 * @property integer $id_employe
 *
 * The followings are the available model relations:
 * @property Employe $idEmploye
 */
class Competence extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'competence';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_employe, intitule_competence, niveau_competence','required'),
			array('id_employe', 'numerical', 'integerOnly'=>true),
			array('intitule_competence, niveau_competence', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_competence, intitule_competence, niveau_competence, id_employe', 'safe', 'on'=>'search'),
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
			'id_competence' => 'Id Competence',
			'intitule_competence' => 'Nom de la compétence',
			'niveau_competence' => 'niveau de la compétence',
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

		$criteria->compare('id_competence',$this->id_competence);
		$criteria->compare('intitule_competence',$this->intitule_competence,true);
		$criteria->compare('niveau_competence',$this->niveau_competence,true);
		$criteria->compare('id_employe',$this->id_employe);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Competence the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
