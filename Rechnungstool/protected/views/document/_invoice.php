
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

$(document).ready(function () {
	console.log("document ready");
	var data = [
	  ['123-456-7', 'Duschgel', '', '', 3.50],
	  ['123-456-7', 'Tabak', '', '', 6.50],
	  ['123-456-9', 'Aspirin', '', 2.50, ''],
	  ['','','','',''],
	  ['','','','',''],
	  ['','','','',''],
	  ['','Gesamt','=SUM(C1:C6)','=SUM(D1:D6)',"=SUM(E1:E6)"],
	];
	
	var boldAndAlignRenderer = function (instance, td, row, col, prop, value, cellProperties) {
		Handsontable.renderers.TextRenderer.apply(this, arguments);
		td.style.fontWeight = 'bold';
		td.style.verticalAlign = 'middle';
		td.style.textAlign = 'center';
	};

	var container = document.getElementById('example');
	var hot = new Handsontable(container, {
		  data: data,
		  // language: de,
		  minSpareRows: 0,
		  formulas: true,
		  rowHeaders: true,
		  colHeaders: ['Kunde ID', 'Artikel', 'MwSt 0%', 'MwSt 7%', 'MwSt 19%'],
		  colWidths: [350, 350, 100, 100, 100],
		  contextMenu: true,
	});
	
	hot.updateSettings({
		cells: function (row, col, prop) {
		  var cellProperties = {};
		  if (hot.getDataAtCell(row, 1) === 'Gesamt') {
			 cellProperties.readOnly = true;
			 cellProperties.fontWeight = 'bold';
			// cellProperties.renderer = boldAndAlignRenderer;
		  }
		  if ([0, 1, 2, 3, 4, 5].indexOf(row) !== -1 && col >= 2) {
			cellProperties.type = 'numeric';
			cellProperties.format = '000.00';
		  }
		  return cellProperties;
		}
  })
  
  
  $(document).on("click","#writingDoc",function(){
			//var $container = $('#example');
			//var handsontable = $container.data('handsontable');
			//alert(container);
			var buttonPressed;
			$("#docSelection .btn").each(function() {
				if($(this).hasClass('active')) {
					buttonPressed = $(this).text();
				}
			});
			var content = hot.getData();
			var header = hot.getSettings().colHeaders;
			var counterType = $('#nummernkreisSelect option:selected').text();
			var jva = $("#select2-chosen-1").text();
			//alert(header);
		$.ajax({
		  method: "POST",
		  type: "json",
		  url: "index.php?r=document/getTableData",
		  data: { 	content: content,
					headers: header,
					counterType : counterType,
					docType: buttonPressed,
					jva: jva,
									}
		})
		  .done(function( data ) {
				alert("data transferred to PHP");
			
		  });
			
			
		
	});

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
				<div id="example" class="handsontable"></div>
				</form>
			</div>
		</div>
	</div>
</div>';						
?>