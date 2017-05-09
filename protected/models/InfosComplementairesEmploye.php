<?php

/**
 * This is the model class for table "infos_complementaires_employe".
 *
 * The followings are the available columns in table 'infos_complementaires_employe':
 * @property integer $id_info_employe
 * @property string $description_info
 * @property integer $id_info_profil
 * @property integer $id_employe
 *
 * The followings are the available model relations:
 * @property InfosComplementairesProfil $idInfoProfil
 * @property Employe $idEmploye
 */
class InfosComplementairesEmploye extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'infos_complementaires_employe';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('description_info, id_info_profil, id_employe', 'required'),
			array('id_info_profil, id_employe', 'numerical', 'integerOnly'=>true),
			array('description_info', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_info_employe, description_info, id_info_profil, id_employe', 'safe', 'on'=>'search'),
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
			'idEmploye' => array(self::BELONGS_TO, 'Employe', 'id_employe'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_info_employe' => 'Id Info Employe',
			'description_info' => 'Description Info',
			'id_info_profil' => 'Id Info Profil',
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

		$criteria->compare('id_info_employe',$this->id_info_employe);
		$criteria->compare('description_info',$this->description_info,true);
		$criteria->compare('id_info_profil',$this->id_info_profil);
		$criteria->compare('id_employe',$this->id_employe);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InfosComplementairesEmploye the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
