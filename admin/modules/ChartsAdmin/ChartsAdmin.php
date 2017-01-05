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

class ChartsAdmin extends CodonModule {
    public function HTMLHead() {
        switch ($this->controller->function) {
			case '':
            case 'viewcharts':
			case 'viewairports':
			case 'addchart':
			case 'editchart':
			$this->set('sidebar', 'charts/sidebar_index.php');
			break;
        }
    }
	
	public function NavBar() {
        echo '<li><a href="'.SITE_URL.'/admin/index.php/ChartsAdmin">Charts Admin</a></li>';
    }

    public function index() {
        $this->viewairports();
    }
	
	public function viewcharts() {
		switch ($this->post->action) {
			case 'deletechart':
				$ret = AirportChartsData::DeleteChart($this->post->id);
				echo json_encode(array('status'=>'ok'));
				return;
			break;
		}
		
        $icao = DB::escape($this->get->icao);
        if(!$icao) {
			$icao = DB::escape($this->post->icao);
		}
		
		// $this->set('title', 'Charts');
		$this->set('chart', AirportChartsData::getAirportCharts($icao));
        $this->show('charts/charts_airport');
	}
	
	public function viewairports() {
        switch ($this->post->action) {
			case 'addchart':
				$this->add_chart_post();
				break;

			case 'editchart':
				$this->edit_chart_post();
				break;
        }

		$this->set('title', Charts);
		$this->set('allairports', OperationsData::findAirport($where));
		$this->show('charts/index');
    }

	public function addchart() {
        $this->set('title', 'Add Chart');
        $this->set('action', 'addchart');
        $this->set('allairports', OperationsData::GetAllAirports());
		$this->set('charttype', Config::Get('CHART_TYPES'));
        $this->show('charts/charts_form');
    }

    public function editchart() {
        $id = DB::escape($this->get->id);

        $this->set('chart', AirportChartsData::GetChartInfo($id));
        $this->set('title', 'Edit Chart');
        $this->set('action', 'editchart');
        $this->set('allairports', OperationsData::GetAllAirports());
		$this->set('charttype', Config::Get('CHART_TYPES'));
        $this->show('charts/charts_form');
    }

	
	protected function add_chart_post() {
        if ($this->post->icao == '' || $this->post->name == '') {
            $this->set('message', 'Some fields were blank!');
            $this->show('core_error');
            return;
        }

        if ($this->post->shown == '1') $this->post->shown = true;
        else  $this->post->shown = false;

        $data = array(
			'icao' 		=> DB::escape($this->post->icao),
			'name' 		=> DB::escape($this->post->name),
			'charttype' => DB::escape($this->post->charttype),
			'link' 		=> DB::escape($this->post->link),
			'shown' 	=> DB::escape($this->post->shown),
		);

        AirportChartsData::AddChart($data);

        if (DB::errno() != 0) {
            $this->set('message', 'There was an error adding the chart');
            $this->show('core_error');
            return;
        }

    }
	
	protected function edit_chart_post() {
        if ($this->post->icao == '' || $this->post->name == '') {
            $this->set('message', 'Some fields were blank!');
            $this->show('core_error');
            return;
        }

        if ($this->post->shown == '1') $this->post->shown = true;
        else  $this->post->shown = false;

        $data = array(
			'icao' 		=> DB::escape($this->post->icao),
			'name' 		=> DB::escape($this->post->name),
			'charttype' => DB::escape($this->post->charttype),
			'link' 		=> DB::escape($this->post->link),
			'shown' 	=> DB::escape($this->post->shown),
		);

        AirportChartsData::EditChart($this->post->id, $data);

        if (DB::errno() != 0) {
            $this->set('message', 'There was an error editting the chart: ' . DB::$error);
            $this->show('core_error');
            return;
        }
    }
}
