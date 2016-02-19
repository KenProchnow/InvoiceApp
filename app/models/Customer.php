<?php

class Customer extends Eloquent{
	
	    protected $fillable = array(
			'id',
			'sid',
			'po',
			'name',
			'address1',
			'address2',
			'city',
			'state',
			'zip',
			'credit_limit',
			'type',
			'created_at',
			'updated_at',
			'prepay_amount',
			'email',
			'is_auto_invoice'
	    	);


	    public static function count(){

	    	$result = DB::select('select count(*) as count from customers'); 

	    	return $result;

	    }

	    public function invoices(){
			return $this->hasMany('Invoice');

	    }


	    public static function count_by_start_date(){
	    	$query = "
	    	SELECT distinct date_format(created_at,'%Y-%m') as x, count(*) as y FROM laravel.customers
			group by x order by x asc
	    	";

	    	$results = DB::select( $query );

	    	// define all variables for the chartArray;
	    	$title = "Customers Created by Month";
	    	$type = "line";
	    	$yAxis_title = "# of Customers";
	    	$chartArray = Graph::helper($results,$title,$type,$yAxis_title);

			return $chartArray;

	    }


	    public static function count_by_customer(){
	    	$query = "
	    		SELECT name as x,  count(*) as y FROM laravel.invoices i
				join laravel.customers c on c.id = i.customer_id 
				group by customer_id
				order by y desc
	    	";

		    $results = DB::select( $query );
		    
		    // define all variables for the chartArray;
		    $title = "Invoice Count by User";
	    	$type = "column";
	    	$yAxis_title = "# of Invoices";
	    	$chartArray = Graph::helper($results,$title,$type,$yAxis_title);			

			return $chartArray;
		}

		public static function count_by_customer_bar(){
	    	$query = "
	    		SELECT name as x,  count(*) as y FROM laravel.invoices i
				join laravel.customers c on c.id = i.customer_id 
				group by customer_id
				order by y desc
	    	";

		    $results = DB::select( $query );
		    
		    // define all variables for the chartArray;
		    $title = "Invoice Count by User";
	    	$type = "bar";
	    	$yAxis_title = "# of Invoices";
	    	$chartArray = Graph::helper($results,$title,$type,$yAxis_title);			

			return $chartArray;
		}

		

		public static function invoiced_total_by_customer(){
	    	$query = "
	    		SELECT name as x,  sum(prepay_amount) as y FROM laravel.invoices i
				join laravel.customers c on c.id = i.customer_id 
                where i.sent_date is not null
				group by customer_id
				order by y desc
	    	";

		    $results = DB::select( $query );
		    
		    // define all variables for the chartArray;
		    $title = "Total Invoice amounts sent by User";
	    	$type = "column";
	    	$yAxis_title = "Total $ Invoiced";
	    	$chartArray = Graph::helper($results,$title,$type,$yAxis_title);			

			return $chartArray;
		}

		public static function invoiced_total_by_customer_bar(){
	    	$query = "
	    		SELECT name as x,  sum(prepay_amount) as y FROM laravel.invoices i
				join laravel.customers c on c.id = i.customer_id 
                where i.sent_date is not null
				group by customer_id
				order by y desc
	    	";

		    $results = DB::select( $query );
		    
		    // define all variables for the chartArray;
		    $title = "Total Invoice amounts sent by User";
	    	$type = "bar";
	    	$yAxis_title = "Total $ Invoiced";
	    	$chartArray = Graph::helper($results,$title,$type,$yAxis_title);			

			return $chartArray;
		}



		public static function invoiced_total_by_customer_pie(){
	    	$query = "
	    		SELECT name as x,  sum(prepay_amount) as y FROM laravel.invoices i
				join laravel.customers c on c.id = i.customer_id 
                where i.sent_date is not null
				group by customer_id
	    	";

		    $results = DB::select( $query );
		    
		    // define all variables for the chartArray;
		    $title = "Total Invoice amounts sent by User";
	    	$type = "pie";
	    	$yAxis_title = "Total $ Invoiced";
	    	$format = '<b>{point.name}</b>: {point.percentage:.1f} %';
	    	$chartArray = Graph::helper($results,$title,$type,$yAxis_title,$format);			

			return $chartArray;
		}


		public static function helper( $array = array() ){

					// could be the graph helper here, but since I want it for other models, makes sens to have it as it's own class. 

		}


}




?>


