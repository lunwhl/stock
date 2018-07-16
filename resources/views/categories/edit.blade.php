@extends ('layout.app')

@section ('title')
	Edit Category
@endsection

@section ('content')
@include('warning.message')
	<form method="POST" action="/categories/{{ $category->id }}">

		{{method_field('PATCH')}}
		{{ csrf_field() }}
	
	<div>
		<label class="card-title p-1">Name</label>
		<input type="text"
				class="form-control" 
		 		required name="name" 
		 		value="{{ $category->name }}"
				placeholder="The name of your category"> 
	</div>

	<div>
		<label class="card-title p-1">Quantity</label>
		<input type="number" 
				class="form-control" 
				required name="quantity" 
				min="0" 
				value="{{ $category->quantity }}" 
				step="0.01"
				placeholder="0"> 
	</div>

	<button type="submit" class="btn btn-primary">
		Edit Category
	</button>
		
	</form>
@endsection
