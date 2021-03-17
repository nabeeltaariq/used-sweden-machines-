  @section('display-products/news')
   
   var nav_button = document.getElementById("nav-button-collapse");
        var navbar = document.getElementById("navbar");
        var sticky = navbar.offsetTop;
          document.getElementById("mobile-search-bar").classList.remove("mobile-search-bar");
    // document.getElementById("search-bar").classList.add("search-bar");
          navbar.classList.add("sticky");
          nav_button.classList.add("nav-button-collapse-scroll");
          document.getElementById("nav-logo").style.display = "block";

  @endsection
@extends("templates.public")
@section("sharing")
<style>
    
    .modal-body .form-control {
        border-radius: 0px;
    }a

    .modal-body {
        color: black;
    }

    .label-heading {

        margin-bottom: -10px;
        margin-top: 10px;
        color: black;
    }

    .carousel-control.left,
    .carousel-control.right {
        background-image: none !important;
        filter: none !important;
    }

    #description_box {
        background-color: #ddeef1;
        color: black;
        height: auto;
        overflow: auto;
        font-size: 12px;
        border: 2px solid #808080;
        height: 310px;
        margin-top: 12px;


    }

    #news-body {

        margin-top: -5px;

    }

    @media screen and (max-width: 765px) {
                    #search-bar, #small-search,#mobile-logo
            {
                display: none !important;
            }
#news-body
{
    margin-top: 80px !important;
}
        #slick,
        #bread-crumb,
        #myModalbig,
        .modal-backdrop.fade {
            display: none !important;
        }

        #news-body {

            margin-top: 10px;
            margin-right: 1px !important;
            margin-left: 1px !important;
        }

        #bread-crumb {
            display: none;
        }

        #description_box {

            height: auto !important;

            font-size: 12px;
            border: 2px solid #808080a6;
            margin-top: 10px;
        }

        #content {
            margin-left: -5px;
            width: 104%;
        }
    }


    .linked li a:hover {
        background: none;
    }


    .slider {
        width: 50%;
        margin: auto;
    }

    .slick-slide {
        margin: 0px;
        width: 132px !important;
        transition: all ease-in-out .3s;
    }

    .slick-slide img {
        width: 100%;
        max-height: 85px !important;
    }

    .slick-prev:before,
    .slick-next:before {
        color: black;

    }



    .slick-current {
        opacity: 1;
    }

    /* ==== Main CSS === */

    .shareButtons {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    #my-thumbs-list {
        overflow: auto;
        width: 400px;
        height: auto;

    }


    .shareButtons li {
        display: inline-block;
    }

    .shareButtons li a {
        display: inline-block;
        font-size: 30px;
        /* margin-right: 3px; */
        margin-right: -2px;
    }

    .btn-theme {


        display: inline-block;

        background-color: #034171;
        border-radius: 5px;
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, .3);
        font-size: 13px;
        font-family: "Open Sans", Arial, sans-serif;
        color: white;

    }

    h3 {
        font-size: 14px;
    }

    .btn-theme:hover {
        color: white;
        text-decoration: none;
    }

    .left
    }

    z-index: 9999 !important;
    }
  
</style>

<link rel="stylesheet" type="text/css" href="./slick/slick.css">
<link rel="stylesheet" type="text/css" href="./slick/slick-theme.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js">
</script>
<meta property="og:url" content="https://usedswedenmachines.com/news/{{$news->id}}" />
<meta property="og:type" content="article" />
<meta property="og:title" content="{{$news->news_title}}" />
<meta property="og:description" content="{{$news->news_des}}" />
<meta property="og:image" content="{{URL::to('public/img/logo.png')}}" />

@endsection
@section("content")

<div style="font-family:arial;font-size:11px;" id="bread-crumb">
    <a href="{{URL::to('/')}}" style="">Home</a>&nbsp;»&nbsp;<a href="{{URL::to('/news')}}">News</a></span>
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
    </style>
</div>
@php

if($news->image == null){

$url = URL::to('public/imgs/newsletter-icon.png');

}else{

$url = URL::to("/storage/app/products/$news->image");

}

