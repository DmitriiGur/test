<div class="page">
	<table class="items">
		<tr>
			<th>Name</th>
			<th>Price</th>
			<th>Qnt.</th>
		 </tr>
		@foreach($products as $product)
			<tr class="item">
				<td class="name">{{$product->name}}</div>
				<td class="price">{{$product->current_price}}</div>
				<td class="quantity">{{$product->current_quantity}}</div>
			</tr>
		@endforeach
	</table>
	<div class="links">
		{{$products->links()}}
	</div>
</div>