@extends ('layout.app')

@section ('title')
	Edit Stock
@endsection

@section ('content')
@include('warning.message')
	<form method="POST" action="/stocks/{{ $stock->id }}">

		{{method_field('PATCH')}}
		@include('stocks.form', [
			'submitButtonText' => 'Update Stock'
		])
		
	</form>
@endsection
