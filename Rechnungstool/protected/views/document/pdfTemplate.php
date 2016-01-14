<?php
/* @var $this SiteController */
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/handsontable-0.19.0/dist/handsontable.full.js');
$cs->registerCssFile($baseUrl.'/js/handsontable-0.19.0/dist/handsontable.full.css');
$cs->registerScriptFile($baseUrl.'/js/handsontable-0.19.0/lib/ruleJS/dist/full/ruleJS.all.full.js');
$cs->registerScriptFile($baseUrl.'/js/handsontable-0.19.0/dist/handsontable-ruleJS/src/handsontable.formula.js');

//TODO: rewrite php.ini
require_once('../Rechnungstool/pdf/pdf_constants.php');
// echo ($baseUrl.'/pdf/pdf_constants.php');

// $adresse_klein = 'Massak Logistik GmbH  Hollfelder Str. 23  96123 Litzendorf';

?>
<!-- MAIN -->
<!-- TOOD: replace by constants in own config file -->
<script>
    var js_header = "<?php echo $header; ?>";
    var js_displayData = "<?php echo $displayData; ?>";
	$(document).ready(function () {
		$("#info").val(JSON.decode(js_header) + " " + JSON.stringify(js_displayData));
	});
</script>
<style>
@media print {
	html, body {
		height: 100%;
	}
	.wrapper {
		height: 100%;
	}
	p {
		font-size: 10pt;
		color: #000;
	}
	.blue {
		color: #123456;
	}
	.head {
		font-size: 8pt;
	}
	.title {
		padding-bottom: 5px;
		padding-left: 0px;
		padding-right: 0px;
		padding-top: 0px;
		margin-top: 0px;
		border-top: 2px solid red;
		border-bottom: 10px solid #2266aa;
		font-family: arial, sans-serif;
		font-size: 42pt;
		color: #2266aa;
		text-shadow: 2px 2px 2px #dd0000;
		font-weight: bold;
		text-align: center;
	}
	.foot {
		font-size: 7pt;
		text-align: center;
	}
	.footer {
	   position:absolute;
	   bottom:0;
	   height: 20px;
   }
	.table-bordered td{
		border: 1px solid #444444;
	}
	#invoiceTable thead tr td{
		font-weight: bold;
		font-size: 10pt;
		text-align: center;
		color: #222222;
		padding: 2pt 7pt;
	}
	#invoiceTable tbody tr td{
		font-weight: 500;
		font-size: 9pt;
		padding: 3pt 2pt 3pt 3pt;
	}
	.small {
		font-size: 6pt;
	}
	.smallExtra {
		font-size: 8pt;
		text-align: right;
	}
	.ulined {
		border-bottom: 1px solid #123456;		
		text-align: center;
	}
	.totalRow td{
		font-size: 18pt;
		font-weight: 800;
		border-top: 2px solid #111111;
		border-bottom: 2px solid #111111;
		background: #eeeeee;
	}
	.invoiceExtra {
		height: 12px;
		padding-top: 2px
		padding-bottom: 2px;
	}
	.invoiceExtra p{
		font-weight: bold;
	}
	.invoiceExtraContainer div p{
		line-height: 1pt;
	}
}

