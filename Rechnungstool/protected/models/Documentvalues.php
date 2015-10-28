<?php

/**
 * This is the model class for table "documentvalues".
 *
 * The followings are the available columns in table 'documentvalues':
 * @property integer $valueId
 * @property integer $documentId
 * @property string $value1
 * @property string $value2
 * @property string $value3
 * @property string $value4
 * @property string $value5
 * @property string $value6
 * @property string $value7
 * @property string $value8
 * @property string $value9
 * @property string $value10
 * @property string $value11
 * @property string $value12
 * @property string $header6
 * @property string $header1
 * @property string $header2
 * @property string $header3
 * @property string $header4
 * @property string $header5
 * @property string $header7
 * @property string $header8
 * @property string $header9
 * @property string $header10
 * @property string $header11
 * @property string $header12
 *
 * The followings are the available model relations:
 * @property Document $document
 */
class Documentvalues extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'documentvalues';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('documentId', 'required'),
			array('documentId', 'numerical', 'integerOnly'=>true),
			array('value1, value2, value3, value4, value5, value6, value7, value8, value9, value10, value11, value12', 'length', 'max'=>255),
			array('header6, header1, header2, header3, header4, header5, header7, header8, header9, header10, header11, header12', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('valueId, documentId, value1, value2, value3, value4, value5, value6, value7, value8, value9, value10, value11, value12, header6, header1, header2, header3, header4, header5, header7, header8, header9, header10, header11, header12', 'safe', 'on'=>'search'),
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
			'document' => array(self::BELONGS_TO, 'Document', 'documentId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'valueId' => 'Value',
			'documentId' => 'Document',
			'value1' => 'Value1',
			'value2' => 'Value2',
			'value3' => 'Value3',
			'value4' => 'Value4',
			'value5' => 'Value5',
			'value6' => 'Value6',
			'value7' => 'Value7',
			'value8' => 'Value8',
			'value9' => 'Value9',
			'value10' => 'Value10',
			'value11' => 'Value11',
			'value12' => 'Value12',
			'header6' => 'Header6',
			'header1' => 'Header1',
			'header2' => 'Header2',
			'header3' => 'Header3',
			'header4' => 'Header4',
			'header5' => 'Header5',
			'header7' => 'Header7',
			'header8' => 'Header8',
			'header9' => 'Header9',
			'header10' => 'Header10',
			'header11' => 'Header11',
			'header12' => 'Header12',
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

		$criteria->compare('valueId',$this->valueId);
		$criteria->compare('documentId',$this->documentId);
		$criteria->compare('value1',$this->value1,true);
		$criteria->compare('value2',$this->value2,true);
		$criteria->compare('value3',$this->value3,true);
		$criteria->compare('value4',$this->value4,true);
		$criteria->compare('value5',$this->value5,true);
		$criteria->compare('value6',$this->value6,true);
		$criteria->compare('value7',$this->value7,true);
		$criteria->compare('value8',$this->value8,true);
		$criteria->compare('value9',$this->value9,true);
		$criteria->compare('value10',$this->value10,true);
		$criteria->compare('value11',$this->value11,true);
		$criteria->compare('value12',$this->value12,true);
		$criteria->compare('header6',$this->header6,true);
		$criteria->compare('header1',$this->header1,true);
		$criteria->compare('header2',$this->header2,true);
		$criteria->compare('header3',$this->header3,true);
		$criteria->compare('header4',$this->header4,true);
		$criteria->compare('header5',$this->header5,true);
		$criteria->compare('header7',$this->header7,true);
		$criteria->compare('header8',$this->header8,true);
		$criteria->compare('header9',$this->header9,true);
		$criteria->compare('header10',$this->header10,true);
		$criteria->compare('header11',$this->header11,true);
		$criteria->compare('header12',$this->header12,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Documentvalues the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
