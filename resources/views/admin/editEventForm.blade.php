@extends("admin.templates.news")
@section("news_content")
<div class="container-fluid">
<h4>Edit Event</h4>
@if(isset($message))

<div class="alert alert-success">
    {{$message}}
</div>

@endif
<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{csrf_token()}}">
    <label for="">
        Event Title
    <input type="text" name="eventTitle" id="eventTitle" class="form-control" value="{{$event->eventName}}" required>
    </label>
    <label for="">
        Event Description
        <textarea name="description" id="description" required>@php echo html_entity_decode($event->eventDescription) @endphp</textarea>
    </label>
    <label for="">
        Date of Event
    <input type="date" name="dateOfEvent" id="dateOfEvent" value="{{$event->dateofevent}}">
    </label>
    <label for="">
        Featured Image
        <input type="file" name="featuredImage" id="featuredImage">
    <img src="{{URL::to('storage/app/event/')}}/{{$event->featuredImage}}" style="max-height:150px">
    </label>
    <label for="">
        Other Images
        <input type="file" name="otherImages[]" multiple>
       
    </label>
    <input type="submit" value="Save Event" class="btn btn-primary btn-block">
</form>
</div>
<br/>
<h4 class="bg-danger" style="color:white;padding:3px 0px">Manage Other Images of This Event</h4>
<br/>
<form action="" method="post">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="_method" value="delete">
    @foreach($pictures as $pic)
<label for="{{$pic->pictureId}}" style="width:200px;float:left">


<input type="checkbox" name="imageToRemove[]" id="{{$pic->pictureId}}" value="{{$pic->pictureId}}"><img src="{{URL::to('storage/app/event/')}}/{{$pic->pictureurl}}" class="img-thumbnail" style="max-height:100px;max-width:150px">
    </label>
@endforeach
<input type="submit" value="Delete Images" class="btn btn-danger">
</form>
@endsection