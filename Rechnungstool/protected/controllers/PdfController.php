<?php

class PdfController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
	}
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{		
		$this->render('index');
	}
	
	public function actionCreatePdf () {
		
		# mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();

        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');

        # render (full page)

        # Load a stylesheet
	$stylesheet = file_get_contents(Yii::getPathOfAlias('bootstrap.assets.css') . '\bootstrap.css');
		//echo $stylesheet;
        $mPDF1->WriteHTML($stylesheet, 1);
        $mPDF1->WriteHTML($this->render('testIndex', array(), true));
		
		/*** INTERESTING FOR RENDERING DOCUMENTS / INVOICES */
        # renderPartial (only 'view' of current controller)
//        $mPDF1->WriteHTML($this->renderPartial('index', array(), true));

        # Renders image
//        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));

        # Outputs ready PDF
        $mPDF1->Output();
		
		# HTML2PDF has very similar syntax		
		/*
        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($this->renderPartial('testIndex', array(), true));
        $html2pdf->Output();
		*/
	}
	
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

}