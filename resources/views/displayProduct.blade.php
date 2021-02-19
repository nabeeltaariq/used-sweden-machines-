@extends("templates.public")
@section("sharing")
<style>
.slick-slide img {
    min-height: 84px !important;
    max-height: 84px !important;
    min-width: 134px;
    max-width: 134px;
}
      
           .modal-body .form-control
            {
                border-radius:0px;
            }
                .modal-body
  {
     color:black;
  }
  .border-class-thinner {
    border: 2px solid #034375;
}
.carousel-control.left, .carousel-control.right {
   background-image:none !important;
   filter:none !important;
}
   .label-heading
   {

       margin-bottom:-10px;
      margin-top:10px;
      color:black;
       }
       #description_box
{
   background-color: #ddeef1;
   color:black;
           height:auto;
            overflow: auto;
            font-size: 12px;
            border: 2px solid #808080;
            height:310px;
            margin-top:12px;
    

}

textarea.form-control {
    height: auto;
    resize: vertical;
}
#product-body
{

    margin-top:-5px;

}

       @media screen and (max-width: 765px) {
  #slick,#bread-crumb,#myModalbig,.modal-backdrop.fade {
   display:none !important;
  }
  #ask-for-price-form
  {
    padding-top: -50px !important;
  }
  
#product-body
{

    margin-top:10px;
    margin-right:1px !important;
        margin-left:1px !important;
}

#description_box
{

           height:auto !important;
    
            font-size: 12px;
            border: 2px solid #808080a6;
margin-top: 10px;
}
#content
{
    margin-left:-5px;
 width:104%;
}
}


                .linked li a:hover
                {
                    background: none;
                }


.slider {
    width: 50%;
    margin: auto;
}

.slick-slide {
    margin:0px;
    width:132px !important;
        transition: all ease-in-out .3s;
}

/*.slick-slide img {*/
/*    width: 100%;*/
/*    max-height:85px !important;*/
/*}*/

.slick-prev:before,
.slick-next:before {
    color: black;
        
}



.slick-current {
    opacity: 1;
}

        /* ==== Main CSS === */

        .shareButtons{
            list-style-type:none;
            margin:0;
            padding:0;
        }
        #my-thumbs-list{
            overflow: auto;
            width: 400px;
            height: auto;

        }


        .shareButtons li{
            display:inline-block;
        }

        .shareButtons li a{
            display: inline-block;
            font-size: 30px;
            /* margin-right: 3px; */
            margin-right: -2px;
        }
        .btn-theme{

            display: inline-block;
  
            background-color: #034171;
            border-radius: 5px;
            box-shadow: 0 0 20px 0 rgba(0,0,0,.3);
            font-size: 13px;
            font-family: "Open Sans",Arial,sans-serif;
            color: white;

        }
        h3{
            font-size:14px;
        }

        .btn-theme:hover{
            color:white;
            text-decoration:none;
        }
        .left
        }
            z-index: 9999 !important;
        }
 
     
    </style>

<<<<<<< HEAD
=======
        #content {
            margin-left: -5px;
            width: 104%;
        }
    }


    }
</style>
>>>>>>> b019f22e7a3044417529358134385a89dd4dbc94

<link rel="stylesheet" type="text/css" href="./slick/slick.css">
<link rel="stylesheet" type="text/css" href="./slick/slick-theme.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js">
</script>
<meta property="og:url" content="" />
<meta property="og:type" content="article" />
<meta property="og:title" content="{{$product->pr_title}}" />
<meta property="og:description" content="{{$product->short_des}}" />
<meta property="og:image" content="{{URL::to('storage/app/products/')}}/{{$product->image}}" />

@endsection
@section("content")
@php
$category = App\Catagories::find($product->cat_id);

@endphp
<div style="font-family:arial;font-size:11px;" id="bread-crumb">
    <a href="{{URL::to('/')}}" style="">Home</a>&nbsp;»&nbsp;<a href="{{URL::to('/used-tetra-pak-machines')}}">{{$category->name}}</a>&nbsp;»&nbsp;<span>{{$product->pr_title}}</span>
    <style>
        a {
            color: #034375;
        }

        .slick-prev {
            left: 0px;
            z-index: 999;
        }

        .slick-next {
            right: 0px;
        }

        .next-pre {
            border-color: #f1ebeb !important;
            border: .5px !important;
            margin: 10px !important;
            height: 30px !important;
            width: 30px !important;
            color: gray !important;
        }




        @media only screen and (max-width:481px) {}
    </style>
</div>
{{--Carousel and Description Div--}}

@if(session()->has('message') )
@if(session('message')==true)
<script>
    swal("", " Your email has been sent Successfully!", "success")
</script>
@else
<script>
    swal("", " Your email has not been sent!", "error")
