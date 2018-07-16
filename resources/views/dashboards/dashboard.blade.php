@extends ('layout.app')
<script src="/js/highcharts.js"></script>
<script src="/js/modules/series-label.js"></script>
<script src="/js/modules/exporting.js"></script>
@section('title')
	Dashboard
@endsection
<style type="text/css">
	.highcharts-credits{
		display:none;
	}
</style>

@section('content')
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">Current Stock</h3>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
			<table class="table table-bordered">
				<tr>
					<th>Category</th>
					<th>Quantity (kg)</th>
				</tr>
				@foreach($categoryQuantities as $categoryQuantity)
					<tr>
						<td>{{$categoryQuantity->name}}</td>
						<td><span class="badge bg-danger">{{$categoryQuantity->quantity}}</span></td>
					</tr>
				@endforeach
			</table>
		</div>
    </div>

	<form method="POST" action="/dashboard">
		{{ csrf_field() }}
		<div class="form-group">
	    	<label>Year</label>
	    	<select name="year" class="form-control select2" style="width: 100%;">
	    		@foreach($stockYears as $key => $stockYear)
	    			@if($key == $year)
	    				<option selected>{{$key}}</option>
	    			@else
	    				<option>{{$key}}</option>
	    			@endif
	    		@endforeach
	    	</select>
	    </div>
	    <button type="submit" class="btn btn-primary">Report</button>
	</form>
	<div id="StockInContainer" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	<div id="StockOutContainer" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	<script>
	var montlyStockInCollection = {!! json_encode($stockInArrays) !!};
	var year = {!! json_encode($year) !!};
	var seriesStockIn = [];
	for (var key in montlyStockInCollection) {	
    		seriesStockIn.push({
    			type: 'column',
    			name: key,
    			data:Object.values(montlyStockInCollection[key])
    		});			
    }
	Highcharts.chart('StockInContainer', {
	    title: {
	        text: 'Stock In ' + year
	    },
	    xAxis: {
	        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
	    },
	    labels: {
	        items: [{
	            style: {
	                left: '50px',
	                top: '18px',
	                color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
	            }
	        }]
	    },
	    series: seriesStockIn
	});

	var montlyStockOutCollection = {!! json_encode($stockOutArrays) !!};
	var seriesStockOut = [];
	for (var key in montlyStockOutCollection) {	
    		seriesStockOut.push({
    			type: 'column',
    			name: key,
    			data:Object.values(montlyStockOutCollection[key])
    		});			
    }
	Highcharts.chart('StockOutContainer', {
	    title: {
	        text: 'Stock Out ' + year
	    },
	    xAxis: {
	        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
	    },
	    labels: {
	        items: [{
	            style: {
	                left: '50px',
	                top: '18px',
	                color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
	            }
	        }]
	    },
	    series: seriesStockOut
	});
</script>
@endsection


