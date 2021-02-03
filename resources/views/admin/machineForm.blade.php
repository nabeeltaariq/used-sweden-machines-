@extends("admin.templates.parts")
@section("parts_content")
    <h3>Add New Machine for Spare Parts</h3>
    <hr/>
    <form action="" enctype="multipart/form-data" method="post">
        
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <label for="machineName">
            Machine Name
            <input type="text" name="machineName" id="machineName" class="form-control">
        </label>
        <label for="machineImage">
                Machine Image
                <input type="file" name="fileToUpload" id="fileToUpload">
        </label>
        <input type="submit" value="Save Machine" class="btn btn-primary btn-block">
    </form>
    
    @if(Session::has('saved'))
    
    <center><p style="text:green">Machine Saved Successfully...</p></center>
    
    @endif
@endsection