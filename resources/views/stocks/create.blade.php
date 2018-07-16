@extends ('layout.app')

@section ('title')
	IN / OUT STOCK
@endsection

@section ('content')
@include('warning.message')
	<form method="POST" action="/stocks">

		{{ csrf_field() }}

	<div>
		<label class="card-title p-1">Action</label>
		<select name="action" class="form-control select2" data-placeholder="Select an Action">
			<option value="IN">IN</option>
			<option value="OUT" selected>OUT</option>
		</select>
	</div>

	<div>
		<label class="card-title p-1">Category</label>
		<select name="category_id" class="form-control select2" data-placeholder="Select an Category">
			@foreach($categories as $category)
					<option value="{{$category->id}}">{{$category->name}}</option>
			@endforeach
		</select>
	</div>

	<div>
		<label class="card-title p-1">Quantity</label>
		<input type="number" 
				class="form-control" 
				required name="quantity" 
				min="0" 
				value="old('quantity')" 
				step="0.01"
				placeholder="0"> 
	</div>

	<button type="submit" class="btn btn-primary">
		Create Stock
	</button>
		
	</form>
@endsection