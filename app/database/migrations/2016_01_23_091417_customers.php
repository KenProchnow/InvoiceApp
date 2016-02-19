<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Customers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('sid')->unique();			
			$table->string('po')->nullable();
			$table->string('name')->nullable();
			$table->string('address1')->nullable();
			$table->string('address2')->nullable();
			$table->string('city')->nullable();
			$table->string('state')->nullable();
			$table->string('zip')->nullable();
			$table->decimal('credit_limit',7,2)->nullable();
			$table->string('type')->nullable();
			$table->decimal('prepay_amount',(7,2));
			$table->string('email');
			$table->timestamps();
			$table->tinyInteger('is_auto_invoice',1)->nullable();
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('customers');
	}

}
