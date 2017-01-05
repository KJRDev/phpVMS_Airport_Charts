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
			<td width="21%" nowrap>
				<div align="center">
					<a href="viewcharts?icao=<?php echo $airport->icao; ?>"><?php echo $airport->icao; ?></a>
				</div>
			</td>
			<td><div align="center"><?php echo $airport->name; ?></div></td>
		<?php
		}
		?>
	</tbody>
</table>