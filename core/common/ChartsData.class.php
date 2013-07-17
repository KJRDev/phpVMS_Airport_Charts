<?php

/**
Module Completed By Vansers

This module is only use for phpVMS (www.phpvms.net) - (A Virtual Airline Admin Software)

@Created By Vansers
@Copyrighted @ 2011
@Under CC 3.0
@http://creativecommons.org/licenses/by-nc-sa/3.0/
**/

// Version 1.0 (September.30.11) - Module Created
// Version 1.1 (October.07.11) - Added Add-On Navgation Button


class ChartsData extends CodonData {
			
	public static function getAllCharts()
	{
		$sql = 'SELECT * FROM `charts`
        ORDER BY `id` ASC';
        return DB::get_results($sql);
	}
	
	public static function getAirportCharts($icao)
	{
		$query = "SELECT *
        FROM charts
        WHERE icao='$icao'";

        return DB::get_results($query);
	}
	
	public static function GetChartInfo($id)
	{
		$id = DB::escape($id);
		
		return DB::get_row('SELECT * FROM `charts` 
		WHERE `id`=' . $id);
		
	}
	
	public static function AddChart($data) {

        $data['icao'] = strtoupper(DB::escape($data['icao']));
        $data['name'] = DB::escape($data['name']);
		$data['charttype'] = DB::escape($data['charttype']);
		$data['link'] = DB::escape($data['link']);

        if ($data['shown'] === true || $data['shown'] == '1') $data['shown'] = 1;
        else  $data['shown'] = 0;

        $sql = "INSERT INTO charts 
					(	`icao`, `name`, `charttype`, `link`, `shown`, `dateadded`)
					VALUES (
						'{$data['icao']}', '{$data['name']}', '{$data['charttype']}', 
						'{$data['link']}', '{$data['shown']}', NOW())";

        $res = DB::query($sql);

        if (DB::errno() != 0) return false;
		
        return true;
    }
	
	public static function EditChart($id, $data) {

        $data['icao'] = strtoupper(DB::escape($data['icao']));
        $data['name'] = DB::escape($data['name']);
		$data['charttype'] = DB::escape($data['charttype']);
		$data['link'] = DB::escape($data['link']);

        if ($data['shown'] === true || $data['shown'] == '1') $data['shown'] = 1;
        else  $data['shown'] = 0;

		
		        $sql = "UPDATE charts
					SET `icao`='{$data['icao']}', `name`='{$data['name']}', `charttype`='{$data['charttype']}', 
						`link`='{$data['link']}', `shown`='{$data['shown']}', `dateupdated`= NOW()
					WHERE `id`='{$id}'";
		
			
		        $res = DB::query($sql);

        if (DB::errno() != 0) return false;
		
        return true;
    }
	
	public static function DeleteChart($id) {
        $sql = 'DELETE FROM charts WHERE id=' . $id;

        DB::query($sql);

        if (DB::errno() != 0) return false;

        return true;
    }


}
