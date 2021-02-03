@extends("admin.templates.contacts")
@section("contacts_content")
<form action="" method="post">
    Quick Add Designation
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="text" name="designationName" id="designationName"/>
    <input type="submit" value="Save" class="btn btn-primary btn-sm">
</form>
<br/>
@if(isset($message))

<div class="alert alert-success">
    {{$message}}
</div>

@endif
<div class="alert alert-success" id="alert" style="display:none">
    Designation Updated and <strong><span id="count">0</span></strong> records affected
</div>
    <input type="text" name="search" id="search" placeholder="Search anything designation here" size="50" autocomplete="Off">
     <div class="row">
         <div class="col-lg-6 col-md-6">
            
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>S#</th>
                        <th>Designation</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table1">
                    @for($i = 0;$i<count($designations)/2;$i++)

                        <tr>
                        <td>{{$i+1}}</td>
                        <td class="designationName">{{$designations[$i]->name}}</td>
                        <td><a href="#" id="{{$designations[$i]->designationId}}" class="editButton">Edit</a></td>
                        </tr>

                    @endfor
                </tbody>
            </table>
         </div>
         <div class="col-lg-6 col-md-6">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>S#</th>
                        <th>Designation</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table2">
                    @for($i = count($designations)/2;$i<count($designations);$i++)

                        <tr>
                        <td>{{$i+1}}</td>
                        <td class="designationName">{{$designations[$i]->name}}</td>
                            <td><a href="" id="{{$designations[$i]->designationId}}" class="editButton">Edit</a></td>
                        </tr>

                    @endfor
                </tbody>
            </table>
        </div>
        
     </div>
<script>

    let designationIdToEdit = null;
    $(document).ready(function(){

        setTimeout(() => {
            $(".alert").hide();
        }, 5000);

    });
    $(".editButton").on("click",function(){

        $(this).parent().parent().children()[1].setAttribute("contenteditable","true");
        $(this).parent().parent().children()[1].focus();
        $(this).parent().parent().children()[1].setAttribute("bgcolor","white");
        designationIdToEdit = $(this).attr("id");
        
        return false;

    });

    $(".designationName").on("focusout",function(){

        $(this).removeAttr("contenteditable");
        $(this).removeAttr("bgcolor");

        const data = confirm("Are you sure you want to rename? this will effect all the records in cms");
        if(data == true){
            $.ajax({
                url:"{{URL::to('admin/contacts/designations/update')}}",
                method:"POST",
                data:{id:designationIdToEdit,"newName":$(this).html(),_token: '{{csrf_token()}}'},
                success:data => 
                {
                    $("#alert").show();
                    $("#count").html(data);
                    setTimeout(() => {
                            $("#alert").hide();
                    }, 3000);
                }
            })
        }
    
    
    });

    $("#search").on("keyup",function(){
        let searchValue = $(this).val();
        
        if(searchValue.length >= 1){

            $(".table1").children().each(function(){

                let data = $(this).children()[1].innerHTML;
                if(data.toUpperCase().indexOf(searchValue.toUpperCase()) >= 0){
                    $(this).show();
                }else{
                    $(this).hide();
                }

            });


            $(".table2").children().each(function(){

            let data = $(this).children()[1].innerHTML;
            if(data.toUpperCase().indexOf(searchValue.toUpperCase()) >= 0){
                $(this).show();
            }else{
                $(this).hide();
            }

            });



        }else{
                $(".table1").children().each(function(){

                    $(this).show();

                }); 


                $(".table2").children().each(function(){

                    $(this).show();

                });    
        }
    });
</script>
@endsection