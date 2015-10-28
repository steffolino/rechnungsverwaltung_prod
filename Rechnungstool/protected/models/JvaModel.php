<?php
class JvaModel extends CFormModel
{
	public $allJvas;
	public $allJvaNameAndExtensions;
	public $allColNames;
	public $allCols;
	
	public $jvaName;
	public $jvaNameExt;
	public $jvaAddress;
    public $jvaColConfig;
    public $jvaFooter;
	public $jvaCustNum;
	public $jvaCustNumDesc;
	
   
	
	public function getAllJvas(){

	$criteria = new CDbCriteria();
	$criteria->condition = 'jvaDeactivated NOT LIKE "y"';

	$this->allJvas = JvaData::model()->with(	
			'defaultColConfig',
			'defaultColConfig.colDef1',
			'defaultColConfig.colDef2',
			'defaultColConfig.colDef3',
			'defaultColConfig.colDef4',
			'defaultColConfig.colDef5',
			'defaultColConfig.colDef6',
			'defaultColConfig.colDef7',
			'defaultColConfig.colDef8',
			'defaultColConfig.colDef9',
			'defaultColConfig.colDef10',
			'defaultColConfig.colDef11',
			'defaultColConfig.colDef12')
		->findAll($criteria);
			
	}
	
	public function getJvaById($id){
		$selectedJVA = JvaData::model()->with(
				'defaultColConfig',
				'defaultColConfig.colDef1',
				'defaultColConfig.colDef2',
				'defaultColConfig.colDef3',
				'defaultColConfig.colDef4',
				'defaultColConfig.colDef5',
				'defaultColConfig.colDef6',
				'defaultColConfig.colDef7',
				'defaultColConfig.colDef8',
				'defaultColConfig.colDef9',
				'defaultColConfig.colDef10',
				'defaultColConfig.colDef11',
				'defaultColConfig.colDef12'
			)->findByPK($id);
		
			return $selectedJVA;
		
	}
	
	
	public function getJvaByIdPartial($id){
		$selectedJVA = JvaData::model()->findByPK($id);
		
			return $selectedJVA;
		
	}
	
	public function getAllJvasNamesAndExtensions(){
		$allJvas = JvaData::model()->findAll();
		$this->allJvaNameAndExtensions = array();
		$valuesPerJva = array();
		foreach($allJvas as $jva){
			array_push($valuesPerJva,$jva->jvaName);
			array_push($valuesPerJva,$jva->jvaNameExt);
			array_push($valuesPerJva,$jva->jvaCustNum);
			array_push($valuesPerJva,$jva->jvaCustNumDesc);
			array_push($this->allJvaNameAndExtensions,$valuesPerJva);
			$valuesPerJva = array();
		}	
	}
	
	
	public function getAllColNames(){
		$allCols = ColDef::model()->findAll();
		$this->allColNames = array();
		foreach($allCols as $col){
			array_push($this->allColNames,$col->colName);
		}	
	}
	
	public function getAllCols(){
		$this->allCols = ColDef::model()->findAll();	
	}
	
	public function getJvaByName($name, $ext){
		return JvaData::model()->find('jvaName=:jvaName AND jvaNameExt=:jvaNameExt',array(':jvaName'=>$name, 'jvaNameExt'=>$ext));
	}

	public function getAllJvaNames($name){
		return JvaData::model()->findAll('jvaName LIKE :jvaName OR jvaNameExt LIKE :jvaName',array(':jvaName'=> '%'.$name.'%'));
	}
	
	public function getJvaByCustNum($custNum){
		return JvaData::model()->find('jvaCustNum=:jvaCustNum',array(':jvaCustNum'=>$custNum));
	}
	
	public function getDefColByJva($jva){
		return DefaultColConfig::model()->findByPK($jva->jvaColConfig);
	}
	
	public function activateJvaByName($name,$ext){
		$jva = $this->getJvaByName($name,$ext);
		$jva->jvaDeactivated = "n";
		$jva->save();
	}
	
	public function activateJvaByCustNum($custNum){
		$jva = $this->getJvaByCustNum($custNum);
		$jva->jvaDeactivated = "n";
		$jva->save();
	}
	public function deactivateJvaByName($name,$ext){
		$jva = $this->getJvaByName($name,$ext);
		$jva->jvaDeactivated = "y";
		$jva->save();
		
	}
	public function deactivateJvaById($id){
		$jva = $this->getJvaById($id);
		$jva->jvaDeactivated = "y";
		$jva->save();
	}
	
	public function deactivateJvaByCustNum($custNum){
		$jva = $this->getJvaByCustNum($custNum);
		$jva->jvaDeactivated = "y";
		$jva->save();
	}
	
	public function deleteJvaById($id){
		$jva = JvaData::model()->findByPK($id);
		$colConfigId = $jva->jvaColConfig;
		JvaData::model()->deleteByPK($id);
		DefaultColConfig::model()->deleteByPK($colConfigId);
	}
	
	public function deleteJvaByName($name, $ext){
		$jva = $this->getJvaByName($name,$ext);
		$colConfigId = $jva->jvaColConfig;
		JvaData::model()->deleteAll('jvaName=:jvaName AND jvaNameExt=:jvaNameExt',array(':jvaName'=>$name, 'jvaNameExt'=>$ext));
		DefaultColConfig::model()->deleteByPK($colConfigId);
	}
	
