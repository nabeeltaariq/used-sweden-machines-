@extends("admin.templates.contacts")
@section("contacts_content")
<br/>
<h3>Edit Country <sup>{{$country->country_name}}</sup></h3>
<hr/>
@if(isset($message))

<div class="alert alert-success">
    {{$message}}
</div>

@endif
<form method="post" enctype="multipart/form-data" action="">
    <label>
        Country Name
        <input type="text" name="countryName" id="countryName" class="form-control" value="{{$country->country_name}}" required>
    </label>
    <label>
        Country Code
        <input type="text" name="countryCode" id="countryCode" class="form-control" value="{{$country->country_code}}" required>
    </label>
    <label>
        Population
        <input type="text" name="population" class="form-control" value="{{$country->population}}" id="shortCode" required>
      </label>
      <label>
        GDB
        <input type="text" name="gdb" class="form-control" value="{{$country->gdb}}" id="shortCode" required>
      </label>
      <label>
        Exports
        <input type="text" name="exports" class="form-control" value="{{$country->exports}}" id="shortCode" required>
      </label>
      <label>
        Imports
        <input type="text" name="imports" class="form-control" value="{{$country->imports}}" id="shortCode" required>
      </label>
      <label>
        Language
        <input type="text" name="language" class="form-control" value="{{$country->language}}" id="shortCode" required>
      </label>
      <label>
        Currency
        <input type="text" name="currency" class="form-control" value="{{$country->currency}}" id="shortCode" required>
      </label>
    <label>
        Flag
        <input type="file" name="flag" id="flag">
        <img src="{{URL::to('/storage/app/cms/countries/')}}/{{$country->picUrl}}" class="img-thumbnail" style="max-width:150px"/>
    </label>
    <input type="submit" value="Save Changes" class="btn btn-danger btn-block">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
</form>

@endsection