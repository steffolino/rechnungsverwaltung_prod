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
		$formModel = new SearchFormModel;
		$model = new FakeActiveRecord;
		$model->myid = 1;
		$model->myattr = 'Datum';
		$this->render('search', array('model' => $model, 'formModel' => $formModel));
	}
}