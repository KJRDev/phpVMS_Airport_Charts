<div id="wrapper">
<h3><?php echo $title?></h3>
<form action="<?php echo adminurl('/ChartsAdmin/viewairports');?>" method="post">
<table class="tablesorter">
<tr>
  <td nowrap><strong>Airport ICAO:</strong></td>
  <td><input id="icao" name="icao" class="airport_select" value="<?php echo $chart->icao;?>" onclick="" /></td>
  <td>Enter the airport chart ICAO </td>
</tr>
<tr>
	<td><strong>Chart Title:</strong></td>
	<td><input type="text" name="name" value="<?php echo $chart->name?>" /></td>
	<td>Enter the chart name</td>
</tr>
<tr>
	<td valign="top"><strong>Chart Type:</strong></td>
	<td><select name="charttype">
			<?php
			foreach($charttype as $chartkey=>$charttype) {
				if($chart->charttype == $chartkey)
					$sel = 'selected';
				else	
					$sel = '';
			?>
				<option value="<?php echo $chartkey?>" <?php echo $sel; ?>><?php echo $charttype?></option>
			<?php
			}
			?>
		</select></td>
	<td>Select what kind of chart is it</td>
</tr>


<tr>
	<td valign="top"><strong>Link to Chart:</strong></td>
	<td><input type="text" name="link" value="<?php echo $chart->link?>" /></td>
	<td>Enter the full url link to where your pilots can download the chart.</td>
</tr>


<tr>
  <td><strong>Show Chart?:</strong></td>
  <?php $checked = ($chart->shown==1 || !$chart)?'CHECKED':''; ?>
  <td><input type="checkbox" id="shown" name="shown" value="1" <?php echo $checked ?> /></td>
  <td>Uncheck if you don't want the chart to be visable on the chart page.</td>
</tr>
<tr>
	<td></td>
	<td><input type="hidden" name="action" value="<?php echo $action?>" />
		<input type="hidden" name="id" value="<?php echo $chart->id?>" />
		<input type="submit" name="submit" value="<?php echo $title?>" />
	</td>
	<td>Then save!</td>
</tr>
</table>
</form>
</div>
<script type="text/javascript">
$(".preview").click(function() {
	icao=$("#icao").val();
	
	url = this.href
		+"&icao="+icao
			
	$('#jqmdialog').jqm({ajax: url}).jqmShow();
	
	return false;
});

<?php
$airport_list = array();
foreach($allairports as $airport) {
	$airport->name = addslashes($airport->name);
	$airport_list[] = "{label:\"{$airport->icao} ({$airport->name})\", value: \"{$airport->icao}\"}";
}
$airport_list = implode(',', $airport_list);
?>
var airport_list = [<?php echo $airport_list; ?>];
$(".airport_select").autocomplete({
	source: airport_list,
	minLength: 2,
	delay: 0
});

</script>