<?php
/***

ActiveRecord Class to represent JVAs

***/

class DefaultColConfig extends CActiveRecord {

	//MUST HAVE
	public static function model($className=__CLASS__) {
			return parent::model($className);
		}

	public function relations()
    {
		
		//EXAMPLE: 'VarName'=>array('RelationsTyp', 'KlassenName', 'FremdSchlüssel', ...Zusätzliche Optionen)
        return array(
				'colDef1' => array(self::HAS_ONE, 'ColDef', array('colDefId' => 'col1')),
				'colDef2' => array(self::HAS_ONE, 'ColDef', array('colDefId' => 'col2')),
				'colDef3' => array(self::HAS_ONE, 'ColDef', array('colDefId' => 'col3')),
				'colDef4' => array(self::HAS_ONE, 'ColDef', array('colDefId' => 'col4')),
				'colDef5' => array(self::HAS_ONE, 'ColDef', array('colDefId' => 'col5')),
				'colDef6' => array(self::HAS_ONE, 'ColDef', array('colDefId' => 'col6')),
				'colDef7' => array(self::HAS_ONE, 'ColDef', array('colDefId' => 'col7')),
				'colDef8' => array(self::HAS_ONE, 'ColDef', array('colDefId' => 'col8')),
				'colDef9' => array(self::HAS_ONE, 'ColDef', array('colDefId' => 'col9')),
				'colDef10' => array(self::HAS_ONE, 'ColDef', array('colDefId' => 'col10')),
				'colDef11' => array(self::HAS_ONE, 'ColDef', array('colDefId' => 'col11')),
				'colDef12' => array(self::HAS_ONE, 'ColDef', array('colDefId' => 'col12')),
			//'defaultColConfig' => array(self::HAS_ONE, 'DefaultColConfig', array('jvaColConfig'=>'colDefId')),
			//'contacts' => array(self::HAS_MANY, 'UserContacts', array('userID'=>'userID')),
        );
    }

}

?>