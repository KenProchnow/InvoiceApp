<?php

class AnalyticsController extends \BaseController {


	public function customers()
	{		
		
		$count = Customer::count();
		$chartArray = Customer::count_by_customer();	
		$chartArray2 = Customer::count_by_start_date();					
		$chartArray3 = Customer::invoiced_total_by_customer();	
		
		
		// return json_encode($chartArray);
		return View::make('analytics.customers')
		->with("count",$count)
		->with("chartArray", $chartArray)
		->with("chartArray2",$chartArray2)
		->with("chartArray3",$chartArray3);

		
	}

	public function stats()
	{				
		$count = Customer::count();
		$chartArray = Customer::count_by_customer();	
		$chartArray2 = Customer::count_by_start_date();					
		$chartArray3 = Customer::invoiced_total_by_customer();		
		$chartArray4 = Customer::invoiced_total_by_customer_pie();	
		$chartArray6 = Customer::count_by_customer_bar();
		$chartArray5 = Customer::invoiced_total_by_customer_bar();			
		

		// return json_encode($chartArray4);
		// 
		return View::make('analytics.stats')
		->with("count",$count)
		->with("chartArray", $chartArray)
		->with("chartArray2",$chartArray2)
		->with("chartArray3",$chartArray3)
		->with("chartArray4",$chartArray4)
		->with("chartArray5",$chartArray5)
		->with("chartArray6",$chartArray6);
		
	}


	public function customers_deprecated()
	{		
		// $customers = Customer::all();				
		
		// $count = Customer::count();
		// loop through results and instatiate results in model
		
			$results = DB::select('select count(*) as count from customers'); 
			$count = $results;

			$results2 = DB::select("SELECT distinct date_format(created_at,'%Y-%m') as date, count(*) as count FROM laravel.customers
			group by date order by date asc");

			// loop through database query
			for ($i=0; $i < count($results2) ; $i++) { 
				$x2[] = $results2[$i]->date;
			}
			// loop through database query
			for ($i=0; $i < count($results2) ; $i++) { 
				$y2[] = (int) $results2[$i]->count;
			}

		$chartArray2["chart"] = array("type" => "line"); 
		$chartArray2["title"] = array("text" => "Customers Created by Month"); 
		$chartArray2["credits"] = array("enabled" => false); 
		$chartArray2["plotOptions"] = array( "series"=> array( "dataLabels"=> array( "enabled"=>true ) ) );
		$chartArray2["navigation"] = array("buttonOptions" => array("align" => "right")); 
		$chartArray2["series"] = array(); 
		$chartArray2['series'][] = array('data'=> $y2);
		$chartArray2["xAxis"] = array("categories" => $x2); 
		$chartArray2["yAxis"] = array("title" => array("text" => "# of Customers")); 

		// return json_encode($chartArray2);



		$results = DB::select('SELECT name,  count(*) as count FROM laravel.invoices i
			join laravel.customers c on c.id = i.customer_id 
			group by customer_id');

		// loop through database query
		for ($i=0; $i < count($results) ; $i++) { 
			$x[] = $results[$i]->name;
		}
		// loop through database query
		for ($i=0; $i < count($results) ; $i++) { 
			$y[] = (int) $results[$i]->count;
		}

		$chartArray["chart"] = array("type" => "column"); 
		$chartArray["title"] = array("text" => "Invoice Count by User"); 
		$chartArray["credits"] = array("enabled" => false); 
		$chartArray["navigation"] = array("buttonOptions" => array("align" => "right")); 
		$chartArray["plotOptions"] = array( "series"=> array( "dataLabels"=> array( "enabled"=>true ) ) );
		$chartArray["series"] = array(); 
		$chartArray['series'][] = array('data'=> $y);
		$chartArray["xAxis"] = array("categories" => $x); 
		$chartArray["yAxis"] = array("title" => array("text" => "# of Invoices")); 

		// return json_encode($chartArray);
		return View::make('analytics.customers')->with("chartArray", $chartArray)->with("count",$count)->with("chartArray2",$chartArray2);
		// return View::make('analytics.customers')->withCount($count);
	}





}