</script>
@endif
@endif
@php
$machine_name= strtoupper( preg_replace('/[^a-z0-9]+/', '-', strtolower(trim($product->pr_title))));
@endphp







<!-- <a style="color:lightgray;" href="{{URL::to('/')}}/{{$machine_name}}/{{$next}}/next"><button>
        < </button> </a>
<a style="color:lightgray;" href="{{URL::to('/')}}/{{$machine_name}}/{{$next}}/next"><button>
        > </button> </a> -->




<div class="row" id="product-body">
    <div style="margin-top: 10px;  " class="col-lg-6 col-md-6 col-sm-6 ">
        <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="100000000">
            <!-- Indicators -->

            <!-- Wrapper for slides -->
            <div class="carousel-inner border-class-thinner" style="height: 310px;">
                <div class="item active">


                    <img src="{{URL::to('storage/app/products/'.$product->image)}}" data-toggle="modal" data-target="#myModalbig" class="img-responsive model-images" style="height:370px;width:100%;">

                </div>
                @php
                $allThumbs = App\Thumbs::where("org_id",$product->id)->get();
                @endphp

                @foreach($allThumbs as $thumb)
                <div class="item">


                    <img src="{{URL::to('storage/app/products/'.$thumb->file_name)}}" data-toggle="modal" data-target="#myModalbig" class="img-responsive" style="width:763px;height: 586px">

                </div>
                @endforeach
            </div>
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        {{--Slick slider Code Starts here --}}
        <section id="slick" style="width: 100%; margin-top: 10px;padding: 0px;display: none;" class="center slider">
            <div>
                <button data-toggle="modal" data-target="#myModal" style="border:none;outline:none;margin:0px;padding:0px;">
                    <img class="main-image" style="border: 2px solid #034375;" src="{{URL::to('storage/app/products/'.$product->image)}}">
                </button>
            </div>



            @php

            $allThumbs = App\Thumbs::where("org_id",$product->id)->get();



            @endphp

            @foreach($allThumbs as $thumb)
            <div>
                <button data-toggle="modal" data-target="#myModal" style="border:none;outline:none;margin:0px;padding:0px;">

                    <img class="main-image" style="border: 2px solid #034375;" src="{{URL::to('storage/app/products/'.$thumb->file_name)}}">
                </button>

            </div>
            @endforeach

            <input id="check-thumbs" type="hidden" value="{{$allThumbs}}">


        </section>

        {{-- Slick slider Code Ends--}}
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div id="description_box">
            <strong>{{$product->pr_title}}</strong><Br />
            <strong>Item #: </strong>&nbsp;&nbsp;&nbsp;{{$product->SKU}}<br />
            <strong>Category</strong>&nbsp;&nbsp;&nbsp;
            @php
            echo $category->name;
            @endphp
            <Br />
            @php
            echo html_entity_decode($product->long_des);
            @endphp
        </div>
        <div style="margin-top: 5px;">
            <ul class="shareButtons linked" style="margin-top: -4px;">
                <li><a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u={{URL::to('/')}}/{{$machine_name}}/{{$product->id}}" style="color:#024374"><i class="fab fa-facebook-square"></i></a></li>
                <li>
                    <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url={{URL::to('/')}}/{{$machine_name}}/{{$product->id}}&title={{$product->pr_title}}&summary=Tetra%20Pak%20Machines&source=USM" style="color: white">
                        <i class="fab fa-linkedin" style="background: #0077b5;border-radius:2px;font-size:27px;padding-left:3px;padding-right:3px"></i>
                    </a>
                </li>
                <li><a href="https://api.whatsapp.com/send?phone=923217415373&&text={{URL::to('/')}}/{{$machine_name}}/{{$product->id}}" style="color:#65bc54"><i class="fab fa-whatsapp-square"></i></a></li>
                <li><a href="mailto:?subject={{$product->pr_title}}-Used Sweden Machines&body=To%20Get%20Information%20About%20This%20Machine,%20Please%20Visit%20{{URL::to('/')}}/{{$machine_name}}/{{$product->id}}%20" style="color:#c15b53"><img src="{{URL::to('public/imgs/email.png')}}" alt="" style="heigt:25px;margin-top:-8px;max-height:25px;max-width:25.17px;min-width:25.17px;width:25.17px"></a></li>

                <li><a href="{{URL::to('/machine-pdf/generate')}}/{{$product->id}}" target="_blank" style="color:maroon">
                        <img src="{{URL::to('public/imgs/pdf.png')}}" style="    height: 25px;
               margin-top: -08px;" alt="image not found">
                    </a></li>
            </ul>
        </div>
        <br>
        <div style="
                font-size: 13px;
                font-family: " Open Sans",Arial,sans-serif; color: #444; ">
                
          <button data-toggle="modal" data-target="#myModal-ask_for_price"  class="btn-theme">Ask For Price </button>

            <button onclick="location.href='{{URL::to('/category/selected')}}/{{$selectedCat}}'" style="margin-left:3px;" class="btn-theme">Back To Review</button>

            @if($next)

            <a class="desktop" href="{{URL::to('/')}}/{{$machine_name}}/{{$next}}/next" autofocus><button class="btn-theme"> Next Machine </button> </a>

            @else
            <button class="desktop" onclick="location.href='{{URL::to('/used-tetra-pak-machines')}}'" class="btn-theme">All Products</button>

            @endif
        </div>
    </div>
