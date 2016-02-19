<?php

class Graph {

			

	public static function helper($results, $title = "Title", $type="column", $yAxis_title = "y axis",$format = ""){

		// if($type!="pie"){
			// loop through database query
			for ($i=0; $i < count($results) ; $i++) { 
				$x[] = $results[$i]->x;
			}
			// loop through database query
			for ($i=0; $i < count($results) ; $i++) { 
				$y[] = (int) $results[$i]->y;
			}
		// }

		// if($type=="pie"){
		// 	$data = array();
		// 	for ($i=0; $i < count($results) ; $i++) { 
		// 		$data[$i] = array();
		// 		$data[$i]['name'] = $results[$i]->x;
		// 		$data[$i]['y'] = (int) $results[$i]->y;
		// 	}	
		// }

		$chartArray 			   = array();
		$chartArray["chart"]       = array("type" => $type); 
		$chartArray["title"]       = array("text" => $title); 
		$chartArray["credits"]     = array("enabled" => false); 
		$chartArray["plotOptions"] = array( "series"=> array( "dataLabels"=> array( "enabled"=>true,'format'=> $format) ) );
		$chartArray["navigation"]  = array("buttonOptions" => array("align" => "right")); 
		$chartArray["series"]      = array(); 

		// if($type!="pie"){
			$chartArray['series'][]    = array('data'=> $y);
			$chartArray["xAxis"]       = array("categories" => $x); 
			$chartArray["yAxis"]       = array("title" => array("text" => $yAxis_title)); 	
		// }
		// if($type=="pie"){

		// 	$chartArray["series"]['data']	   = $data;
		// }

		$chartArray['dataLabels']  = array(); 
		$chartArray['dataLabels']['enabled']  = true;
		$chartArray['dataLabels']['format']  = '<b>{point.name}</b>: {point.percentage:.1f} %';
		

		return $chartArray;
	}
			
}


		 // pie: {
   //              allowPointSelect: true,
   //              cursor: 'pointer',
   //              dataLabels: {
   //                  enabled: true,
   //                  format: '<b>{point.name}</b>: {point.percentage:.1f} %',
   //                  style: {
   //                      color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
   //                  }
   //              }
   //          }

?>