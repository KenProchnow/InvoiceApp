<?php

class Invoice extends Eloquent{
	 protected $fillable = array('invoice_id', 'customer_id','user_id','sent_date');
	 
	 public function customer(){
	 	return $this->belongsTo('Customer');

	 }

}




?>