@endphp
<div class="row" id="news-body">


    <div style="margin-top:12px;  " class="col-lg-6 col-md-6 col-sm-6 ">
        <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="100000000">
            <!-- Indicators -->

            <!-- Wrapper for slides -->
            <div class="carousel-inner border-class" style="height: 310px;">
                <div class="item active">


                    <img src="{{$url}}" data-toggle="modal" data-target="#myModalbig" class="img-responsive model-images" class="img-responsive" style="height:370px;width:100%;">
                    <img src="{{$url}}" class="img-responsive" style="height:370px;width:100%;">

                </div>
                @php
                $allThumbs = App\News_Image::where("news_id",$news->id)->get();
                @endphp

                @foreach($allThumbs as $thumb)
                <div class="item">


                    <img src="{{$url}}" data-toggle="modal" data-target="#myModalbig" class="img-responsive model-images" class="img-responsive" style="height:370px;width:100%;">
                    <img src="{{URL::to('/storage/app/products/'.$thumb->imageUrl)}}" class="img-responsive" style="height:370px;width:100%;">

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
                    <img class="main-image" style="border: 2px solid #034375;" src="{{$url}}">
                </button>
            </div>



            @php

            $allThumbs = App\News_Image::where("news_id",$news->id)->get();


            @endphp

            @foreach($allThumbs as $thumb)
            <div>
                <button data-toggle="modal" data-target="#myModal" style="border:none;outline:none;margin:0px;padding:0px;">

                    <img class="main-image" style="border: 2px solid #034375;" src="{{URL::to('/storage/app/products/'.$thumb->imageUrl)}}">
                </button>

            </div>
            @endforeach

            <input id="check-thumbs" type="hidden" value="{{$allThumbs}}">


        </section>

        {{-- Slick slider Code Ends--}}
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div id="description_box">
            <strong>{{$news->news_title}}</strong><Br />
            <strong>News #: </strong>&nbsp;&nbsp;&nbsp;{{$news->id}}<br />
            <strong>News Date</strong>&nbsp;&nbsp;&nbsp;

            {{$news->news_date}}<br />

            <strong>Description: </strong><br />
            @php
            echo html_entity_decode($news->news_des);
            @endphp
            <Br />

        </div>

        <div style="margin-top: 5px;">
            <ul class="shareButtons linked" style="margin-top: -4px;">
                <li><a href="http://www.facebook.com/sharer/sharer.php?u={{URL::to('/')}}/news/{{$news->id}}" target="_blank" style="color:#024374"><i class="fab fa-facebook-square"></i></a></li>


                <li> <a href="https://www.linkedin.com/shareArticle?mini=true&url={{URL::to('/')}}/news/by/{{$news->id}}&title={{$news->news_title}}&summary=Used Sweden Machines News&source=USM" target="_blank" style="color:white">
                        <i class="fab fa-linkedin" style="background: #0077b5;border-radius:2px;font-size:27px;padding-left:3px;padding-right:3px"></i>
                    </a></li>

                <!--<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=https://www.usedswedenmachines.com/news/{{$news->id}}&title={{$news->news_title}}&summary=Used Sweden Machines News&source=USM" style="color: white;background-color:#017bb5;heighr:20px;" target="_blank"><i class="fab fa-linkedin"></i></a></li>-->
                <li><a href="https://api.whatsapp.com/send?phone=923217415373&&text={{URL::to('/')}}/news/by/{{$news->id}}" target="_blank" style="color:#65bc54"><i class="fab fa-whatsapp-square"></i></a></li>
                <li><a href="mailto:info@usm.com.pk?subject={{$news->news_title}}Machine-Used%20Sweden%20Machines News&body=To%20Get%20Information%20About%20This%20News,%20Please%20Visit%20{{URL::to('/')}}/news/by/{{$news->id}}" target="_blank" style="color:#c15b53"><img src="{{URL::to('public/imgs/email.png')}}" alt="" style="heigt:25px;margin-top:-8px;max-height:25px;max-width:25.17px;min-width:25.17px;width:25.17px"></a></li>
                <li><a href="{{URL::to('/machine-pdf-news/generate')}}/{{$news->id}}" target="_blank" style="color:maroon">
                        <img src="{{URL::to('public/imgs/pdf.png')}}" style="    height: 25px;
               margin-top: -08px;" alt="image not found">
                    </a></li>


            </ul>
        </div>


        <br>
        <div style="
                font-size: 13px;
                font-family: " Open Sans,Arial,sans-serif; color: #444; " id="news-buttons">
                
              <a href=" {{URL::to('/news')}}" class="btn-theme"><button class="btn-theme" style="  padding: 4px;"> All News</button></a>
            @if($news->Next() != null)
            <a href="{{URL::to('/news/by')}}/{{$news->Next()->id}}" autofocus><button class="btn-theme" style="  padding: 4px;"> Next News </button> </a>

            @endif
        </div>
    </div>

