@extends("admin.templates.news")

@section("news_content")



    <h5>Add New News</h5>

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

            <input type="text" class="form-control" name="newsTitle" id="newsTitle" required>

        </label>

        <label for="newsDate">

            News Date

            <input type="date" name="newsDate" id="newsDate" class="form-control" required placeholder="use month/day/year format">

        </label>

        <label for="image">

            Image

            <input type="file" name="imageToUpload" id="imageToUpload" accept="image/*" required>*required

        </label>
        <label for="otherImages">
            Other Images
            <input type="file" name="imagesToUpload[]" id="imageToUpload" accept="image/*" multiple>
        </label>

        <label for="description">

            Description

            <textarea name="description" id="description"></textarea>

        </label>

        <input type="submit" value="Save News" class="btn btn-primary btn-block">

    </form>

@endsection
