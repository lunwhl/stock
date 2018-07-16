@extends ('layout.app')

@section ('title')
	Create Category
@endsection

@section ('content')
@include('warning.message')
	<form method="POST" action="/categories">

		{{ csrf_field() }}
	
	<div>
		<label class="card-title p-1">Name</label>
		<input type="text"
				class="form-control" 
		 		required name="name" 
		 		value="{{ old('name')  }}"
				placeholder="The name of your category"> 
	</div>

	<div>
		<label class="card-title p-1">Quantity</label>
		<input type="number" 
				class="form-control" 
				required name="quantity" 
				min="0" 
				value="{{ old('quantity')  }}" 
				step="0.01"
				placeholder="0"> 
	</div>

	<button type="submit" class="btn btn-primary">
		Create Category
	</button>
		
	</form>
@endsection