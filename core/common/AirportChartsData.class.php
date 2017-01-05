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


class AirportChartsData extends CodonData {	
	public static function getAllCharts()
	{
		$sql = "SELECT * FROM ".TABLE_PREFIX."charts ORDER BY id ASC";
        return DB::get_results($sql);
	}
	
	public static function getAirportCharts($icao)
	{
		$query = "SELECT * FROM ".TABLE_PREFIX."charts WHERE icao = '$icao'";
        return DB::get_results($query);
	}
	
	public static function GetChartInfo($id)
	{
		$id = DB::escape($id);
		$query = "SELECT * FROM ".TABLE_PREFIX."charts WHERE id = '$id'";
		return DB::get_row($query);
		
	}
	
	public static function AddChart($data)
	{
        $data['icao'] 	   = strtoupper(DB::escape($data['icao']));
        $data['name'] 	   = DB::escape($data['name']);
		$data['charttype'] = DB::escape($data['charttype']);
		$data['link'] 	   = DB::escape($data['link']);

        if ($data['shown'] === true || $data['shown'] == '1') $data['shown'] = 1;
        else  $data['shown'] = 0;

        $sql = "INSERT INTO ".TABLE_PREFIX."charts
				(`icao`, `name`, `charttype`, `link`, `shown`, `dateadded`)
				VALUES (
				'{$data['icao']}', '{$data['name']}', '{$data['charttype']}', 
				'{$data['link']}', '{$data['shown']}', NOW())";

        $res = DB::query($sql);

        if (DB::errno() != 0) return false;
		
        return true;
    }
	
	public static function EditChart($id, $data) {
        $data['icao'] 	   = strtoupper(DB::escape($data['icao']));
        $data['name'] 	   = DB::escape($data['name']);
		$data['charttype'] = DB::escape($data['charttype']);
		$data['link'] 	   = DB::escape($data['link']);

        if ($data['shown'] === true || $data['shown'] == '1') $data['shown'] = 1;
        else  $data['shown'] = 0;

		
		$sql = "UPDATE ".TABLE_PREFIX."charts
				SET `icao`='{$data['icao']}',
					`name`='{$data['name']}',
					`charttype`='{$data['charttype']}', 
					`link`='{$data['link']}',
					`shown`='{$data['shown']}',
					`dateupdated`= NOW()
				WHERE `id`='{$id}'";


		$res = DB::query($sql);

        if (DB::errno() != 0) return false;
        return true;
    }
	
	public static function DeleteChart($id)
	{
		$sql = "DELETE FROM ".TABLE_PREFIX."charts WHERE id = '$id'";
        DB::query($sql);

        if (DB::errno() != 0) return false;
        return true;
    }
}
