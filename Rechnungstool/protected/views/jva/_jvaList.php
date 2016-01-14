<?php
	// echo "test";
	// if(isset($deactivateResult)) echo $deactivateResult;
	foreach ($jvaListModel as $jva) {
			echo "<div style='margin-left:20px; font-size:1.2em;' class='radio'><label><input class='jvaListItem' type='radio' name='jvaRadios' value='".$jva->jvaDataId."'>".$jva->jvaName ." ".$jva->jvaNameExt."</label></div>";
		}
?>