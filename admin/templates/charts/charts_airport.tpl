<!--<h3><?php echo $chart->icao; ?> Charts</h3> -->

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
    <th>Last Updated</th>
    <th>Options</th>
</tr>
</thead>
<tbody>
<?php
foreach($chart as $chart)
{ 
	 
	 // To skip a chart that is not shown:
	 //if($chart->shown == 0) { continue; }
?>
<tr id="row<?php echo $chart->id;?>">
	<td width="1%" nowrap><div align="center"><?php echo $chart->icao; ?></div></td>
	<td>
			
	  <div align="center"><?php echo $chart->name; ?></div></td>
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
    <td><div align="center">    <?php
                if($chart->dateupdated == 0000-00-00)
                        echo 'Not Updated';
                   elseif($chart->dateupdated)
                        echo ($chart->dateupdated);        
                ?></div></td>
    <td>
    		<button class="{button:{icons:{primary:'ui-icon-wrench'}}}" 
			onclick="window.location='<?php echo adminurl('/ChartsAdmin/editchart?id='.$chart->id);?>';">Edit</button>
    		<button href="<?php echo SITE_URL?>/admin/action.php/ChartsAdmin/viewcharts" action="deletechart" 
			id="<?php echo $chart->id;?>" class="deleteitem {button:{icons:{primary:'ui-icon-trash'}}}">
			Delete</button>
    
    
<!--    		<button class="deletechart {button:{icons:{primary:'ui-icon-trash'}}}" 
			href="<?php echo adminaction('/ChartsAdmin/viewcharts');?>" action="deletechart" id="<?php echo $chart->id;?>">Delete</button> -->
            </td>
<?php
}
?>
</tbody>
</table>