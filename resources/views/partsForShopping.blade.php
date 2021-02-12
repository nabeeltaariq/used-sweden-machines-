@extends("templates.public")
@section("content")
<script>
  $(function() {
    if (!($('#table-outer').get(0).scrollHeight > $('#table-outer').height())) {

      $('#table-outer').css("max-width", "650px");

    }

  });
</script>
<style>
  #table-outer {
    height: 435px;
    overflow-y: auto;
    margin-left: -7px;
    margin-top: 4px;


  }

  #search {
    float: right;
    font-size: 12px;
    /*padding: 7px 20px 7px 20px;*/
    margin-top: -15px;
    border: none;
    width: 280px;
    font-family: arial;
    margin-right: 0px;

  }

  #search:focus {
    outline: none;
  }

  td {
    border: none;
  }

  tr {
    border: none;
  }

  #check_side {
    margin-top: -5px !important;
    position: absolute !important;
  }

  @media screen and (max-width: 768px) {
    #search {
      margin-left: 110px !important;
    }

    .imgoffer {
      width: 110px !important;
    }
  }

  @media screen and (max-width: 996px) {

    #check_side {
      margin-top: 10px !important;
      /*position:relative !important;*/
    }

  }

  .remove a:hover {
    background-color: white;
    color: black;
  }

  #myUL ul li:hover {
    background-color: white;
    color: black;
  }

  #myUL ul li a:hover {
    background-color: white;
    color: black;
  }

  #myUL ul {
    background-color: white;

  }

  ul {
    list-style-type: none;
  }

  .tag {
    display: block;
    background-color: gray;
    color: white;
    padding: 5px;
    margin: 5px 0px 2px;
  }

  .tag:hover {
    color: white;
    text-decoration: none;
    cursor: default;
  }

  ul.machinesView {
    margin-top: 30px;
  }

  ul.machinesView li {
    width: 80px;
    height: 100px;
    float: left;
    margin-right: 30px;

  }

  ul.machinesView li img {
    max-width: 50px;
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

  /*tree view coding start*/

  /* Remove default bullets */
  ul,
  #myUL {
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
    user-select: none;
    /* Prevent text selection */
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

  #myUL li {
    width: 100%;
  }

  #myUL li a {
    width: 100%;
  }

  /* Show the nested list when the user clicks on the caret/arrow (with JavaScript) */
  .active {
    display: block;
  }


  /*tree view coding end*/
</style>
<div style="font-family:arial;font-size:11px;margin-top:0px;" id="bread-crumb">
  <a href="{{URL::to('/')}}" style="">Home</a>&nbsp;»&nbsp; <a href="{{URL::to('/tetra-pak-spare-parts')}}">{{$selectedMachine->title}}</a>&nbsp;»&nbsp;<span>Tetra Pak Machine Spare parts</span>
  <style>
    a {
      color: #034375;
    }
  </style>
</div>
<input type="text" id="search" name="search" onkeyup="myFunction()" placeholder="Search by part name or number">

<div class="row" style="margin-left:0px;margin-right:1px;margin-top:-2px;" ng-app="myModule" ng-controller="myController">
  <div class="col-lg-3 col-md-3 col-sm-3 all-categories" style="overflow: auto;box-sizing:border-box;padding-bottom:25px;margin-left:0px;height:435px;">

    <form action="{{URL::to('/all-spare-parts')}}" method="get" style="margin-left: -15px;">
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
    <br /><br />


    <div style="max-height:250px;overflow:auto;margin-left:10px;margin-left: -15px;">
      <strong>Machine Parts</strong>
      <ul id="myUL">
        <li class="remove"><a href="{{URL::to('all-spare-parts')}}?machineId={{$machineId}}">All Parts</a></li>
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
  <div class="col-lg-9 col-md-9 col-sm-9" id="table-outer" ng-show="!loading">

    @if($spareParts != null && count($spareParts) >= 1)

    @foreach($spareParts as $part)

    <article class="line">
      <div style="font-family: arial;
    font-size: 13px;margin-left:10px;padding-top:10px;margin-top:-10px;">
        <div class="col-sm-3 col-md-3 col-lg-3 products">
          <div style=" ">

            <a href="#" class="fancybox">
              <img class="imgoffer" src="{{URL::to('/storage/app/products/')}}/{{$part->image}}" style="width:130px;
height: 100px;border: solid 2px #034375; color:#999999;margin-right:10px" align="left" title="">

            </a>
          </div>


        </div>
        <div class="col-sm-9 col-md-9 col-lg-9" style="padding-top:-10px;padding-bottom:7px;padding-left:0px;border-top:1px solid gray;">

          <p style="font-size:12px;margin-bottom:0px;">Part Number: {{$part->spare_part_no}}</p>

          <table>
            <tbody>
              <tr>
                <td width="175" style="padding: 0px;border: 0;">
                  <p style="font-weight:bold;font-size:12px;margin-bottom:0px;">{{$part->title}}</p>
                  <strong>Manufacturer :</strong>
                  @php
                  $manufacturer = App\Manufacturer::find($part->manufac);
                  if($manufacturer != null){
                  echo $manufacturer->title;
                  }
                  @endphp
                </td>
                <td>
                  <p style="font-weight:bold;font-size:14px;margin-bottom:0px;">Price:<span style="color:red;"> {{$part->price}}$</span>


                  </p>

                  <strong>Delivery Status:</strong>
                  <span style="color:green;">Within 24 hours</span>
                </td>
              </tr>

            </tbody>
          </table>

          <p class="para" style="height: 30px;margin-bottom:0px;margin-right:-15px">
            {{$part->description}}
            <span style="float:right;"> Quantity <input style="padding:5px;font-weight:bolder;display:inline;cursor:default;width:60px" class="numberField" type="number" value="1" min="1" max="1000">
              <!--<a href="{{URL::to('/api/fillCart')}}" data="partNo={{$part->spare_part_no}}&amp;partTitle={{$part->title}}&amp;price={{$part->price}}&amp;status={{$part->ds}}&amp;manu={{($manufacturer != null ? $manufacturer->title : '')}}" style="display:inline-block;border:1px solid #ccc;padding:10px;background-color:maroon;color:white"><span class="fas fa-cart-arrow-down" aria-hidden="true"></span> Add to Basket</a>-->
              <button onclick="processRequest(this)" data="partNo={{$part->spare_part_no}}&amp;partTitle={{$part->title}}&amp;price={{$part->price}}&amp;status={{$part->ds}}&amp;manu={{($manufacturer != null ? $manufacturer->title : '')}}" style="display:inline-block;border:1px solid maroon;padding:5px;background-color:maroon;color:white"><span class="fas fa-cart-arrow-down" aria-hidden="true"></span> Add to Cart</button>
            </span>
          </p>
          <!--<p align="right" style="margin:0">-->


          <!--</p>-->
          <br>

        </div>
      </div>
    </article>

    @endforeach

    @else

    <div class="alert alert-danger">
      No Spare Part Founded regarding this category
    </div>

    @endif
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
</script>
<script>
  var toggler = document.getElementsByClassName("myCaret");
  var i;

  for (i = 0; i < toggler.length; i++) {
    toggler[i].addEventListener("click", function() {
      this.parentElement.querySelector(".nested").classList.toggle("active");
      this.classList.toggle("caret-down");
    });
  }

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