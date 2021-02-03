@extends("templates.public")
@section("content")

<style>
    
        .tagline{
            width:100%;
            margin-top:4px;
            margin-bottom:5px;
            background-color:#e8e8e8;
        }

        .tagline .heading{
            width:100%;
            padding:7px 14px;
            background-color:#999;
            color:white;
        }
        .tagline .content{
            padding:7px 14px;
        }

        .latestOffers{
            margin-top: 4px;
            padding: 10px;
            font-family: arial;
            font-size: 14px;
            background: linear-gradient(90deg, #FBCA01 0%,#FBCA01 100%);
            display:inline-block;
            font-weight:bolder;
            color:#034375;
            margin-bottom:3px;
        }
        .projects{
            font-size:18px;
        }
        .subscribeButton{
            background: #034375;
            width: 100px;
            height: 28px;
            color: #fff;
            cursor: pointer;
            border-radius: 5px;
            box-shadow: 0 0 20px 0 rgba(0,0,0,.3);
        }
        
      .mobile_welcome
        {
            display:none;
            
        }
        .desktop_welcome
        {
            display: inherit;
           margin-top:10px;
        }
       
     
 
      @media screen and (max-width: 765px) 
    {
          
        .desktop_welcome
        {
            
            display:none;
        }
         
        .mobile_welcome
        {
            display: inherit;
           margin-top:10px !important;
        }
    }
        
        ul.mobile_products{
    list-style-type:none;
    margin:0;
    padding:0;

}

ul.mobile_products li{
    display:block;
}

ul.mobile_products li a{
    display: block;
    margin-bottom: 3px;
    font-size: 18px;
    font-weight: bolder;
    color: #015292;
}
ul.mobile_products li a:hover{
    display: block;
    margin-bottom: 3px;
    font-size: 18px;
    font-weight: bolder;
    color: #015292;
    background-color:#ffff;
}
   
    </style>

    <div class="row desktop_welcome" id="desk" >
        <div class="col-lg-4 col-md-4 col-sm-6" style="padding-right:0px;">
          
            <div class="tagline">
                <div class="heading" style="font-family:arial;font-size:13px">
                    Used Sweden Machines Services
                </div>
                <div class="content">
                    <ul style="font-family:arial;font-size:13px;padding-left:10px">
                        <li>Buy and Sell Used Tetra Pak Machines</li>
                        <li>Tetra Pak Machines Spare parts</li>
                        <li>Technical Services</li>
                    </ul>
                </div>
            </div>
            <p class="projects">
                <strong style="font-size:14px;font-weight:bolder;color: #034375;">International Projects</strong>
                <img height="176px;" src="{{URL::to('public/imgs/Capture.PNG')}}" style="width:100%">
            </p>
          
            <p style="font-size:13px;font-family:arial">
                Subscribe for Newsletter!<br/>
            <form action="" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="email" name="email" placeholder="Enter your Email" size="20" required/>
                <input type="submit" value="Subscribe"  class="subscribeButton">
                <br/>
                @if(isset($message))

                    {{$message}}

                @endif
            </form>
            </p>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-6" >
            <?php
            $featuredProducts = App\Product::where("is_feature",1)->get();

            ?>
            <h3 style="font-family: arial;
                font-size: 14px;
                font-weight: bolder;
                background-color: #fbca01;
                display: inline-block;
                padding: 8px;
                color:#034375;
                margin-top: 4px;">Latest Offers</h3>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">

                        <span>
                            <?php

                            $firstMachineurl = null;
                            $fistMachineTitle = $featuredProducts[0]->pr_title;
                            $fistMachineTitle = str_replace("®",'',$fistMachineTitle);
                            $tokens = explode(" ",$fistMachineTitle);
                            $firstMachineurl = implode("-",$tokens);
                            $machine_name= strtoupper( preg_replace('/[^a-z0-9]+/', '-', strtolower(trim($featuredProducts[0]->pr_title))));
                            ?>
                            </span>
                    <p id="web" style="text-align: justify; padding:0px;margin-bottom:0px">
                        <a  href="{{URL::to('/')}}/{{$machine_name}}/{{$featuredProducts[0]->id}}">
                            <img src="{{URL::to('storage/app/products/')}}/{{$featuredProducts[0]->image}}" style="width:100%;height:250px;border:2px solid #034375">
                        </a>
                        <a href="{{URL::to('/')}}/{{$machine_name}}/{{$featuredProducts[0]->id}}" style="color:black">
                            <strong style="font-family:arial;font-size:13px;display:block;margin-top:10px">{{$featuredProducts[0]->pr_title}}</strong>
                        </a>

                    <p style="margin:0px;font-size:13px;font-family:arial;line-height:20px;text-align:justify;">{{$featuredProducts[0]->short_des}} <a id="web" href="{{URL::to('/')}}/{{$machine_name}}/{{$featuredProducts[0]->id}}" style="color:#034375;">read more</a></p>

                    </p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">

                    <?php

                    $firstMachineurl = null;
                    $fistMachineTitle = $featuredProducts[1]->pr_title;
                    $fistMachineTitle = str_replace("®",'',$fistMachineTitle);
                    $tokens = explode(" ",$fistMachineTitle);
                    $firstMachineurl = implode("-",$tokens);
                    $machine_name= strtoupper( preg_replace('/[^a-z0-9]+/', '-', strtolower(trim($featuredProducts[1]->pr_title))));
                    ?>
                    <a  href="{{URL::to('/')}}/{{$machine_name}}/{{$featuredProducts[1]->id}}">
                        <img src="{{URL::to('storage/app/products/')}}/{{$featuredProducts[1]->image}}" style="width:100%;height:250px;border:2px solid #034375">
                    </a>
                    <p id="web" style="text-align: justify; padding:0px;margin-bottom:0px">
                        <a style="color:black;" href="{{URL::to('/')}}/{{$machine_name}}/{{$featuredProducts[1]->id}}">
                            <strong style="font-family:arial;font-size:13px;display:block;margin-top:5px">{{$featuredProducts[1]->pr_title}}</strong>
                        </a>
                    <p style="margin:0px;font-size:13px;font-family:arial;line-height:20px;text-align:justify;">{{$featuredProducts[1]->short_des}} <a id="web" href="{{URL::to('/')}}/{{$machine_name}}/{{$featuredProducts[1]->id}}" style="color:#034375;">read more</a></p>

                    </p>
                </div>
            </div>
        </div>
        
        
    </div>
    
    
    
  

<button style="display:none;" id="m" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Open modal for @getbootstrap
</button>

<div class="modal fade"  id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content"  >
      <div class="modal-header"style="background-color:#034375;color:#fbca01;"  >
       
        <h4 class="modal-title"  id="exampleModalLabel">Newsletter</h4>
      </div>
      <div class="modal-body form-group" style="   margin-bottom: -10px;top:-10px;">
           <button type="button" style="background-color:#fbca01;color:#034375;float:right;border-radius:20px;"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div class="form-group">
                <form  action="" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
               
                
                <br/>
               
            </form>
               <h3 style="color:#034375;"  align="center"> Subscribe Now</h3>
          
         <input  align="center" class="form-control" type="email" name="email" placeholder="Enter your Email" required/>
              @if(isset($message))

                    {{$message}}

                @endif
          </div>
        
      </div>
      <!--background-color: #034375;-->
      <div class="modal-footer" style="background-color:#034375;">
      
       <input type="submit" value="Subscribe"  class="btn btn-primary" style="background-color:#fbca01;color:#034375;">
      </div>
    </div>
  </div>
</div>



 
    <div class="mobile_welcome" style="margin-top:40px;">
    <ul class="mobile_products" align="right">
<li><a href="{{URL::to('/used-tetra-pak-machines')}}/?cat_id=All">All Machines ({{$totalMachines ?? ''}})</a></li>
    @foreach($statistics ?? '' as $stat)

        <li><a href="{{URL::to('/used-tetra-pak-machines')}}/?cat_id={{$stat['id']}}">{{$stat["name"]}} ({{$stat["totalProducts"]}})</a></li>

    @endforeach
</ul>
</div>


<script >
 window.onload=  zE(function() {
zE.activate();
});


    var reloading = sessionStorage.getItem("reloading");
    if (reloading) {

       
    }
    else
    {
           
            
         setTimeout(function ()
  {
     $('#m').click();
  }, 10000);

 
              sessionStorage.setItem("reloading", "true");
              
                    
    }


   
  $("input[name='search']").on("keyup",function(){

        let val = $(this).val();
        $(".mobile_products li").each(function(index,listitem){

          let data = listitem.childNodes[0].innerHTML;
        
            if(data.toUpperCase().indexOf(val.toUpperCase()) >= 0){
                listitem.style.display = "block";
            }else{
                listitem.style.display = "none";
            }


        });

    }); 
   
</script>
    
@endsection
