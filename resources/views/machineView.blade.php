@extends("templates.public")

@section("content")
<style>
    .machinesView li a strong:hover {
        background-color: #ffff;
         !important;
        color: black;
    }

    .machinesView li a img:hover {
        background-color: #ffff;
         !important;
        text-decoration: none;
    }


    .mobile_spareparts {
        display: none;
    }

    #table-outer {
      width: 100%;
      height: auto;
      margin-left: -10px !important;
      margin-top: -10px !important;

    

    }

    #myTable {
      width: 100%;



    }

    #myTable tr td {



      padding-bottom: 5px;
    }

    #myTable tr td:nth-child(2) {
      padding-left: 15px !important;


    }

    #myTable tr {
      border-top: 1px solid #e6e6e6;


    }


    .newsletter {
      margin-left: 2px !important;
    }

    .img-responsive {
         border: 2px solid #034375;
          width: 150px;
    height: 100px;
      max-width: 100px !important;
      max-height: 90px !important;
    }


    @media screen and (max-width: 765px) {
        .desktop_spareparts {
            display: none;
        }

        .mobile_spareparts {
            display: inherit;
            margin-top: 36px;


        }

        .links_navigated_pages {
            display: none;
        }


    }


    ul {

        list-style-type: none;

    }



    .tag {

        display: block;

        background: none repeat scroll 0 0 #999;

        color: white;

        padding: 5px;

        margin: 5px 0px 2px;

        font-family: "Open Sans", Arial, sans-serif;

        font-size: 13px;

    }



    .tag:hover {

        color: white;

        text-decoration: none;

        cursor: default;

    }



    ul.machinesView {}



    ul.machinesView li {

        width: 25%;

        height: 140px;

        float: left;



    }





    ul.machinesView li a {

        color: black;

    }



    ul.machinesView li a:hover {

        text-decoration: none;

    }



    ul.machinesView li strong {

        font-weight: bolder;

        font-size: 14px;

    }




    .partsControl {


        width: 98.55%;
        background-color: #005294;
        border-top: 2px solid #005294;
        display: flex;
        margin-top: -40px;
        position: absolute;


    }


    .partsControl a {
        color: white;
        padding: 16px 10px 16px 40px;

        width: 32%;
    }
</style>

<div class="links_navigated_pages" style="font-family:arial;font-size:11px;margin-top:0px;">

    <a href="{{URL::to('/')}}" style="">Home</a>&nbsp;»&nbsp;<span>Tetra Pak Machines Spare Parts</span></span>

    <style>
        a {

            color: #034375;

        }
    </style>

</div>

<div class="mobile_spareparts" id="mob-sep">
    <div class="partsControl" id="partsControl">

        <a href="#" data-toggle="modal" data-target="#myModal"><i class="fas fa-filter"></i> Filter</a>
        <a href="#"><i class="fas fa-sort-amount-down"></i> Sort</a>
        <a href="{{URL::to('cart')}}"><i class="glyphicon glyphicon-shopping-cart"></i> Cart <sup id="totalItems">{{(Request::session()->has("cartData") ? count(Request::session()->get("cartData")) : '')}}</sup></a>

    </div>
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
    <br /><br />



