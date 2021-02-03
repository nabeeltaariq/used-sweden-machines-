@extends("admin.templates.parts")
@section("parts_content")

<h3>Edit Spare Part: {{$part->title}}</h3>

<form action="{{ url('/admin/spareParts/') }}/{{$part->id}}/update" method="post" enctype="multipart/form-data">
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

               <option value="{{$machine->id}}" {{ $machine->id == $part->machine_id ? "selected" : ""}}>{{$machine->title}}</option>

                @endforeach
               </select>
</div>

<div class="form-group">
    <label>Select Category</label>
    <select class="form-control" required name="cat_id" id="category_id" required="">
                @foreach($categories as $cat)
                <option value="{{$cat->id}}" {{ $cat->id == $part->category ? "selected" : "" }}>{{$cat->title}}</option>
                @endforeach
                           </select>
</div>

<div class="form-group">
    <label>Select Sub-Category</label>
    <select class="form-control"  required id="sub_category" name="subcat_id" required="">
                  
                  @foreach($sub_category as $sub)
                  
                  <option value="{{$sub->id}}" {{ $sub->id == $part->sub_category ? "selected" : "" }}>{{ $sub->title }}</option>
                  
                  @endforeach
                  
               </select>
</div>

<div class="form-group">
    <label>Title</label>
    <input value="{{$part->title}}" type="text" name="title" class="form-control" required>
</div>

<div class="form-group">
    <label>Spare Part No</label>
    <input value="{{$part->spare_part_no}}" type="number" class="form-control" name="spare_part_no" required>
</div>

<div class="form-group">
    <label>Price</label>
    <input value="{{$part->price}}" type="number" class="form-control" name="price" required>
</div>

<div class="form-group">
    <label>Delivery Scope</label>
    <input value="{{$part->ds}}" type="text" name="delivery_scope" class="form-control" required>
</div>


<div class="form-group">
    <label>Description</label>
    <textarea class="form-control" name="spare_part_desc" required>{{$part->description}}</textarea>
</div>

<div class="form-group">
    <label>Image</label>
    <input type="file" name="fileToUpload" class="form-control">
    
    <br>
    
    <p>Current Pic: <img src="{{ url('/storage/app/products') }}/{{$part->image}}" height="150px" width="150px"></p>
</div>

<button type="submit" class="btn btn-block btn-primary">Update Spare Part</button>
</form>

<center>
    @if(Session::has('saved'))
    
    <p>Spare Part Updated Successfully..</p>
    
    @endif
</center>

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