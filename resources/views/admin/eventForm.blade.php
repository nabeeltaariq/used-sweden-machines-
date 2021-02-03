@extends("admin.templates.news")
@section("news_content")
<div class="container-fluid">
<h4>Add New Event</h4>
@if(isset($message))

<div class="alert alert-success">
    {{$message}}
</div>

@endif
<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{csrf_token()}}">
    <label for="">
        Event Title
        <input type="text" name="eventTitle" id="eventTitle" class="form-control" required>
    </label>
    <label for="">
        Event Description
        <textarea name="description" id="description" required></textarea>
    </label>
    <label for="">
        Date of Event
        <input type="date" name="dateOfEvent" id="dateOfEvent">
    </label>
    <label for="">
        Featured Image
        <input type="file" name="featuredImage" id="featuredImage" required>
    </label>
    <label for="">
        Other Images
        <input type="file" name="otherImages[]" multiple>
    </label>
    <input type="submit" value="Save Event" class="btn btn-primary btn-block">
</form>
</div>
@endsection