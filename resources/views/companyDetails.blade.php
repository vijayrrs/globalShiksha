@include('layout.header')
<div class="card">
    <div class="page-title">
        <h2>Company Detail</h2>
    </div>
</div>
<div class="card">
<table class="table" id="table">
    <caption><strong>Company Information:</strong></caption>
    <thead>
        <tr align= "left">
            <th>#</th>
            <th>Corporate Identification Number</th>
            <th>Company Name</th>
            <th>Company Status</th>
            <th>Age (Date of Incorporation)</th>
            <th>Registration Number</th>
            <th>Company Category</th>
            <th>Company Subcategory</th>
            <th>Class of Company</th>
            <th>ROC Code</th>
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
    <caption><strong>CONTACT DETAILS:</strong></caption>
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
    <caption><strong>Location:</strong></caption>
    <thead>
        <tr align= "left">
            <th>#</th>
            <th>State</th>
            <th>District</th>
            <th>City</th>
            <th>Pin</th>
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

<div class="card">
<table class="table" id="table">
    <caption><strong>Directors:</strong></caption>
    <thead>
        <tr align= "left">
            <th>#</th>
            <th>Director Identification Number</th>
            <th>Name</th>
            <th>Designation</th>
            <th>Date of Appointment</th>
        </tr>
    </thead>
    <tbody>
        @foreach($companyDetails as $item)
            <tr>
                <td>{{$item->d_No}}</td>
                <td>{{$item->d_Name}}</td>
                <td>{{$item->d_Designation}}</td>
                <td>{{$item->d_DateOfAppointment}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
@include('layout.footer')