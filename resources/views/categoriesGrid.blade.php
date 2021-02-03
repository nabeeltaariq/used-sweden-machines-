@extends("templates.public")

@section("content")

<div style="font-family:arial;font-size:11px;">

    <a href="{{URL::to('/')}}" style="">Home</a>&nbsp;»&nbsp;<a href="{{URL::to('/tetra-pak-spare-parts')}}">{{$selectedMachine->title}}</a>&nbsp;»&nbsp;<span>Spare Parts Categories</span>

     <style>

         a{

             color:#034375;

         }

     </style>    

 </div>
<div class="row">

    <div class="col-lg-3 col-md-3" style="margin-top:10px;">

        <form action="{{URL::to('/all-spare-parts')}}" method="get">

            <ul style="padding:0px">

                

                <li class="aside-submenu" id="web">

                  <a id="web" class="tag">Select Your Machine Part</a> 

                   <select class="show-aside-ul menu12" id="machine_id" required style="width: 100%;padding: 2px;" name="machineId" required="">

                      <option value="">Select Machine</option>

    

                    @foreach($machines as $machine)

    

                   <option value="{{$machine->id}}">{{$machine->title}}</option>

    

                    @endforeach

                   </select>

                </li>

                <li class="aside-submenu">

                  

                  <select class="show-aside-ul" required style="width: 100%;padding: 2px;" name="cat_id" id="category_id" required="">

                    <option value="">Select Part Category</option>

                               </select>

                </li>

                <li class="aside-submenu">

          

                   <select class="show-aside-ul"  required style="width: 100%;padding: 2px;" id="sub_category" name="subcat_id" required="">

                      <option value="">Select Type</option>

                      

                   </select>

                </li>

        

                <li style="background:white; float:right;">

                

               

                  <input name="search_part" type="submit" class="news_btn" id="Submit" style="background: #034375;width: 100px;

                    height: 28px;

                    color: #fff;

                    cursor: pointer;

                    border-radius: 5px;

                    box-shadow: 0 0 20px 0 rgba(0,0,0,.3);" value="Search">

                

                </li>

             </ul>

            </form>

<br/><br/>

         <strong>Machine Parts</strong>

         <div style="max-height:250px;overflow:auto;">

                <ul id="myUL">

                <li><a href="{{URL::to('all-spare-parts')}}?machineId={{$machineId}}">All Parts</a></li>

                    @foreach($categories as $cat)

                        <li><span class="myCaret">{{$cat->title}}</span>

                            <ul class="nested">

                                @foreach($subCategories as $subCat)

                                    @if($subCat->parent_id == $cat->id)

                                        <li>

                                        <a href="{{URL::to('all-spare-parts')}}?machineId={{$machineId}}&cat_id={{$cat->id}}&subcat_id={{$subCat->id}}">{{$subCat->title}}</a>

                                        </li>

                                    @endif

                                @endforeach

                            </ul>

                        

                        </li>

                    @endforeach

                </ul>





         </div>



    </div>

    <div class="col-lg-9 col-md-9">
        <div style="/*padding: 10px; */
        margin-left: -10px;
        border: #ddd 2px solid;
        padding-top: 0px;
        height: 350px;
        max-height: 350px;
        overflow: auto;
        margin-top: 5px;">
            <ul class="machinesView">

                @foreach($categories as $cat)

                    

                    <li>
                        <p align="center" style="width:116px">
                            <a href="{{URL::to('/all-spare-parts')}}?machineId={{$machineId}}&cat_id={{$cat->id}}">

                            <img src="{{URL::to('/storage/app/products/')}}/{{$cat->image}}" alt=""><br/>

                            <strong>{{$cat->title}}</strong>

                        </a>
                        </p> 
                    </li>

        

                @endforeach

            </ul>
        </div>
    </div>

    

</div>



<style>

    ul{

        list-style-type:none;

    }



    .tag{

        display: block;

        background-color: gray;

        color: white;

        padding: 5px;

        margin: -5px 0px 2px;

    }



    .tag:hover{

        color:white;

        text-decoration:none;

        cursor:default;

    }



    ul.machinesView{

        margin-top: 12px;
    /* margin: 0px; */
    padding: 0px;
    padding-left: 16px;

    }



    ul.machinesView li{

       
        width:116px;
        height:80px;

        float:left;

        margin-right:13px;

        

    }

    ul.machinesView li img{

        max-width:50px;

    }



    ul.machinesView li a{

        color:black;

    }



    ul.machinesView li a:hover{

        text-decoration:none;

    }



    ul.machinesView li strong{

        font-weight:bolder;

        font-size:12px;

    }



    /*tree view coding start*/



    /* Remove default bullets */

ul, #myUL {

  list-style-type: none;

}



/* Remove margins and padding from the parent ul */

#myUL {

  margin: 0;

  padding: 0;

}



/* Style the caret/arrow */

.myCaret {

  cursor: pointer;

  user-select: none; /* Prevent text selection */

}



/* Create the caret/arrow with a unicode, and style it */

.myCaret::before {

  content: "\25B6";

  color: black;

  display: inline-block;

  margin-right: 6px;

}



/* Rotate the caret/arrow icon when clicked on (using JavaScript) */

.caret-down::before {

  transform: rotate(90deg);

}



/* Hide the nested list */

.nested {

  display: none;

}



#myUL li{

    width:100%;

}



#myUL li a{

    width:100%;

}



/* Show the nested list when the user clicks on the caret/arrow (with JavaScript) */

.active {

  display: block;

}





    /*tree view coding end*/

</style>

<script>

    var toggler = document.getElementsByClassName("myCaret");

var i;



for (i = 0; i < toggler.length; i++) {

  toggler[i].addEventListener("click", function() {

    this.parentElement.querySelector(".nested").classList.toggle("active");

    this.classList.toggle("caret-down");

  });

}

</script>

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