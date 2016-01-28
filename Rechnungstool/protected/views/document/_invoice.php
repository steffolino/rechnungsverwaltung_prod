
<?php

// $baseUrl = Yii::app()->baseUrl; 
// $cs = Yii::app()->getClientScript();
// $cs->registerScriptFile($baseUrl.'/js/handsontable-0.19.0/dist/handsontable.full.js');
// $cs->registerCssFile($baseUrl.'/js/handsontable-0.19.0/dist/handsontable.full.css');
// $cs->registerScriptFile($baseUrl.'/js/handsontable-0.19.0/lib/ruleJS/dist/full/ruleJS.all.full.js');
// $cs->registerScriptFile($baseUrl.'/js/handsontable-0.19.0/dist/handsontable-ruleJS/src/handsontable.formula.js');
// C:\inetpub\wwwroot\massaki\Rechnungstool\js\handsontable-0.19.0\dist

?>

<script>
	function getTableDataNumeric (tableData, tableID) {
			console.log("getting table data");
			
			var htCoreData = $(tableID+" .htCore tbody tr");
			htCoreData.each(function(i, v){
				console.log(i);
				tableData[i] = Array();
				$(this).children('td').each(function(ii, vv){
					tableData[i][ii] = $(this).text();
				}); 
			});
			tableData = tableData.slice(0, hot.countRows());
			// tableData = JSON.stringify(tableData);
			// console.log("tData: "+tableData);
			// console.log(hot.countRows());

		 return (tableData);
	};


	function parseAndCalcAndTranferInvoice () {
		
		var tableData = Array();
		
		var zeroTotal = 0;
		var sevenTotal = 0;
		var nineTeenTotal = 0;
		
		tableData = getTableDataNumeric(tableData, "#InvoiceExample");
		console.log(tableData);
		var tableLength = tableData.length;
		for(var i = 0; i < tableLength; i++) {
			console.log(tableData[i]);
			var rowLength = tableData[i].length;
			if(tableData[i][0].indexOf("Gesamt") !== -1) {
				console.log("0: "+tableData[i][parseInt(rowLength-3)]);
				if( tableData[i][parseInt(rowLength-3)] !== '') {
					zeroTotal = tableData[i][parseInt(rowLength-3)];
				} 
				if( tableData[i][parseInt(rowLength-2)] !== '') {
					sevenTotal = tableData[i][parseInt(rowLength-2)];
				}
				if( tableData[i][parseInt(rowLength-1)] !== '') {
					nineTeenTotal = tableData[i][parseInt(rowLength-1)];
				}
				// console.log("7: "+tableData[i][parseInt(rowLength-2)]);
				// console.log("19:"+tableData[i][parseInt(rowLength-1)]);
			}
		}
		var warenwertNetto = parseFloat(parseFloat(zeroTotal) + parseFloat(sevenTotal * 0.93) + parseFloat(nineTeenTotal * 0.81)).toFixed(2);
		var warenwertBrutto = parseFloat(parseFloat(zeroTotal) + parseFloat(sevenTotal) + parseFloat(nineTeenTotal)).toFixed(2);
		var MwSt19 = parseFloat(nineTeenTotal * 0.19).toFixed(2);
		var MwSt7 = parseFloat(sevenTotal * 0.07).toFixed(2);
		var MwSt0 = parseFloat(zeroTotal).toFixed(2);
		doTheTransfer(warenwertNetto, MwSt19, MwSt7, MwSt0, warenwertBrutto);
		// var restbetrag = parseFloat();
		console.log(warenwertNetto + " " + warenwertBrutto + " " + MwSt19 + " " + MwSt7);
	} ;
	
	function doTheTransfer(warenwertNetto, MwSt19, MwSt7, MwSt0, warenwertBrutto) {
		if(typeof(warenwertNetto) !== 'undefined') {
			$("#warenwertNetto").val(warenwertNetto);
		} else {
			$("#warenwertNetto").val('0.00');			
		}
		if(typeof(warenwertBrutto) !== 'undefined') {
			$("#warenwertBrutto").val(warenwertBrutto);
		} else {
			$("#warenwertBrutto").val('0.00');			
		}
		if(typeof(MwSt0) !== 'undefined') {
			$("#mwst0").val(MwSt0);
		} else {
			$("#mwst0").val('0.00');			
		}
		if(typeof(MwSt7) !== 'undefined') {
			$("#mwst7").val(MwSt7);
		} else {
			$("#mwst7").val('0.00');			
		}
		if(typeof(MwSt19) !== 'undefined') {
			$("#mwst19").val(MwSt19);
		} else {
			$("#mwst19").val('0.00');			
		}
		var rest = parseFloat(parseFloat(warenwertBrutto));
		if ($("#bezahltExternVal").val() !== '') {
			rest = rest - parseFloat($("#bezahltExternVal").val());
			console.log(parseFloat($("#bezahltExternVal").val()));
			console.log(parseFloat($("#bereitsBerechnet").val()));
			console.log(rest);
		}
		if($("#bereitsBerechnet").val() !== '') {
			rest = rest - parseFloat($("#bereitsBerechnet").val()).toFixed(2);
		}
		$("#restbetrag").val(rest.toFixed(2));
	}

	$(document).on("click", "#invoiceNueber", function () {
		parseAndCalcAndTranferInvoice();
	});

	  $(document).on("click","#writingDoc",function(){
			//var $container = $('#example');
			//var handsontable = $container.data('handsontable');
			//alert(container);
			if($("#InvoiceExample").is(':visible')){
				var buttonPressed;
				$("#docSelection .btn").each(function() {
					if($(this).hasClass('active')) {
						buttonPressed = $(this).text();
					}
				});
				var defaultDocument;
				if($("#chkDefaultDocInvoice").is(':checked')){
					defaultDocument = "yes";
				}else{
					defaultDocument ="no";
				}
				var content = hot.getData();
				var header = hot.getSettings().colHeaders;
				console.log(header);
				var counterType = $('#nummernkreisSelect option:selected').text();
				var jva = $("#select2-chosen-1").text();
				
				var contentNumeric = Array();
				contentNumeric = getTableDataNumeric(contentNumeric, "#InvoiceExample");
				var invoiceExtraHTML = getInvoiceExtraHTML(invoiceExtraHTML);
							
				$.ajax({
				  method: "POST",
				  type: "json",
				  url: "index.php?r=document/getTableData",
				  data: { 	
							invoiceExtra: invoiceExtraHTML,
							content: content,
							contentNumeric: contentNumeric,
							headers: header,
							counterType : counterType,
							docType: buttonPressed,
							jva: jva,
							defaultDocument: defaultDocument,
					}
				})
				  .done(function(data) {
						// jQuery.noConflict();
						var dataArr = jQuery.parseJSON(data);
						$("#pdfFilePath").attr('src', dataArr.filePath);
						$("#counterType").val(dataArr.counterType);
						if(dataArr.printedFlag === 1){
							$("#printed").prop('checked', true);
						}else{
							$("#printed").prop('checked', false);
						}
						$("#previewModal").modal('show');
						// alert("data transferred to PHP");
				  });	
		}

	
$(document).ready(function () {
  		
});

  	
	function getInvoiceExtraHTML(invoiceExtra) {

		var invoiceExtraKids = $("#invoiceExtraContainer .invoiceExtra .form-group .control-label");
		var invoiceExtraVals = $("#invoiceExtraContainer .invoiceExtra .form-group .form-control");

		// alert(invoiceExtraKids);
		// alert(invoiceExtraVals);
		
		invoiceExtra = Array();
				
		var j=0;
	
		invoiceExtraVals.each(function(i, v){
			if(j == 5) {
				//DATE  
				invoiceExtra[i] = $(this).val();					
			} else {
				invoiceExtra[i] = parseFloat($(this).val());
			}
			j++;
			console.log($(this).val());
		});
		

		return invoiceExtra;

	}

});
</script>
<?php 
echo '
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-heading">Rechnung</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form id="items">
				<div id="InvoiceExample" class="handsontable"></div>
				<br/>
				<div id="invoiceExtraContainer">
					<div class="row">
					</div>
					<div class="row invoiceExtra">
						<div class="form-group form-group-sm">
							<div class="col-md-2 col-md-offset-4">
								<button type=button id="invoiceNueber" class="btn btn-xs btn-warning">&Uuml;bertragen&nbsp;<i class="fa fa-forward"></i></input>
							</div>
							<label class="col-md-2 control-label" for="warenwertNetto">Warenwert netto</label>
							<div class="col-md-2 form-group-sm">
								<input type="text" id="warenwertNetto" class="form-control" placeholder="Warenwert netto">
							</div>
						</div>
					</div>
					<div class="row invoiceExtra">
					<div class="form-group form-group-sm">
							<label class="col-md-2 col-md-offset-6 control-label" for="mwst0">MwSt (0%)</label>
							<div class="col-md-2 form-group-sm">
								<input type="text" id="mwst0" class="form-control" placeholder="MwSt (0%)">
							</div>
						</div>
					</div>
					<div class="row invoiceExtra">
						<div class="form-group form-group-sm">
							<label class="col-md-2 col-md-offset-6 control-label" for="mwst7">MwSt (7%)</label>
							<div class="col-md-2 form-group-sm">
								<input type="text" id="mwst7" class="form-control" placeholder="MwSt (7%)">
							</div>
						</div>
					</div>
					<div class="row invoiceExtra">
						<div class="form-group form-group-sm">
							<label class="col-md-2 col-md-offset-6 control-label" for="mwst19">MwSt (19%)</label>
							<div class="col-md-2 form-group-sm">
								<input type="text" id="mwst19" class="form-control" placeholder="MwSt (19%)">
							</div>
						</div>
					</div>
					<div class="row invoiceExtra">
						<div class="form-group form-group-sm">
							<label class="col-md-2 col-md-offset-6 control-label" for="warenwertBrutto">Warenwert brutto</label>
							<div class="col-md-2 form-group-sm">
								<input type="text" id="warenwertBrutto" class="form-control" placeholder="Warenwert brutto">
							</div>
						</div>
					</div>
					<div class="row invoiceExtra">
						<div class="form-group form-group-sm">
							<label class="col-md-2 col-md-offset-6 control-label" for="bezahltExternDate">Bezahlt von Externen</label>
							<div class="col-md-2 form-group-sm">
								<input type="text" id="bezahltExternDate" class="form-control" placeholder="Datum">
							</div>
							<div class="col-md-2 form-group-sm">
								<input type="text" id="bezahltExternVal" class="form-control" placeholder="Betrag">
							</div>
						</div>
					</div>
					<div class="row invoiceExtra">
						<div class="form-group form-group-sm">
							<label class="col-md-2 col-md-offset-6 control-label" for="bereitsBerechnet">Bereits berechnet</label>
							<div class="col-md-2 form-group-sm">
								<input type="text" id="bereitsBerechnet" class="form-control" placeholder="Bereits berechnet">
							</div>
						</div>
					</div>
					<div class="row invoiceExtra">
						<div class="form-group form-group-sm">
							<label class="col-md-2 col-md-offset-6 control-label" for="restbetrag">Restbetrag</label>
							<div class="col-md-2 form-group-sm">
								<input type="numeric" step="0.01" min="0.00" id="restbetrag" class="form-control" placeholder="Restbetrag">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="checkbox">
							<label class="col-md-2 col-md-offset-4 control-label" for="chkDefaultDocInvoice"><b>Standard Dokument?&nbsp;</b></label>
								&nbsp;<input type="checkbox" value="" name="defaultDocInvoice" id="chkDefaultDocInvoice">
							</label>
						</div>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>';						
?>