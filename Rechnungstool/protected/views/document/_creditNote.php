
<?php

$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/handsontable-0.19.0/dist/handsontable.full.js');
$cs->registerCssFile($baseUrl.'/js/handsontable-0.19.0/dist/handsontable.full.css');
$cs->registerScriptFile($baseUrl.'/js/handsontable-0.19.0/lib/ruleJS/dist/full/ruleJS.all.full.js');
$cs->registerScriptFile($baseUrl.'/js/handsontable-0.19.0/dist/handsontable-ruleJS/src/handsontable.formula.js');

// C:\inetpub\wwwroot\massaki\Rechnungstool\js\handsontable-0.19.0\dist

?>

<script>

	function parseAndCalcAndTranferCreditNote () {
		
		var tableData = Array();
		
		var zeroTotal = 0;
		var sevenTotal = 0;
		var nineTeenTotal = 0;
		
		tableData = getTableDataNumeric(tableData, "#CreditNoteExample");
		console.log("tableData: " +tableData);
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
		doTheTransferCreditNote(warenwertNetto, MwSt19, MwSt7, MwSt0, warenwertBrutto);
		// var restbetrag = parseFloat();
		console.log(warenwertNetto + " " + warenwertBrutto + " " + MwSt19 + " " + MwSt7);
	} ;
	
	function doTheTransferCreditNote(warenwertNetto, MwSt19, MwSt7, MwSt0, warenwertBrutto) {
		console.log("doingTheTransfer: "+ warenwertNetto+ MwSt19+ MwSt7+ MwSt0+ warenwertBrutto);
		if(typeof(warenwertNetto) !== 'undefined') {
			$(".creditNoteExtra #warenwertNetto").val(warenwertNetto);
		} else {
			$(".creditNoteExtra #warenwertNetto").val('0.00');			
		}
		if(typeof(warenwertBrutto) !== 'undefined') {
			$(".creditNoteExtra #warenwertBrutto").val(warenwertBrutto);
		} else {
			$(".creditNoteExtra #warenwertBrutto").val('0.00');			
		}
		if(typeof(MwSt0) !== 'undefined') {
			$(".creditNoteExtra #mwst0").val(MwSt0);
		} else {
			$(".creditNoteExtra #mwst0").val('0.00');			
		}
		if(typeof(MwSt7) !== 'undefined') {
			$(".creditNoteExtra #mwst7").val(MwSt7);
		} else {
			$(".creditNoteExtra #mwst7").val('0.00');			
		}
		if(typeof(MwSt19) !== 'undefined') {
			$(".creditNoteExtra #mwst19").val(MwSt19);
		} else {
			$(".creditNoteExtra #mwst19").val('0.00');			
		}
		var rest = parseFloat(parseFloat(warenwertBrutto));
		if ($(".creditNoteExtra #bezahltExternVal").val() !== '') {
			rest = rest - parseFloat($(".creditNoteExtra #bezahltExternVal").val());
			console.log(parseFloat($(".creditNoteExtra #bezahltExternVal").val()));
			console.log(parseFloat($(".creditNoteExtra #bereitsBerechnet").val()));
			console.log(rest);
		}
		if($("#bereitsBerechnet").val() !== '') {
			rest = rest - parseFloat($(".creditNoteExtra #bereitsBerechnet").val()).toFixed(2);
		}
		$(".creditNoteExtra #restbetrag").val(rest.toFixed(2));
		console.log("done transferring");
	}

	$(document).on("click", "#creditNoteNueber", function () {
		console.log("nueber");
		parseAndCalcAndTranferCreditNote();
	});
	
