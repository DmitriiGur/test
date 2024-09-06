
<?php
	namespace App\Http\Controllers;
	 
	use App\Http\Controllers\Controller;
	use App\Model\Product;
	use Illuminate\View\View;

	class ProductController extends Controller {
	
		public function getCatalogue() {			
		
			$properties=$request->input('properties',array());
			$page=$request->input('page',1); /* page parameter name was not given in the task description so taken by default */
		

			/*
			checking if we have a cached result for this query
			assuming functions getRedisCache and setRedisCache are globally declared
			*/
			$hash=md5('productCatalogue'.json_encode($properties).$page);
			$result=getRedisCache($hash);
			if (empty($result)) { 
				$products=Product::getCataloguePagination($properties);
				$result=view('product.catalogue', compact('products'))->render();
				setRedisCache($hash,$result);
			}
			return response($result, 200)->header('Content-Type', 'text/html');

		}
	}
			
