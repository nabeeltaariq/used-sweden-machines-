@extends("admin.templates.parts")
@section("parts_content")
    <h3>Add New Category of Spare Part</h3>
    <form action="{{ url('/admin/spareParts/categories/new/store') }}" method="post" enctype="multipart/form-data">
        
        @csrf
        <label for="machineId">
            Select Machine
            <select required name="machineId" id="machineId" class="form-control">
                @foreach($machines as $machine)

            <option value="{{$machine->id}}">{{$machine->title}}</option>

                @endforeach
            </select>
        </label>
        <label for="catName">
            Category Name
            <input required type="text" name="categoryName" id="categoryName" class="form-control">
        </label>
        
        <label for="catName">
            Category Image
            <input required type="file" name="fileToUpload" id="fileToUpload" class="form-control">
        </label>
        
        
        <input type="submit" value="Save Category" class="btn btn-primary btn-block">
    </form>
    
    
    <center>
    @if(Session::has('saved'))
    
    <p>Category Added Successfully..</p>
    
    @endif
</center>
@endsection