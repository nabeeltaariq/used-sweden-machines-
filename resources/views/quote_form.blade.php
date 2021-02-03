@extends("templates.public")

@section("content")

                @php

                   $category = App\Catagories::find($product->cat_id);

                  

                @endphp

                <div style="font-family:arial;font-size:11px">

    <a href="{{URL::to('/')}}" style="">Home</a>&nbsp;»&nbsp;<a href="#">{{$category->name}}</a>&nbsp;»&nbsp;<span>{{$product->pr_title}}</span>

     <style>

         a{

             color:#034375;

         }

     </style>    

 </div>

  

   <div class="row">

        <div class="col-xl-6 col-lg-6 col-md-6">

            <img class="mainImage" src="{{URL::to('/storage/app/products/')}}/{{$product->image}}" alt="" style="max-height:250px;border:2px solid #034375">

            <div style="margin:10px 30px 0px 0px;">

                <div class="owl-carousel owl-theme">

                    @php

                    $allThumbs = App\Thumbs::where("org_id",$product->id)->get();    



                    @endphp

                    @foreach($allThumbs as $thumb)

                    <div class="item">

                    <img class="thumb" src="{{URL::to('/storage/app/products/')}}/{{$thumb->file_name}}" alt="" style="min-height:75px;max-height:75px;border:2px solid #034375;cursor:pointer">

                    </div>

                    @endforeach

                    

                </div>

               @if(count($allThumbs) >= 1)

                *drag the images to scroll

                @endif

            </div>

        </div>

        <div class="col-xl-6 col-lg-6 col-md-6">

            <div style="min-height:260px;max-height:360px;overflow:auto">

                <table style="border: 2px double #eee;width:100%;font-size:13px;font-family:arial">
                    @if(isset($messageFlush))
                        <div class="col md-12" style="font-weight:bold; color :#034375;">
                            {{$messageFlush }}
                        </div>
                    @endif
                    <tbody><tr style="background-color: #f3f9fa;"><td colspan="2"><b style="color:#034375;background-color:#e8f3f5;display:block">USM-Used Sweden Machines</b>

                      

                      <p style="background-color:#e8f3f5;margin-bottom:0px">Tel: +92 (321) 7415373</p>

                      <p style="background-color:#e8f3f5;margin: 0 0 1px;">Email: <a style="font-weight:bolder;color: #034375;" href="mailto:info@usedswedenmachines.com" style="">info@usedswedenmachines.com</a></p></td></tr>

                </tbody></table>

                

                <form action="{{route('QuoteFormSubmit',$product->id)}}" method="POST">
                    @csrf

                <table style="width:100%;font-family:arial;font-size:12px;margin-top:1px">

                             

                    <tbody><tr style="background-color: #f3f9fa;">

                      <td width="110" height="22" align="left" valign="top"><div align="left"><span class="kontakt-form-text">Machine Name:</span> </div></td>

                        <input type="hidden" name="token" id="token">


                    <td height="22" colspan="2" align="left" valign="top"><input name="machine_name" type="text" class="kontakt-text" id="machine_name" style="width:100%;outline:none" size="30" value="{{$product->pr_title}}" readonly=""></td>

                    </tr>

                    <tr style="background-color: #f3f9fa;;">

                      <td width="110" height="22" align="left" valign="top"><div align="left"><span class="kontakt-form-text">Item #:</span> </div></td>

        

                    <td colspan="2" style="background-color: #f3f9fa;" height="22" align="left" valign="top"><input name="serial_no" style="width:100%;outline:none" type="text" class="kontakt-text" id="serial_no" size="30" value="{{$product->SKU}}" readonly=""></td>

                    </tr>

                    <tr style="background-color: #f3f9fa;">

                      <td width="110" height="22" align="left" valign="top"><div align="left"><span class="kontakt-form-text">Email ID:</span> </div></td>

        

                      <td height="22" colspan="2" align="left" valign="top"><input name="email" style="width:100%;outline:none" type="email" class="kontakt-text" id="email" size="30" value="" required=""></td>

                    </tr>

                    <tr style="background-color: #f3f9fa;">

                      <td width="110" height="22" align="left" valign="top"><div align="left"><span class="kontakt-form-text">Phone #:</span> </div></td>

        

                      <td height="22" colspan="2" align="left" valign="top"><input name="phone" style="width:100%;outline:none" type="text" class="kontakt-text" id="phone" size="30" value="" required=""></td>

                    </tr>

                    <tr style="background-color: #f3f9fa;">

                      <td width="110" height="22" align="left" valign="top"><div align="left"><span class="kontakt-form-text">Full Name:</span> </div></td>

        


                      <td height="22" colspan="2" align="left" valign="top"><input name="full_name" type="text" class="kontakt-text" style="width:100%;outline:none" id="full_name" size="30" value=""></td>

                    </tr>

                    

                    <tr style="background-color: #f3f9fa;">

                      <td width="110" height="22" align="left" valign="top"><div align="left"><span class="kontakt-form-text">Company:</span> </div></td>

        


                      <td height="22" colspan="2" align="left" valign="top"><input name="company" style="width:100%" type="text" class="kontakt-text" id="company" size="30" value=""></td>

                    </tr>             

                    

                

                    <tr style="background-color: #f3f9fa;">

                      <td width="110" height="22" align="left" valign="top"><div align="left"><span class="kontakt-form-text">Special Request:</span> </div></td>

        

                      <td height="22" colspan="2" align="left" valign="top"><textarea name="request" class="kontakt-text" id="request" style="width:100%;outline:none" cols="31">Please, contact regarding this machine</textarea></td>

                    </tr>

                    

                    <tr align="left" valign="bottom">

                      <td width="110" align="left" valign="top"></td>

                      

                      <td>

                         

                        <input name="quote_form" type="submit" class="kontakt_btn" id="Submit" style="height:30px;width:75px;font-size: 13px;font-weight: bolder;" value="Submit">
                      </td>

                    </tr>

          

                  

                </tbody></table>

                </form>

            </div>

           

            <br/>

            <div style="
            font-size: 13px;
                margin: 10px 30px 0% 35px;
                font-family: "Open Sans",Arial,sans-serif;
                color: #444;
        ">

                <button onclick="location.href='{{URL::to('/machine')}}/{{$product->id}}'" class="btn-theme">Ask For Price </button>
                <button onclick="location.href='{{URL::to('/used-tetra-pak-machines')}}'" class="btn-theme">Back To Review</button>
                @if($next != null)
                    <button style="
                background: #034375;
                border-radius: 5px;
                box-shadow: 0 0 20px 0 rgba(0,0,0,.3);
                /* margin-right: 0px; */
            " onclick="location.href='{{URL::to('/')}}/{{$next}}'" class="btn-theme"> Next Machine </button>
                @else

                    <button onclick="location.href='{{URL::to('/used-tetra-pak-machines')}}'" class="btn-theme">All Products</button>

                @endif
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
    padding: 3px 15px;
    background-color: #034171;
    border-radius: 5px;
    box-shadow: 0 0 20px 0 rgba(0,0,0,.3);
    font-size: 13px;
    font-family: "Open Sans",Arial,sans-serif;
    color: white;



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