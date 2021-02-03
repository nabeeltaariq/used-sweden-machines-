@extends("admin.templates.news")
@section("news_content")
<h3>Add New Testimonial</h3>
<form action="" method="post" enctype="multipart/form-data">
    @if(isset($message))
    <div class="alert alert-success">
        {{$message}}
    </div>
    @endif
<input type="hidden" name="_token" value="{{csrf_token()}}">
    <label for="companyName">
        Company Name
        <input type="text" name="companyName" id="companyName" value="{{$test->companyName}}" class="form-control">
    </label>
    <label for="personName">
        Person Name
        <input type="text" name="personName" value="{{$test->personName}}" id="personName" class="form-control">
    </label>
    <label for="testimonial">
        Testimonial
        <textarea id="testimonial" name="testimonial" class="form-control">{{$test->testimonial}}</textarea>
    </label>
    <label for="personDesignation">
        Person Designation
        <input type="text" name="personDesignation" id="personDesignation" value="{{$test->personDesignation}}" class="form-control">
    </label>
    <label for="sentDate">
       Sent Date
        <input type="date" name="sentDate" style="width:50%;display:inline-block" id="sentDate" class="form-control">
        <strong>Old Selected Date {{$test->sentDate}}</strong>
    </label>
    <label for="Brand Logo">
        Brand Logo
        <input type="file" name="fileToUpload" id="fileToUpload">
        <img src="{{URL::to('/storage/app/')}}/{{$test->brandLogo}}" style="max-height:150px" class="img-thumbnail"/>
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    </label>
    <input type="submit" value="Save Changes" class="btn btn-primary btn-block">
    @if(isset($message))

    <div class="alert alter-success">
        {{$message}}
    </div>

    @endif
</form>
@endsection