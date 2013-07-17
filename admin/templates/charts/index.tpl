<h3><?php echo $title?></h3>
<?php
if(!$allairports) {
	echo 'There are no airports!';
	return;
}
?>

<table width="512" class="tablesorter" id="tabledlist">
<thead>
<tr>
	<th>Airport ICAO</th>
	<th width="79%">Airport Name</th>
</tr>
</thead>
<tbody>
<?php
foreach($allairports as $airport)
{ 
	 
	 // To skip a chart that is not shown:
	 //if($charts->shown == 0) { continue; }
?>
<tr>
	<td width="21%" nowrap><div align="center">
    
    <a href="viewcharts?icao=<?php echo $airport->icao; ?>"><?php echo $airport->icao; ?></a>
    
    
    
    </div></td>
	<td>
			
	  <div align="center"><?php echo $airport->name; ?></div></td>

<?php
}
?>
</tbody>
</table>