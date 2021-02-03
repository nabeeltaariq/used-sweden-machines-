@extends("admin.templates.contacts")
@section("contacts_content")
<h3>Edit Subscriber Email</h3>
<hr/>
@if(isset($message))
<div class="alert alert-success">
    {{$message}}
</div>
@endif
    <form action="" method="post">

        <p>
            Edit subscriber Email <input type="email" class="form-control" style="width:50%;display:inline-block" name="email" id="email" value="{{$subscriber->email_add}}">
            <input type="submit" value="Save Changes" class="btn btn-primary"> 
        </p>


    </form>


@endsection