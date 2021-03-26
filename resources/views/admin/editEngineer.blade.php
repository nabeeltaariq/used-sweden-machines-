@extends("admin.templates.products")
@section("products_content")
<div class="container">
    <br/>
    <h4>Edit Engineer</h4>
    <hr/>
    <form action="../updateEngineer" method="POST">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="id" value="{{$engineer->engineerId}}">

        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-12">
                <b> Country</b>
            </div>
            <div class="col-lg-9 col-md-8 col-sm-12">
                <select   name="country" style="width:100%">
                    @foreach ($allCounteries as  $country)
                  
                     

                     @if ( $country->country_name  == $engineer_team->country )
                     <option value="{{ $country->country_name }}" selected>{{ $country->country_name }}</option>
                 @else
                 <option value="{{ $country->country_name }}" >{{ $country->country_name }}</option>
                 @endif


                    @endforeach



                                 </select>
                               
            </div>
         
            <div class="col-lg-3 col-md-4 col-sm-12" style="margin-top:10px">
                <b> Name</b>
            </div>
            <div class="col-lg-3 col-md-8 col-sm-12" style="margin-top:10px">
                 <input type="text" name="name" value="{{$engineer->teamPersonName}}" />
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12" style="margin-top:10px">
                <b> Email</b>
            </div>
            <div class="col-lg-3 col-md-8 col-sm-12" style="margin-top:10px">
                 <input type="email" name="email" value="{{$engineer->email}}" />
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12">
                <b> Cnic</b>
            </div>
            <div class="col-lg-3 col-md-8 col-sm-12">
                 <input type="text" name="cnic"  value="{{$engineer_team->cnicPassport}}"/>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12">
                <b> Mobile No</b>
            </div>
            <div class="col-lg-3 col-md-8 col-sm-12">
                 <input type="text" name="mob_no" value="{{$engineer->mobileNo}}" />
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12">
                <b> LinkdIn</b>
            </div>
            <div class="col-lg-3 col-md-8 col-sm-12">
                 <input type="text" name="linkdin" value="{{$engineer->linkdIn}}" />
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-12">
                <b> Nationality</b>
            </div>
            <div class="col-lg-3 col-md-8 col-sm-12">
                 <input type="text" name="nationality" value="{{$engineer_team->nationality}}" />

            </div>
            <div class="col-lg-3 col-md-4 col-sm-12">
                <b> Date of Birth</b>
            </div>
            <div class="col-lg-3 col-md-8 col-sm-12">
                 <input type="text" name="dob" value="{{$engineer_team->dateOfBirth}}" />
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12">
                <b> Jobs can perform</b>
            </div>
            <div class="col-lg-3 col-md-8 col-sm-12">
                 <input type="text" name="jcp" value="{{$engineer_team->experienceMechanic}}" />
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12">
                <b> Wrokshop Details</b>
            </div>
            <div class="col-lg-3 col-md-8 col-sm-12">
                 <input type="text" name="wdetails" value="{{$engineer_team->workshopDetails}}" />
            </div>
        <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top:10px;">
            <input type="submit" name="submit" style="float: right;background-color:#034375;color:white"  class="btn"/>
        </div>
         
        </div>

    </form>
</div>
<style>
    label{
        width:100%;
    }
</style>
@endsection