  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js">
  </script>
  <style>
    .navbar-nav>li>a {

      padding: 0.8em;
      color: white;

      font-size: 12.5px;
      padding: 8px;
    }

    .navbar {
      min-height: 32px !important;

      background-color: #034375;
      width: 97.75%;
      height: auto;
      margin-top: -15px;
      margin-left: 11px;
      border-radius: 0px;


    }

    .navbar-default .navbar-toggle .icon-bar {
      background-color: #044271;

      height: 4px;
    }

    #mobile-no {
      display: none;
    }

    #mobile-no a {
      color: white;
      text-align: center;
      font-weight: bold;
      background-color: #404040;
      margin-bottom: -7px;

    }

    .mobile-search-bar {
      display: none;
    }

    #nav-logo,
    #scroll-search-icon {
      display: none;
    }

    #left-align {
      margin-left: -15px;
    }

    @media (max-width: 768px) {
      .navbar {
        width: 97.50%;
      }




    }

    @media (max-width: 765px) {

      .navbar-toggle {
        display: block;
        background-color: #ddd;
      }


    }

    @media only screen and (max-width: 765px) {


      #left-align {
        margin-left: -0px;
      }

      #mobile-no {
        display: block !important;


      }

      .navbar-color {
        position: absolute;
        z-index: 1;
        width: 100%;
        background-color: #044271;
      }

      #nav-button-collapse {

        box-shadow: none;
        color: #015291;
      }

      .nav-button-collapse-scroll {


        float: left;
        box-shadow: none;
        color: red;

      }

      .navbar-nav>li>a {

        padding-left: 10px;
        transition: height 2s;
        border-bottom: 0.08px solid #989797;
      }

      .navbar {

        /*position:absolute !important;*/
        width: 100%;
        margin-top: -20px;
        margin-left: 0px;
        border-top: none;
        background-color: #e7e7ec;
        z-index: 1 !important;
      }

      .sticky {
        position: fixed;
        top: 36px;

        /*border:none !important;*/
      }

      .mobile-search-bar {
        display: block !important;
        margin-top: -62px;
        margin-left: 10px;
        width: 80%;

        z-index: 1;
        position: absolute;
      }

      .mobile-scroll-search-bar {


        width: 81%;
        margin-top: 20px;
        margin-left: 20px;
        height: 45px;
        border: 1px solid #777;

      }

      .search-bar {
        display: block !important;
        width: 100%;
        height: 100%;
        background-color: white;
        /*opacity:0.5;*/
        position: fixed;
        margin-top: -65px;
        z-index: 1;
      }

    }

    .nav li:hover {
      background-color: #9e9e9e;
    }
  </style>
  <div class="mobile-fixed">

    @include('templates.partials.header')
    <nav class="navbar navbar-default" id="navbar">
      <div>
        <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false" id="nav-button-collapse" style="border:none" onclick="hideScollSearchBar()">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div class="navbar-header">

          <div id="nav-logo">
            <a class="navbar-brand" href="#">
              <img onclick="javascript:window.location='{{URL::to('/')}}';" src="{{URL::to('public/imgs/usm.svg')}}" style="height:50px;width:200px;float:left;margin-top:-13px">

            </a>
            <span class="glyphicon glyphicon-search" style="float:right;color: #044271;font-size:25px;margin-top:13px" onclick="displaySearchBar()"></span>
          </div>


        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div style="background-color:##034375;" class="collapse navbar-collapse navbar-color" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li id="left-align"><a class=" {{(Request::path() == '/' ? 'active' : '')}}" href="{{URL::to('/')}}" style="color: white;">Home</a></li>
            <li><a style="color: white;" class="{{(Request::path() == 'tetra-pak-machines-expert' ? 'active' : '')}}" href="{{URL::to('tetra-pak-machines-expert')}}">About Us</a></li>
            <li><a class="{{(Request::path() == 'used-tetra-pak-machines' ? 'active' : '')}}" style="color: white;" href="{{URL::to('used-tetra-pak-machines')}}">Used Tetra Pak Machines</a></li>
            <li><a class="{{(Request::path() == 'tetra-pak-spare-parts' ? 'active' : '')}}" style="color: white;" href="{{URL::to('tetra-pak-spare-parts')}}" style="position:relative">Tetra Pak Spare Parts <span style="position: absolute;
          top: -4px;
          right: 5px;
          font-size: 10px;
          font-weight: bolder;
          color: #ffdd00;">Online Shop</span> </a></li>
            <li><a class="{{(Request::path() == 'upload-your-machine' ? 'active' : '')}}" style="color: white;" href="{{URL::to('upload-your-machine')}}">Upload Your Machine</a></li>
            <li><a class="{{(Request::path() == 'Technical-services' ? 'active' : '')}}" style="color: white;" href="{{URL::to('Technical-services')}}">Technical Services</a></li>


            <li><a type="button" id="contactUs" data-toggle="modal" data-target="#myModal-contactus" class="{{(Request::path() == 'contact' ? 'active' : '')}}" style="color: white;cursor:pointer;">Contact Us</a></li>
            <li><a class="{{(Request::path() == 'news' ? 'active' : '')}}" style="color: white;" href="{{URL::to('news')}}">News</a></li>
            <li id="right-align"><a class="{{(Request::path() == 'cart' ? 'active' : '')}}" href="{{URL::to('cart')}}" style="color:white;background-color:{{(Request::session()->has('cartData') ?  'maroon' : 'none')}}"><span class="fas fa-shopping-cart"></span> Cart <sup id="totalItems">{{(Request::session()->has("cartData") ? count(Request::session()->get("cartData")) : '')}}</sup> </a></li>
            <li id="mobile-no"><a href="#">Call USM: +92-321-741-5373</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <div id="search-bar">
      <input type="text" name="search" autocomplete="Off" placeholder="Search In USM" class="form-control mobile-search-bar" id="mobile-search-bar">
      <span class="glyphicon glyphicon-search" style="float:right;color:#777;font-size:25px;margin-right:12px;margin-top:-38px;" onclick="removeScroll()" id="scroll-search-icon"></span>
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="myModal-contactus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background: linear-gradient(90deg, #FBCA01 0%,#FBCA01 100%);dispaly:flex;text-align:center;position:relative;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <p class="modal-title" id="myModalLabel" style=" vertical-align: text-bottom;">
          <h3 class="item" style="

              display: inline-block;

              padding: 7px 20px;

               font-size: 20px;

              font-weight: bolder;
          

              color: #034375;

               background: #b43720;

               background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…IgaGVpZ2h0PSIxIiBmaWxsPSJ1cmwoI2dyYWQtdWNnZy1nZW5lcmF0ZWQpIiAvPgo8L3N2Zz4=);

               background: -moz-linear-gradient(90deg, #b43720 0%, #e94541 100%);

               background: -webkit-gradient(linear, left bottom, right top, color-stop(0%,#b43720), color-stop(100%,#e94541));

               background: -webkit-linear-gradient(90deg, #b43720 0%,#e94541100%);

               background: -o-linear-gradient(90deg, #b43720 0%,#e94541 100%);

               background: -ms-linear-gradient(90deg, #b43720 0%,#e94541 100%);

               background: linear-gradient(90deg, #FBCA01 0%,#FBCA01 100%);">Contact Us</h3>
          </p>
        </div>
        <div style="font-size:15px;margin-left:30px">
          <strong>USM-Used Sweden Machines</strong><br>83-A, S.I.E # 1,<br>Gujranwala
          Pakistan<br><br>Tel.: +92 (321) 7415373<br>E-Mail: <a class="link" style="color: blue; text-decoration: underline;" href="mailto: info@usedswedenmachines.com">info@usedswedenmachines.com</a>
        </div>
        <form id="contact-form">
          @csrf

          <input type="hidden" name="token" id="token">
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-12">
                <p>Item #</p>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-12">
                <input name="serial_no" type="text" id="serial_no" value="" class="col-lg-9 form-control">
              </div>

              <div class="col-lg-3 col-md-3 col-sm-12">
                <p>Machine Name</p>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-12">
                <input name="machine_name" type="text" id="machine_name" style="width:100%;outline:none" value="" class="col-lg-9 form-control">
              </div>

              <div class="col-lg-3 col-md-3 col-sm-12">
                <p>Full Name</p>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-12">
                <input name="full_name" type="text" style="width:100%;outline:none" id="full_name" value="" class="col-lg-9 form-control">
              </div>



              <div class="col-lg-3 col-md-3 col-sm-12">
                <p>Phone No.<span style="color:red">*</span></p>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-12">
                <input name="phone" type="text" id="phone" value="" class="col-lg-9 form-control">
              </div>
              <div class="col-lg-3 col-md-3 col-sm-12">
                <p>Email<span style="color:red">*</span></p>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-12">
                <input name="email" type="email" id="email" value="" required="" class="col-lg-9 form-control">
              </div>
              <div class="col-lg-3 col-md-3 col-sm-12">
                <p>Company</p>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-12">
                <input name="company" id="company" value="" class="col-lg-9 form-control">
              </div>

              <div class="col-lg-3 col-md-3 col-sm-12">
                <p>Special Request</p>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-12">
                <textarea name="request" id="request" cols="31" placeholder="Please, contact regarding this machine" class="col-lg-9 form-control"></textarea>
              </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            <button name="quote_form" type="submit" class="btn btn-default" id="btn-save" name="submit">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <style>
    .modal-body .form-control {
      border-radius: 0px;
    }

    .modal-body {
      color: black;
    }

    /*.col-lg-3*/
    /*{*/

    /*    margin-bottom:-10px;*/
    /*   margin-top:10px;*/
    /*    }*/
    /* @media screen and (max-width: 480px) {*/

    /*    .modal-body*/
    /*  {*/
    /*      margin-top:-50px;*/
    /*  }*/
    /*.row*/
    /*{*/

    /*    margin-top:40px;*/
    /*    margin-right:1px !important;*/
    /*        margin-left:1px !important;*/
    /*}*/


    /* }*/
  </style>
  <script type="text/javascript">
    window.onload = (function() {
      var width_of_screen = (window.screen.width)
      if (width_of_screen >= 500) {

        document.getElementById('contactUs').setAttribute('data-toggle', '');
        document.getElementById('contactUs').setAttribute('data-target', '');
        document.getElementById('contactUs').setAttribute('href', "{{URL::to('contact')}}");


      }
    })();
    $("#contact-form").submit(function(e) {
      e.preventDefault();
      let machine_name = $("#machine_name").val();
      let serial_no = $("#serial_no").val();
      let phone = $("#phone").val();
      let email = $("#email").val();
      let full_name = $("#full_name").val();
      let company = $("#company").val();




      $.ajax({

        url: "/machine/contactUsform",
        type: "POST",
        data: {
          token: "{{ csrf_token() }}",

          machine_name: machine_name,
          serial_no: serial_no,
          phone: phone,
          email: phone,
          full_name: full_name,
          company: company,


        },

        success: function(data) {

          if (data == "success")
            swal("", " Your email has been sent Successfully!", "success");
          else
            swal("", " Your email has not been sent ", "error");

        }
        //   error: function(){
        //     swal("", " Your email has not been sent!", "error");
        //  }
        //       error: function(xhr, status, error) {
        //   var err = eval("(" + xhr.responseText + ")");
        //   alert(err.Message);
        // }
      });
    });
  </script>