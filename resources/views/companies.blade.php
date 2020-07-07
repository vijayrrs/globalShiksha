@include('layout.header')
<div class="card">
    <div class="page-title">
        <h2>Companies</h2>
    </div>
</div>
<div class="card">
<table class="table" id="table">
    <thead>
        <tr <tr align= "left">
            <th class="text-center">#</th>
            <th class="text-center">Name</th>
            <th class="text-center">Link</th>
            <th class="text-center">Status</th>
        </tr>
    </thead>
    <tbody>
    	@foreach($companies as $item)
    		<tr>
    			<td>{{$item->id}}</td>
    			<td>{{$item->name}}</td>
    			<td>{{$item->link}}</td>-
    			<td>{{$item->status}}</td>
    		</tr>
    	@endforeach
    </tbody>
</table>
</div>

@include('layout.footer')