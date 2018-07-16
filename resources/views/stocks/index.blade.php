@extends ('layout.app')

@section ('title')
	Index Stock
@endsection

@section ('content')
	<div class="card">
              <div class="card-body p-0">
                <table class="table table-condensed">
                  <tr>
                    <th style="width: 10px">ID</th>
                    <th>IN / OUT</th>
                    <th>Category</th>
                    <th>Quantity</th>
                  </tr>
                  @forelse ($stocks as $key => $stock)
                  <tr>
                    <td>{{$key+1}}.</td>
                    <td>{{$stock->action}}</td>
                    <td>{{$stock->category->name}}</td>
                    <td>{{$stock->quantity}}</td>
                  </tr>
                  @empty
                  <tr>
                  	<td colspan="4">Nothing to show. Please create stock <a href="/stocks/create">here</a>.</td>
                  </tr>
                  @endforelse
                </table>
              </div>
            </div>
@endsection