</div>

<!-- Modal -->
<div style="margin-top: 40px;" class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" style="height:586px;width:763px">


        <div class="modal-header" style="border:none;">
            <button type="button" class="close" data-dismiss="modal" style="color:#034375;font-weight:bold;font-size:30px;opacity:1;background-color: white;border-radius: 10px;position: absolute;z-index:1;margin-top: 17px;margin-left: 730px"><span>&times;</span><span class="sr-only">Close</span></button>


        </div>

        <div class="modal-content" style="  height:586px;width:763px">

            <div class="modal-body" style="padding:0px;height
            :auto">


                <div id="myCarousel4" class="carousel slide" data-ride="carousel" data-interval="100000000" style="height:586px;width:763px">
                    <!-- Indicators -->

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner " style="height:586px;width:763px;border:10px solid white">
                        <div class="item active">

                            <img style="width:763px;height: 586px" class="model-images" src="{{URL::to('storage/app/products/'.$product->image)}}">
                        </div>
                        @php
                        $allThumbs = App\Thumbs::where("org_id",$product->id)->get();
                        @endphp

                        @foreach($allThumbs as $thumb)
                        <div class="item">
                            <img src="{{URL::to('storage/app/products/'.$thumb->file_name)}}" class="img-responsive" style="width:763px;height: 586px">

                        </div>
                        @endforeach
                    </div>
                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel4" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel4" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

            </div>
        </div>
        <div class="modal-footer">
            <center>
                <div style="background-color:#034375;color:white;font-size: 11px;border:2px solid white;border-radius: 20px;padding:4px;float: none " class="col-sm-6">{{$product->pr_title}}</div>
            </center>
        </div>

    </div>
</div>
</div>


<!-- Modal -->
<div style="margin-top: 40px" class="modal fade" id="myModalbig" role="dialog">

    <div class="modal-dialog" style="height:586px;width:763px">


        <div class="modal-header" style="border:none;">
            <button type="button" class="close" data-dismiss="modal" style="color:#034375;font-weight:bold;font-size:30px;opacity:1;background-color: white;border-radius: 10px;position: absolute;z-index:1;margin-top: 17px;margin-left: 730px"><span>&times;</span><span class="sr-only">Close</span></button>


        </div>

        <div class="modal-content" style="  height:586px;width:763px">

            <div class="modal-body" style="padding:0px;height
            :auto">


                <div id="myCarousel3" class="carousel slide" data-ride="carousel" data-interval="100000000" style="height:586px;width:763px">
                    <!-- Indicators -->

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner " style="height:586px;width:763px;border:10px solid white">
                        <div class="item active">

                            <img style="width:763px;height: 586px" class="model-images" src="{{URL::to('storage/app/products/'.$product->image)}}">
                        </div>
                        @php
                        $allThumbs = App\Thumbs::where("org_id",$product->id)->get();
                        @endphp

                        @foreach($allThumbs as $thumb)
                        <div class="item">
                            <img src="{{URL::to('storage/app/products/'.$thumb->file_name)}}" class="img-responsive" style="width:763px;height: 586px">

                        </div>
                        @endforeach
                    </div>
                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel3" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel3" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

            </div>
        </div>
        <div class="modal-footer">
            <center>
                <div style="background-color:#034375;color:white;font-size: 11px;border:2px solid white;border-radius: 20px;padding:4px;float: none " class="col-sm-6">{{$product->pr_title}}</div>
            </center>
        </div>

    </div>
</div>
</div>
{{-- Model Code Ends--}}



<!-- Modal -->
<div class="modal fade" id="myModal-ask_for_price" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="color: #FBCA01;background-color:#034375;font-weight:bolder;">
      <button type="button" style="background-color:#fbca01;color:#034375;float:right;border-radius:20px;"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p class="modal-title" id="myModalLabel" style=""> {{$product->pr_title}}</p>
      </div>
      
                  <!--<p style="background: linear-gradient(90deg, #FBCA01 0%,#FBCA01 100%);color:#034375;padding:8px;font-weight:bolder;">-->
                  <!--  USM-Used Sweden Machines</br>-->
                  <!--  83-A, S.I.E # 1,</br>-->
                  <!--  Gujranwala Pakistan</br>-->
                  <!--  Tel.: +92 (321) 7415373</br>-->
                  <!--  E-Mail: info@usedswedenmachines.com</p>       -->
