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
        <input type="text" name="companyName" id="companyName" class="form-control">
    </label>
    <label for="personName">
        Person Name
        <input type="text" name="personName" id="personName" class="form-control">
    </label>
    <label for="testimonial">
        Testimonial
        <textarea id="testimonial" name="testimonial" class="form-control"></textarea>
    </label>
    <label for="personDesignation">
        Person Designation
        <input type="text" name="personDesignation" id="personDesignation" class="form-control">
    </label>
    <label for="sentDate">
       Sent Date
        <input type="date" name="sentDate" id="sentDate" class="form-control">
    </label>
    <label for="Brand Logo">
        Brand Logo
        <input type="file" name="fileToUpload" id="fileToUpload">
    </label>
    <input type="submit" value="Save Testimonial" class="btn btn-primary btn-block">
</form>
@endsection