<?php

class DocumentController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	
	
	public function actionEnterNewDoc()
	{
		$this->render('enterNewDoc');
	}

	
	public function actionTestDocument()
	{
		//TO DO: This simulates the $_POST array which then comes from inserts of user
		$row1 = array(5,6,"Horst",7,NUll,Null,Null,NUll,NUll,NUll,NUll,NUll,"Artikelbeschreibung","Artikelnummer","Artikenanzahl","Rechnung",NUll,Null,Null,NUll,NUll,NUll,NUll,NUll);
		$row2 = array(6,7,"Detelef",8,NUll,Null,Null,NUll,NUll,NUll,NUll,NUll,"Artikelbeschreibung","Artikelnummer","Artikenanzahl","Rechnung",NUll,Null,Null,NUll,NUll,NUll,NUll,NUll);
		$allRows = array($row1,$row2);
		$contactPerson = "Alfred E. Neumann";
		$jvaId = 0;
		$docType = "Gutschrift";
		$counterType = "IK";
		$newDoc = new DocumentImplementierung;
		//$result = $newDoc->insertNewDocument($docType,$jvaId,$contactPerson,$allRows,$counterType);
		$result = $newDoc->getColumnValuesPerSelectedJva($jvaId);
		$this->render('enterNewDoc',array('allRows'=>$allRows, 'result'=>$result));
	}
	
	
	public function actionGetTableData()
	{	
		$jvaModel = new JvaModel;
		$counterType = $_POST["counterType"];
		$docType = $_POST["docType"];
		$jvaNamePlusExt = $_POST["jva"];
		$jvaNamePlusExtArray = array();
		$jvaNamePlusExtArray = explode("|",$jvaNamePlusExt);
		$jvaName = $jvaNamePlusExtArray[0];
		$jvaExt = $jvaNamePlusExtArray[1];
		$jva = $jvaModel->getJvaByName(trim($jvaName), trim($jvaExt));
		
		$jvaId = $jva->jvaDataId;
		$header = $_POST["headers"];
		$content = $_POST["content"];
		
		$allRows = array();
		$row  = array();
		$counter = 0;
		foreach($content as $zeile){
			foreach($zeile as $cell){
				array_push($row,$cell);
				$counter++;
			}
			for($counter;$counter <= 11;$counter++){
				array_push($row,NULL);
			}
			$counter++;
			foreach($header as $colHeader){
				array_push($row,$colHeader);
				$counter++;
			}
			for($counter;$counter <= 23;$counter++){
				array_push($row,NULL);
			}
			$allRows = array_merge($allRows,$row);
			
			$counter = 0;
		}
		$neuDoc = new DocumentImplementierung;
		//$result = $neuDoc->insertNewDocument($docType,$jvaId,$contactPerson,$allRows,$counterType);
	}
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}