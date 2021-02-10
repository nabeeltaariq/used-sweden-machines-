@extends("templates.public")
@section("content")

<style>
  * {
    box-sizing: border-box;
  }

  #scroll-search-icon {
    margin-top: 3px !important;
  }

  #myInput {
    float: right;
    font-size: 12px;
    margin-top: -15px;
    border: 1px solid #ffff;
    width: 280px;
    font-family: arial;
    margin-right: 33px;

  }

  input:focus {
    outline: none;
  }

  #more {
    display: none;
  }

  .leftSidebar li {
    display: block;
  }

  .display {
    height: 465px;
    max-height: 465px;
    overflow-x: hidden;
    overflow-y: auto;
    position: relative;
    margin-top: 0px;
  }

  .leftSidebar li a {
    display: block;
    text-decoration: none;
    color: black;
    font-weight: bold;
    font-size: 13px;
    padding: 3px 0px;
    font-family: arial;
  }

  .leftSidebar li a:hover {
    color: grey;
    background-color: transparent;
  }

  .para {
    font-family: arial;
    font-size: 13px;
  }

  .none-dropdown {
    visibility: hidden;
    border: none;
  }

  .img-responsive {
    border: 2px solid #034375;
    width: 150px;
    height: 100px;
    max-width: 150px;
    max-height: 130px
      /*cursor: -webkit-pointer; cursor: grab;*/

  }

  table {
    width: 100%;
  }

  table tr td {

    text-align: justify;
    padding-bottom: 5px;



  }

  table tr td:nth-child(2) {
    padding-left: 20px !important;

    padding-bottom: 4px;
  }

  .content {

    border-top: 1px solid gray;
    height: 100px;


  }

  #table-outer {
    height: 435px;
    overflow-y: auto;
    /*margin-left:100px;*/
    margin-top: 4px;

  }

  #check {

    font-family: arial;
    font-size: 13px;
    color: #333;

  }

  /*#check*/
  /*   {*/
  /*     overflow: hidden;*/
  /* display: -webkit-box;*/
  /* -webkit-line-clamp:4;*/
  /* -webkit-box-orient: vertical;*/
  /*   }*/
  .leftSidebar li a.selected {
    color: gray;
  }

  .mob {
    display: none;
  }

  #title {
    font-size: 13px;
    line-height: 1.2;
    color: black;
    font-family: arial;
    font-weight: bold;
    margin-top: 3px;
  }

  @media only screen and (max-width: 1030px) {
    #myInput {

      margin-right: 18px;
    }
  }

  @media only screen and (max-width: 768px) {

    .col-lg-3,
    .col-md-3 {
      width: 26%;
    }

    .col-lg-9,
    .col-md-9 {
      width: 74%;
    }

    #table-outer {
      margin-left: 0px !important;
    }

    #bread-crumb {
      display: none;
    }

    .row {
      margin-top: 30px !important;
    }

    .content {

      height: auto;
    }

    #myInput {
      margin-top: 10px !important;

    }

  }

  @media only screen and (max-width:600px) {
    .row {
      margin-top: 30px !important;
    }

    #bread-crumb {
      display: none;
    }

    .mob {
      display: inline-block;
    }

    .desk {
      display: none;
    }

    .all-categories {
      display: none !important;
    }

    .leftSidebar {
      display: none;
    }

    #mobile-search-bar {

      margin-bottom: -40px !important;
    }

    #nav-button-collapse {
      margin-top: 7px !important;
    }

    #myInput {
      display: none;
    }

    #check {
      max-width: 230px;
      overflow-x: hidden;
      font-family: arial;
      font-size: 12px;


    }

    .row {
      margin-right: -10px !important;
      margin-left: -10px !important;

    }

    #table-outer {
      width: 100%;
      height: auto;
      margin-left: 0px !important;
      margin-top: -15px;

    }

    table {
      width: 100%;



    }

    table tr td {



      padding-bottom: 5px;
    }

    table tr td:nth-child(2) {
      padding-left: 15px !important;


    }

    table tr {
      border-top: 1px solid #e6e6e6;


    }

    .content {
      border: none;
      height: auto;
    }

    .img-responsive {
      max-width: 100px !important;
      max-height: 90px !important;
      margin-top: 5px;
    }

    #status-logo {
      width: 60px;
    }

    .btn-sm {
      display: none;
    }

    #title {
      font-size: 12px;
    }

    .menu {
      display: none;
    }

    #scroll-search-icon {
      margin-top: 10px !important;

    }
  }

  @media only screen and (max-width: 350px) {
    #check {
      max-width: 170px;
      font-size: 10px;
    }

    .img-responsive {
      box-shadow: none;
      width: 80px;
      height: 80px;
    }

    #status-logo {
      width: 40px;
    }
  }

  /* The Modal (background) */
  .modal-tetra-pak {
    display: none;
    position: fixed;
    z-index: 1;
    padding-top: 100px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0, 0, 0);
    /* Fallback color */
    background-color: rgba(0, 0, 0, 0.9);
    /* Black w/ opacity */
  }

  /* Modal Content (image) */
  .modal-content-tetrapak {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
  }

  /* Add Animation */
  .modal-content-tetrapak {
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
  }

  @-webkit-keyframes zoom {
    from {
      -webkit-transform: scale(0)
    }

    to {
      -webkit-transform: scale(1)
    }
  }

  @keyframes zoom {
    from {
      transform: scale(0)
    }

    to {
      transform: scale(1)
    }
  }

  /* The Close Button */
  .close-tetra-pak {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
  }

  .close-tetra-pak:hover,
  .close-tetra-pak:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
  }

  /* 100% Image Width on Smaller Screens */
  @media only screen and (max-width: 700px) {
    .modal-content-tetrapak {
      width: 100%;
    }
  }
