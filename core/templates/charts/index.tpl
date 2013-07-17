<!--<h3><?php echo $title?></h3>
 -->
<?php
if(!$allairports) {
	echo 'There are no airports!';
	return;
}
?>

<table id="tabledlist" class="tablesorter">
<thead>
<tr>
	<th>Airport ICAO</th>
	<th>Airport Name</th>
    <th>View Charts</th>
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
	<td width="1%" nowrap><div align="center">
    
    <?php echo $airport->icao; ?>
    
    
    
    </div></td>
	<td>
			
	  <div align="center"><?php echo $airport->name; ?></div></td>
      
      <td><div align="center"><a href="charts/viewcharts?icao=<?php echo $airport->icao; ?>">View Charts</a></div></td>

<?php
}
?>
</tbody>
</table>