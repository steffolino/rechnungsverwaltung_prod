<?php
class JvaController extends Controller
{
	public function actionTest(){
		
		$jvaModel = new JvaModel;
				
		$jvaCol1 = "Artikelbeschreibung";
		$jvaCol2 = "Artikelnummer";
		$jvaCol3="";
		$jvaCol4="";
		$jvaCol5="";
		$jvaCol6="";
		$jvaCol7="";
		$jvaCol8="";
		$jvaCol9="";
		$jvaCol10="";
		$jvaCol11="";
		$jvaCol12="";
		$jvaCol13="";
		$jvaName = "JVA Hauptsi";
		$jvaAddress = "Hauptsi 30 96052 Bamberg";
		$jvaNameExt = "drunter";
		$jvaFooter = "Adela Tschuessikowski!";
		$jvaCustNum = '';
		$jvaCustNumDesc = '';
		
		$jvaOldName = "JVA Hauptsi";
		$jvaOldNameExt = "drunter";
		//$jvaModel->getAllJvas();
		//$jvaModel->getAllColNames();
		//$jvaModel->getAllJvasNamesAndExtensions();
		$jvaModel->insertJva($jvaName,$jvaNameExt,$jvaAddress,$jvaFooter,$jvaCustNum,$jvaCustNumDesc,$jvaCol1,$jvaCol2,$jvaCol3,$jvaCol4,$jvaCol5,$jvaCol6,$jvaCol7,$jvaCol8,$jvaCol9,$jvaCol10,$jvaCol11,$jvaCol12);
		//$jvaModel->updateJva($jvaOldName,$jvaOldNameExt,$jvaName,$jvaNameExt,$jvaAddress,$jvaFooter,$jvaCustNum,$jvaCustNumDesc,$jvaCol1,$jvaCol2,$jvaCol3,$jvaCol4,$jvaCol5,$jvaCol6,$jvaCol7,$jvaCol8,$jvaCol9,$jvaCol10,$jvaCol11,$jvaCol12);
		//$jvaModel->deleteJvaByName($jvaName,$jvaNameExt);
		//$jvaModel->getAllCols();
		$this->render('jvatest',array('jvaModel'=>$jvaModel));
	}
	public function actionListJVAs () {
		
		$jvaModel = new JvaModel;
		$jvaModel->getAllJvas();
		$jvaModel->getAllColNames();
		$colNames = $jvaModel->allColNames;
		$jvaListModel = $jvaModel->allJvas;
		$jvaAddFormModel= new JvaAddModel;
		$jvaEditFormModel="";
		 $this->render('jvaList', array('jvaListModel' => $jvaListModel, 'jvaAddFormModel' => $jvaAddFormModel,'jvaEditFormModel' => $jvaEditFormModel, 'colNames'=>$colNames));
	}
	
	public function actionLoadJVAEditForm () {
		if(isset($_POST['jvaID'])) {
			$jvaID = htmlspecialchars($_POST['jvaID']);
			// $jvaID = $_POST['jvaID'];
			$jvaModel = new JvaModel;
			$jvaModel->getAllColNames();
			$colNames = $jvaModel->allColNames;
			$selectedJVA = $jvaModel->getJvaById($jvaID);
			$this->renderPartial('_jvaEditForm', array('jvaEditFormModel'=> $selectedJVA ,'colNames'=>$colNames), false, true);
			
		} else {
			echo "ERROR: jvaID not set";
		}
	}
	