$(document).ready(function () {

  $(document).on("click","#writingDoc",function(){

	if($("#CreditNoteExample").is(':visible')){		
		var buttonPressed;
			$("#docSelection .btn").each(function() {
				if($(this).hasClass('active')) {
					buttonPressed = $(this).text();
				}
			});
			var defaultDocument;
			if($("#chkDefaultDocCredit").is(':checked')){
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
				contentNumeric = getTableDataNumeric(contentNumeric, "#CreditNoteExample");
				var creditNoteExtraHTML = getcreditNoteExtraHTML(creditNoteExtraHTML);
	
	
				$.ajax({
				  method: "POST",
				  type: "json",
				  url: "index.php?r=document/getTableData",
				  data: { 	
							creditNoteExtra: creditNoteExtraHTML,
							content: content,
							contentNumeric: contentNumeric,
							headers: header,
							counterType : counterType,
							docType: buttonPressed,
							jva: jva,
							defaultDocument: defaultDocument,
					}
				})
				  .done(function( data ) {
  						jQuery.noConflict();
						var dataArr = jQuery.parseJSON(data);
						$("#pdfFilePath").attr('src', dataArr.filePath);
						$("#counterType").val(dataArr.counterType);
						if(dataArr.printedFlag === 1){
							$("#printed").prop('checked', true);
						}else{
							$("#printed").prop('checked', false);
						}
						$("#previewModal").modal('show');
				  });	
		}
  		
	});

  	
	function getcreditNoteExtraHTML(creditNoteExtra) {

		var creditNoteExtraKids = $("#creditNoteExtraContainer .creditNoteExtra .form-group .control-label");
		var creditNoteExtraVals = $("#creditNoteExtraContainer .creditNoteExtra .form-group .form-control");

		// alert(creditNoteExtraKids);
		// alert(creditNoteExtraVals);
		
		creditNoteExtra = Array();
		
		// for(var i = 0; i < creditNoteExtraKids.length; i++) {
			// creditNoteExtra[i] = creditNoteExtraVals[i].val();
		// }
		
		// creditNoteExtraKids.each(function(i, v){
			// creditNoteExtra[i] = Array();
			// creditNoteExtra[i] = $(this).text();
			// creditNoteExtra[i][0] = creditNoteExtraVals[i];
			// console.log();
			var j=0;
		
			creditNoteExtraVals.each(function(i, v){
				if(j == 5) {
					//DATE  
					creditNoteExtra[i] = $(this).val();					
				} else {
					creditNoteExtra[i] = parseFloat($(this).val());
				}
				j++;
				console.log($(this).val());
			});
			
		// });

		return creditNoteExtra;

	}

});
</script>

<?php 
echo '
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-heading">Gutschrift</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form id="items">
				<div id="CreditNoteExample" class="handsontable"></div>
				</form>
			</div>
			<br>
		</div>
		<br/>
		<div id="creditNoteExtraContainer">
			<div class="row">
			</div>
			<div class="row creditNoteExtra">
				<div class="form-group form-group-sm">
					<div class="col-md-2 col-md-offset-4">
						<button type=button id="creditNoteNueber" class="btn btn-xs btn-warning">&Uuml;bertragen&nbsp;<i class="fa fa-forward"></i></input>
					</div>
					<label class="col-md-2 control-label" for="warenwertNetto">Warenwert netto</label>
					<div class="col-md-2 form-group-sm">
						<input type="text" id="warenwertNetto" class="form-control" placeholder="Warenwert netto">
					</div>
				</div>
			</div>
			<div class="row creditNoteExtra">
			<div class="form-group form-group-sm">
					<label class="col-md-2 col-md-offset-6 control-label" for="mwst0">MwSt (0%)</label>
					<div class="col-md-2 form-group-sm">
						<input type="text" id="mwst0" class="form-control" placeholder="MwSt (0%)">
					</div>
				</div>
			</div>
			<div class="row creditNoteExtra">
				<div class="form-group form-group-sm">
					<label class="col-md-2 col-md-offset-6 control-label" for="mwst7">MwSt (7%)</label>
					<div class="col-md-2 form-group-sm">
						<input type="text" id="mwst7" class="form-control" placeholder="MwSt (7%)">
					</div>
				</div>
			</div>
			<div class="row creditNoteExtra">
				<div class="form-group form-group-sm">
					<label class="col-md-2 col-md-offset-6 control-label" for="mwst19">MwSt (19%)</label>
					<div class="col-md-2 form-group-sm">
						<input type="text" id="mwst19" class="form-control" placeholder="MwSt (19%)">
					</div>
				</div>
			</div>
			<div class="row creditNoteExtra">
				<div class="form-group form-group-sm">
					<label class="col-md-2 col-md-offset-6 control-label" for="warenwertBrutto">Warenwert brutto</label>
					<div class="col-md-2 form-group-sm">
						<input type="text" id="warenwertBrutto" class="form-control" placeholder="Warenwert brutto">
					</div>
				</div>
			</div>
			<div class="row creditNoteExtra">
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
			<div class="row creditNoteExtra">
				<div class="form-group form-group-sm">
					<label class="col-md-2 col-md-offset-6 control-label" for="bereitsBerechnet">Bereits berechnet</label>
					<div class="col-md-2 form-group-sm">
						<input type="text" id="bereitsBerechnet" class="form-control" placeholder="Bereits berechnet">
					</div>
				</div>
			</div>
			<div class="row creditNoteExtra">
				<div class="form-group form-group-sm">
					<label class="col-md-2 col-md-offset-6 control-label" for="restbetrag">Restbetrag</label>
					<div class="col-md-2 form-group-sm">
						<input type="numeric" step="0.01" min="0.00" id="restbetrag" class="form-control" placeholder="Restbetrag">
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="checkbox">
				<label class="col-md-2 col-md-offset-4 control-label" for="chkDefaultDocCredit"><b>Standard Dokument?&nbsp;</b></label>
					&nbsp;<input type="checkbox" value="" name="defaultDocCredit" id="chkDefaultDocCredit">
				</label>
			</div>
		</div>
	</div>
</div>';						
?>