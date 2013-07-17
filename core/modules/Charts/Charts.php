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

 
class Charts extends CodonModule
{
	

	public function index()
	{
		if(!Auth::LoggedIn()) {
			$this->set('message', 'You must be logged in to access this feature!');
			$this->render('core_error.tpl');
			return;
		};
		
		$this->set('title', Charts);
		
		$this->set('allairports', OperationsData::findAirport($where));

		$this->render('charts/index.tpl');
	}
	
	public function viewcharts()
	{
        $icao = $_GET['icao'];
        if(!$icao)
        {$icao = DB::escape($this->post->icao);}
		
		$this->set('title', $icao);
		$this->set('allairports', OperationsData::findAirport($where));
		$this->set('chart', ChartsData::getAirportCharts($icao));
        $this->show('charts/charts_airport.tpl');
	}
}