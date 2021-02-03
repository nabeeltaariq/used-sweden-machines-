@extends("admin.templates.news")
@section("news_content")

    <h5>Edit News</h5>
    <hr/>
    @if(isset($message))
    <div class="alert alert-success">
        {{$message}}
    </div>
    @endif
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <label for="newsTitle">
            News Title
        <input type="text" class="form-control" name="newsTitle" id="newsTitle" value="{{$news->news_title}}" required>
        </label>
        <label for="newsDate">
            News Date
        <input type="date" name="newsDate" required placeholder="Try to use m/d/Y format" id="newsDate" class="form-control" value="{{$news->news_date}}">
        </label>
        <label for="image">
            Image
            <input type="file" name="imageToUpload" id="imageToUpload">
        <img src="{{URL::to('/storage/app/products/')}}/{{$news->image}}" class="img-thumbnail" style="max-height:100px">
        </label>
        <label for="images">
            Other Images
            <input type="file" name="imagesToUpload[]" id="imagesToUpload" multiple>

        </label>
        <label for="description">
            Description
            <textarea name="description" id="description">@php echo html_entity_decode($news->news_des) @endphp</textarea>
        </label>
        <input type="submit" value="Save News" class="btn btn-primary btn-block">
    </form>
    <form method="post" id="deleteForm" action="{{URL::to('/admin/news/removeImages')}}">
        @if(count($images) >= 1)
            <h3>Other images</h3>
        @endif
        @foreach($images as $image)

        <label style="display:inline-block;max-width:100px">
            <input type="checkbox" class="imgToDelete" name="imageToDelete[]" value="{{$image->id}}">
            <img src="{{URL::to('/storage/app/products/')}}/{{$image->imageUrl}}" class="img-thumbnail" style="max-width:100px">
        </label>
         <input type="hidden" name="_token" value="{{csrf_token()}}">
        @endforeach
        @if(count($images) >= 1)
            <input type="submit" value="Delete Selected Images" class="btn btn-danger btn-sm">
        @endif
    </form>
    <script>
        $("#deleteForm").on("submit",function(e){
            e.preventDefault();
          let length =  $(".imgToDelete:checked").length;
            if(length >= 1){
                $(this)[0].submit();
            }else{
                alert("It looks like you have not select any image");
            }
        });
    </script>
@endsection