<form action="{{route('QuoteFormSubmit',$product->id)}}" style="padding:10px;" method="POST" id="ask-for-price-form">
                    @csrf
                     <input type="hidden" name="token" >
      <div class="modal-body">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 label-heading" >
                <p >Item #</p>
            </div>
             <div class="col-lg-9 col-md-9 col-sm-12 ">
                <input name="serial_no"  type="text"  value="{{$product->SKU}}" readonly="" class="col-lg-9 form-control" style="text-align:center">
            </div>
            
             <div class="col-lg-3 col-md-3 col-sm-12 label-heading">
                <p>Machine Name</p>
            </div>
             <div class="col-lg-9 col-md-9 col-sm-12">
                <input name="machine_name" type="text"   value="{{$product->pr_title}}" readonly="" class="col-lg-9 form-control">
            </div>
         
             <div class="col-lg-3 col-md-3 col-sm-12 label-heading">
                <p>Full Name</p>
            </div>
             <div class="col-lg-9 col-md-9 col-sm-12">
               <input name="full_name" type="text"  class="col-lg-9 form-control" required>
            </div>
            
            
            
              <div class="col-lg-3 col-md-3 col-sm-12 label-heading">
                <p>Phone No</p>
            </div>
             <div class="col-lg-9 col-md-9 col-sm-12">
             <input name="phone" type="text"    class="col-lg-9 form-control" required>
            </div>
                <div class="col-lg-3 col-md-3 col-sm-12 label-heading">
                <p>Email<span style="color:red">*</span></p>
            </div>
             <div class="col-lg-9 col-md-9 col-sm-12">
               <input name="email" type="email"    class="col-lg-9 form-control" required>
            </div>
              <div class="col-lg-3 col-md-3 col-sm-12 label-heading">
                <p>Company</p>
            </div>
             <div class="col-lg-9 col-md-9 col-sm-12">
             <input name="company" type="text"   class="col-lg-9 form-control" required>
            </div>
            
              <div class="col-lg-3 col-md-3 col-sm-12 label-heading">
                <p>Special Request</p>
            </div>
             <div class="col-lg-9 col-md-9 col-sm-12">
            <textarea name="request" placeholder="Please, contact regarding this machine"   cols="31" class="col-lg-9 form-control" required></textarea>
            </div>
            
        </div>
      </div>
         
      <div class="modal-footer">
        <button type="button" class="btn btn-default" style="color: #FBCA01;background-color:#034375;font-weight:bolder;" data-dismiss="modal">Close</button>
     
        <button name="quote_form" type="submit" style="color: #FBCA01;background-color:#034375;font-weight:bolder;" class="btn btn-default" id="Submit" name="submit" >Submit
        </button>
      </div>
       </form>
    </div>
  </div>
</div>


{{-- jQuery Starts--}}
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="./slick/slick.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    $(document).on('ready', function() {
        var val = $("#check-thumbs").val();
        if (val) {
            $("#slick").show();
        }


        $(".vertical-center-4").slick({
            dots: true,
            vertical: true,
            centerMode: true,
            slidesToShow: 5,
            slidesToScroll: 1
        });
        $(".vertical-center-3").slick({
            dots: true,
            vertical: true,
            centerMode: true,
            slidesToShow: 3,
            slidesToScroll: 3
        });
        $(".vertical-center-2").slick({
            dots: true,
            vertical: true,
            centerMode: true,
            slidesToShow: 2,
            slidesToScroll: 2
        });
        $(".vertical-center").slick({
            dots: true,
            vertical: true,
            centerMode: true,
        });
        $(".vertical").slick({
            dots: true,
            vertical: true,
            slidesToShow: 3,
            slidesToScroll: 3
        });
        $(".regular").slick({
            dots: true,
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3
        });
        $(".center").slick({
            dots: false,
            fade: false,
            slickUnfilter: false,
            infinite: true,
            centerMode: true,
            slidesToShow: 2,
            slidesToScroll: 1
        });
        $(".variable").slick({
            dots: true,
            infinite: true,
            variableWidth: true
        });
        $(".lazy").slick({
            lazyLoad: 'ondemand', // ondemand progressive anticipated
            infinite: true
        });
    });
    $(".main-image").on("click", function() {
        let image_source = $(this).attr("src");
        $(".model-images").attr("src", image_source);
    });
    $(".thumb-images").on("click", function() {
        let image_source = $(this).attr("src");
        $(".model-images").attr("src", image_source);
    });
</script>
{{-- jQuery Ends--}}

@endsection