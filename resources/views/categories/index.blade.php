@extends ('layout.app')

@section ('title')
	Index Category
@endsection

@section ('content')
	<div class="card">
              <div class="card-body p-0">
                <table class="table table-condensed">
                  <tr>
                    <th style="width: 10px">ID</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th style="width: 40px">Action</th>
                  </tr>
                  @forelse ($categories as $key => $category)
                  <tr>
                    <td>{{$key+1}}.</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->quantity}}</td>
                    <td><a href="/categories/{{$category->id}}/edit" class="button btn btn-primary">Edit</a></td>
                  </tr>
                  @empty
                  <tr>
                  	<td colspan="4">Nothing to show. Please create category <a href="/categories/create">here</a>.</td>
                  </tr>
                  @endforelse
                </table>
              </div>
            </div>
@endsection
