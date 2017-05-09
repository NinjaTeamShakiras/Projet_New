<?php

/**
 * This is the model class for table "adresse".
 *
 * The followings are the available columns in table 'adresse':
 * @property integer $id_adresse
 * @property string $rue
 * @property string $ville
 * @property string $code_postal
 *
 * The followings are the available model relations:
 * @property Employe[] $employes
 * @property Entreprise[] $entreprises
 */
class Adresse extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'adresse';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rue', 'length', 'max'=>100),
			array('ville', 'length', 'max'=>45),
			array('code_postal', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_adresse, rue, ville, code_postal', 'safe', 'on'=>'search'),
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
			'employes' => array(self::HAS_MANY, 'Employe', 'id_adresse'),
			'entreprises' => array(self::HAS_MANY, 'Entreprise', 'id_adresse'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_adresse' => 'Id Adresse',
			'rue' => 'Rue',
			'ville' => 'Ville',
			'code_postal' => 'Code Postal',
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

		$criteria->compare('id_adresse',$this->id_adresse);
		$criteria->compare('rue',$this->rue,true);
		$criteria->compare('ville',$this->ville,true);
		$criteria->compare('code_postal',$this->code_postal,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Adresse the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
