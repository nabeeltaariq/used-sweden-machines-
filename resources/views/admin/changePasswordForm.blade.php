@extends("admin.templates.admin")
@section("content")
<br/><br/>
<div class="container">
    <h4>Change your password</h4>
   <form action="" method="post">
        <label for="password">
            Enter New Password
            <input type="text" name="password" id="password" class="form-control" required>
        </label>
        <label for="confirmPassword">
            Confirm New Password
            <input type="text" name="confirmPassword" id="confirmPassword" class="form-control" required>
        </label>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="submit" value="Save New Password" class="btn btn-primary btn-block">
        @if(isset($error))

            <div class="alert alert-danger">{{$error}}</div>

        @endif
        @if(isset($success))

        <div class="alert alert-success">{{$success}}</div>

        @endif
    </form>
</div>
@endsection
