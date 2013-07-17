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

class ChartsAdmin extends CodonModule {

    public function HTMLHead() {
        switch ($this->controller->function) {
			case '':
            case 'viewcharts':
			case 'viewairports':
			case 'addchart':
			case 'editchart':
                $this->set('sidebar', 'charts/sidebar_index.tpl');
                break;
        }
    }
	
	public function NavBar()
    {
        echo '<li><a href="'.SITE_URL.'/admin/index.php/ChartsAdmin">Charts Admin</a></li>';
    }

    public function index() 
	{
        $this->viewairports();
    }
	
	public function viewcharts()
	{
		switch ($this->post->action) {
			
			case 'deletechart':
				$ret = ChartsData::DeleteChart($this->post->id);
				
				echo json_encode(array('status'=>'ok'));
				return;
                break;
		
		}
		
        $icao = $_GET['icao'];
        if(!$icao)
        {$icao = DB::escape($this->post->icao);}
		
		//$this->set('title', );
		$this->set('chart', ChartsData::getAirportCharts($icao));
        $this->show('charts/charts_airport.tpl');
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

		$this->render('charts/index.tpl');
    }

	public function addchart() 
	{
        
        $this->set('title', 'Add Chart');
        $this->set('action', 'addchart');
        $this->set('allairports', OperationsData::GetAllAirports());
		$this->set('charttype', Config::Get('CHART_TYPES'));
        $this->render('charts/charts_form.tpl');
    }

    public function editchart() {
        
        $id = $this->get->id;

        $this->set('chart', ChartsData::GetChartInfo($id));
        $this->set('title', 'Edit Chart');
        $this->set('action', 'editchart');
        $this->set('allairports', OperationsData::GetAllAirports());
		$this->set('charttype', Config::Get('CHART_TYPES'));
        $this->render('charts/charts_form.tpl');
    }

	
	protected function add_chart_post() {

        if ($this->post->icao == '' || $this->post->name == '') {
            $this->set('message', 'Some fields were blank!');
            $this->render('core_error.tpl');
            return;
        }

        if ($this->post->shown == '1') $this->post->shown = true;
        else  $this->post->shown = false;

        $data = array(
		'icao' => $this->post->icao, 
		'name' => $this->post->name,
        'charttype' => $this->post->charttype, 
		'link' => $this->post->link, 
		'shown' => $this->post->shown
		);

        ChartsData::AddChart($data);

        if (DB::errno() != 0) {
            $this->set('message', 'There was an error adding the chart');

            $this->render('core_error.tpl');
            return;
        }

    }
	
	protected function edit_chart_post() {

        if ($this->post->icao == '' || $this->post->name == '') {
            $this->set('message', 'Some fields were blank!');
            $this->render('core_error.tpl');
            return;
        }

        if ($this->post->shown == '1') $this->post->shown = true;
        else  $this->post->shown = false;

        $data = array(
		'icao' => $this->post->icao, 
		'name' => $this->post->name,
        'charttype' => $this->post->charttype, 
		'link' => $this->post->link, 
		'shown' => $this->post->shown
		);

        ChartsData::EditChart($this->post->id, $data);

        if (DB::errno() != 0) {
            $this->set('message', 'There was an error editting the chart: ' . DB::$error);

            $this->render('core_error.tpl');
            return;
        }
    }

}
