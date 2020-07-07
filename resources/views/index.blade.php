@include('layout.header')
<div class="card">
	<div class="page-title">
		<h2>Industries</h2>
	</div>
</div>
<div class="card">
<table class="table" id="table">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Name</th>
            <th class="text-center">Link</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
    	@foreach($industry as $item)
    		<tr>
    			<td>{{$item->id}}</td>
    			<td>{{$item->name}}</td>
    			<td>{{$item->link}}</td>-
    			<td>
    				<a href="{{url('/companies/'.$item->id)}}">View Details</a>
    			</td>
    		</tr>
    	@endforeach
    </tbody>
</table>
</div>

@include('layout.footer')