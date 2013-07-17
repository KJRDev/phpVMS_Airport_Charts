
<h3>Go to Airport ICAO:</h3>
<script type="text/javascript">
function MM_jumpMenuGo(objId,targ,restore){ //v9.0
  var selObj = null;  with (document) { 
  if (getElementById) selObj = getElementById(objId);
  if (selObj) eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0; }
}
</script>


<form name="form" id="form">
  
  <select name="jumpMenu" id="jumpMenu">

<?php
foreach($allairports as $airport)
{
			echo '<option value="viewcharts?icao='.$airport->icao.'">'.$airport->icao.' - ' . $airport->name .'</option>';
		}
		?>
  </select>
  <input type="button" name="go_button" id= "go_button" value="Go" onclick="MM_jumpMenuGo('jumpMenu','parent',0)" />
</form>

<h3><?php echo $title?> Charts</h3>
<?php
if(!$chart) {
	echo 'There are no charts!';
	return;
}
?>

<table id="tabledlist" class="tablesorter">
  <thead>
<tr>
	<th>Airport ICAO</th>
	<th>Chart Title</th>
	<th>Chart Type</th>
	<th>Date Added</th>
    <th>Date Updated</th>
</tr>
</thead>
<tbody>
<?php
foreach($chart as $chart)
{ 
	 
	 // To skip a chart that is not shown:
	 if($chart->shown == 0) { continue; }
?>
<tr>
	<td width="1%" nowrap><div align="center"><?php echo $chart->icao; ?></div></td>
	<td>
			
	  <div align="center"><a href="<?php echo $chart->link; ?>" target="_blank"><?php echo $chart->name; ?></a></div></td>
	<td><div align="center">
    <?php
                
                if($chart->charttype == 1)
                        echo 'Facility';
                elseif($chart->charttype == 2)
                        echo 'Standard Instrument Departure';
                elseif($chart->charttype == 3)
                        echo 'Standard Terminal Arrival';
                elseif($chart->charttype == 4)
                        echo 'ILS Approach';
                elseif($chart->charttype == 5)
                        echo 'Approach';
                
                
                ?>
    
    
    
    
    
    
    </div>
    
    
    
    
    
    
    
    
    
    
    </td>
	<td><div align="center"><?php echo $chart->dateadded; ?></div></td>
    <td><div align="center">
    
    
    
    
    
    <?php
                if($chart->dateupdated == 0000-00-00)
                        echo 'Not Updated';
                   elseif($chart->dateupdated)
                        echo ($chart->dateupdated);        
                ?>
    
    
    
    
    
    
    
    </div></td>
<?php
}
?>
</tbody>
</table>