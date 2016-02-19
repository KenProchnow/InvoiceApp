<?php

class Invoice extends Eloquent{
	 protected $fillable = array('invoice_id', 'customer_id');
	 
	 public function customer(){
	 	return $this->belongsTo('Customer');

	 }

}




?>