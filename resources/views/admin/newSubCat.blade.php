@extends("admin.templates.parts")
@section("parts_content")

<form action="{{ url('/admin/spareParts/sub-categories/add/new/store') }}" method="post">
@csrf
<div class="form-group">
    <label>Parent Category</label>
    <select class="form-control" name="parent_cat">
        @foreach($categories as $cat)
        
        <option value="{{$cat->id}}">{{$cat->title}}</option>
        
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Machine Name</label>
    <select class="form-control" name="machine_id">
        @foreach($machines as $machine)
        
        <option value="{{$machine->id}}">{{$machine->title}}</option>
        
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Title</label>
    <input required type="text" name="subcat_title" class="form-control" placeholder="Enter Sub-Category Title">
</div>

<button type="submit" class="btn btn-primary btn-block">Add</button>
</form>

<center>
    @if(Session::has('saved'))
    
    <p>Sub-Category Added Successfully..</p>
    
    @endif
</center>
@endsection