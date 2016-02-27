<?php

class Invoice extends Eloquent{
	 protected $fillable = array('invoice_id', 'customer_id','user_id','sent_date');
	 
	 public function customer(){
	 	return $this->belongsTo('Customer');

	 }

	 public static function dates(){
			$user_id = Auth::user()->id;

	    	$query = "
	    	SELECT distinct date_format(sent_date,'%Y-%m') as date from invoices as i				
                where i.sent_date is not null
                and i.user_id = {$user_id}
				order by date asc
	    	";
	    	
		    $results = DB::select( $query );

		    $dates = [];

		    for ($i=0; $i < count($results) ; $i++) { 
				$dates[] = $results[$i]->date;
			}
		   
			return $dates;
		}

}




?>