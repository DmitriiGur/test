<?php
	use App\Http\Controllers\ProductController;
	use Illuminate\Support\Route;
	 
	Route::get('/products', [ProductController::class, 'getCatalogue']);

