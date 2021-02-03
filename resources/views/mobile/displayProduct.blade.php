@extends("mobile.templates.public")

@section("content")
@php
$category = App\Catagories::find($product->cat_id);

@endphp
<div class="container">
<h4 style="color: #024374;">{{$product->pr_title}}</h4>
</div>
<div class="row" style="margin-top:5px">

    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <center>
            <img class="mainImage" src="{{URL::to('/storage/app/products/')}}/{{$product->image}}" alt="" style="max-height: 310px;
            border: 2px solid #034375;max-width: 100%;min-width: 300px;height:auto" class="img-fluid"></center>
        <div style="margin:10px 30px 0px 0px;">
            <center>
                <div class="slickClass ml-4">

                    @php

                    $allThumbs = App\Thumbs::where("org_id",$product->id)->get();



                    @endphp

                    @foreach($allThumbs as $thumb)

                    <div class="item">
                        <a href="{{URL::to('/storage/app/products/')}}/{{$thumb->file_name}}" data-lightbox="example-set" data-title="Use right left arrow keys to move next and previous">
                            <img class="thumb" src="{{URL::to('/storage/app/products/')}}/{{$thumb->file_name}}" alt="" style="min-height:75px;max-height:75px;border:2px solid #034375;cursor:pointer">
                        </a>
                    </div>

                    @endforeach
                </div>
            </center>

        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6">

        <center>
            <div>
                <ul class="shareButtons" style="margin-top: -4px;">
                    <li><a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u={{URL::to('/')}}/machineView/{{$product->id}}" style="color:#024374"><i class="fab fa-facebook-square"></i></a></li>
                    <li><a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url={{URL::to('/machineView/')}}/{{$product->id}}&title={{$product->pr_title}}&summary=Tetra%20Pak%20Machines&source=USM" style="color: #017bb5"><i class="fab fa-linkedin"></i></a></li>
                    <li><a href="whatsapp://send?text={{URL::to('/machineView')}}/{{$product->id}}" style="color:#65bc54"><i class="fab fa-whatsapp-square"></i></a></li>
                    <li><a href="mailto:?subject={{$product->pr_title}}-Used Sweden Machines&body=To%20Get%20Information%20About%20This%20Machine,%20Please%20Visit%20{{URL::to('/machineView/')}}/{{$product->id}}%20" style="color:#c15b53"><img src="{{URL::to('/public/imgs/email.png')}}" alt="" style="heigt:25px;margin-top:-8px;max-height:25px;max-width:25.17px;min-width:25.17px;width:25.17px"></a></li>

                    <li><a href="{{URL::to('/machine-pdf')}}/{{$product->id}}" target="_blank" style="color:maroon">
                            <img src="{{URL::to('/public/imgs/pdf.png')}}" style="    height: 25px;
               margin-top: -08px;" alt="image not found">
                        </a></li>
                </ul>
            </div>
        </center>
        <center>
            <div style="font-size: 13px;margin: 10px 7%;color: #444;font-family:Arial, Helvetica, sans-serif">
                <button class="btn-theme" data-toggle="modal" data-target="#myModal">Machine Info</button>
                    <button onclick="location.href='{{URL::to('/used-tetra-pak-machines')}}'" style="margin-left:3px;" class="btn-theme">Back To Review</button>
                    <!-- @if($next != null)
                <button onclick="location.href='{{URL::to('/')}}/{{$next}}'" class="btn-theme"> Next Machine </button>
                @else
                <button onclick="location.href='{{URL::to('/used-tetra-pak-machines')}}'" class="btn-theme">All Products</button>
                @endif -->
            </div>
        </center>
    </div>
</div>
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Machine Info</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div style="background-color: #ddeef1;
            min-height: 310px;
            max-height: 310px;

            overflow: auto;
            font-size: 12px;
            border: 2px solid #808080a6;">
                    <strong>{{$product->pr_title}}</strong><Br />
                    <strong>Item #: </strong>&nbsp;&nbsp;&nbsp;{{$product->SKU}}<br />
                    <strong>Category</strong>&nbsp;&nbsp;&nbsp;
                    @php

                    echo $category->name;
                    @endphp
                    <Br />

                    @php
                    echo html_entity_decode($product->long_des)
                    @endphp
                </div>
            </div>

        </div>
    </div>
</div>
<style>
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
        padding: 3px 15px;
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
</style>
<script>
    $('.owl-carousel').owlCarousel({
        loop: false,
        margin: 4,
        nav: true,
        responsive: {
            0: {
                items: 5
            },
            600: {
                items: 5
            },
            1000: {
                items: 5
            }
        }
    })

    $(".thumb").on("click", function() {

        let src = $(this).attr("src");
        $(".mainImage").attr("src", src);
    });

    $("#my-thumbs-list").mCustomScrollbar({
        scrollButtons: {
            enable: true
        }
    });
</script>
@endsection