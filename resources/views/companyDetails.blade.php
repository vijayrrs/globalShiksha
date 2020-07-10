@include('layout.header')
<div class="card">
    <div class="page-title">
        <h2>Company Detail</h2>
    </div>
</div>
<div class="card">
<table class="table" id="table">
    <thead>
        <tr align= "left">
            <th class="text-center">#</th>
            <th class="text-center">Corporate Identification Number</th>
            <th class="text-center">Company Name</th>
            <th class="text-center">Company Status</th>
            <th class="text-center">Age (Date of Incorporation)</th>
            <th class="text-center">Registration Number</th>
            <th class="text-center">Company Category</th>
            <th class="text-center">Company Subcategory</th>
            <th class="text-center">Class of Company</th>
            <th class="text-center">ROC Code</th>
        </tr>
    </thead>
    <tbody>
    	@foreach($companyDetails as $item)
    		<tr>
    			<td>{{$item->id}}</td>
    			<td>{{$item->cin_no}}</td>
    			<td>{{$item->name}}</td>
    			<td>{{$item->status}}</td>
    			<td>{{$item->age}}</td>
    			<td>{{$item->registration_number}}</td>
    			<td>{{$item->category_name}}</td>
    			<td>{{$item->sub_category_name}}</td>
    			<td>{{$item->class}}</td>
    			<td>{{$item->roc_no}}</td>
    		</tr>
    	@endforeach
    </tbody>
</table>
</div>

<div class="card">
<table class="table" id="table">
    <thead>
        <tr align= "left">
            <th class="text-center">#</th>
            <th class="text-center">Email Address</th>
            <th class="text-center">Registered Office</th>
        </tr>
    </thead>
    <tbody>
        @foreach($companyDetails as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->email_addr}}</td>
                <td>{{$item->registered_office}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>

<div class="card">
<table class="table" id="table">
    <thead>
        <tr align= "left">
            <th class="text-center">#</th>
            <th class="text-center">State</th>
            <th class="text-center">District</th>
            <th class="text-center">City</th>
            <th class="text-center">Pin</th>
        </tr>
    </thead>
    <tbody>
        @foreach($companyDetails as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->state}}</td>
                <td>{{$item->district}}</td>
                <td>{{$item->city}}</td>
                <td>{{$item->pin}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>

@include('layout.footer')