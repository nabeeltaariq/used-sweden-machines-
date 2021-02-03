@extends("admin.templates.parts")
@section("parts_content")


 <div class="container">
  <div class="row">
   <div class="col-md-12">
    <h4>Excel Upload</h4>
    <hr>
    <form method="post" enctype="multipart/form-data">
     <div class="form-group row">
      <label class="col-md-3">Select File</label>
      <div class="col-md-8">
       <input type="file" name="uploadfile" class="form-control" />
      </div>
     </div>

     <div class="form-group row">
      <label class="col-md-3"></label>
      <div class="col-md-8">
       <input type="submit" name="submit" class="btn btn-primary">
      </div>
     </div>
    </form>
   </div>
  </div>
 </div>

@endsection