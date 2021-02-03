@extends("admin.templates.contacts")
@section("contacts_content")
    <h3>Head of Contacts</h3>
    <p>
        From here you can add, manage and update head of contact sections you can add new head of contact by <a href="#" data-toggle="modal" data-target="#myModal">Click here</a>
    </p>
    @if(isset($message))

      <div class="alert alert-success">
        New Contact Head Saved Successfully
      </div>

    @endif
    <!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add New Head of Contact</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
            
            <form action="" method="post">
                <label for="headName">
                  Head Name
                  <input type="text" name="headName" id="headName" class="form-control" required>
                  
                </label>
              <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="submit" value="Save Contact Head" class="btn btn-primary btn-block">
            </form>


        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
  
      </div>
    </div>
  </div>
  <!-- end of modal -->
    <table class="table table-bordered table-striped table-sm">
        <thead>
            <tr>
                <th>ID</th>
                <th>Head Name</th>
                
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($heads as $head)

                <tr>
                <td>{{$head->id}}</td>
                <td class="headName">{{$head->name}}</td>
                
                    <td><a href="" class="btn btn-primary btn-sm editButton">Edit</a></td>
                </tr>


            @endforeach
        </tbody>
    </table>
    <script>
      $(".editButton").on("click",function(e){
       $(this).parent().parent().children()[1].setAttribute("contenteditable","true");
       $(this).parent().parent().children()[1].setAttribute("bgcolor","white");
       $(this).parent().parent().children()[1].focus();
       $(this).hide();
        return false;
      });


      $(".headName").on("focusout",function(){
         
          let headName = $(this).text();
         
          let id = $(this).parent().children()[0].innerText;
          
        
          

          $(this).removeAttr("contenteditable");
          $(this).removeAttr("bgcolor");

          $.ajax({
            url:"{{URL::to('admin/contacts/editHead')}}",
            method:"POST",
            data:{"_token":"{{csrf_token()}}","id":id,"name":headName},
            success:function(data){
              console.log(data);
            }
          })

        $(".editButton").each(function(index,element){
          element.style.display = "inline-block";
        });
      });
    
    </script>
@endsection