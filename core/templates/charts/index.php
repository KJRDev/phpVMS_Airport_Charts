<?php
/**
Module Completed By Vansers

This module is only use for phpVMS (www.phpvms.net) - (A Virtual Airline Admin Software)

@Created By Vansers
@Copyrighted @ 2016
@Under CC 3.0
@http://creativecommons.org/licenses/by-nc-sa/3.0/
**/

// Version 1.0 (September.30.11) - Module Created
// Version 1.1 (October.07.11) - Added Add-On Navgation Button
// Version 2.0 (January.05.17) - Updated for phpVMS 5.5.x
?>
<!--<h3><?php echo $title?></h3>-->
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
			<td width="1%" nowrap><div align="center"><?php echo $airport->icao; ?></div></td>
			<td><div align="center"><?php echo $airport->name; ?></div></td>
			<td><div align="center"><a href="<?php echo SITE_URL; ?>/index.php/charts/viewcharts?icao=<?php echo $airport->icao; ?>">View Charts</a></div></td>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>