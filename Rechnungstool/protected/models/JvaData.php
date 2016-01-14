<?php

/**
 * This is the model class for table "jvadata".
 *
 * The followings are the available columns in table 'jvadata':
 * @property integer $jvaDataId
 * @property string $jvaName
 * @property string $jvaAddress
 * @property integer $jvaColConfig
 * @property string $jvaNameExt
 * @property string $jvaFooter
 * @property string $jvaCustNum
 * @property string $jvaCustNumDesc
 * @property string $jvaDeactivated
 * @property integer $jvaColMemm
 * @property integer $jvaColLoeh
 * @property integer $jvaColWitt
 *
 * The followings are the available model relations:
 * @property Document[] $documents
 * @property Defaultcolconfig $jvaColConfig0
 * @property Defaultcolconfig $jvaColLoeh0
 * @property Defaultcolconfig $jvaColMemm0
 * @property Defaultcolconfig $jvaColWitt0
 */
class Jvadata extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'jvadata';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('jvaName, jvaAddress, jvaColConfig', 'required'),
			array('jvaColConfig, jvaColMemm, jvaColLoeh, jvaColWitt', 'numerical', 'integerOnly'=>true),
			array('jvaName, jvaAddress', 'length', 'max'=>255),
			array('jvaNameExt, jvaCustNum, jvaCustNumDesc', 'length', 'max'=>45),
			array('jvaDeactivated', 'length', 'max'=>1),
			array('jvaFooter', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('jvaDataId, jvaName, jvaAddress, jvaColConfig, jvaNameExt, jvaFooter, jvaCustNum, jvaCustNumDesc, jvaDeactivated, jvaColMemm, jvaColLoeh, jvaColWitt', 'safe', 'on'=>'search'),
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
			'documents' => array(self::HAS_MANY, 'Document', 'jvaId'),
			'jvaColIk' => array(self::BELONGS_TO, 'Defaultcolconfig', 'jvaColConfig'),
			'jvaColLoehne' => array(self::BELONGS_TO, 'Defaultcolconfig', 'jvaColLoeh'),
			'jvaColMemmel' => array(self::BELONGS_TO, 'Defaultcolconfig', 'jvaColMemm'),
			'jvaColWitte' => array(self::BELONGS_TO, 'Defaultcolconfig', 'jvaColWitt'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'jvaDataId' => 'Jva Data',
			'jvaName' => 'Jva Name',
			'jvaAddress' => 'Jva Address',
			'jvaColConfig' => 'Jva Col Config',
			'jvaNameExt' => 'Jva Name Ext',
			'jvaFooter' => 'Jva Footer',
			'jvaCustNum' => 'Jva Cust Num',
			'jvaCustNumDesc' => 'Jva Cust Num Desc',
			'jvaDeactivated' => 'Jva Deactivated',
			'jvaColMemm' => 'Jva Col Memm',
			'jvaColLoeh' => 'Jva Col Loeh',
			'jvaColWitt' => 'Jva Col Witt',
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

		$criteria->compare('jvaDataId',$this->jvaDataId);
		$criteria->compare('jvaName',$this->jvaName,true);
		$criteria->compare('jvaAddress',$this->jvaAddress,true);
		$criteria->compare('jvaColConfig',$this->jvaColConfig);
		$criteria->compare('jvaNameExt',$this->jvaNameExt,true);
		$criteria->compare('jvaFooter',$this->jvaFooter,true);
		$criteria->compare('jvaCustNum',$this->jvaCustNum,true);
		$criteria->compare('jvaCustNumDesc',$this->jvaCustNumDesc,true);
		$criteria->compare('jvaDeactivated',$this->jvaDeactivated,true);
		$criteria->compare('jvaColMemm',$this->jvaColMemm);
		$criteria->compare('jvaColLoeh',$this->jvaColLoeh);
		$criteria->compare('jvaColWitt',$this->jvaColWitt);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Jvadata the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
