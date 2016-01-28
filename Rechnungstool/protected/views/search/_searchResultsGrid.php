<?php

$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/protected\extensions\bootstrap\assets\js\bootstrap.js');
?>

<script>

$(document).ready(function () {
	
		$('#previewModal').modal({backdrop: 'static', keyboard: false});
		
		
		$(document).on("click", "#OkButton", function () {
			$("#previewModal").modal("hide");
			var printedCheck ;
			if($("#printed").is(":checked")){
				printedCheck = 1;
			}else{
					printedCheck = 0;
			}
			var counter = $("#counter").val();
			$.ajax({
				  method: "POST",
				  type: "json",
				  url: "index.php?r=search/updatedPrintStatus",
				  data: { 	
							printedFlag:printedCheck,
							counter:counter,
					}
				})
				 .done(function(data){
						$("#previewPdfModal").modal("hide");
				});												
				
		});
		
	})
</script>
<div class="panel panel-warning">
							<div class="panel-heading">
								<h3 class="panel-heading">Search Results</h3>
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-md-12">
									<?php if(isset($gridDataProvider) && !empty($gridDataProvider)){
										//var_dump($gridDataProvider);
											
											//cf. http://yiibooster.clevertech.biz/extendedGridView
												$this->widget('booster.widgets.TbExtendedGridView', array(
													'id'=>'documentIdSearch',
													'type' => 'striped bordered',
													'dataProvider' => $gridDataProvider,
													'template' => "{items}",
													'selectableRows' => 1,
													'bulkActions' => array(
													'actionButtons' => array(
														array(
															'buttonType' => 'button',
															'context' => 'primary',
															'size' => 'small',
															'label' => 'Dokument anzeigen',
															'click' => 'js:function previewDokument(){
																var result = [];
																var tbodyrow = $(\'#documentIdSearch table tbody tr\');
																tbodyrow.each(function(){
																	if($(this).hasClass("selected")){
																		var value = $(this).find("td:eq(3)").text();
																		result.push(value);
																	}
																});
																
																
																$.ajax({
																  method: "POST",
																  type: "json",
																  url: "index.php?r=search/getPreviewPdf",
																  data: { 	
																			
																			documentCounter: result
																	}
																})
																  .done(function(data){
																	  var dataArrS = jQuery.parseJSON(data);
																	  // alert(dataArrS);
																		$("#pdfFilePathSearch").attr("src", dataArrS.path);
																		$("#printAmountLabel").text(dataArrS.printAmount);
																		//alert(dataArrS.printedFlag);
																		if(dataArrS.printedFlag === "1" ||dataArrS.printedFlag === 1 ){
																			$("#printed").attr("checked", true);
																		}else{
																			$("#printed").attr("checked", false);
																		}																		
																		$("#counter").val(dataArrS.counter);
																		$("#previewPdfModal").modal("show");
																		
																	});	
															}',
															'id'=>'documentIdAction'
															)
														),
														// if grid doesn't have a checkbox column type, it will attach
														// one and this configuration will be part of it
														'checkBoxColumnConfig' => array(
															
															'name' => 'CheckId'
														),
													),
													'columns' => $gridColumns,
												));
											}
											?>
									</div>
								</div>
							</div>
							
						</div>
						
						<div  id="previewPdfModal" class = "modal">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<h4 class="modal-title">Vorschau</h4>
	  </div>
	  <div class="modal-body">
		<embed id="pdfFilePathSearch" src="" width="550px" height="480px">
	  </div>
	  <div class="modal-footer">
		<div class="alert alert-info col-md-7" style="font-size: 14px; padding:12px;">
			<p>Dieses Dokument sollte <div id ="printAmountLabel"></div>mal gedruckt werden.</p>
		</div>
		<input type="checkbox"  id="printed" > Schon gedruckt?<br>
		<a id="OkButton" type="button"  class="btn btn-primary">Ok</a>
		<input type="hidden" id="counter">
			  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->