	public function actionSaveJVAEditForm(){
		$jvaModel = new JvaModel;
		$jvaModel->getAllColNames();
		$colNames = $jvaModel->allColNames;
		if(isset($_POST['data'])){
			$jvaName = $_POST['data'][0];
			$jvaNameExt = $_POST['data'][1];
			$jvaCustName = $_POST['data'][2];
			$jvaCustNameDesc = $_POST['data'][3];
			$jvaFooter = $_POST['data'][4];
			$jvaAddress = $_POST['data'][5];
			$jvaCol1 = $_POST['data'][6];
			$jvaCol2 = $_POST['data'][7];
			$jvaCol3 = $_POST['data'][8];
			$jvaCol4 = $_POST['data'][9];
			$jvaCol5 = $_POST['data'][10];
			$jvaCol6 = $_POST['data'][11];
			$jvaCol7 = $_POST['data'][12];
			$jvaCol8 = $_POST['data'][13];
			$jvaCol9 = $_POST['data'][14];
			$jvaCol10 = $_POST['data'][15];
			$jvaCol11 = $_POST['data'][16];
			$jvaCol12 = $_POST['data'][17];
			$jvaModel->updateJva($jvaName,$jvaNameExt,$jvaAddress,$jvaFooter,$jvaCustName,$jvaCustNameDesc,$jvaCol1,$jvaCol2,$jvaCol3,$jvaCol4,$jvaCol5,$jvaCol6,$jvaCol7,$jvaCol8,$jvaCol9,$jvaCol10,$jvaCol11,$jvaCol12);
			
			$selectedJVA = $jvaModel->getJvaByName($jvaName,$jvaNameExt);
			$this->renderPartial('_jvaEditForm', array('jvaEditFormModel'=> $selectedJVA ,'colNames'=>$colNames), false, true);
		} else {
			echo "data not set";
		}
		
	}
	
	
	public function actionSaveJVAAddForm(){
		$jvaModel = new JvaModel;
		$jvaModel->getAllColNames();
		$colNames = $jvaModel->allColNames;
		if(isset($_POST['data'])){
			$jvaName = $_POST['data'][0];
			$jvaNameExt = $_POST['data'][1];
			$jvaCustName = $_POST['data'][2];
			$jvaCustNameDesc = $_POST['data'][3];
			$jvaFooter = $_POST['data'][4];
			$jvaAddress = $_POST['data'][5];
			$jvaCol1 = $_POST['data'][6];
			$jvaCol2 = $_POST['data'][7];
			$jvaCol3 = $_POST['data'][8];
			$jvaCol4 = $_POST['data'][9];
			$jvaCol5 = $_POST['data'][10];
			$jvaCol6 = $_POST['data'][11];
			$jvaCol7 = $_POST['data'][12];
			$jvaCol8 = $_POST['data'][13];
			$jvaCol9 = $_POST['data'][14];
			$jvaCol10 = $_POST['data'][15];
			$jvaCol11 = $_POST['data'][16];
			$jvaCol12 = $_POST['data'][17];
			$jvaModel->insertJva($jvaName,$jvaNameExt,$jvaAddress,$jvaFooter,$jvaCustName,$jvaCustNameDesc,$jvaCol1,$jvaCol2,$jvaCol3,$jvaCol4,$jvaCol5,$jvaCol6,$jvaCol7,$jvaCol8,$jvaCol9,$jvaCol10,$jvaCol11,$jvaCol12);
			$selectedJVA = $jvaModel->getJvaByName($jvaName,$jvaNameExt);
			
			//$this->renderPartial('_jvaEditForm', array('jvaEditFormModel'=> $selectedJVA ,'colNames'=>$colNames), false, true);

			$jvaModel = new JvaModel;
			$jvaModel->getAllJvas();
			$jvaListModel = $jvaModel->allJvas;
			$this->renderPartial('_jvaList', array('jvaListModel' => $jvaListModel), false, true);
		}
	}
	
	
	public function actionDeactivateJVAById(){
		$jvaModel = new JvaModel;
		$jvaModel->getAllColNames();
		// $colNames = $jvaModel->allColNames;
		if(isset($_POST['jvaID'])) {
			$jvaID = htmlspecialchars($_POST['jvaID']);
			$jvaModel->deactivateJvaById($jvaID);
		}
		$jvaModel->getAllJvas();
		$jvaList = $jvaModel->allJvas;
		// $jvaAddFormModel= new JvaAddModel;
		// $jvaEditFormModel="";
		 $this->renderPartial('_jvaList', array('jvaListModel' => $jvaList), false, true);
	}
	
	public function actionGetJvaAsJson () {
		if(isset($_GET['jvaSearchTerm'])) {
			$searchTerm = htmlspecialchars($_GET['jvaSearchTerm']);
			$jvaModel = new JVAModel();
			$jvaNamesArray = $jvaModel->getAllJvaNames($searchTerm);
			// $jvaNamesArray = $jvaModel->allJvas;
			echo CJSON::encode($jvaNamesArray);
			return;
		}
		echo "Error in Controller";
	}
}