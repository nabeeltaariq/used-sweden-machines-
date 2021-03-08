@extends("templates.public")
@section("content")
<style>
    .form-control
    {
        height:28px;
        
    }
    .row
    {
        margin-top:-8px;
    }
         #existing-customer{
        padding-left:50px;
    } 
    #existing-customer form{
       margin-top:-40px;
    }
    @media only screen and (max-width: 770px) {
    #register-new{
        padding-left:50px;
    } 
    @media only screen and (max-width: 600px) {
    .row{
        margin-top:20px;
           margin-right:40px !important;
           width:70%;
    }
    #existing-customer,#register-new
    {
     padding-right:50px;
    }
          

            #search-bar
            {
                display: none !important;
            }
               #small-search
            {
                display: none !important;
            }

    }
   /*@media only screen and (max-width: 620px) {*/
   /*    .border-end*/
   /*    {*/
   /*        border:none !important;*/
   /*    }*/
   /*   .set*/
   /*   {*/
   /*       background-color:white !important;*/
   /*   }*/
   /*   .row*/
   /*   {*/
   /*        background-color:white !important;*/
   /*   }*/
   /*    .table , h3*/
   /*   {*/
   /*        background-color:white !important;*/
   /*   }*/
   /*     .back*/
   /*   {*/
   /*        background-color:white !important;*/
   /*   }*/
      
       
  
   /*}*/
</style>

<section>
    
  
	<div class="row " style="width:100%">
	    <div class="col-lg-6 col-md-6 col-sm-12 " 
	    id="existing-customer">

			<h3 align="center" style="font-family:Georgia;font-size:18px;">Existing Customer</h3>
			<br>
			<br>
			<form   method="post" action="{{URL::to('auth')}}">
		
		
			<lable>Email Address</lable>
			<br>
		
						<input type="email" name="email" class="form-control">
				
				<input type="hidden" name="_token" value="{{csrf_token()}}">
		
			<lable>	Password</lable>
			<br>
			
			<input type="password" name="password" class="form-control">
			
			<br>
			<a href="{{URL::to('/forget-password')}}" style="text-decoration:underline">Forgot Password</a>
				<br>
						<input type="submit" value="Log In" style="display:inline-block;padding:10px 30px;border:1px solid #ccc;color:white;background-color:#034375">
			
					<br/>
						<p style="color:red">
						@if(isset($message))

						{{$message}}

						@endif
						</p>

		</form>

		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 " id="register-new"  >
		    					    @if(session('status'))
<!--<p class="alert alert-danger" style="margin-top:10px">{{Session::get('status') }}</p>-->
<div style="margin-top:10px" class="alert alert-danger alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Oops!</strong> {{Session::get('status') }}.
</div>
@endif

			<h3 align="center" style="font-family:Georgia;font-size:18px">Register Now</h3>
			<form method="post" action="{{URL::to('/createProfile')}}">
			
				<input type="hidden" name="_token" value="{{csrf_token()}}">
		                <lable>	Email Address</lable><br>
						<input type="email" name="email" class="form-control" required>
								<lable>Full Name</lable><br>
						<input type="text" name="fname" class="form-control" >
								<lable>	Country</lable><br>
						<input type="text" name="country" class="form-control" >
								<lable>	Phone No</lable><br>
						<input type="number" name="phone" class="form-control">
								<lable>	Company</lable><br>
						<input type="text" name="company" class="form-control" >
						
		             	<lable>		Password</lable>
			<br>
						<input type="password" name="password" class="form-control"required>
				<lable>	Repeat Password</lable><br>
						<input type="password" name="confirmpassword" class="form-control"required>
				<br>
						<input type="checkbox" name="confirmation1ForSignup" required > I confirm that I have read and accept this Privacy Policy.
				<br>
						<input type="submit" value="Next" style="display:inline-block;padding:10px 30px;border:1px solid #ccc;color:white;background-color:#034375">
			

			
		</form>

		</div>
		<div>
	



</section>

@endsection