@extends("admin.templates.admin")

@section("content")
    <br/><br/>
    <div class="container">
        <div class="message">

        </div>
        <h4>User Management</h4>
        <a class="btn btn-primary" href="{{URL::to('/admin/addNewUser')}}"> <i class="fa fa-plus"></i> Add New User</a>
        <br><br>
        <table class="table table-striped table-bordered table-hover table-sm thead-dark">
            <thead>
            <tr>
                <th>Username</th>
                <th>Mobile No.</th>
                <th>User Role</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->username}}</td>
                    <td>{{$user->MobNo}}</td>
                    <td>
                        @if($user->roleId==1)
                            Admin
                        @endif
                        @if($user->roleId==0)
                            Custom User
                        @endif
                    </td>
                    <td>
                        <a href="{{URL::to('/admin/editUser')}}/{{$user->uId}}" class="btn btn-info"><i
                                class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                        <a href="#" userId="{{$user->uId}}" class="btn deleteUser btn-danger"><i
                                class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script>
        $('.deleteUser').on('click', function (e) {
            e.preventDefault();
            if (confirm('are you sure you want to remove user roles?')) {
                let userId = $(this).attr('userId');

                $.ajax({
                    url: '{{url("/admin/removeUser")}}/' + userId,
                    method: 'Post',
                    success: function (response) {
                        var message = response.message;
                        if (message){
                            $('.message').append('<div class="alert alert-success">' +message+ '</div>');
                            location.reload();
                        }

                    }
                });
            }

        });
    </script>
@endsection
