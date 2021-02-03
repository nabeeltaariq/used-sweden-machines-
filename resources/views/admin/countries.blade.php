@extends("admin.templates.contacts")
@section("contacts_content")
<h3>All Countries <sup><a href="#" data-toggle="modal" data-target="#myModal">Add New</a></sup></h3>
@if(isset($message))

<div class="alert alert-success">
{{$message}}
</div>

@endif
<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add New Country</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
          <form method="post" action="" enctype="multipart/form-data">
            <label>
              <input type="hidden" name="_token" value="{{csrf_token()}}">
              Country Name
              <input type="text" name="countryName" class="form-control" required id="countryName">
            </label>
            <label>
              Short Code 
              <input type="text" name="shortCode" class="form-control" id="shortCode" required>
            </label>
            <label>
              Population
              <input type="text" name="population" class="form-control" id="shortCode" required>
            </label>
            <label>
              GDB
              <input type="text" name="gdb" class="form-control" id="shortCode" required>
            </label>
            <label>
              Exports
              <input type="text" name="exports" class="form-control" id="shortCode" required>
            </label>
            <label>
              Imports
              <input type="text" name="imports" class="form-control" id="shortCode" required>
            </label>
            <label>
              Language
              <input type="text" name="language" class="form-control" id="shortCode" required>
            </label>
            <label>
              Currency
              <input type="text" name="currency" class="form-control" id="shortCode" required>
            </label>
            <label>
              Country Flag
              <input type="file" name="countryFlag" id="countryFlag">
            </label>
            <input type="submit" value="Save Country" class="btn btn-primary btn-block"/>
          </form>
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
  
      </div>
    </div>
  </div>
<hr/>
<table id="myTable" class="table table-sm">
    <thead>
        <tr>
            <th>ID</th>
            <th>Flag</th>
            <th>Country Name</th>
            <th>Short Code</th>
            <th>Population</th>
            <th>Language</th>
            <th>GDB</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        @foreach($countries as $country)

        <tr>
        <td>{{$country->id}}</td>
        <th>
        @if(!empty($country->picUrl))
          <img src="{{URL::to('/storage/app/cms/countries/')}}/{{$country->picUrl}}" style="max-height:50px" class="img-thumbnail"/>
        
        @endif
        </th>
        <td>{{$country->country_name}}</td>
        <td>{{$country->country_code}}</td>
        <td>{{$country->population}}</td>
        <td>{{$country->language}}</td>
        <td>{{$country->gdb}}</td>
        <td><a href="{{URL::to('admin/contacts/countries/edit/')}}/{{$country->id}}" class="btn btn-primary btn-sm">Edit</a></td>
        </tr>

        @endforeach
    </tbody>
</table>
@endsection