@extends("admin.templates.admin")

@section("content")
<br/><br/>
<div class="container">
    <h4>User Management</h4>
    <a class="btn btn-primary" href="{{URL::to('/admin/addNewUser')}}"> <i class="fa fa-plus"></i> Add New User</a>
    <br><br>
    <table class="table table-striped table-bordered table-hover table-sm thead-dark" >
        <thead>
            <tr>
                <th>Username</th>
                <th>Phone No.</th>
                <th>User Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->username}}</td>
                    <td>{{$user->PhoneNo}}</td>
                    <td>
                        @if($user->roleId==1)
                            Admin
                        @endif
                        @if($user->roleId==0)
                            Custom User
                        @endif
                    </td>
                    <td>
                        <a href="{{URL::to('/admin/editUser')}}/{{$user->uId}}" class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
