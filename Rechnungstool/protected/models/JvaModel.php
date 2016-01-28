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
	
	public  $jvaColIK;
	public  $jvaColMemm;
	public  $jvaColLoeh;
	public  $jvaColWitt;
	
	public function getAllJvas(){

	$criteria = new CDbCriteria();
	$criteria->condition = 'jvaDeactivated NOT LIKE "y"';

	$this->allJvas = JvaData::model()
		->findAll($criteria);
			
	}
	
	public function getJvaById($id){
		$selectedJVA = JvaData::model()->findByPK($id);
		
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
	
	public function getDefColByJva($jva,$switch){
		switch($switch){
			case "Ik":
				return DefaultColConfig::model()->findByPK($jva->jvaColConfig);
				break;
			case "Memmel":
				return DefaultColConfig::model()->findByPK($jva->jvaColMemm);
				break;
			case "Loehne":
				return DefaultColConfig::model()->findByPK($jva->jvaColLoeh);
				break;
			case "Witte":
				return DefaultColConfig::model()->findByPK($jva->jvaColWitt);
				break;
			default:
				break;
		}
		
	}

	
	
		
		
	public function getDefColByJvaIKMemmLoehWitt ($jva){
		return DefaultColConfig::model()->findByPK($jva->jvaColIK, $jva->jvaColMemm,$jva->jvaColLoeh, $jva->jvaColWitt);
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
		if($jva->jvaAddress === ""){
			$jva->jvaAddress = "deactivated";
		}
		$jva->jvaDeactivated = "y";
		$jva->save();
		return $jva;
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
	
	public function insertJva($name,$nameExt,$address,$footer,$custNum,$custNumDesc,$colIk1,$colIk2,$colIk3,$colIk4,$colIk5,$colIk6,$colIk7,$colIk8,$colIk9,$colIk10,$colIk11,$colIk12,$colMemmel1,$colMemmel2,$colMemmel3,$colMemmel4,$colMemmel5,$colMemmel6,$colMemmel7,$colMemmel8,$colMemmel9,$colMemmel10,$colMemmel11,$colMemmel12,$colLoehne1,$colLoehne2,$colLoehne3,$colLoehne4,$colLoehne5,$colLoehne6,$colLoehne7,$colLoehne8,$colLoehne9,$colLoehne10,$colLoehne11,$colLoehne12,$colWitte1,$colWitte2,$colWitte3,$colWitte4,$colWitte5,$colWitte6,$colWitte7,$colWitte8,$colWitte9,$colWitte10,$colWitte11,$colWitte12,$printAmountIk,$printAmountMemmel,$printAmountLoehne,$printAmountWitte){
		$result = "false";
		$jvaColIk1 = $this->getColIdByName($colIk1);
		$jvaColIk2 = $this->getColIdByName($colIk2);
		$jvaColIk3 = $this->getColIdByName($colIk3);
		$jvaColIk4 = $this->getColIdByName($colIk4);
		$jvaColIk5 = $this->getColIdByName($colIk5);
		$jvaColIk6 = $this->getColIdByName($colIk6);
		$jvaColIk7 = $this->getColIdByName($colIk7);
		$jvaColIk8 = $this->getColIdByName($colIk8);
		$jvaColIk9 = $this->getColIdByName($colIk9);
		$jvaColIk10 = $this->getColIdByName($colIk10);
		$jvaColIk11 = $this->getColIdByName($colIk11);
		$jvaColIk12 = $this->getColIdByName($colIk12);
		$jvaColMemmel1 = $this->getColIdByName($colMemmel1);
		$jvaColMemmel2 = $this->getColIdByName($colMemmel2);
		$jvaColMemmel3 = $this->getColIdByName($colMemmel3);
		$jvaColMemmel4 = $this->getColIdByName($colMemmel4);
		$jvaColMemmel5 = $this->getColIdByName($colMemmel5);
		$jvaColMemmel6 = $this->getColIdByName($colMemmel6);
		$jvaColMemmel7 = $this->getColIdByName($colMemmel7);
		$jvaColMemmel8 = $this->getColIdByName($colMemmel8);
		$jvaColMemmel9 = $this->getColIdByName($colMemmel9);
		$jvaColMemmel10 = $this->getColIdByName($colMemmel10);
		$jvaColMemmel11 = $this->getColIdByName($colMemmel11);
		$jvaColMemmel12 = $this->getColIdByName($colMemmel12);
		$jvaColLoehne1 = $this->getColIdByName($colLoehne1);
		$jvaColLoehne2 = $this->getColIdByName($colLoehne2);
		$jvaColLoehne3 = $this->getColIdByName($colLoehne3);
		$jvaColLoehne4 = $this->getColIdByName($colLoehne4);
		$jvaColLoehne5 = $this->getColIdByName($colLoehne5);
		$jvaColLoehne6 = $this->getColIdByName($colLoehne6);
		$jvaColLoehne7 = $this->getColIdByName($colLoehne7);
		$jvaColLoehne8 = $this->getColIdByName($colLoehne8);
		$jvaColLoehne9 = $this->getColIdByName($colLoehne9);
		$jvaColLoehne10 = $this->getColIdByName($colLoehne10);
		$jvaColLoehne11 = $this->getColIdByName($colLoehne11);
		$jvaColLoehne12 = $this->getColIdByName($colLoehne12);
		$jvaColWitte1 = $this->getColIdByName($colWitte1);
		$jvaColWitte2 = $this->getColIdByName($colWitte2);
		$jvaColWitte3 = $this->getColIdByName($colWitte3);
		$jvaColWitte4 = $this->getColIdByName($colWitte4);
		$jvaColWitte5 = $this->getColIdByName($colWitte5);
		$jvaColWitte6 = $this->getColIdByName($colWitte6);
		$jvaColWitte7 = $this->getColIdByName($colWitte7);
		$jvaColWitte8 = $this->getColIdByName($colWitte8);
		$jvaColWitte9 = $this->getColIdByName($colWitte9);
		$jvaColWitte10 = $this->getColIdByName($colWitte10);
		$jvaColWitte11 = $this->getColIdByName($colWitte11);
		$jvaColWitte12 = $this->getColIdByName($colWitte12);
		
		$newJva = new JvaData;
		$newJva->jvaName = $name;
		$newJva->jvaNameExt = $nameExt;
		$newJva->jvaAddress = $address;
		$newJva->jvaFooter = $footer;
		$newJva->jvaCustNum = $custNum;
		$newJva->jvaCustNumDesc = $custNumDesc;
		
		$newJva->jvaColIk = new DefaultColConfig;
		$newJva->jvaColIk->col1 = $jvaColIk1;
		$newJva->jvaColIk->col2 = $jvaColIk2;
		$newJva->jvaColIk->col3 = $jvaColIk3;
		$newJva->jvaColIk->col4 = $jvaColIk4;
		$newJva->jvaColIk->col5 = $jvaColIk5;
		$newJva->jvaColIk->col6 = $jvaColIk6;
		$newJva->jvaColIk->col7 = $jvaColIk7;
		$newJva->jvaColIk->col8 = $jvaColIk8;
		$newJva->jvaColIk->col9 = $jvaColIk9;
		$newJva->jvaColIk->col10 = $jvaColIk10;
		$newJva->jvaColIk->col11 = $jvaColIk11;
		$newJva->jvaColIk->col12 = $jvaColIk12;
		$newJva->jvaColIk->printAmount = $printAmountIk;
		$newJva->jvaColIk->save();
		$newJva->jvaColMemmel = new DefaultColConfig;
		$newJva->jvaColMemmel->col1 = $jvaColMemmel1;
		$newJva->jvaColMemmel->col2 = $jvaColMemmel2;
		$newJva->jvaColMemmel->col3 = $jvaColMemmel3;
		$newJva->jvaColMemmel->col4 = $jvaColMemmel4;
		$newJva->jvaColMemmel->col5 = $jvaColMemmel5;
		$newJva->jvaColMemmel->col6 = $jvaColMemmel6;
		$newJva->jvaColMemmel->col7 = $jvaColMemmel7;
		$newJva->jvaColMemmel->col8 = $jvaColMemmel8;
		$newJva->jvaColMemmel->col9 = $jvaColMemmel9;
		$newJva->jvaColMemmel->col10 = $jvaColMemmel10;
		$newJva->jvaColMemmel->col11 = $jvaColMemmel11;
		$newJva->jvaColMemmel->col12 = $jvaColMemmel12;
		$newJva->jvaColMemmel->printAmount = $printAmountMemmel;
		$newJva->jvaColMemmel->save();
		$newJva->jvaColLoehne = new DefaultColConfig;
		$newJva->jvaColLoehne->col1 = $jvaColLoehne1;
		$newJva->jvaColLoehne->col2 = $jvaColLoehne2;
		$newJva->jvaColLoehne->col3 = $jvaColLoehne3;
		$newJva->jvaColLoehne->col4 = $jvaColLoehne4;
		$newJva->jvaColLoehne->col5 = $jvaColLoehne5;
		$newJva->jvaColLoehne->col6 = $jvaColLoehne6;
		$newJva->jvaColLoehne->col7 = $jvaColLoehne7;
		$newJva->jvaColLoehne->col8 = $jvaColLoehne8;
		$newJva->jvaColLoehne->col9 = $jvaColLoehne9;
		$newJva->jvaColLoehne->col10 = $jvaColLoehne10;
		$newJva->jvaColLoehne->col11 = $jvaColLoehne11;
		$newJva->jvaColLoehne->col12 = $jvaColLoehne12;
		$newJva->jvaColLoehne->printAmount = $printAmountLoehne;
		$newJva->jvaColLoehne->save();
		$newJva->jvaColWitte = new DefaultColConfig;
		$newJva->jvaColWitte->col1 = $jvaColWitte1;
		$newJva->jvaColWitte->col2 = $jvaColWitte2;
		$newJva->jvaColWitte->col3 = $jvaColWitte3;
		$newJva->jvaColWitte->col4 = $jvaColWitte4;
		$newJva->jvaColWitte->col5 = $jvaColWitte5;
		$newJva->jvaColWitte->col6 = $jvaColWitte6;
		$newJva->jvaColWitte->col7 = $jvaColWitte7;
		$newJva->jvaColWitte->col8 = $jvaColWitte8;
		$newJva->jvaColWitte->col9 = $jvaColWitte9;
		$newJva->jvaColWitte->col10 = $jvaColWitte10;
		$newJva->jvaColWitte->col11 = $jvaColWitte11;
		$newJva->jvaColWitte->col12 = $jvaColWitte12;
		$newJva->jvaColWitte->printAmount = $printAmountWitte;
		$newJva->jvaColWitte->save();
		
		$newJva->jvaColConfig = $newJva->jvaColIk->colConfigId;
		$newJva->jvaColMemm = $newJva->jvaColMemmel->colConfigId;
		$newJva->jvaColLoeh = $newJva->jvaColLoehne->colConfigId;
		$newJva->jvaColWitt= $newJva->jvaColWitte->colConfigId;
		
		$result = $newJva->save();
		
		return $result;
	}
	
	public function updateJva($name,$nameExt,$address,$footer,$custNum,$custNumDesc,$colIk1,$colIk2,$colIk3,$colIk4,$colIk5,$colIk6,$colIk7,$colIk8,$colIk9,$colIk10,$colIk11,$colIk12,$colMemmel1,$colMemmel2,$colMemmel3,$colMemmel4,$colMemmel5,$colMemmel6,$colMemmel7,$colMemmel8,$colMemmel9,$colMemmel10,$colMemmel11,$colMemmel12,$colLoehne1,$colLoehne2,$colLoehne3,$colLoehne4,$colLoehne5,$colLoehne6,$colLoehne7,$colLoehne8,$colLoehne9,$colLoehne10,$colLoehne11,$colLoehne12,$colWitte1,$colWitte2,$colWitte3,$colWitte4,$colWitte5,$colWitte6,$colWitte7,$colWitte8,$colWitte9,$colWitte10,$colWitte11,$colWitte12,$printAmountIk,$printAmountMemmel,$printAmountLoehne,$printAmountWitte){
		$result = "false";

		$jvaColIk1 = $this->getColIdByName($colIk1);
		$jvaColIk2 = $this->getColIdByName($colIk2);
		$jvaColIk3 = $this->getColIdByName($colIk3);
		$jvaColIk4 = $this->getColIdByName($colIk4);
		$jvaColIk5 = $this->getColIdByName($colIk5);
		$jvaColIk6 = $this->getColIdByName($colIk6);
		$jvaColIk7 = $this->getColIdByName($colIk7);
		$jvaColIk8 = $this->getColIdByName($colIk8);
		$jvaColIk9 = $this->getColIdByName($colIk9);
		$jvaColIk10 = $this->getColIdByName($colIk10);
		$jvaColIk11 = $this->getColIdByName($colIk11);
		$jvaColIk12 = $this->getColIdByName($colIk12);
		$jvaColMemmel1 = $this->getColIdByName($colMemmel1);
		$jvaColMemmel2 = $this->getColIdByName($colMemmel2);
		$jvaColMemmel3 = $this->getColIdByName($colMemmel3);
		$jvaColMemmel4 = $this->getColIdByName($colMemmel4);
		$jvaColMemmel5 = $this->getColIdByName($colMemmel5);
		$jvaColMemmel6 = $this->getColIdByName($colMemmel6);
		$jvaColMemmel7 = $this->getColIdByName($colMemmel7);
		$jvaColMemmel8 = $this->getColIdByName($colMemmel8);
		$jvaColMemmel9 = $this->getColIdByName($colMemmel9);
		$jvaColMemmel10 = $this->getColIdByName($colMemmel10);
		$jvaColMemmel11 = $this->getColIdByName($colMemmel11);
		$jvaColMemmel12 = $this->getColIdByName($colMemmel12);
		$jvaColLoehne1 = $this->getColIdByName($colLoehne1);
		$jvaColLoehne2 = $this->getColIdByName($colLoehne2);
		$jvaColLoehne3 = $this->getColIdByName($colLoehne3);
		$jvaColLoehne4 = $this->getColIdByName($colLoehne4);
		$jvaColLoehne5 = $this->getColIdByName($colLoehne5);
		$jvaColLoehne6 = $this->getColIdByName($colLoehne6);
		$jvaColLoehne7 = $this->getColIdByName($colLoehne7);
		$jvaColLoehne8 = $this->getColIdByName($colLoehne8);
		$jvaColLoehne9 = $this->getColIdByName($colLoehne9);
		$jvaColLoehne10 = $this->getColIdByName($colLoehne10);
		$jvaColLoehne11 = $this->getColIdByName($colLoehne11);
		$jvaColLoehne12 = $this->getColIdByName($colLoehne12);
		$jvaColWitte1 = $this->getColIdByName($colWitte1);
		$jvaColWitte2 = $this->getColIdByName($colWitte2);
		$jvaColWitte3 = $this->getColIdByName($colWitte3);
		$jvaColWitte4 = $this->getColIdByName($colWitte4);
		$jvaColWitte5 = $this->getColIdByName($colWitte5);
		$jvaColWitte6 = $this->getColIdByName($colWitte6);
		$jvaColWitte7 = $this->getColIdByName($colWitte7);
		$jvaColWitte8 = $this->getColIdByName($colWitte8);
		$jvaColWitte9 = $this->getColIdByName($colWitte9);
		$jvaColWitte10 = $this->getColIdByName($colWitte10);
		$jvaColWitte11 = $this->getColIdByName($colWitte11);
		$jvaColWitte12 = $this->getColIdByName($colWitte12);
		
		
		$updateJva = $this->getJvaByName($name,$nameExt);
		$updateJva->jvaName = $name;
		$updateJva->jvaNameExt = $nameExt;
		$updateJva->jvaAddress = $address;
		$updateJva->jvaFooter = $footer;
		$updateJva->jvaCustNum = $custNum;
		$updateJva->jvaCustNumDesc = $custNumDesc;
		
		
		
		$updateJva->jvaColIk = $this->getDefColByJva($updateJva,"Ik");
		$updateJva->jvaColIk->col1 = $jvaColIk1;
		$updateJva->jvaColIk->col2 = $jvaColIk2;
		$updateJva->jvaColIk->col3 = $jvaColIk3;
		$updateJva->jvaColIk->col4 = $jvaColIk4;
		$updateJva->jvaColIk->col5 = $jvaColIk5;
		$updateJva->jvaColIk->col6 = $jvaColIk6;
		$updateJva->jvaColIk->col7 = $jvaColIk7;
		$updateJva->jvaColIk->col8 = $jvaColIk8;
		$updateJva->jvaColIk->col9 = $jvaColIk9;
		$updateJva->jvaColIk->col10 = $jvaColIk10;
		$updateJva->jvaColIk->col11 = $jvaColIk11;
		$updateJva->jvaColIk->col12 = $jvaColIk12;
		$updateJva->jvaColIk->printAmount = $printAmountIk;
		$updateJva->jvaColIk->save();
		$updateJva->jvaColMemmel = $this->getDefColByJva($updateJva,"Memmel");
		$updateJva->jvaColMemmel->col1 = $jvaColMemmel1;
		$updateJva->jvaColMemmel->col2 = $jvaColMemmel2;
		$updateJva->jvaColMemmel->col3 = $jvaColMemmel3;
		$updateJva->jvaColMemmel->col4 = $jvaColMemmel4;
		$updateJva->jvaColMemmel->col5 = $jvaColMemmel5;
		$updateJva->jvaColMemmel->col6 = $jvaColMemmel6;
		$updateJva->jvaColMemmel->col7 = $jvaColMemmel7;
		$updateJva->jvaColMemmel->col8 = $jvaColMemmel8;
		$updateJva->jvaColMemmel->col9 = $jvaColMemmel9;
		$updateJva->jvaColMemmel->col10 = $jvaColMemmel10;
		$updateJva->jvaColMemmel->col11 = $jvaColMemmel11;
		$updateJva->jvaColMemmel->col12 = $jvaColMemmel12;
		$updateJva->jvaColMemmel->printAmount = $printAmountMemmel;
		$updateJva->jvaColMemmel->save();
		$updateJva->jvaColLoehne = $this->getDefColByJva($updateJva,"Loehne");
		$updateJva->jvaColLoehne->col1 = $jvaColLoehne1;
		$updateJva->jvaColLoehne->col2 = $jvaColLoehne2;
		$updateJva->jvaColLoehne->col3 = $jvaColLoehne3;
		$updateJva->jvaColLoehne->col4 = $jvaColLoehne4;
		$updateJva->jvaColLoehne->col5 = $jvaColLoehne5;
		$updateJva->jvaColLoehne->col6 = $jvaColLoehne6;
		$updateJva->jvaColLoehne->col7 = $jvaColLoehne7;
		$updateJva->jvaColLoehne->col8 = $jvaColLoehne8;
		$updateJva->jvaColLoehne->col9 = $jvaColLoehne9;
		$updateJva->jvaColLoehne->col10 = $jvaColLoehne10;
		$updateJva->jvaColLoehne->col11 = $jvaColLoehne11;
		$updateJva->jvaColLoehne->col12 = $jvaColLoehne12;
		$updateJva->jvaColLoehne->printAmount = $printAmountLoehne;
		$updateJva->jvaColLoehne->save();
		$updateJva->jvaColWitte = $this->getDefColByJva($updateJva,"Witte");
		$updateJva->jvaColWitte->col1 = $jvaColWitte1;
		$updateJva->jvaColWitte->col2 = $jvaColWitte2;
		$updateJva->jvaColWitte->col3 = $jvaColWitte3;
		$updateJva->jvaColWitte->col4 = $jvaColWitte4;
		$updateJva->jvaColWitte->col5 = $jvaColWitte5;
		$updateJva->jvaColWitte->col6 = $jvaColWitte6;
		$updateJva->jvaColWitte->col7 = $jvaColWitte7;
		$updateJva->jvaColWitte->col8 = $jvaColWitte8;
		$updateJva->jvaColWitte->col9 = $jvaColWitte9;
		$updateJva->jvaColWitte->col10 = $jvaColWitte10;
		$updateJva->jvaColWitte->col11 = $jvaColWitte11;
		$updateJva->jvaColWitte->col12 = $jvaColWitte12;
		$updateJva->jvaColWitte->printAmount = $printAmountWitte;
		$updateJva->jvaColWitte->save();
		
				
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
	
	public function getColNameById($id){
			$col = ColDef::model()->find(
				'colDefId=:colId',
				array(':colId'=>$id)
			);
			if($col !== NULL){
				return $col->colName;
			}else{
				return NULL;
			}
		
	}
	
}