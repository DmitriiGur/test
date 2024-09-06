<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

public function up()
{
    Schema::create('products', function(Blueprint $table)
    {
        $table->increments('id');
        $table->string('name');
        $table->integet('current_quantity');
		$table->integet('current_price');
		$table->tinyInteger('active')->default(1);
        $table->timestamps();
    });
	
	Schema::create('product_props', function(Blueprint $table)
    {
        $table->increments('id');
		$table->integet('product_id');
        $table->string('prop_name');
        $table->string('prop_value');
        $table->timestamps();
    });	
}

public function down()
{
	Schema::down('products');
	Schema::down('product_props');
}
