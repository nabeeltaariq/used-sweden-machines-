@extends("mobile.templates.public")
@section("content")


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Filter Spare Parts</h4>
      </div>
      <div class="modal-body">
        <form method="get" action="">
            <table style="width:100%;">
                <tr>
                    <td style="padding-bottom:10px">
                        <select name="machineId" id="machineId" class="form-control" required>
                            <option value="*">Select Machine</option>
                            @foreach($machines as $machine)

    

                                <option value="{{$machine->id}}">{{$machine->title}}</option>
         
             
         
                             @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="padding-bottom:10px">
                        <select class="form-control" id="catagories" name="catagories">
                                <option value="*">Select Catagory</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="padding-bottom:10px">
                        <select class="form-control" name="subCat" id="subCat">
                                <option value="*">Select Sub Catagory</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="padding-bottom:10px">
                        <input type="submit" value="Filter" class="btn btn-primary">
                    </td>
                </tr>
            </table>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- end of model -->
<br/><br/>
<div class="products">
    <table>
        @foreach($parts as $part)
    <tr>
    <td style="padding-bottom:4px"><img src="{{URL::to('/storage/app/products/')}}/<?= $part->image ?>" height='120px' width='120px'/></td>
        <td style="padding-left:10px">
            <b>Part# <?= $part ->spare_part_no ?></b><br/><b>Price <span class="text-danger"><?= $part->price ?></span></b><br/>
            <b><?= $part->title ?></b><br/>
            <b>Delivery Status: </b><b class="text-success"><?= $part->ds ?></b><br/>
            <input type="number" name="quantity" id="quantity" value="1" class="form-control" style="width:10vw;float:left;margin-right:2px"><a href="#" class="btn btn-primary" style="    background-color: white;
    color: black;
    border: 2px solid #005296;margin-left:4px"><i class="glyphicon glyphicon-shopping-cart"></i> Add to Cart</a>


        </td>
    </tr>
    @endforeach

    </table>

</div>

<script>

        let clearCatagories = () => {
            $("#catagories").html("<option value='*'>Select Catagory</option>");

        }

        let clearSubCatagories = () => {
            $("#subCat").html("<option value='*'>Select Sub Catagory</option>");
        }


   $("#machineId").on("change",function(){

    let selectedVal = $(this).val();

    if(selectedVal != "*"){
        $.ajax({
            url:"{{URL::to('/api/getPartsCategories')}}/" + selectedVal,
            data:{machineId:selectedVal},
            success:function(data){
                console.log(data);
               
                clearCatagories();
                for(i = 0;i<data.length;i++){
                    $("#catagories").append("<option value='"+data[i].id+"'>"+data[i].title+"</option>");
                }
            }
        });
    }else{
        clearCatagories();
        clearSubCatagories();
    }

   });

   $("#catagories").on("change",function(){

    let selectedVal = $(this).val();
    let machineId = $("#machineId").val();
    clearSubCatagories();
    if(selectedVal != "*"){
        $.ajax({
            url:"{{URL::to('/api/getSubCategory')}}/" + selectedVal,
            data:{catagoryId:selectedVal,machine:machineId},
            success:function(data){
                
                for(i = 0;i<data.length;i++){
                    $("#subCat").append("<option value='"+data[i].id+"'>"+data[i].title+"</option>");
                }
            }
        });
    }





   });

   $("input[name='search']").on("keyup",function(){

        let keyword = $(this).val();
        if(keyword.length >= 1){

            $(".products table tr").each(function(){

              let currentKeyword  = $(this)[0].cells[1].children[4].innerHTML;
              if(currentKeyword.toUpperCase().indexOf(keyword.toUpperCase()) != -1){
                $(this).show();
              }else{
                $(this).hide();
              }

            });

        }else{

            $(".products table tr").each(function(){

              $(this).show();

            });


        }


   });

</script>

<style>
    .partsControl{
        width:100%;
        margin:auto;

    }

    .partsControl ul{
        list-style-type:none;
        background-color: #005294;
        margin:0px;
        padding:0px;
    /* margin-top: -7px; */
    position: fixed;
    right: 0;
    left: 0;
    top: 171px;
    z-index:2;

    }

    .partsControl ul li{
        display:inline-block;
    }
    .partsControl ul li a{
        display:inline-block;
        padding:10px 9vw;
        color:white;

    }
</style>


@endsection