</style>
<div class="wrapper">
	<div class="row">
		<div class=" col-xs-12" media="screen">
			<h1 class="title"><i>Massak Logistik GmbH</i></h1>
		</div>
	</div>
	<br/>
	<div class=row>
			<div class=" col-xs-4 col-xs-offset-1">
				<p class="small blue ulined"> <?php echo MASSAK_ADDRESSE_KLEIN ?></p>
				<p> <?php echo $jva->jvaName; ?></p>
				<?php
				// if(!empty($jva->jvaNameExt)) {
					// echo "<p>".$jva->jvaNameExt."</p>";
				// }
				?>
				<p><?php echo $jva->jvaAddress; ?></p>
			</div>
			<div class="col-xs-5 col-xs-offset-1">
				<div class=row>
					<div class="col-xs-4">
						<p class="blue head"><?php echo MASSAK_LOGISTIK_BAMBERG; ?></p>
					</div>
					<div class="col-xs-5">
						<p class="blue head"><?php echo MASSAK_LOGISTIK_LOEHNE; ?></p>
					</div>
					<div class="col-xs-7">	
						<p class="blue head"><?php echo MASSAK_BANKVERBINDUNG; ?></p>
					</div>
				</div>
			</div>
	</div>
	<br/>
	<!-- Invoice Meta -->
	<div class=row>
		<div class="col-xs-2 col-xs-offset-1">
			<?php
			echo "<p>".$docType."</p>";
			?>
		</div>
		<div class="col-xs-2 col-xs-offset-1">
			<?php
			echo "<p>".$counter."</p>";
			?>
		</div>
		<div class="col-xs-2 col-xs-offset-2">
			<?php $date = date('d.m.Y'); 
			echo "<p>".$date."</p>";
			?>
		</div>
	</div>
	<div class=row style="height:40%;">
		<div class=row>
			<div class=" col-xs-10 col-xs-offset-1">
				<table id="invoiceTable" class="table table-bordered">
					<thead class="thead">
						<tr class="thead"> <?php foreach($header as $headerItem) {echo "<td>".$headerItem."</td>";} ?></tr>
					</thead>
					<tbody>
						<?php 
						// $lastKey = end(array_keys($displayData));
						foreach($displayData as $row) {
								if(strstr(strtolower($row[0]), 'gesamt')) {
									echo "<tr class='totalRow'>";
									$i = 0;
									foreach ($row as $data) {
										if($i >= (sizeOf($row) - 3)) {
											echo "<td style='text-align:right'><b>".$data."€</b></td>";
										} else {
											echo "<td><b>".$data."</b></td>";
										}
										$i++;
									}
									echo "</tr>";
								} else {
									echo "<tr>";
									$i = 0;
									foreach ($row as $data) {
										if($i >= (sizeOf($row) - 3)) {
											echo "<td style='text-align:right'>".$data."€</td>";
										} else {
											echo "<td>".$data."</td>";
										}
										$i++;
									}
									echo "</tr>";
								}
						} ?>
					</tbody>
					<!--tfoot>
						<tr><td>Zu bezahlen:</td><td></td><td>15</td><td>20</td><td>35</td></tr>
					</tfoot-->
				</table>		
			</div>
		</div>
		<br/>
		<!-- FIX FOR PRINTING PDF -->
		<div class="row">
			<div class="col-xs-11 col-xs-offset-1 invoiceExtraContainer">
				<?php //echo str_replace('-md-', '-xs-', $invoiceExtra); ?>
				<div class="row">
						<div class="col-xs-2 invoiceExtra col-xs-offset-6">
							<p class="smallExtra">Warenwert netto</p>
						</div>
						<div class="col-xs-2 invoiceExtra">
							<p class="smallExtra"><?php if(!empty($invoiceExtra[0])) echo number_format(floatval($invoiceExtra[0]), 2,","," ")." €"; ?></p>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-2 invoiceExtra col-xs-offset-6">
							<p class="smallExtra">MwSt 0%</p>
						</div>
						<div class="col-xs-2 invoiceExtra ">
							<p class="smallExtra"><?php if(!empty($invoiceExtra[1])) echo number_format(floatval($invoiceExtra[1]), 2,","," ")." €"; ?></p>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-2 invoiceExtra col-xs-offset-6">
							<p class="smallExtra">MwSt 7%</p>
						</div>
						<div class="col-xs-2 invoiceExtra ">
							<p class="smallExtra"><?php if(!empty($invoiceExtra[2])) echo number_format(floatval($invoiceExtra[2]), 2,","," ")." €"; ?></p>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-2 invoiceExtra col-xs-offset-6">
						<p class="smallExtra">MwSt 19%</p>
						</div>
						<div class="col-xs-2 invoiceExtra ">
							<p class="smallExtra"><?php if(!empty($invoiceExtra[3])) echo number_format(floatval($invoiceExtra[3]), 2,","," ")." €"; ?></p>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-2 invoiceExtra col-xs-offset-6">
							<p class="smallExtra">Warenwert brutto</p>
						</div>
						<div class="col-xs-2 invoiceExtra ">
							<p class="smallExtra"><?php if(!empty($invoiceExtra[4])) echo number_format(floatval($invoiceExtra[4]), 2,","," ")." €"; ?></p>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-2 invoiceExtra col-xs-offset-6">
							<p class="smallExtra">Bezahlt von Extern:</p>
						</div>
						<br/>
						<div class="col-xs-2 col-xs-offset-7 invoiceExtra ">
							<p class="smallExtra"><?php if(!empty($invoiceExtra[5])) echo $invoiceExtra[5]; ?></p>
						</div>
						<div class="col-xs-1 invoiceExtra ">
							<p class="smallExtra"><?php if(!empty($invoiceExtra[6])) echo number_format(floatval($invoiceExtra[6]), 2,","," ")." €"; ?></p>
						</div>
						<br/>
					</div>
					<div class="row">
						<div class="col-xs-2 invoiceExtra col-xs-offset-6">
							<p class="smallExtra">Bereits berechnet</p>
						</div>
						<div class="col-xs-2 invoiceExtra ">
							<p class="smallExtra"><?php if(!empty($invoiceExtra[7])) echo number_format(floatval($invoiceExtra[7]), 2,","," ")." €"; ?></p>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-2 invoiceExtra col-xs-offset-6">
							<p class="smallExtra">Restbetrag</p>
						</div>
						<div class="col-xs-2 invoiceExtra ">
							<p class="smallExtra"><?php if(!empty($invoiceExtra[8])) echo number_format(floatval($invoiceExtra[8]), 2,","," ")." €"; ?></p>
						</div>
					</div>
			</div>
		</div>
	</div>
	<br/>
	<div class=row>
		<div class="col-xs-4 col-xs-offset-1">
			<p><?php echo $jva->jvaFooter; ?></p>
		</div>
		<div class="col-xs-4 col-xs-offset-2">
			<p>Ware erhalten, Unterschrift</p>
			<p>____________________________</p>
		</div>
	</div>
	<hr/>
	<!-- FOOT -->
	<div class="row footer">
		<div class="col-xs-6 col-xs-offset-3">
				<p class="blue foot"><?php echo MASSAK_FOOTER; ?></p>
		</div>
	</div>
</div>