	public function deleteJvaByCustNum($custNum){
		$jva = $this->getJvaByCustNum($custNum);
		$colConfigId = $jva->jvaColConfig;
		JvaData::model()->deleteAll('jvaCustNum=:jvaCustNum',array(':jvaCustNum'=>$custNum));
		DefaultColConfig::model()->deleteByPK($colConfigId);
	}
	
	public function insertJva($name,$nameExt,$address,$footer,$custNum,$custNumDesc,$col1,$col2,$col3,$col4,$col5,$col6,$col7,$col8,$col9,$col10,$col11,$col12){
		$result = "false";
		$jvaCol1 = $this->getColIdByName($col1);
		$jvaCol2 = $this->getColIdByName($col2);
		$jvaCol3 = $this->getColIdByName($col3);
		$jvaCol4 = $this->getColIdByName($col4);
		$jvaCol5 = $this->getColIdByName($col5);
		$jvaCol6 = $this->getColIdByName($col6);
		$jvaCol7 = $this->getColIdByName($col7);
		$jvaCol8 = $this->getColIdByName($col8);
		$jvaCol9 = $this->getColIdByName($col9);
		$jvaCol10 = $this->getColIdByName($col10);
		$jvaCol11 = $this->getColIdByName($col11);
		$jvaCol12 = $this->getColIdByName($col12);
		
		$newJva = new JvaData;
		$newJva->jvaName = $name;
		$newJva->jvaNameExt = $nameExt;
		$newJva->jvaAddress = $address;
		$newJva->jvaFooter = $footer;
		$newJva->jvaCustNum = $custNum;
		$newJva->jvaCustNumDesc = $custNumDesc;
		
		$newJva->defaultColConfig = new DefaultColConfig;
		$newJva->defaultColConfig->col1 = $jvaCol1;
		$newJva->defaultColConfig->col2 = $jvaCol2;
		$newJva->defaultColConfig->col3 = $jvaCol3;
		$newJva->defaultColConfig->col4 = $jvaCol4;
		$newJva->defaultColConfig->col5 = $jvaCol5;
		$newJva->defaultColConfig->col6 = $jvaCol6;
		$newJva->defaultColConfig->col7 = $jvaCol7;
		$newJva->defaultColConfig->col8 = $jvaCol8;
		$newJva->defaultColConfig->col9 = $jvaCol9;
		$newJva->defaultColConfig->col10 = $jvaCol10;
		$newJva->defaultColConfig->col11 = $jvaCol11;
		$newJva->defaultColConfig->col12 = $jvaCol12;
		$newJva->defaultColConfig->save();
		
		
		$newJva->jvaColConfig = $newJva->defaultColConfig->colConfigId;
		$result = $newJva->save();
		
		return $result;
	}
	
	public function updateJva($name,$nameExt,$address,$footer,$custNum,$custNumDesc,$col1,$col2,$col3,$col4,$col5,$col6,$col7,$col8,$col9,$col10,$col11,$col12){
		$result = "false";

		$jvaCol1 = $this->getColIdByName($col1);
		$jvaCol2 = $this->getColIdByName($col2);
		$jvaCol3 = $this->getColIdByName($col3);
		$jvaCol4 = $this->getColIdByName($col4);
		$jvaCol5 = $this->getColIdByName($col5);
		$jvaCol6 = $this->getColIdByName($col6);
		$jvaCol7 = $this->getColIdByName($col7);
		$jvaCol8 = $this->getColIdByName($col8);
		$jvaCol9 = $this->getColIdByName($col9);
		$jvaCol10 = $this->getColIdByName($col10);
		$jvaCol11 = $this->getColIdByName($col11);
		$jvaCol12 = $this->getColIdByName($col12);
		
		$updateJva = $this->getJvaByName($name,$nameExt);
		$updateJva->jvaName = $name;
		$updateJva->jvaNameExt = $nameExt;
		$updateJva->jvaAddress = $address;
		$updateJva->jvaFooter = $footer;
		$updateJva->jvaCustNum = $custNum;
		$updateJva->jvaCustNumDesc = $custNumDesc;
		
		$updateJva->defaultColConfig = $this->getDefColByJva($updateJva);
		$updateJva->defaultColConfig->col1 = $jvaCol1;
		$updateJva->defaultColConfig->col2 = $jvaCol2;
		$updateJva->defaultColConfig->col3 = $jvaCol3;
		$updateJva->defaultColConfig->col4 = $jvaCol4;
		$updateJva->defaultColConfig->col5 = $jvaCol5;
		$updateJva->defaultColConfig->col6 = $jvaCol6;
		$updateJva->defaultColConfig->col7 = $jvaCol7;
		$updateJva->defaultColConfig->col8 = $jvaCol8;
		$updateJva->defaultColConfig->col9 = $jvaCol9;
		$updateJva->defaultColConfig->col10 = $jvaCol10;
		$updateJva->defaultColConfig->col11 = $jvaCol11;
		$updateJva->defaultColConfig->col12 = $jvaCol12;
		$updateJva->defaultColConfig->save();
				
		//$updateJva->jvaColConfig = $updateJva->defaultColConfig->colConfigId;
		$result = $updateJva->save();
		
		return $result;
	}
	
	
	public function getColIdByName($name){
			$col = ColDef::model()->find(
				'colName=:colName',
				array(':colName'=>$name)
			);
			if($col !== NULL){
				return $col->colDefId;
			}else{
				return NULL;
			}
		
	}
	
	
}