<!--     <div class="products" style="margin-top:-5px">
        <table>
            @foreach($parts as $part)
            <tr>

                <td style="padding-bottom:4px"><img src="{{URL::to('/storage/app/products/')}}/<?= $part->image ?>" height='120px' width='120px' /></td>
                <td style="padding-left:10px">
                    <b>Part# <?= $part->spare_part_no ?></b><br /><b>Price <span class="text-danger"><?= $part->price ?></span></b><br />
                    <b><?= $part->title ?></b><br />
                    <b>Delivery Status: </b><b class="text-success"><?= $part->ds ?></b><br />
                    <button onclick="processRequest(this)" data="partNo={{$part->spare_part_no}}&amp;partTitle={{$part->title}}&amp;price={{$part->price}}&amp;status={{$part->ds}}&amp;manu={{($manufacturer ?? '' != null ? $manufacturer ?? ''->title : '')}}" style="display:inline-block;border:1px solid maroon;padding:5px;background-color:maroon;color:white"><span class="fas fa-cart-arrow-down" aria-hidden="true"></span> Add to Cart</button>
                </td>
            </tr>
            @endforeach

        </table>

    </div> -->
    <div class="col-lg-9 col-md-9 col-sm-12" class="margin-top-table" id="table-outer" ng-show="!loading">

    <table id="myTable">
          @foreach($parts as $part)
    <tr>
        <td>
          <div>
            <a href="#">
              <img class="img-responsive " src="{{URL::to('/storage/app/products/')}}/<?= $part->image ?>" alt=" " />
            </a>
          </div>
        </td>
        <td>
          <div class="content">
            <span> <b>Part# <?= $part->spare_part_no ?></b></span><br>
            <span > <strong><?= $part->title ?></strong></span><br>
           
            <span > <strong>Price <span class="text-danger"><?= $part->price ?></span> </strong></span><br>
            <span > <strong>Delivery Status:  <span class="text-success"><?= $part->ds ?></span> </strong></span><br>
                <button onclick="processRequest(this)" data="partNo={{$part->spare_part_no}}&amp;partTitle={{$part->title}}&amp;price={{$part->price}}&amp;status={{$part->ds}}&amp;manu={{($manufacturer ?? '' != null ? $manufacturer ?? ''->title : '')}}" style="display:inline-block;border:1px solid maroon;padding:5px;background-color:maroon;color:white"><span class="fas fa-cart-arrow-down" aria-hidden="true"></span> Add to Cart</button>


          </div>
        </td>
    </tr>
     @endforeach

    </table>
</div>

</div>

<div style="overflow-x:hidden;" class="row desktop_spareparts">

    <div class="col-lg-3 col-md-3 col-sm-3">

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



                    <select class="show-aside-ul" required style="width: 100%;padding: 2px;" id="sub_category" name="subcat_id" required="">

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

    </div>

    <div class="col-lg-9 col-md-9 col-sm-9" style="    padding: 0px;
    margin-left: -15px;">

        <ul class="machinesView">

            @foreach($machines as $machine)



            <li>

                <a href="{{URL::to('spare-parts/categories')}}/{{$machine->id}}">

                    <img style="width:146px;height:100px" src="{{URL::to('/storage/app/products/') . '/' . $machine->image}}" alt=""><br /><strong>{{$machine->title}}</strong>
            </li>

            </a>

            @endforeach

        </ul>

    </div>

</div>




