<?php

/**
 * This is the model class for table "infos_complementaires_entreprise".
 *
 * The followings are the available columns in table 'infos_complementaires_entreprise':
 * @property integer $id_info_entreprise
 * @property string $description_info
 * @property integer $id_info_profil
 * @property integer $id_entreprise
 *
 * The followings are the available model relations:
 * @property InfosComplementairesProfil $idInfoProfil
 * @property Entreprise $idEntreprise
 */
class InfosComplementairesEntreprise extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'infos_complementaires_entreprise';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('description_info, id_info_profil, id_entreprise', 'required'),
			array('id_info_profil, id_entreprise', 'numerical', 'integerOnly'=>true),
			array('description_info', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_info_entreprise, description_info, id_info_profil, id_entreprise', 'safe', 'on'=>'search'),
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
			'idInfoProfil' => array(self::BELONGS_TO, 'InfosComplementairesProfil', 'id_info_profil'),
			'idEntreprise' => array(self::BELONGS_TO, 'Entreprise', 'id_entreprise'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_info_entreprise' => 'Id Info Entreprise',
			'description_info' => 'Description Info',
			'id_info_profil' => 'Id Info Profil',
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

		$criteria->compare('id_info_entreprise',$this->id_info_entreprise);
		$criteria->compare('description_info',$this->description_info,true);
		$criteria->compare('id_info_profil',$this->id_info_profil);
		$criteria->compare('id_entreprise',$this->id_entreprise);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InfosComplementairesEntreprise the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
