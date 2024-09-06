
<?
	namespace App\Models;
	
	use Illuminate\Database\Eloquent\Model;
	
	class Product extends Model {
	
		const CATALOGUE_PAGE_SIZE=40;
		
		public static function getCataloguePagination($properties=array()) {			
		
			$productQuery=self::where('active',1);

			$propertiesCnt= count(array_keys($properties)));//number of properties declared in the filter			
			if ($propertiesCnt) {
				//inner joining product_props in order to get all matched properties rows for each product.
				$productQuery->join('product_props', 'product.id', '=', 'product_props.product_id')
							  ->where(function ($query) use (&$properties) {
									foreach($properties as $key=>$value) {
										$query->orWhere(function ($query) use (&$key,&$value) {
											$query->where('product_props.prop_name',$key);
											if (gettype($value)=='array') {
												//possible multiple options for certain property
												$query->whereIn('product_props.prop_value',$value);
											} else {
												//single option for certain property
												$query->where('product_props.prop_value','=',$value);
											}
										});
									}
								})
							 ->groupBy('product.id') //collapsing the selection to a state as one row per one product
							 ->having('count(*)', '=', $propertiesCnt); // but making sure all declared filter properties are matched 
			}

			return $productQuery->orderBy('product.id','DESC')->paginate(self::CATALOGUE_PAGE_SIZE);
		}
	}

			