</style>
<div style="font-family:arial;font-size:11px;margin-top:0px;" id="bread-crumb">
  <a href="{{URL::to('/')}}" style="">Home</a>&nbsp;»&nbsp;<span>Products</span></span>
  <style>
    a {
      color: #034375;
    }
  </style>
</div>
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search By Machine Name or SKU">

<div class="row" style="margin-left:-25px;margin-right:1px;margin-top:3px;" ng-app="myModule" ng-controller="myController">
  <div class="col-lg-3 col-md-3 col-sm-12 all-categories" style="margin-top:5px;background-color:#f4f4f4;height: 435px;overflow: auto;box-sizing:border-box;padding-bottom:25px;float:left;margin-right:0px;padding-left:40px;">
    <ul class="leftSidebar" style="padding-left:0px;">
      <li>
        <a href="{{URL::to('/all')}}" id="*" class="{{($selectedCat == 'all' ? 'selected' : '')}}">» All Machines</a>
      </li>
      @foreach($allCatagories as $catagory)
      <li>
        <a href="{{URL::to('category/selected/')}}/{{$catagory->id}}" class="{{($selectedCat == $catagory->id ? 'selected' : '')}}" id="{{$catagory->id}}">
          » {{$catagory->name}}
        </a>
      </li>
      @endforeach
    </ul>
  </div>
  <div class="col-lg-9 col-md-9 col-sm-12" id="table-outer" ng-show="!loading">

    <table id="myTable">
      <?php
      foreach ($allProductsJustIn as $product) {
      ?>
        <tr>
          <td>
            <div>


              @php $machine_name= strtoupper( preg_replace('/[^a-z0-9]+/', '-', strtolower(trim($product->pr_title)))); @endphp
              <a href="{{URL::to('/')}}/{{$machine_name}}/{{$product->id}}">
                <img src="https://www.usedswedenmachines.com/public/imgs/justInLogo.png" style="position:absolute;left:15px;top:210" id="status-logo">
                <img class="img-responsive " src="{{URL::to('storage/app/products/'.$product->image)}}" onclick="myimg(this)" alt=" " />
              </a>

            </div>



          </td>
          <td>
            <div class="content">
              <span>item #: {{$product->SKU}}</span><br>

              <a style="text-decoration:none" href="{{URL::to('/')}}/{{$machine_name}}/{{$product->id}}"> <span id="title"> <strong> {{$product->pr_title}} </strong></span><br>
              </a>
              <div id="check">

                @php
                echo substr(strip_tags(htmlspecialchars_decode($product->long_des, ENT_QUOTES)),0,150);


                @endphp
                <a class="desk" style="color:#034375;" href="{{URL::to('/')}}/{{$machine_name}}/{{$product->id}}"><strong>»&nbsp;More details</strong></a>
                <span class="mob">...</span>
                <a class="mob" style="font-weight:bold" href="{{URL::to('/')}}/{{$machine_name}}/{{$product->id}}">
                  <span>More details</span> </a>
              </div>
            </div>
          </td>
        </tr>
      <?php
      }
      ?>
      @if($allProductsSold !=null)

      <?php
      foreach ($allProductsSold as $product) {
      ?>
        <tr>
          <td>
            <div>
              @php $machine_name= strtoupper( preg_replace('/[^a-z0-9]+/', '-', strtolower(trim($product->pr_title)))); @endphp
              <a href="{{URL::to('/')}}/{{$machine_name}}/{{$product->id}}">
                <img src="https://www.usedswedenmachines.com/public/imgs/soldLogo.png" style="position:absolute;left:15px;top:210" id="status-logo">
                <img class="img-responsive " src="{{URL::to('storage/app/products/'.$product->image)}}" onclick="myimg(this)" alt=" " />
              </a>
            </div>
          </td>
          <td>
            <div class="content">
              <span>item #: {{$product->SKU}}</span><br>
              <span id="title"> <strong> {{$product->pr_title}} </strong></span><br>
              <div id="check">

                @php
                echo substr(strip_tags(htmlspecialchars_decode($product->long_des, ENT_QUOTES)),0,150);


                @endphp
                <a class="desk" style="color:black" href="{{URL::to('/')}}/{{$machine_name}}/{{$product->id}}"><strong>»&nbsp;More details</strong></a>
                <span class="mob">...</span> <a class="mob" style="font-weight:bold" href="{{URL::to('/')}}/{{$machine_name}}/{{$product->id}}"><span>More details</span> </a>
              </div>
            </div>
          </td>
        </tr>
      <?php
      }
      ?>
      @endif
    </table>
  </div>
</div>
<script>
  //           $( document ).ready(function() {
  //   var hellohhh=$("#byeeee").val();
  //   $("#check").html(hellohhh).text();
  // });
  function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
  $("input[name='search']").on("keyup", function() {

    let keyword = $(this).val();
    if (keyword.length >= 1) {

      $(" table tr").each(function() {

        let currentKeyword = $(this)[0].cells[1].children[0].innerHTML;

        if ((currentKeyword.toUpperCase().indexOf(keyword.toUpperCase()) != -1)) {
          $(this).show();
        } else {
          $(this).hide();
        }

      });

    } else {

      $(".products table tr").each(function() {

        $(this).show();

      });


    }


  });
</script>
@endsection