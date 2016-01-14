<?php

class PdfModel extends CFormModel
{

	public $jvaData;
	public $tableHeaders;
	public $tableData;

		public function createPdf () {
		
		# mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();

        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');

        # render (full page)

        # Load a stylesheet
		$stylesheet = file_get_contents(Yii::getPathOfAlias('bootstrap.assets.css') . '\bootstrap.css');
		//echo $stylesheet;
        $mPDF1->WriteHTML($stylesheet, 1);
        $mPDF1->WriteHTML($this->render('pdf/testIndex', array(), true));
		
		/*** INTERESTING FOR RENDERING DOCUMENTS / INVOICES */
        # renderPartial (only 'view' of current controller)
//        $mPDF1->WriteHTML($this->renderPartial('index', array(), true));

        # Renders image
//        $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));

        # Outputs ready PDF
        return($mPDF1->Output());
		
		# HTML2PDF has very similar syntax		
		/*
        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($this->renderPartial('testIndex', array(), true));
        $html2pdf->Output();
		*/
	}

}
?>