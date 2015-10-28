<?php


echo "Hallo<br>";
if(isset($jvaModel->allJvas)){

	echo "<pre>";
	var_dump($jvaModel->allJvas);
	echo "</pre>";

}
if(isset($jvaModel->allCols)){
	echo "<pre>";
	var_dump($jvaModel->allColNames);
	echo "</pre>";
	
}
if(isset($jvaModel->allJvaNameAndExtensions)){
	echo "<pre>";
	var_dump($jvaModel->allJvaNameAndExtensions);
	echo "</pre>";
	
}

?>