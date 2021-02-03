@extends("templates.public")
@section("content")
               
<a href="{{URL::to('/')}}">Home</a>>><a href="{{URL::to('/news')}}">News</a>>><a href="{{URL::to('/news?news_type=events')}}">Events</a>
   <br/> 
   <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6">
            @php
               
                    $url = URL::to("/storage/app/event/$event->featuredImage");
               
            @endphp
            <img class="mainImage" src="{{$url}}" alt="" style="max-height:250px;max-width:420px;border:2px solid blue">
            <div style="margin:10px 30px 0px 0px;">
                <div class="owl-carousel owl-theme">
                    
                    @foreach($pictures as $thumb)
                    <div class="item">
                    <img class="thumb" src="{{URL::to('/storage/app/event/')}}/{{$thumb->pictureurl}}" alt="" style="min-height:75px;max-height:75px;border:2px solid blue;cursor:pointer">
                    </div>
                    @endforeach
                    
                </div>
               @if(count($pictures) >= 1)
                *drag the images to scroll
                @endif
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6">
            <div style="background-color:#ddeef1;min-height:260px;max-height:260px;overflow:auto">
                
                <strong>Event #: </strong>&nbsp;&nbsp;&nbsp;{{$event->eventId}}<br/>
                <strong>Event Date</strong>&nbsp;&nbsp;&nbsp;
                {{$event->dateofevent}}<br/>
                {{$event->eventName}}

                <Br/>
                @php
                    echo html_entity_decode($event->eventDescription)
                @endphp
            </div>
            <div>
               <ul class="shareButtons">
                   <li><a href="" style="color:#034375"><i class="fab fa-facebook-square"></i></a></li>
                   <li><a href="" style="color:maroon"><i class="fas fa-envelope"></i></a></li>
                   <li><a href="" class="text-success"><i class="fab fa-whatsapp-square"></i></a></li>
                   <li><a href=""><i class="fab fa-linkedin"></i></a></li>
               </ul>
            </div>
            <br/>
            <div>
               
               
                
                <a href="{{URL::to('/news?news_type=events')}}" class="btn-theme">All Events</a>
                {{-- @if($news->Next() != null)
                <a href="{{URL::to('/news/')}}/{{$news->Next()->id}}" class="btn-theme">Next News</a>
                @endif --}}
            </div>
        </div>
    </div>
<style>
.shareButtons{
    list-style-type:none;
    margin:0;
    padding:0;
}
.shareButtons li{
    display:inline-block;
}

.shareButtons li a{
    display:inline-block;
    font-size:35px;
    margin-right:3px;
}
.btn-theme{
  
    display: inline-block;
    padding: 5px 20px;
    background-color: #034375;
    color: white;
    border-radius: 5px;
    box-shadow: 2px 2px 2px #ccc;
    margin: 0px 10px 30px 0px;

}

.btn-theme:hover{
    color:white;
    text-decoration:none;
}
</style>
<script>
$('.owl-carousel').owlCarousel({
    loop:false,
    margin:4,
    nav:true,
    responsive:{
        0:{
            items:5
        },
        600:{
            items:5
        },
        1000:{
            items:5
        }
    }
})

$(".thumb").on("click",function(){

   let src = $(this).attr("src");
    $(".mainImage").attr("src",src);
});
</script>
@endsection