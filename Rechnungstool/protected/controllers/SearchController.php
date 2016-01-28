<?php

class SearchController extends Controller
{
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	public function actionUpdatedPrintStatus(){
		$docImpl = new DocumentImplementierung;
		$document = $docImpl->getDocumentWithCounter($_POST['counter']);
		$docImpl->updatePrintedStatus($document->documentId,$_POST['printedFlag']);
		echo "true";
	}
	

	public function actionGetPreviewPdf(){
		
		if(isset($_POST['documentCounter'][0])){
			
			$selectedCounter = $_POST['documentCounter'][0];
			$docImpl = new DocumentImplementierung;
			
			$document = $docImpl->getDocumentWithCounter($selectedCounter);
			
			$printedFlag = $document->printed;
			$path = $document->pdf_location;
			$path =  $path;
			if (strpos($document->counter, 'IK') ){
				$printAmount = $document->jva->jvaColIk->printAmount;
			}else if(strpos($document->counter, 'Memmelsdorf')){
				
				$printAmount = $document->jva->jvaColMemmel->printAmount;
			}else if(strpos($document->counter, 'Loehne')){
				$printAmount = $document->jva->jvaColLoehne->printAmount;
			}else{
				$printAmount = $document->jva->jvaColWitte->printAmount;
			}
			echo json_encode(array("path"=>$path,"printAmount"=>trim($printAmount),"counter"=>$document->counter,"printedFlag"=>$printedFlag)); 
			//var_dump($path);
		}else{
			echo "Error";
		}
	}
	
	public function actionSearch ()
	{
		
			if(isset($_POST['searchTerm']) && !isset($_POST['filtersEnabled'])){
				$formModel = new SearchFormModel;
				$formModel->freeSearchTerm = $_POST['searchTerm'];
				$gridDataProviderData = $formModel->searchWithoutFilter();
				$gridDataProvider  =new CArrayDataProvider($gridDataProviderData, 	
					array(
						'keyField' => 'documentId',  
						'id'=>'documentId'
						,));
				//TO DO: Amend!!!!
				$gridColumns = array('jvaName::Jva Name','timeStamp::Zeit','counter::Zähler');
				
				if(!empty($gridDataProvider)){
					$this->renderPartial('_searchResultsGrid', array('gridDataProvider'=> $gridDataProvider ,'gridColumns'=>$gridColumns), false, true);
				}else{
					echo "No result;";
				}
			}else if(isset($_POST['filtersEnabled'])){
				
				$formModel = new SearchFormModel;
				$formModel->freeSearchTerm = $_POST['searchTerm'];
				if($_POST['startDate'] !== "Empty"){
					$startDate = new DateTime($_POST['startDate']);
				$formModel->startDate =	$startDate->format('Y-m-d H:i:s');
					
				}else{
					$formModel->startDate = NULL;
				}
				if($_POST['endDate'] !== "Empty"){
					$endDate = new DateTime($_POST['endDate']);
					$formModel->endDate = $endDate->format('Y-m-d H:i:s');
					
				}else{
					$formModel->endDate = NULL;
				}
				
				$nameSet = trim($_POST['nameSet']);
				//var_dump(empty($nameSet));
				if(!empty($nameSet)&& $nameSet !=="  " && $nameSet !=="" && strlen($nameSet) >2 && $nameSet !== "JVA Name"){
					$formModel->jvaName = $nameSet;
				}else{
					$formModel->jvaName = NULL;
				}
				if(isset($_POST['selectedDocType']) && !empty($_POST['selectedDocType']) ){
					$formModel->docType = $_POST['selectedDocType'];	
				}else{
					$formModel->docType = NULL;
				}
				//var_dump($formModel->jvaName);
				$gridDataProviderData = $formModel->searchWithFilter();
				$gridDataProvider  =new CArrayDataProvider($gridDataProviderData, 	
					array(
						'keyField' => 'documentId',  
						'id'=>'documentId'
						,));
				
				//TODO: To be amended!!!
				$gridColumns = array('jvaName::Jva Name','timeStamp:.Zeit','counter::Zähler');
				if(!empty($gridDataProvider)){
					$this->renderPartial('_searchResultsGrid', array('gridDataProvider'=> $gridDataProvider ,'gridColumns'=>$gridColumns), false, true);
				}else{
					echo "No result;";
				}
			}else{
				$formModel = new SearchFormModel;
				$model = new FakeActiveRecord;
				$model->myid = 1;
				$model->myattr = 'Datum';
				$this->render('search', array('model' => $model, 'formModel' => $formModel));	
			}
		
			
	
		
	}
}