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

	public function actionSearch ()
	{
		
			if(isset($_POST['searchTerm'])){
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
					$date->format('Y-m-d');
					$formModel->startDate = $startDate;
				}else{
					$formModel->startDate = NULL;
				}
				if($_POST['startDate'] !== "Empty"){
					$endDate = new DateTime($_POST['endDate']);
					$date->format('Y-m-d');
					$formModel->endDate = $endDate;
				}else{
					$formModel->endDate = NULL;
				}
				if(!empty($_POST['nameSet']) && $_POST['nameSet'] !== "JVA Name"){
					$formModel->jvaName = $_POST['nameSet'];
				}else{
					$formModel->jvaName = NULL;
				}
				if(isset($_POST['selectedDocType']) && !empty($_POST['selectedDocType']) ){
					$formModel->docType = $_POST['selectedDocType'];	
				}else{
					$formModel->docType = NULL;
				}
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