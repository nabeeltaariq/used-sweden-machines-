@extends("admin.templates.parts")
@section("parts_content")

<h3>Add New Spare Part</h3>

<form action="{{ url('/admin/spareParts/new/store') }}" method="post" enctype="multipart/form-data">
@csrf
<div class="form-group">
    <label>Select Manufacturer</label>
    <select class="form-control" name="manu_id">
        @foreach($manufacture as $manu)
        
        <option value="{{$manu->id}}">{{$manu->title}}</option>
        
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Select Machine</label>
    <select class="form-control" id="machine_id" required name="machineId" required="">
                  <option value="">Select Machine</option>

                @foreach($machines as $machine)

               <option value="{{$machine->id}}">{{$machine->title}}</option>

                @endforeach
               </select>
</div>

<div class="form-group">
    <label>Select Category</label>
    <select class="form-control" required name="cat_id" id="category_id" required="">
                <option value="">Select Part Category</option>
                           </select>
</div>

<div class="form-group">
    <label>Select Sub-Category</label>
    <select class="form-control"  required id="sub_category" name="subcat_id" required="">
                  <option value="">Select Type</option>
                  
               </select>
</div>

<div class="form-group">
    <label>Title</label>
    <input type="text" name="title" class="form-control" required>
</div>

<div class="form-group">
    <label>Spare Part No</label>
    <input type="number" class="form-control" name="spare_part_no" required>
</div>

<div class="form-group">
    <label>Price</label>
    <input type="number" class="form-control" name="price" required>
</div>

<div class="form-group">
    <label>Delivery Scope</label>
    <input type="text" name="delivery_scope" class="form-control" required>
</div>


<div class="form-group">
    <label>Description</label>
    <textarea class="form-control" name="spare_part_desc" required></textarea>
</div>

<div class="form-group">
    <label>Image</label>
    <input type="file" name="fileToUpload" class="form-control" required>
</div>

<button type="submit" class="btn btn-block btn-primary">Add Spare Part</button>
</form>

<center>
    @if(Session::has('saved'))
    
    <p>Spare Part Added Successfully..</p>
    
    @endif
</center>

<br><br>
<script>
    $("#machine_id").on("change",function(){
      let machineId = $(this).val();
      $.ajax({
          url:"{{URL::to('/api/getPartsCategories')}}/" + machineId,
          method:"GET",
          success:function(response){
              let categories = response;
              $("#category_id").html("<option value=''>Select Categories</option>");
              categories.map(category => {
                  $("#category_id").append("<option value='"+category.id+"'>"+category.title+"</option>");
              })

          }
      })
    });

    $("#category_id").on("change",function(){

        let category_id = $(this).val();
        $.ajax({
            url:"{{URL::to('/api/getSubCategory')}}/" + category_id,
            method:"GET",
            success:function(response){
               $("#sub_category").html("<option value=''>Select Sub Category</option>");
               response.map(data => {
                   $("#sub_category").append("<option value='"+data.id+"'>"+data.title+"</option>")
               })
            }
        })

    });

</script>
@endsection