<script>
    let clearCatagories = () => {
        $("#catagories").html("<option value='*'>Select Catagory</option>");

    }

    let clearSubCatagories = () => {
        $("#subCat").html("<option value='*'>Select Sub Catagory</option>");
    }


    $("#machineId").on("change", function() {

        let selectedVal = $(this).val();

        if (selectedVal != "*") {
            $.ajax({
                url: "{{URL::to('/api/getPartsCategories')}}/" + selectedVal,
                data: {
                    machineId: selectedVal
                },
                success: function(data) {
                    console.log(data);

                    clearCatagories();
                    for (i = 0; i < data.length; i++) {
                        $("#catagories").append("<option value='" + data[i].id + "'>" + data[i].title + "</option>");
                    }
                }
            });
        } else {
            clearCatagories();
            clearSubCatagories();
        }

    });

    $("#catagories").on("change", function() {

        let selectedVal = $(this).val();
        let machineId = $("#machineId").val();
        clearSubCatagories();
        if (selectedVal != "*") {
            $.ajax({
                url: "{{URL::to('/api/getSubCategory')}}/" + selectedVal,
                data: {
                    catagoryId: selectedVal,
                    machine: machineId
                },
                success: function(data) {

                    for (i = 0; i < data.length; i++) {
                        $("#subCat").append("<option value='" + data[i].id + "'>" + data[i].title + "</option>");
                    }
                }
            });
        }





    });

    $("input[name='search']").on("keyup", function() {

    let keyword = $(this).val();
    if (keyword.length >= 1) {

      $("#table-outer table tr").each(function() {

        let currentKeyword = $(this)[0].cells[1].children[0].innerHTML;

        if ((currentKeyword.toUpperCase().indexOf(keyword.toUpperCase()) != -1)) {
          $(this).show();
        } else {
          $(this).hide();
        }

      });

    } else {

      $("#table-outer table tr").each(function() {

        $(this).show();

      });


    }


  });

    $("#machine_id").on("change", function() {

        let machineId = $(this).val();

        $.ajax({

            url: "{{URL::to('/api/getPartsCategories')}}/" + machineId,

            method: "GET",

            success: function(response) {

                let categories = response;

                $("#category_id").html("<option value=''>Select Categories</option>");

                categories.map(category => {

                    $("#category_id").append("<option value='" + category.id + "'>" + category.title + "</option>");

                })



            }

        })

    });



    $("#category_id").on("change", function() {



        let category_id = $(this).val();

        $.ajax({

            url: "{{URL::to('/api/getSubCategory')}}/" + category_id,

            method: "GET",

            success: function(response) {

                $("#sub_category").html("<option value=''>Select Sub Category</option>");

                response.map(data => {

                    $("#sub_category").append("<option value='" + data.id + "'>" + data.title + "</option>")

                })

            }

        })



    });



    function processRequest(cartButton) {


        let partData = cartButton.getAttribute("data");

        let previousInnerHTML = cartButton.innerHTML;
        var quantity = cartButton.parentNode.children[0].value;
        partData += "&quantity=" + quantity;
        cartButton.innerHTML = "Please Wait... ";

        $.ajax({
            url: "{{URL::to('/api/fillCart/now')}}",
            method: "GET",
            data: partData,
            success: function(data) {

                cartButton.classList.add("btn");
                cartButton.disabled = true;
                cartButton.innerHTML = "Added";
                $("#totalItems").html(data);
            }


        });



    }
    $("#search").on("keyup", function() {

        let val = $(this).val();

        $(".line").each(function(index, element) {
            let partNumber = element.childNodes[1].childNodes[3].childNodes[1].innerHTML;
            let partName = element.childNodes[1].childNodes[3].childNodes[3].childNodes[1].childNodes[0].childNodes[1].innerHTML;

            if (val.length >= 1) {

                if (partNumber.toUpperCase().indexOf(val.toUpperCase()) >= 0) {
                    element.style.display = "block";
                } else if (partName.toUpperCase().indexOf(val.toUpperCase()) >= 0) {
                    element.style.display = "block";
                } else {
                    element.style.display = "none";
                }
            } else {
                element.style.display = "block";
            }
        });

    });


    $("#machine_id").on("change", function() {
        let machineId = $(this).val();
        $.ajax({
            url: "{{URL::to('/api/getPartsCategories')}}/" + machineId,
            method: "GET",
            success: function(response) {
                let categories = response;
                $("#category_id").html("<option value=''>Select Categories</option>");
                categories.map(category => {
                    $("#category_id").append("<option value='" + category.id + "'>" + category.title + "</option>");
                })

            }
        })
    });

    $("#category_id").on("change", function() {

        let category_id = $(this).val();
        $.ajax({
            url: "{{URL::to('/api/getSubCategory')}}/" + category_id,
            method: "GET",
            success: function(response) {
                $("#sub_category").html("<option value=''>Select Sub Category</option>");
                response.map(data => {
                    $("#sub_category").append("<option value='" + data.id + "'>" + data.title + "</option>")
                })
            }
        })

    });
</script>

@endsection

@section("spare-parts")
var mob = document.getElementById("mob-sep");
var vv = mob.offsetTop;
if (window.pageYOffset >= vv) {
mob.style.marginTop = "-8px";
document.getElementById("partsControl").style.position = "fixed";
}
else {
document.getElementById("partsControl").style.position = "absolute";
mob.style.marginTop = "40px";

}
@endsection