@extends("admin.templates.parts")
@section("parts_content")

<h3>Edit Machine: {{$machine->title}}</h3>

<form enctype="multipart/form-data" action="{{url('admin/spareParts/machines/')}}/{{$machine->id}}/update" method="POST">
@csrf
<div class="form-group">
    
    <input type="text" name="machine_title" class="form-control" required="" value="{{$machine->title}}" />
    
    
</div>

<div class="form-group">
    <input type="file" name="machine_pic" class="form-control" />
    </br>
    <p>Current Pic: <img src="{{url('/storage/app/products')}}/{{$machine->image}}" height="150px" width="150px"></p>
    
</div>

<button type="submit" class="btn btn-primary btn-block">Update Machine</button>
    
</form>

<center>
    @if(Session::has('saved'))
    
    <p>Machine Updated Successfully..</p>
    
    @endif
</center>


@endsection