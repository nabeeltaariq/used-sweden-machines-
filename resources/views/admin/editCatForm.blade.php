@extends("admin.templates.parts")
@section("parts_content")

<h3>Edit Category: {{$cat->title}}</h3>

<form action="{{ url('/admin/spareParts/categories') }}/{{$cat->id}}/update" method="POST" enctype="multipart/form-data">
    @csrf
<div class="form-group">
    <label>Machine Name</label>
    <select class="form-control" name="machine_id">
        @foreach($machines as $machine)
        
        <option value="{{$machine->id}}" {{ $cat->machine_id == $machine->id ? "selected" : ""}}>{{$machine->title}}</option>
        
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Category Name</label>
    <input type="text" class="form-control" name="cat_name" value="{{$cat->title}}" required>
</div>

<div class="form-group">
    <input type="file" class="form-control" name="fileToUpload">
    <br>
    <p>Current Pic: <img src="{{url('/storage/app/products')}}/{{$cat->image}}" height="150px" width="150px"></p>
</div>

<button class="btn btn-primary btn-block" type="submit">Update</button>
    
</form>

<center>
    @if(Session::has('saved'))
    
    <p>Category Updated Successfully..</p>
    
    @endif
</center>
@endsection