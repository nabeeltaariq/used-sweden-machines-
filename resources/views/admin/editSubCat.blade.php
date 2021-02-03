@extends("admin.templates.parts")
@section("parts_content")

<h3>Edit Sub-Category: {{$sub->title}}</h3>

<form action="{{ url('/admin/spareParts/sub-categories') }}/{{$sub->id}}/update" method="post">
@csrf
<div class="form-group">
    <label>Parent Category</label>
    <select class="form-control" name="parent_cat">
        @foreach($categories as $cat)
        
        <option value="{{$cat->id}}" {{$sub->parent_id == $cat->id ? "selected" : ""}}>{{$cat->title}}</option>
        
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Machine Name</label>
    <select class="form-control" name="machine_id">
        @foreach($machines as $machine)
        
        <option value="{{$machine->id}}" {{$sub->machine_id == $machine->id ? "selected" : ""}}>{{$machine->title}}</option>
        
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Title</label>
    <input required type="text" name="subcat_title" class="form-control" placeholder="Enter Sub-Category Title" value="{{$sub->title}}">
</div>

<button type="submit" class="btn btn-primary btn-block">Update</button>
</form>

<center>
    @if(Session::has('saved'))
    
    <p>Sub-Category Updated Successfully..</p>
    
    @endif
</center>
@endsection