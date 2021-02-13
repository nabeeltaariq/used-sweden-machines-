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
    margin-right: 0px;
  }

  input:focus {
    outline: none;
  }

  #more {
    display: none;
  }

  .news {

    list-style-type: none;

    margin: 0;

    padding: 0;

    width: 100%;

    background-color: #f4f4f4;


  }


  ul li {

    display: block;

  }



  .news li a {

    display: block;

    padding: 10px 20px;

    color: black;

  }



  .news li a:hover {

    background-color: #ccc;

    color: white;

    text-decoration: none;

  }



  .news li a.active {

    background-color: #ccc;

    color: white;

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

  #myTable {
    width: 100%;
  }

  #myTable tr td {

    text-align: justify;
    padding-bottom: 5px;



  }

  #myTable tr td:nth-child(2) {
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

    margin-top: -4px;

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

    .dropdown {
      display: block !important;
      margin-top: 10px;
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

    #myTable {
      width: 100%;



    }

    #myTable tr td {



      padding-bottom: 15px;
    }

    #myTable tr td:nth-child(2) {
      padding-left: 10px !important;
      padding-bottom: 15px;

    }

    #myTable tr {
      border-top: 1px solid #e6e6e6;


    }

    .content {
      border: none;

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
<div class="sharing_top" style="font-family:arial;font-size:11px;margin-top:0px;" id="bread-crumb">
  <a href="{{URL::to('/')}}" style="">Home</a>&nbsp;»&nbsp;<a href="{{URL::to('/news')}}">News</a>
  <style>
    a {
      color: #034375;
    }
  </style>
</div>
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search By Machine Name or SKU">
<div class="dropdown" style="display:none;">
  <button id="dLabel" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
    Select News
    <span class="caret"></span>
  </button>

  <ul class="dropdown-menu" aria-labelledby="dLabel">
    <li><a href="{{URL::to('/news')}}" class="{{($mode=='news' ? 'active' : '')}}">News</a></li>

    <li><a href="{{URL::to('/news?news_type=events')}}" class="{{($mode=='events' ? 'active' : '')}}">Events</a></li>

    <li><a href="{{URL::to('/news?news_type=newsletter')}}" class="{{($mode=='newsletter' ? 'active' : '')}}">Newsletters</a></li>

    <li><a href="{{URL::to('/news?news_type=testimonials')}}" class="{{($mode=='testimonials' ? 'active' : '')}}">Testimonials</a></li>

    <li><a href="{{URL::to('/news?news_type=references')}}" class="{{($mode=='references' ? 'active' : '')}}">References</a></li>
  </ul>
</div>
<div class="row" style="width:100%;margin-top:10px;" ng-app="myModule" ng-controller="myController">
  <div class="col-lg-3 col-md-3 col-sm-12 all-categories" style="margin-top:-6px;box-sizing:border-box;padding-bottom:25px;float:left;margin-right:0px;">
    <ul class="news">

      <li><a href="{{URL::to('/news')}}" class="{{($mode=='news' ? 'active' : '')}}">News</a></li>

      <li><a href="{{URL::to('/news?news_type=events')}}" class="{{($mode=='events' ? 'active' : '')}}">Events</a></li>

      <li><a href="{{URL::to('/news?news_type=newsletter')}}" class="{{($mode=='newsletter' ? 'active' : '')}}">Newsletters</a></li>

      <li><a href="{{URL::to('/news?news_type=testimonials')}}" class="{{($mode=='testimonials' ? 'active' : '')}}">Testimonials</a></li>

      <li><a href="{{URL::to('/news?news_type=references')}}" class="{{($mode=='references' ? 'active' : '')}}">References</a></li>

    </ul>

    <form method="post" action="">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <input type="email" name="email" placeholder="Enter Email for news" style="width:100%;margin-top:10px;" required />
      <input type="submit" value="Subscribe" class="subscribeButton" style="background: #034375;width: 100px;

              height: 28px;

              color: #fff;

              cursor: pointer;

              border-radius: 5px;

              box-shadow: 0 0 20px 0 rgba(0,0,0,.3);float:right">
      <br />
      @if(isset($message))

      {{$message}}

      @endif



    </form>

  </div>
  <div class="col-lg-9 col-md-9 col-sm-12" id="table-outer" ng-show="!loading">
    @if($mode=="news")
    <table id="myTable">



      @foreach ($data as $news)

      <tr>
        <td width="20">
          <div>
            <a href="{{URL::to('/getnews/by/')}}/{{$news->id}}">
              <img class="img-responsive " src="{{($news->image == null ? URL::to('/public/imgs/newsletter-icon.png') : URL::to('/storage/app/products/') . '/' . $news->image)}}" onclick="myimg(this)" alt=" " />
            </a>
          </div>
        </td>
        <td>
          <div class="content">
            <?php
            $date = date_create($news->news_date);
            $news->news_date = date_format($date, "j M , Y");
            ?>
            <span> {{$news->news_date}}</span><br>

            <a style="text-decoration:none" href="{{URL::to('/getnews/by/')}}/{{$news->id}}"> <span id="title"> <strong> {{$news->news_title}} </strong></span><br>
            </a>
            <div id="check">

              @php
              echo substr(strip_tags(htmlspecialchars_decode($news->news_des, ENT_QUOTES)),0,100);
              @endphp
              <a class="desk" style="color:#034375;" href="{{URL::to('/getnews/by/')}}/{{$news->id}}"><strong>»&nbsp;More details</strong></a>
              <span class="mob">...</span>
              <a class="mob" style="font-weight:bold" href="{{URL::to('/getnews/by/')}}/{{$news->id}}">
                <span>More details</span> </a>
            </div>
          </div>
        </td>
      </tr>
      @endforeach


    </table>
    @endif
    @if($mode=="newsletter")
    <table id="myTable">



      @foreach ($data as $news)

      <tr>
        <td width="20">
          <div>
            <a href="{{URL::to('news/newsletter/')}}/{{$news->id}}">
              <img class="img-responsive " src="{{URL::to('public/imgs/letter.png')}}" onclick="myimg(this)" alt=" " />
            </a>
          </div>
        </td>
        <td>
          <div class="content ">

            <span>{{$news->news_date}}</span><br>

            <a style="text-decoration:none" href="{{URL::to('/getnews/by/')}}/{{$news->id}}"> <span id="title"> <strong> {{$news->temp_title}} </strong></span><br>
            </a>
            <div id="check">

              <a style="color:#034375;" href="{{URL::to('news/newsletter/')}}/{{$news->id}}"><strong>View Complete Newsletter</strong></a>

            </div>
          </div>
        </td>
      </tr>
      @endforeach


    </table>
    @endif
    @if($mode == "testimonials")


    <table>
      @foreach($data as $news)
      <tr style="border-bottom:1px solid #e6e6e6;">
        <td>
          <img src="{{URL::to('/storage/app/') . '/' . $news->brandLogo}}" alt="" style="width: 130px;
            height: 110px;
            color: #999999;
            border: solid 2px #034375;">
        </td>
        <td>
          <div style="margin-left:30px;">
            <p style="font-size:12px;font-weight:bolder;display:block;margin-top:19px">



              <span style="float:left;color:green">

                {{$news->companyName}} </span>

              <span style="float:right">

                {{$news->sentDate}} </span>

              <br>

            </p>

            <p class="para" style="min-height: 50px;text-align: justify;">

              {{$news->testimonial}}

            </p>



            <p class="reduce-margin-top-onMobile" style="font-size:12px;font-weight:bolder;margin-bottom:35px">



              <span style="float:left">Sent By {{$news->personName}} , {{$news->personDesignation}} at {{$news->companyName}}</span>

            </p>
            <br>
        </td>
  </div>
  </tr>
  @endforeach
  </table>

  @endif

  @if($mode == "references")

  <table>
    <tbody>
      @foreach($data as $news)
      <tr>
        <th style="border-right:none;">Company Name</th>
        <td style="border-right:none;color:green;font-weight:bolder;width:80%" colspan="2">{{$news->customerName}}
        </td>
      </tr>
      <tr>
        <th style="border-right:none">Delivery Scope</th>
        <td colspan="3" style="border-right:none">{{$news->deliveryScope}}</td>
      </tr>
      <tr>

        <th style="border-right:none">Project Status</th>

        <td colspan="3" style="border-right:none">

          {{$news->projectStatus}}

        </td>

      </tr>
      <tr style="border-bottom:1px solid gray;">

        <th style="border-right:none;min-width:120px;PADDING-BOTTOM:20PX;">Contact Person</th>

        <td style="border-right:none;PADDING-BOTTOM:15PX;">

          {{$news->contactPerson}}

        </td>

      </tr>


      @endforeach

    </tbody>
  </table>

  @endif
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

      $(" table tr").each(function() {

        $(this).show();

      });


    }


  });
</script>
@endsection