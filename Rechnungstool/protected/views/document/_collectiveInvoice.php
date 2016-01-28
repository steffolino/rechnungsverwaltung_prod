
<?php

// $baseUrl = Yii::app()->baseUrl; 
// $cs = Yii::app()->getClientScript();
// $cs->registerScriptFile($baseUrl.'/js/handsontable-0.19.0/dist/handsontable.full.js');
// $cs->registerCssFile($baseUrl.'/js/handsontable-0.19.0/dist/handsontable.full.css');
// $cs->registerScriptFile($baseUrl.'/js/handsontable-0.19.0/lib/ruleJS/dist/full/ruleJS.all.full.js');
// $cs->registerScriptFile($baseUrl.'/js/handsontable-0.19.0/dist/handsontable-ruleJS/src/handsontable.formula.js');

// C:\inetpub\wwwroot\massaki\Rechnungstool\js\handsontable-0.19.0\dist
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/protected\extensions\bootstrap\assets\js\bootstrap.js');

?>
<script>

jQuery(function ($) {
	// jQuery.noConflict();
	function getAllSelectedRows(){
		var nameSetT = $("#select2-chosen-1").text();
		var resultT = [];														
		var tbodyrowT = $('#CollectiveGrid table tbody tr');
		var counterTypeT = $('#nummernkreisSelect option:selected').text();
		var buttonPressedT;
				$("#docSelection .btn").each(function() {
					if($(this).hasClass('active')) {
						buttonPressedT = $(this).text();
					}
				});
		tbodyrowT.each(function(){
			if($(this).hasClass("selected")){
				var valueT = $(this).find("td:eq(1)").text();
				resultT.push(valueT);
			}
		});
		$.ajax({
				method: "POST",
				type: "json",
				url: "index.php?r=document/addToCollectiveInvoice",
				data: { 
					counterType: counterTypeT,
					docType: buttonPressedT,
					data: resultT,
					jva: nameSetT,
				}
		}).done(function(data) {
			var dataArr = jQuery.parseJSON(data);
			$("#pdfFilePathCollect").attr('src', dataArr.filePath);
			$("#counterTypeCollect").val(dataArr.counterType);
			$("#collectiveId").val(dataArr.newId);
			if(dataArr.printedFlag === 1){
				$("#printedCollect").prop('checked', true);
			}else{
				$("#printedCollect").prop('checked', false);
			}
			
			$("#previewModalCollect").modal('show');
			
			//$('#docContentCollectiveInvoice').html(data);
		});
	}
	
	$('#writingDoc').on("click",function(){
		if($("#CollectiveInvoiceExample").is(':visible')){
			getAllSelectedRows();
		}
	});
  

});

</script>
<?php 
echo '
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-heading">Sammelrechnung</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form id="items">
				<div id="CollectiveInvoiceExample">';
				 if(isset($gridDataProvider) && !empty($gridDataProvider)){
										//var_dump($gridDataProvider);											
											//cf. http://yiibooster.clevertech.biz/extendedGridView
												$this->widget('booster.widgets.TbExtendedGridView', array(
													'id'=>'CollectiveGrid',
													'type' => 'striped bordered',
													'dataProvider' => $gridDataProvider,
													'template' => "{items}",
													'selectableRows' => 2,
													'bulkActions' => array(
													'actionButtons' => array(
														array(
															'buttonType' => 'button',
															'context' => 'primary',
															'size' => 'small',
															'label' => 'Ausgewählte Dokumente zu einer Sammelrechnung zusammenfassen und Vorschau anzeigen',
															'click' => 'js:function getAllSelectedRows(){
																var nameSet = $("#select2-chosen-1").text();
																var result = [];
																var tbodyrow = $(\'#CollectiveGrid table tbody tr\');
																
																var counterType = $("#nummernkreisSelect option:selected").text();
																var buttonPressed;
																$("#docSelection .btn").each(function() {
																	if($(this).hasClass("active")) {
																		buttonPressed = $(this).text();
																	}
																});
																tbodyrow.each(function(){
																	if($(this).hasClass("selected")){
																		var value = $(this).find("td:eq(1)").text();
																		result.push(value);
																	}
																});
																$.ajax({
																		method: "POST",
																		type: "json",
																		url: "index.php?r=document/addToCollectiveInvoice",
																		data: { 
																			counterType: counterType,
																			docType: buttonPressed,
																			data: result,
																			jva:nameSet,
																		}
																}).done(function(data) {
																	//$("#docContentCollectiveInvoice").html(data);
																	var dataArr = jQuery.parseJSON(data);
																	$("#pdfFilePathCollect").attr("src", dataArr.filePath);
																	$("#counterTypeCollect").val(dataArr.counterType);
																	$("#collectiveId").val(dataArr.newId);
																	$("#previewModalCollect").modal("show");
																});
															}',
															'id'=>'BulkDocumentId'
															)
														),
														// if grid doesn't have a checkbox column type, it will attach
														// one and this configuration will be part of it
														
													),
													'columns' => $gridColumns,
													//TODO: work this out
													/*
													'columns' =>  array(
														// 'jvaName',
														// 'jva_creationDate',
														// 'zaehler',
														$gridColumns,
														array(
																 'class'=>'bootstrap.widgets.TbButtonColumn',
																 'template' => '{postview} {preview}',
																// Buttons config
																'buttons' => array(
																	'postview' => array(
																		'label' => '...',     // text label of the button
																		'url' => '...',       // the PHP expression for generating the URL of the button
																		'click' => '...',     // a JS function to be invoked when the button is clicked
																	),
																	'preview' => array(
																		// Another button config
																	),
																),
														),
													),
													*/
												));
											}
											echo '
				
				
				</div>
				</form>
			</div>
		</div>
	</div>
</div>';						
?>