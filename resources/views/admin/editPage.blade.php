@extends("admin.templates.admin")
<br/>
@section("content")
<div class="container-fluid">
    <h3>Edit Page <sup><code>{{$page->page_title}}</code></sup></h3>
    @if(isset($message))

        <div class="alert alert-success">
        {{$message}} <a href="{{URL::to('/admin/pages')}}" class="alert-link">Click Here to browse all page</a>
        </div>

    @endif
    <form action="" method="post">
        <label for="page_title">
            Title
        <input type="text" name="page_title" id="page_title" class="form-control" value="{{$page->page_title}}">
        </label>
    <input type="hidden" name="_token" value="{{csrf_token()}}">
        <label for="description">
            Webpage Content
            <textarea name="description" id="description">
                @php
                    
                    echo $page->page_contents

                @endphp
            </textarea>
        </label>
        <label for="keywords">
            Meta Keywords
        <input type="text" name="keywords" id="keywords" class="form-control" value="{{$page->meta_key}}">
        </label>
        <label for="meta_description">
            Meta Description
            <textarea name="meta_description" id="meta_description" class="form-control">{{$page->meta_des}}</textarea>
        </label>
        <input type="submit" value="Save Changes" class="btn btn-primary btn-block">
    </form>
</div>
<style>

</style>
@endsection