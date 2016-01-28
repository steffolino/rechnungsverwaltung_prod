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
	
	
	public function actionLoadTableData(){
		$jvaModel = new JvaModel;
		$jvaNamePlusExt = $_POST["jva"];
		$docTypeName = $_POST["docType"];
		$numberCircle = $_POST["colConfig"];
		$docTypeImpl = new DoctypeImplementierung;
		$jvaNamePlusExtArray = array();
		$jvaNamePlusExtArray = explode("|",$jvaNamePlusExt);
		$jvaName = $jvaNamePlusExtArray[0];
		$jvaExt = $jvaNamePlusExtArray[1];
		$docTypeId = $docTypeImpl->getDocIdByName($docTypeName);
		$jva = $jvaModel->getJvaByName(trim($jvaName), trim($jvaExt));
		if($numberCircle === "ik"){
				$defaultColConfig = $jvaModel->getDefColByJva($jva,"Ik");
			}else if($numberCircle === "memmel"){
				$defaultColConfig = $jvaModel->getDefColByJva($jva,"Memmel");
			}else if($numberCircle === "loehne"){
				$defaultColConfig = $jvaModel->getDefColByJva($jva,"Loehne");
			}else{
				$defaultColConfig = $jvaModel->getDefColByJva($jva,"Witte");	
			}
		$printAmount = $defaultColConfig->printAmount;
		if($docTypeName === "Sammelrechnung"){
			$doc = new DocumentImplementierung;
			// $possibleDocs = $doc->getInvoicesDeliveryNotInCollective($jvaName,$jvaExt);
			// $gridDataProvider  =new CArrayDataProvider($possibleDocs,
			$possibleDocs = $doc->getInvoicesDeliveryNotInCollective($jvaName,$jvaExt,$numberCircle);
			$gridDataProvider  =new CArrayDataProvider($possibleDocs, 	
					array(
						'keyField' => 'documentId',  
						'id'=>'documentId'
						,));
			$gridColumns = array('documentId::ID','jvaName::Jva Name','timeStamp::Datum','counter::Zähler');
			$this->renderPartial('_collectiveInvoice', array('gridDataProvider'=> $gridDataProvider ,'gridColumns'=>$gridColumns), false, true);
		
		} else {
			
			$headerAndData = array();
			$header = array();
			$data = array();
			$allData = array();
			$counter = 0;
		
			$col1 = $jvaModel->getColNameById($defaultColConfig->col1);
			if($col1 !== NULL && $col1 !== ' '){
				array_push($header,$col1);
				$counter++;
			}
			$col2 = $jvaModel->getColNameById($defaultColConfig->col2);
			if($col2 !== NULL && $col2 !== ' '){
				array_push($header,$col2);
				$counter++;
			}
			$col3 = $jvaModel->getColNameById($defaultColConfig->col3);
			if($col3 !== NULL && $col3 !== ' '){
				array_push($header,$col3);
				$counter++;
			}
			$col4 = $jvaModel->getColNameById($defaultColConfig->col4);
			if($col4 !== NULL && $col4 !== " "){
				array_push($header,$col4);
				$counter++;
			}
			$col5 = $jvaModel->getColNameById($defaultColConfig->col5);
			if($col5 !== NULL && $col5 !== " "){
				array_push($header,$col5);
				$counter++;
			}
			$col6 = $jvaModel->getColNameById($defaultColConfig->col6);
			if($col6 !== NULL && $col6 !== " "){
				array_push($header,$col6);
				$counter++;
			}
			$col7 = $jvaModel->getColNameById($defaultColConfig->col7);
			if($col7 !== NULL && $col7 !== " "){
				array_push($header,$col7);
				$counter++;
			}
			$col8 = $jvaModel->getColNameById($defaultColConfig->col8);
			if($col8 !== NULL && $col8 !== " "){
				array_push($header,$col8);
				$counter++;
			}
			$col9 = $jvaModel->getColNameById($defaultColConfig->col9);
			if($col9 !== NULL && $col9 !== " "){
				array_push($header,$col9);
				$counter++;
			}
			$col10 = $jvaModel->getColNameById($defaultColConfig->col10);
			if($col10 !== NULL && $col10 !== " "){
				array_push($header,$col10);
				$counter++;
			}
			$col11 = $jvaModel->getColNameById($defaultColConfig->col11);
			if($col11 !== NULL && $col11 !== " "){
				array_push($header,$col11);
				$counter++;
			}
			$col12 = $jvaModel->getColNameById($defaultColConfig->col12);
			if($col12 !== NULL && $col12 !== " "){
				array_push($header,$col12);
				$counter++;
			}

			$docValues = new DocumentvaluesImplementierung;
			$doc = new DocumentImplementierung;
			$lastUsedDocId = $doc->getLastUsedDocumentId(trim($jvaName),trim($jvaExt),$docTypeId,$numberCircle);
			$documentValues = $docValues->getDocumentValuesByDocumentId($lastUsedDocId);
			
			foreach($documentValues as $rows){
				
				$data = array();
				$value1 = $rows->value1;
				if($value1 !== "Gesamt:") {
					if($value1 !== NULL) {
						array_push($data,$value1);
					}
					
					$value2 = $rows->value2;
					if($value2 !== NULL ){
						array_push($data,$value2);
					}
					$value3 = $rows->value3;
					if($value3 !== NULL ){
						array_push($data,$value3);
					}
					$value4 = $rows->value4;
					if($value4 !== NULL ){
						array_push($data,$value4);
					}
					$value5 = $rows->value5;
					if($value5 !== NULL ){
						array_push($data,$value5);
					}
					$value6 = $rows->value6;
					if($value6 !== NULL ){
						array_push($data,$value6);
					}
					$value7 = $rows->value7;
					if($value7 !== NULL ){
						array_push($data,$value7);
					}
					$value8 = $rows->value8;
					if($value8 !== NULL ){
						array_push($data,$value8);
					}
					$value9 = $rows->value9;
					if($value9 !== NULL ){
						array_push($data,$value9);
					}
					$value10 = $rows->value10;
					if($value10 !== NULL ){
						array_push($data,$value10);
					}
					$value11 = $rows->value11;
					if($value11 !== NULL ){
						array_push($data,$value11);
					}
					$value12 = $rows->value12;
					if($value12 !== NULL ){
						array_push($data,$value12);
					}
					array_push($allData,$data);
				}
			}
			
			$everything = array();
			array_push($everything,$header);
			array_push($everything,$allData);
			
			//var_dump($header);
			echo json_encode(array('dataVal'=>$everything,'printAmount'=>$printAmount));
		}
		
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
		$defaultDocument = $_POST["defaultDocument"];
		$jvaId = $jva->jvaDataId;
		$header = $_POST["headers"];
		$content = $_POST["content"];
		if(isset($_POST["invoiceExtra"])){
			$invoiceExtra = $_POST["invoiceExtra"];
		}else{
			$invoiceExtra = "";
		}
		if(isset($_POST["contentNumeric"])){
			$contentNumeric = $_POST["contentNumeric"];
		}else{
			$contentNumeric = "";
		}
		
		$contactPerson = "Herr Aumueller"; 
		
		$allRows = array();
		$row  = array();
		$counter = 0;
		//PARSE NUMBERS INSTEAD OF SUM()
		foreach($contentNumeric as $zeile){
			
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
			array_push($allRows,$row);
			
			$counter = 0;
			$row  = array();
		}
		$neuDoc = new DocumentImplementierung;


		// $pdfModel = new PdfModel;
		// $documentPdf = $pdfModel->createPdf();

		# mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();

        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');

        # render (full page)
		date_default_timezone_set('Europe/Berlin');
		$curDate = date("Ymd_His");

        # Load a stylesheet
		$stylesheet = file_get_contents(Yii::getPathOfAlias('bootstrap.assets.css') . '\bootstrap.css');
		//echo $stylesheet;
		
		/*** INTERESTING FOR RENDERING DOCUMENTS / INVOICES */
        # renderPartial (only 'view' of current controller)
//        $mPDF1->WriteHTML($this->renderPartial('index', array(), true));

        # Renders image
//        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));

		$filePath = Yii::getPathOfAlias('webroot')."/pdf/temp/".$docType."/";
		// $filePath = Yii::getPathOfAlias('webroot')."/pdf/temp/";
		$fileName = str_replace(" ", "", $jvaName)."_".$docType."_".$curDate.".pdf";

		$completeFilePathName = $filePath.$fileName;

		// $result = $neuDoc->insertNewDocument($docType,$jvaId,$contactPerson,$allRows,$counterType,$defaultDocument, $completeFilePathName);
		$result = $neuDoc->insertNewDocument($docType,$jvaId,$contactPerson,$allRows,$counterType,$defaultDocument, "pdf/temp/".$docType."/".$fileName);
		$printedFlag = $result->printed;

        $mPDF1->WriteHTML($stylesheet, 1);
		$mPDF1->WriteHTML($this->render('pdfTemplate', array('displayData' => $contentNumeric, 'header' => $header, 'jva' => $jva, 'curDate' => $curDate, 'invoiceExtra' => $invoiceExtra, 'docType' => $docType, 'counter' => $result->counter), true));

		$mPDF1->Output($completeFilePathName, "F");
		
		//pass also $documentId, leave out counter 
		echo json_encode(array('filePath' => "pdf/temp/".$docType."/".$fileName, 'counterType' => $counterType,'printedFlag'=>$printedFlag));
		// echo var_dump($result->counter);
		// var_dump($result);
	}
	
	public function actionDeleteThatPdf() {
		if(isset($_POST['filePath']) && isset($_POST['counterType'])) {
			//TODO: action for deleting 
			$filePath = $_POST['filePath'];
			$counterType = $_POST['counterType'];
			$docImpl = new DocumentImplementierung;
			//TODO: Revert Counter
			$revertResult = $docImpl->revertCounter($counterType);
			if(isset($_POST['docType'])){
				$collectiveImpl = new CollectiveinvoiceImplementierung;
				$collectiveImpl->deleteCollectiveInvoicePerId($_POST['collId']);
			}
			if($revertResult) {
				$result = $docImpl->deleteDocumentByFilePath($filePath);
				unlink(Yii::getPathOfAlias('webroot')."/".$filePath);
				echo json_encode($revertResult);
			} else {
				echo "error reverting counter";
			}
			// echo $result.$filePath;
		} else {
			echo "error deleting";
		}
	}
	
	public function actionSaveThatPdf() {
		if(isset($_POST['filePath'])){
			$filePath = $_POST['filePath'];
			$newFilePath = str_replace("/temp", "", $filePath);
			if (copy(Yii::getPathOfAlias('webroot')."/".$filePath, Yii::getPathOfAlias('webroot')."/".$newFilePath)) {
			  unlink(Yii::getPathOfAlias('webroot')."/".$filePath);
			}
			$docImpl = new DocumentImplementierung;
			$result = $docImpl->updateFilePath($filePath, $newFilePath);			
			echo $newFilePath;
		}
	}
	
	public function actionAddToCollectiveInvoice(){
		//TODO: generate PDF from single documents and preview in modal and calculate total of all invoices as collectiveinvoicetotal
		// rest similar to regular invoice stuff: preview -> save / cancel
		if(isset($_POST['data'])){
			$jvaModel = new JvaModel;
			$collectiveData = $_POST['data'];
			$collectiveImpl = new CollectiveinvoiceImplementierung;
			$resultCounter = $collectiveImpl->insertNewCollectiveInvoice($collectiveData);
			$jvaNamePlusExt = $_POST["jva"];
			$docType = $_POST["docType"];
			$jvaNamePlusExtArray = array();
			$jvaNamePlusExtArray = explode("|",$jvaNamePlusExt);
			$jvaName = $jvaNamePlusExtArray[0];
			$jvaExt = $jvaNamePlusExtArray[1];
			$counterType = $_POST['counterType'];
			$jva = $jvaModel->getJvaByName(trim($jvaName), trim($jvaExt));
			//This is for re-rendering of the yiiBooster
			// if($result > 0){
				// $doc = new DocumentImplementierung;
				// $jvaNamePlusExt = $_POST["jva"];
				// $jvaNamePlusExtArray = array();
				// $jvaNamePlusExtArray = explode("|",$jvaNamePlusExt);
				// $jvaName = $jvaNamePlusExtArray[0];
				// $jvaExt = $jvaNamePlusExtArray[1];
				// $possibleDocs = $doc->getInvoicesDeliveryNotInCollective($jvaName,$jvaExt);
				// $gridDataProvider  =new CArrayDataProvider($possibleDocs, 	
					// array(
						// 'keyField' => 'documentId',  
						// 'id'=>'documentId'
						// ,));
				// $gridColumns = array('documentId::ID','jvaName::Jva Name','timeStamp','counter::Zähler');
				// $this->renderPartial('_collectiveInvoice', array('gridDataProvider'=> $gridDataProvider ,'gridColumns'=>$gridColumns), false, true);	
			// }
			$neuDoc = new DocumentImplementierung;
			//Start of PDF Preview Modal after selecting data for collective invoices
			//Hardcode Header 
			$header = array('Rechnungsnummer','Rechnungsdatum','Rechnungsbetrag');
			
			//get data of selected 
			$contentNumeric = $neuDoc->getNecessaryDataForCollectivePreview($collectiveData);
			$invoiceExtra = $neuDoc->getInvoiceExtraFromAllSum($collectiveData);
			
			
			$allRows = array();
			$row  = array();
			$counter = 0;
			//PARSE NUMBERS INSTEAD OF SUM()
			foreach($contentNumeric as $zeile){
				
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
				array_push($allRows,$row);
				
				$counter = 0;
				$row  = array();
			}
			$mPDF1 = Yii::app()->ePdf->mpdf();

			# You can easily override default constructor's params
			$mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');

			# render (full page)
			date_default_timezone_set('Europe/Berlin');
			$curDate = date("Ymd_His");

			$filePath = Yii::getPathOfAlias('webroot')."/pdf/temp/".$docType."/";
			// $filePath = Yii::getPathOfAlias('webroot')."/pdf/temp/";
			$fileName = str_replace(" ", "", $jvaName)."_".$docType."_".$curDate.".pdf";

			$completeFilePathName = $filePath.$fileName;

			# Load a stylesheet
			$stylesheet = file_get_contents(Yii::getPathOfAlias('bootstrap.assets.css') . '\bootstrap.css');
			
			$result = $neuDoc->insertNewDocument($docType,$jvaId,$contactPerson,$allRows,$counterType,$defaultDocument, "pdf/temp/".$docType."/".$fileName);
			$printedFlag = $result->printed;

			$mPDF1->WriteHTML($stylesheet, 1);
			$mPDF1->WriteHTML($this->render('pdfCollectiveTemplate', array('displayData' => $contentNumeric, 'header' => $header, 'jva' => $jva, 'curDate' => $curDate, 'invoiceExtra' => $invoiceExtra, 'docType' => $docType, 'counter' => $result->counter), true));

			$mPDF1->Output($completeFilePathName, "F");
		
			//pass also $documentId, leave out counter 
			echo json_encode(array('filePath' => "pdf/temp/".$docType."/".$fileName, 'counterType' => $counterType,'newId'=>$resultCounter,'printedFlag'=>$printedFlag));
			//var_dump($contentNumeric);
		}
	}
	
}