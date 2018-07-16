	{{ csrf_field() }}
	
	<div>
		<label class="card-title p-1">Action</label>
		<select name="action" class="form-control select2" data-placeholder="Select an Action">
			@if($stock->action === 'IN')
				<option value="IN" selected>IN</option>
				<option value="OUT">OUT</option>
			@else
				<option value="IN">IN</option>
				<option value="OUT" selected>OUT</option>
			@endif
		</select>
	</div>

	<div>

		<label class="card-title p-1">Category</label>
		<select name="category_id" class="form-control select2" data-placeholder="Select an Category">
			@foreach($categories as $category)
				@if($category->id === $stock->category_id)
					<option selected value="{{$category->id}}">{{$category->name}}</option>
				@else
					<option value="{{$category->id}}">{{$category->name}}</option>
				@endif
			@endforeach
		</select>
	</div>

	<div>
		<label class="card-title p-1">Quantity</label>
		<input type="number" 
				class="form-control" 
				required name="quantity" 
				min="0" 
				step="0.01"
				placeholder="0"> 
	</div>

	<button type="submit" class="btn btn-primary">
		@if($submitButtonText)
			{{'Create Stock'}}
			@endif
	</button>