</div>


<div style="margin-top: 20px;" class="modal fade" id="myModalbig" role="dialog">
    <div class="modal-dialog" style="height:486px;width:600px">


        <div class="modal-header" style="border:none;">
            <button type="button" class="close" data-dismiss="modal" style="color:#034375;font-weight:bold;font-size:30px;opacity:1;background-color: white;border-radius: 10px;position: absolute;z-index:1;margin-top: 17px;margin-left: 94%"><span>&times;</span><span class="sr-only">Close</span></button>


        </div>

        <div class="modal-content" style=" height:486px;width:600px">

            <div class="modal-body" style="padding:0px;height
            :auto">


                <div id="myCarousel4" class="carousel slide" data-ride="carousel" data-interval="100000000" style="height:486px;width:600px">
                    <!-- Indicators -->

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner " style="height:486px;width:600px;border:10px solid white">
                        <div class="item active">

                            <img style="height:486px;width:600px" class="model-images" src="{{$url}}">
                        </div>
                        @php
                        $allThumbs = App\News_Image::where("news_id",$news->id)->get();
                        @endphp

                        @foreach($allThumbs as $thumb)
                        <div class="item">
                            <img src="{{URL::to('/storage/app/products/'.$thumb->imageUrl)}}" class="img-responsive" style="height:486px;width:600px">

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
                <div style="background-color:#034375;color:white;font-size: 11px;border:2px solid white;border-radius: 20px;padding:4px;float: none " class="col-sm-6">{{$news->news_title}}</div>
            </center>
        </div>

    </div>
</div>



<!-- Modal -->
<div style="margin-top: 20px;" class="modal fade" id="myModal" role="dialog">

    <div class="modal-dialog" style="height:height:486px;width:600px">


        <div class="modal-header" style="border:none;">
            <button type="button" class="close" data-dismiss="modal" style="color:#034375;font-weight:bold;font-size:30px;opacity:1;background-color: white;border-radius: 10px;position: absolute;z-index:1;margin-top: 17px;margin-left: 94%"><span>&times;</span><span class="sr-only">Close</span></button>


        </div>

        <div class="modal-content" style=" height:486px;width:600px">

            <div class="modal-body" style="padding:0px;height
            :auto">


                <div id="myCarousel3" class="carousel slide" data-ride="carousel" data-interval="100000000" style="height:486px;width:600px">
                    <!-- Indicators -->

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner " style="height:486px;width:600px;border:10px solid white">
                        <div class="item active">

                            <img style="height:486px;width:600px" class="model-images" src="">
                        </div>
                        @php
                        $allThumbs = App\News_Image::where("news_id",$news->id)->get();
                        @endphp

                        @foreach($allThumbs as $thumb)
                        <div class="item">
                            <img src="{{URL::to('/storage/app/products/'.$thumb->imageUrl)}}" class="img-responsive" style="height:486px;width:600px">

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
                <div style="background-color:#034375;color:white;font-size: 11px;border:2px solid white;border-radius: 20px;padding:4px;float: none " class="col-sm-6">{{$news->news_title}}</div>
            </center>
        </div>

    </div>
</div>
{{-- Model Code Ends--}}





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