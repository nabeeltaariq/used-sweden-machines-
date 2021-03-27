@extends("admin.templates.contacts")
@section("contacts_content")
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js">
</script>
    <div  class="container-fluid">
        <div class="row">
            <div class="col-lg-5">
                <select class="form-control"  onchange="loadContact(this)">
   @foreach ($allTypes as  $type)
 

       @if ( $id[0]  == $type->id )
    <option value="{{ $type->id }}" selected>{{ $type->name }}</option>
@else
<option value="{{ $type->id }}">{{ $type->name }}</option>
@endif


   @endforeach
                </select>
            </div>
            <div class="col-lg-5">
                <input type="text"  id="myInput" class="form-control" placeholder="Search By name, country or product/service name">
                      
            </div>
            <div class="col-lg-2">
            <a href="{{url('admin/fetch/contacts')}}" class="btn text-white btn-primary" >
                Back..
            </a>
            </div>

        </div>
        <br>
        
    <div >
        <table class="table table-bordered table-sm" id="contact-tbl">
            @if ( $id[0]  != 6 )
                <thead>
               
                    <tr>
                        <th>ID</th>
                        <th>Company Name</th>
                        <th>Country</th>
                        <th>Product</th>
                        <th>Website</th>
                    </tr>
                    {{-- <tr >
                        <th colspan="5" style="text-align:center">
                            <div class="spinner-border text-success"></div>
                        </th>
                    </tr> --}}
                </thead>
                <tbody id="example">
                    @foreach ($allContacts as $contacts )
                    <tr>
                        <td>{{ $contacts->contactUdId }}</td>
                        <td><a href="{{URL::to('admin/contacts/singleContact/')}}/{{ $contacts->contactUdId }}">{{ $contacts->companyName }}</a></td>
                        <td>{{ $contacts->country }}</td>
                        <td>{{ $contacts->productService }}</td>
                      
                        <td>
                            <a href="{{ $contacts->web }}" target="_blank" class="btn btn-primary btn-sm"><i class="fab fa-internet-explorer"></i> Visit Site</a>
                        <a href="{{URL::to('/admin/contacts/edit')}}/{{ $contacts->contactUdId }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Quick Edit</a>
                        </td>
                    </tr>
                        
                    @endforeach
              
                </tbody>
                @else
                <thead>

                    <tr>
                    <th>Engineer ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Linked In</th>
                    <th>Nationality</th>
                    <th>Date of Birth</th>
                    <th>Jobs Can Perform</th>
                    <th>Operations</th>
                </tr> 
            </thead>
            <tbody id='example'>
            @foreach  ($allContacts as $engineer )
                  
                      <tr id="eng-{{ $engineer->engineerId }}">
                        <td>{{ $engineer->engineerId }}</td>
                      <td><a href="#">{{ $engineer->teamPersonName }}</a></td>
        
                     <td>{{ $engineer->email }}</td>
                       <td>{{ $engineer->mobileNo }}</td>
                       <td> <span>
                        <a href="{{ $engineer->linkedIn }}" target="_blank" class="btn btn-primary btn-sm" style="font-size:11px;height:17px;background-color:#007bff"><pre style="color:white">Visit Profile</pre></a>
                    </span></td>
        
                    
                        <td>{{ $engineer->nationality }}</td>
                        <td>{{ $engineer->dateOfBirth }}</td>
                       <td>{{ $engineer->experienceMechanic }}</td>
                        
                        <td>
                        <button class="btn btn-danger btn-sm" title="delte" onclick="deleteContact(this)" value="{{$engineer->engineerId}}"><i class="fa fa-trash"></i></button>
                        <a href="../editEngineer/{{$engineer->engineerId}}" class="btn btn-warning btn-sm" title="Quick Edit"><i class="fas fa-user-edit"></i></a>
                        <a href="../viewEngineer/{{$engineer->engineerId}}" class="btn btn-warning btn-sm" title="view"><i class="fa fa-eye"></i></a>
                        
                    </td>
                     </tr>
                    
                   </tbody>
                    @endforeach

                @endif
        </table>
    </div>
  
</div>
<script>
    $(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#example tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
function loadContact(e)
    {
        let id=e.value;
        let url="<?php echo $id[0] ?>";
        if(url=='e')
        url="getContacts/"+id;
       
        else
        url="../getContacts/"+id;
      
  document.getElementById('contact-tbl').innerHTML="<tr><th colspan='5' style='text-align:center'>          <div class='spinner-border text-success'></div></th></tr>";
      $.ajax({

url:url,
type: "GET",
data: {
 id:id,
  


},

success: function(data) {
document.getElementById('contact-tbl').innerHTML=data;
}
});
      
    }
    function deleteContact(e)
    {
    let id=e.value;
    let url="<?php echo $id[0] ?>";
        if(url=='e')
        url="deleteEngineer/";
       
        else
        url="../deleteEngineer/";
      $.ajax({

        url: url,
        type: "GET",
        data: {
          id: id,
          


        },

        success: function(data) {

        
               if (data == "success")
        document.getElementById("eng-"+id).style.display="none";
          else
            swal("", " OOPS! Something went wrong... ", "error");



        }
    });
      
    }
</script>
<style>
    table{
        font-size:12px;
    }
    .btn{
        padding: 0px 2px;
    }



</style>
@endsection
