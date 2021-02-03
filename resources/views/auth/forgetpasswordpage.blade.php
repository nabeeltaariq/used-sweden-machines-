@extends("templates.public")
@section("content")
<br/>
<div id="forget-pass-body">
        <h3 style="
    font-weight:bold;
     display: block;
     font-family: 'arial';
     display:inline-block;
     font-size:14px;
     background: #b43720;
     background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…IgaGVpZ2h0PSIxIiBmaWxsPSJ1cmwoI2dyYWQtdWNnZy1nZW5lcmF0ZWQpIiAvPgo8L3N2Zz4=);
     background: -moz-linear-gradient(90deg, #b43720 0%, #e94541 100%);
     background: -webkit-gradient(linear, left bottom, right top, color-stop(0%,#b43720), color-stop(100%,#e94541));
     background: -webkit-linear-gradient(90deg, #b43720 0%,#e94541100%);
     background: -o-linear-gradient(90deg, #b43720 0%,#e94541 100%);
     background: -ms-linear-gradient(90deg, #b43720 0%,#e94541 100%);
     background: linear-gradient(90deg, #FBCA01 0%,#FBCA01 100%);
     filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b43720', endColorstr='#e94541',GradientType=1 );
    
     color: #034b84;
    
     line-height: 30px;
     padding: 0px 14px;
     position: relative;
    ">Forget USM password?</h3>
    <p>
        Please enter your email to get your password it is just one click confirmation and you will get your password in your email
    </p>
    <form action="forget-password" method="post">
        Enter your email <input type="text" name="Email" id="Email" required>
        <input type="submit" value="Get Password" class="btn-theme">
    </form>
    <br/>
    @if(isset($type))
        @if($type == "success")
            <div class="alert alert-success">An Email has been sent to your email {{$request->Email}} containing password of this email after getting password you may click <a href="{{URL::to('/auth')}}">Here</a></div>
        @else
            <div class="alert alert-danger">Sorry This email not exists in our system but you can sign up with this email by clicking <a href="{{URL::to('/auth')}}">Here</a></div>
        @endif

    @endif

</div>


    <style>
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
           @media only screen and (max-width: 416px) {
    #forget-pass-body{
        margin-top:-20px ;
        margin-left:10px ;
        margin-right:10px ;
        
    }
    </style>
@endsection